# Docker Setup - Unified Registration System

## 📁 الملفات المطلوبة

### ملفات Docker الأساسية
- `Dockerfile` - صورة Docker للتطبيق
- `docker-compose.yml` - إعداد Docker Compose مع Traefik
- `docker-entrypoint.sh` - سكريبت بدء التشغيل
- `.dockerignore` - ملفات مستثناة من البناء

### ملفات التكوين (في `docker/`)
- `nginx-app.conf` - إعدادات Nginx للمسار الفرعي
- `php-fpm.conf` - إعدادات PHP-FPM
- `local.ini` - إعدادات PHP المحلية

### ملفات التوثيق
- `DEPLOYMENT-GUIDE.md` - دليل النشر الكامل
- `.env.production.example` - مثال لملف البيئة

---

## 🖥️ التشغيل المحلي (للاختبار)

### 1. إعداد ملف البيئة

```bash
# نسخ ملف البيئة
cp .env.example .env

# تعديل ملف .env
# تأكد من:
# - DB_HOST=127.0.0.1 (أو اسم حاوية MySQL إذا كنت تستخدم Docker)
# - APP_URL=http://localhost:8000
# - APP_DEBUG=true
```

### 2. بناء الصورة

```bash
# بناء صورة Docker
docker-compose build

# أو إعادة بناء من الصفر
docker-compose build --no-cache
```

### 3. تشغيل الحاويات

```bash
# تشغيل في الخلفية
docker-compose up -d

# أو تشغيل مع عرض السجلات
docker-compose up
```

### 4. إعداد Laravel

```bash
# توليد مفتاح التطبيق
docker-compose exec app php artisan key:generate

# تشغيل Migrations
docker-compose exec app php artisan migrate

# تشغيل Seeders (اختياري)
docker-compose exec app php artisan db:seed

# إنشاء رابط التخزين
docker-compose exec app php artisan storage:link

# تحسين الأداء
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

### 5. الوصول للتطبيق

- **التطبيق**: http://localhost:8000
- **phpMyAdmin** (إذا كان مفعّل): http://localhost:8080

### 6. عرض السجلات

```bash
# جميع السجلات
docker-compose logs -f

# سجلات التطبيق فقط
docker-compose logs -f app

# سجلات Nginx
docker-compose logs -f nginx
```

### 7. إيقاف الحاويات

```bash
# إيقاف الحاويات
docker-compose down

# إيقاف وحذف البيانات (volumes)
docker-compose down -v
```

---

## 🚀 الرفع والتشغيل على السيرفر (Hostinger VPS)

### 📍 معلومات السيرفر

- **المسار الرئيسي للمشاريع**: `/docker`
- **المسار المطلوب للمشروع**: `/docker/unified-registration-system`
- **المستخدم**: `hatem`
- **طريقة الاتصال**: SSH فقط

### المتطلبات على السيرفر

- Docker و Docker Compose مثبتان
- Traefik يعمل مع network اسمه `proxy`
- قاعدة بيانات MySQL موجودة (مثل `mysql_db`)
- معرفات المستخدم (uid/gid) - افتراضياً: `ayman` (1003:1003)

---

### الخطوة 1: الاتصال بالسيرفر

```bash
# من جهازك المحلي
ssh hatem@your-server-ip

# بعد الاتصال، ستكون في المجلد الرئيسي
# للانتقال إلى مجلد المشاريع:
cd /docker
```

---

### الخطوة 2: رفع الملفات إلى السيرفر

**📍 المسار المطلوب:** `/docker/unified-registration-system`

#### الطريقة الأولى: عبر Git (مُوصى بها)

```bash
# على السيرفر - بعد الاتصال عبر SSH
cd /docker

# استنساخ المشروع
git clone [your-repo-url] unified-registration-system

# الانتقال إلى مجلد المشروع
cd unified-registration-system

# التحقق من الموقع
pwd
# يجب أن يظهر: /docker/unified-registration-system
```

#### الطريقة الثانية: عبر SFTP

1. **استخدم FileZilla أو WinSCP أو أي عميل SFTP**
2. **اتصل بالسيرفر:**
   - **Host**: عنوان IP السيرفر
   - **Username**: `hatem`
   - **Port**: 22 (SSH)
   - **Password**: كلمة مرور SSH
3. **انتقل إلى المسار:** `/docker`
4. **أنشئ مجلد جديد اسمه:** `unified-registration-system`
5. **ارفع جميع الملفات** إلى هذا المجلد:
   - `Dockerfile`
   - `docker-compose.yml`
   - `docker-entrypoint.sh`
   - `.dockerignore`
   - مجلد `docker/` (بكل محتوياته)
   - جميع ملفات المشروع (app, config, database, resources, routes, public, إلخ)

#### الطريقة الثالثة: رفع ملف مضغوط (ZIP)

```bash
# على جهازك المحلي: اضغط المشروع في ملف ZIP
# ثم على السيرفر:

