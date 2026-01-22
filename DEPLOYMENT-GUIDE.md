# دليل النشر على Hostinger VPS مع Traefik

## 📋 المتطلبات

- Docker و Docker Compose مثبتان على السيرفر
- Traefik يعمل على السيرفر مع network اسمه `proxy`
- قاعدة بيانات MySQL موجودة (مثل `mysql_db`)
- معرفات المستخدم (uid/gid) - افتراضياً: `ayman` (1003:1003)

## 🚀 خطوات النشر

### 1. رفع الملفات إلى السيرفر

```bash
# عبر Git
git clone [your-repo-url]
cd unified-registration-system

# أو عبر SFTP - ارفع جميع الملفات
```

### 2. إعداد ملف البيئة (.env)

```bash
cp .env.production.example .env
```

قم بتعديل ملف `.env`:

```env
APP_NAME="Unified Registration System"
APP_ENV=prod
APP_DEBUG=false
APP_URL=https://furqanshop.com/unified-registration/

DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=unified_registration
DB_USERNAME=unified_registration_user
DB_PASSWORD=your_secure_password

# باقي المتغيرات...
```

**مهم جداً:**
- `APP_URL` يجب أن ينتهي ب `/` ويحتوي على المسار الفرعي
- `DB_HOST` يجب أن يكون اسم حاوية MySQL (مثل `mysql_db`)

### 3. تعديل docker-compose.yml (إذا لزم الأمر)

تحقق من:
- **user, uid, gid**: تأكد من أن القيم صحيحة للمستخدم على السيرفر
- **PathPrefix**: تأكد من أن المسار `/unified-registration` صحيح
- **Domain**: تأكد من أن `furqanshop.com` هو النطاق الصحيح

```yaml
services:
  app:
    build:
      args:
        user: ayman      # غيّر إذا لزم الأمر
        uid: 1003        # غيّر إذا لزم الأمر
        gid: 1003        # غيّر إذا لزم الأمر
```

### 4. بناء وتشغيل الحاويات

```bash
# بناء الصورة
docker-compose build

# تشغيل الحاويات
docker-compose up -d

# عرض السجلات
docker-compose logs -f
```

### 5. إعداد Laravel

```bash
# الدخول إلى حاوية التطبيق
docker-compose exec app sh

# داخل الحاوية:
# توليد مفتاح التطبيق
php artisan key:generate

# تشغيل Migrations
php artisan migrate --force

# تشغيل Seeders (اختياري)
php artisan db:seed --force

# إنشاء رابط التخزين
php artisan storage:link

# تحسين الأداء
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. إعداد الصلاحيات

```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R ayman:ayman storage bootstrap/cache
```

## 🔧 التكوين

### Traefik Labels

الملصقات في `docker-compose.yml` تقوم بـ:
- تفعيل Traefik للحاوية
- تعيين القاعدة: `Host(furqanshop.com) && PathPrefix(/unified-registration)`
- إضافة middleware لإضافة `/` في النهاية
- تفعيل SSL مع Cloudflare resolver
- إضافة security headers

### Nginx Configuration

ملف `docker/nginx-app.conf`:
- يستمع على البورت 80
- يخدم الملفات من `/var/www/public`
- يوجّه PHP requests إلى `app:9000` (PHP-FPM)
- يدعم المسار الفرعي `/unified-registration`

### PHP-FPM Configuration

ملف `docker/php-fpm.conf`:
- يعمل كـ user `ayman`
- يستمع على البورت 9000
- إعدادات pool محسّنة للأداء

## 📝 ملاحظات مهمة

### 1. المسار الفرعي

Laravel يحتاج إلى معرفة أنه يعمل في مسار فرعي:
- تأكد من أن `APP_URL` يحتوي على المسار الكامل
- Nginx يتعامل مع إعادة التوجيه تلقائياً

### 2. قاعدة البيانات

- تأكد من أن `DB_HOST` هو اسم حاوية MySQL الصحيحة
- إذا كانت قاعدة البيانات على حاوية منفصلة، تأكد من أنها على نفس network `proxy`

### 3. الصلاحيات

- الملفات يجب أن تكون مملوكة للمستخدم الصحيح (ayman:ayman)
- `storage` و `bootstrap/cache` يجب أن تكون قابلة للكتابة (775)

### 4. الأمان

- `APP_DEBUG=false` في الإنتاج
- `APP_ENV=prod` في الإنتاج
- استخدم كلمات مرور قوية

## 🐛 استكشاف الأخطاء

### المشكلة: 404 Not Found

**الحل:**
1. تحقق من Traefik labels في `docker-compose.yml`
2. تحقق من `APP_URL` في `.env`
3. تحقق من logs: `docker-compose logs nginx`

### المشكلة: Database Connection Error

**الحل:**
1. تحقق من `DB_HOST` في `.env` (يجب أن يكون اسم الحاوية)
2. تحقق من أن قاعدة البيانات على نفس network
3. اختبر الاتصال: `docker-compose exec app php artisan db:monitor`

### المشكلة: Permission Denied

**الحل:**
```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R ayman:ayman storage bootstrap/cache
```

### المشكلة: Assets لا تعمل

**الحل:**
1. تحقق من `APP_URL` يحتوي على المسار الكامل
2. أعد بناء الأصول: `docker-compose exec app npm run production`
3. امسح الكاش: `docker-compose exec app php artisan view:clear`

## 🔄 التحديثات

```bash
# سحب التحديثات
git pull

# إعادة بناء
docker-compose build --no-cache

# إعادة التشغيل
docker-compose up -d

# تشغيل Migrations الجديدة
docker-compose exec app php artisan migrate --force

# تحديث الكاش
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

## 📊 المراقبة

```bash
# عرض السجلات
docker-compose logs -f app
docker-compose logs -f nginx

# عرض حالة الحاويات
docker-compose ps

# استخدام الموارد
docker stats
```

## ✅ Checklist قبل النشر

- [ ] ملف `.env` معد بشكل صحيح
- [ ] `APP_URL` يحتوي على المسار الكامل مع `/` في النهاية
- [ ] `DB_HOST` هو اسم حاوية MySQL الصحيحة
- [ ] user/uid/gid صحيحة في `docker-compose.yml`
- [ ] Traefik labels صحيحة (domain, path)
- [ ] تم بناء الصورة بنجاح
- [ ] تم تشغيل Migrations
- [ ] الصلاحيات صحيحة
- [ ] تم تفعيل الكاش
- [ ] تم اختبار الوصول للتطبيق