# الاتصال بالسيرفر
ssh hatem@your-server-ip

# الانتقال إلى مجلد المشاريع
cd /docker

# رفع الملف (من جهازك المحلي)
# scp unified-registration-system.zip hatem@server-ip:/docker/

# فك الضغط
unzip unified-registration-system.zip

# إعادة تسمية المجلد إذا لزم الأمر
mv unified-registration-system-main unified-registration-system

# الانتقال إلى المجلد
cd unified-registration-system
```

---

### الخطوة 3: إعداد ملف البيئة

```bash
# على السيرفر - تأكد أنك في المجلد الصحيح
cd /docker/unified-registration-system

# التحقق من الموقع الحالي
pwd
# يجب أن يظهر: /docker/unified-registration-system

# التحقق من وجود الملفات
ls -la
# يجب أن ترى: Dockerfile, docker-compose.yml, docker-entrypoint.sh

# نسخ ملف البيئة
cp .env.production.example .env

# تعديل ملف .env
nano .env
# أو
vi .env
```

**إعدادات مهمة في `.env`:**

```env
APP_NAME="Unified Registration System"
APP_ENV=prod
APP_DEBUG=false
APP_URL=https://furqanshop.com/unified-registration/

DB_CONNECTION=mysql
DB_HOST=mysql_db                    # اسم حاوية MySQL
DB_PORT=3306
DB_DATABASE=unified_registration
DB_USERNAME=unified_registration_user
DB_PASSWORD=your_secure_password

# باقي المتغيرات المطلوبة...
```

**⚠️ مهم جداً:**
- `APP_URL` يجب أن ينتهي ب `/` ويحتوي على المسار الفرعي الكامل
- `DB_HOST` يجب أن يكون اسم حاوية MySQL (مثل `mysql_db`)

**للخروج من nano:** اضغط `Ctrl+X` ثم `Y` ثم `Enter`  
**للخروج من vi:** اضغط `Esc` ثم اكتب `:wq` ثم `Enter`

---

### الخطوة 4: تعديل docker-compose.yml (إذا لزم الأمر)

```bash
# تعديل الملف
nano docker-compose.yml
```

تحقق من:
- **user, uid, gid**: تأكد من القيم الصحيحة للمستخدم على السيرفر
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

**للتأكد من uid/gid على السيرفر:**
```bash
id ayman
# أو
id $USER
```

---

### الخطوة 5: التحقق من Network

```bash
# التحقق من وجود network proxy
docker network ls | grep proxy

# يجب أن ترى network اسمه "proxy"
# إذا لم يكن موجوداً، أنشئه:
docker network create proxy

# ملاحظة: في معظم الحالات، network "proxy" موجود مسبقاً
# لأن Traefik يستخدمه
```

---

### الخطوة 6: بناء الصورة

```bash
# تأكد أنك في المجلد الصحيح
cd /docker/unified-registration-system

# بناء صورة Docker
docker-compose build

# أو إعادة بناء من الصفر (إذا كان هناك مشاكل)
docker-compose build --no-cache

# ملاحظة: عملية البناء قد تستغرق عدة دقائق
# انتظر حتى تنتهي العملية
```

---

### الخطوة 7: تشغيل الحاويات

```bash
# تأكد أنك في المجلد الصحيح
cd /docker/unified-registration-system

# تشغيل الحاويات في الخلفية
docker-compose up -d

# عرض حالة الحاويات
docker-compose ps

# يجب أن ترى حاويتين:
# - unified-registration-app (Running)
# - unified-registration-webserver (Running)

# عرض السجلات
docker-compose logs -f

# للخروج من عرض السجلات: اضغط Ctrl+C
```

---

### الخطوة 8: إعداد Laravel

```bash
# تأكد أنك في المجلد الصحيح
cd /docker/unified-registration-system

# توليد مفتاح التطبيق
docker-compose exec app php artisan key:generate

# تشغيل Migrations
docker-compose exec app php artisan migrate --force

# تشغيل Seeders (اختياري)
docker-compose exec app php artisan db:seed --force

# إنشاء رابط التخزين
docker-compose exec app php artisan storage:link

# إعداد الصلاحيات
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R ayman:ayman storage bootstrap/cache

# تحسين الأداء (في الإنتاج)
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

---

### الخطوة 9: التحقق من التشغيل

```bash
# عرض حالة الحاويات
docker-compose ps

# يجب أن تكون جميع الحاويات في حالة "Up"

# عرض السجلات
docker-compose logs -f app
docker-compose logs -f nginx

# للخروج من عرض السجلات: اضغط Ctrl+C

# اختبار الاتصال بقاعدة البيانات
docker-compose exec app php artisan tinker
# ثم في Tinker:
# DB::connection()->getPdo();
# إذا نجح، ستظهر معلومات الاتصال
# للخروج: اكتب exit
```

---

### الخطوة 10: الوصول للتطبيق

بعد اكتمال الإعداد، يجب أن يكون التطبيق متاحاً على:
- **https://furqanshop.com/unified-registration/**

**للتحقق:**
```bash
# اختبار من السيرفر نفسه
curl http://localhost/unified-registration/

# أو من المتصفح على جهازك
# افتح: https://furqanshop.com/unified-registration/
```

---

## 🔄 التحديثات المستقبلية

### عند وجود تحديثات في الكود:

```bash
# على السيرفر
cd /docker/unified-registration-system

# سحب التحديثات (إذا كنت تستخدم Git)
git pull

# إعادة بناء الصورة
docker-compose build

# إعادة تشغيل الحاويات
docker-compose up -d

# تشغيل Migrations الجديدة (إن وجدت)
docker-compose exec app php artisan migrate --force

# تحديث الكاش
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

---

## 🛠️ الأوامر المفيدة

### عرض السجلات
```bash
# جميع السجلات
docker-compose logs -f

# سجلات التطبيق
docker-compose logs -f app

# سجلات Nginx
docker-compose logs -f nginx

# آخر 100 سطر
docker-compose logs --tail=100 app
```

### إدارة الحاويات
```bash
# إيقاف الحاويات
docker-compose stop

# إعادة تشغيل الحاويات
docker-compose restart

# إيقاف وحذف الحاويات
docker-compose down

# إيقاف وحذف البيانات
docker-compose down -v
```

### تنفيذ أوامر Artisan
```bash
# أي أمر Artisan
docker-compose exec app php artisan [command]

# أمثلة:
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

### الدخول إلى الحاويات
```bash
# الدخول إلى حاوية التطبيق
docker-compose exec app sh

# الدخول إلى حاوية Nginx
docker-compose exec nginx sh

# للخروج من الحاوية: اكتب exit
```

### عرض استخدام الموارد
```bash
# استخدام الموارد
docker stats

# معلومات الحاويات
docker-compose ps
```

---

## 🐛 استكشاف الأخطاء

### المشكلة: Network 'proxy' not found

```bash
# إنشاء network
docker network create proxy
```

### المشكلة: Permission denied

```bash
# إصلاح الصلاحيات
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R ayman:ayman storage bootstrap/cache
```

### المشكلة: Database Connection Error

1. تحقق من `DB_HOST` في `.env` (يجب أن يكون اسم حاوية MySQL)
2. تحقق من أن قاعدة البيانات على نفس network `proxy`
3. اختبر الاتصال:
```bash
docker-compose exec app php artisan tinker
# DB::connection()->getPdo();
```

### المشكلة: 404 Not Found

1. تحقق من Traefik labels في `docker-compose.yml`
2. تحقق من `APP_URL` في `.env`
3. تحقق من logs: `docker-compose logs nginx`

### المشكلة: Assets لا تعمل

1. تحقق من `APP_URL` يحتوي على المسار الكامل
2. أعد بناء الأصول:
```bash
docker-compose exec app npm install
docker-compose exec app npm run production
```

### المشكلة: الحاوية لا تبدأ

```bash
# عرض السجلات المفصلة
docker-compose logs app

# إعادة بناء من الصفر
docker-compose build --no-cache
docker-compose up -d
```

---

## ✅ Checklist قبل النشر

- [ ] ملف `.env` معد بشكل صحيح
- [ ] `APP_URL` يحتوي على المسار الكامل مع `/` في النهاية
- [ ] `DB_HOST` هو اسم حاوية MySQL الصحيحة
- [ ] user/uid/gid صحيحة في `docker-compose.yml`
- [ ] Traefik labels صحيحة (domain, path)
- [ ] Network `proxy` موجود
- [ ] تم بناء الصورة بنجاح
- [ ] تم تشغيل الحاويات بنجاح
- [ ] تم تشغيل Migrations
- [ ] الصلاحيات صحيحة
- [ ] تم تفعيل الكاش
- [ ] تم اختبار الوصول للتطبيق

---

## 📖 للمزيد من التفاصيل

راجع `DEPLOYMENT-GUIDE.md` للدليل الكامل والمفصل.
