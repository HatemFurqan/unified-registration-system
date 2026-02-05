# خطة النشر الكاملة - Unified Registration System

## ✅ الملفات الجاهزة

- ✅ `Dockerfile` - جاهز
- ✅ `docker-compose.yml` - جاهز
- ✅ `nginx-app.conf` - جاهز
- ✅ `local.ini` - جاهز
- ✅ `git_pull.sh` - جاهز

---

## 📋 الخطوات المتبقية على السيرفر

### المرحلة 1: إعداد الملفات الأساسية

#### 1.1 رفع الملفات إلى السيرفر

```bash
# على السيرفر
cd /docker

# إنشاء المجلد
mkdir -p unified-registration-system
cd unified-registration-system

# استنساخ المشروع (إذا كان موجود على Git)
# أو رفع الملفات عبر SFTP
```

#### 1.2 إعداد ملف .env

```bash
# نسخ ملف البيئة
cp .env.production.example .env

# تعديل ملف .env
nano .env
```

**إعدادات مهمة في `.env`:**
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

# باقي المتغيرات المطلوبة...
```

**⚠️ مهم جداً:**
- `APP_URL` يجب أن ينتهي ب `/`
- `DB_HOST` يجب أن يكون `mysql_db` (اسم حاوية MySQL)

---

### المرحلة 2: إعداد الصلاحيات

```bash
# تغيير ملكية الملفات
sudo chown -R hatem:hatem /docker/furqan-shop/registration-forms/unified-registration-system

# إعطاء الصلاحيات
sudo chmod -R 777 /docker/furqan-shop/registration-forms/unified-registration-system

# إنشاء ملفات السجلات
# المسار الكامل: /docker/furqan-shop/registration-forms/unified-registration-system/storage/logs/nginx/
cd /docker/furqan-shop/registration-forms/unified-registration-system
sudo mkdir -p storage/logs/nginx
sudo touch storage/logs/nginx/error.log
sudo touch storage/logs/nginx/access.log
sudo chmod 666 storage/logs/nginx/*.log
```

---

### المرحلة 3: بناء وتشغيل Docker

#### 3.1 بناء الصورة

```bash
cd /docker/furqan-shop/registration-forms/unified-registration-system

# بناء الصورة
docker compose build --no-cache
```

#### 3.2 تشغيل الحاويات

```bash
# تشغيل الحاويات
docker compose up -d

# التحقق من الحالة
docker compose ps

# يجب أن ترى:
# - unified-registration-app (Up)
# - unified-registration-server (Up)
```

---

### المرحلة 4: إعداد Laravel

#### 4.1 إصلاح Git ownership (إذا لزم)

```bash
docker exec -it unified-registration-app bash -c 'git config --global --add safe.directory /var/www'
```

#### 4.2 تشغيل Composer Install

```bash
# تشغيل composer install
docker exec -it unified-registration-app composer install --ignore-platform-reqs --no-dev --optimize-autoloader --no-interaction

# التحقق من vendor
docker exec -it unified-registration-app ls -la vendor
```

#### 4.3 إعداد Laravel الأساسي

```bash
# توليد مفتاح التطبيق
docker exec -it unified-registration-app php artisan key:generate

# تشغيل Migrations
docker exec -it unified-registration-app php artisan migrate --force

# تشغيل Seeders (اختياري)
docker exec -it unified-registration-app php artisan db:seed --force

# إنشاء رابط التخزين
docker exec -it unified-registration-app php artisan storage:link
```

#### 4.4 إعداد الصلاحيات داخل الحاوية

```bash
# إصلاح الصلاحيات
docker exec -it unified-registration-app chmod -R 775 storage bootstrap/cache
docker exec -it unified-registration-app chown -R hatem:hatem storage bootstrap/cache
```

#### 4.5 تحسين الأداء (Cache)

```bash
# تفعيل الكاش
docker exec -it unified-registration-app php artisan config:cache
docker exec -it unified-registration-app php artisan route:cache
docker exec -it unified-registration-app php artisan view:cache
```

---

### المرحلة 5: التحقق من التشغيل

#### 5.1 التحقق من الحاويات

```bash
# عرض حالة الحاويات
docker compose ps

# يجب أن تكون جميع الحاويات في حالة "Up"
```

#### 5.2 التحقق من السجلات

```bash
# سجلات التطبيق
docker compose logs app

# سجلات Nginx
docker compose logs nginx
```

#### 5.3 اختبار الاتصال

```bash
# اختبار من السيرفر
curl http://localhost/unified-registration/

# أو من المتصفح
# https://furqanshop.com/unified-registration/
```

---

### المرحلة 6: إعداد قاعدة البيانات (إذا لم تكن موجودة)

#### 6.1 التحقق من حاوية MySQL

```bash
# عرض جميع الحاويات
docker ps -a | grep mysql

# أو
docker ps -a | grep db
```

#### 6.2 إنشاء قاعدة البيانات (إذا لزم)

```bash
# الدخول إلى حاوية MySQL
docker exec -it mysql_db mysql -u root -p

# داخل MySQL:
CREATE DATABASE unified_registration CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'unified_registration_user'@'%' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON unified_registration.* TO 'unified_registration_user'@'%';
FLUSH PRIVILEGES;
EXIT;
```

---

## 🔄 التحديثات المستقبلية

### استخدام git_pull.sh

```bash
# إعطاء صلاحيات التنفيذ
chmod +x git_pull.sh

# تشغيل السكريبت
sudo ./git_pull.sh
```

**ملاحظة:** السكريبت يقوم بـ:
- سحب التحديثات من Git
- تشغيل composer install
- تحديث المشروع تلقائياً

---

## ✅ Checklist النهائي

قبل اعتبار المشروع جاهزاً، تأكد من:

- [ ] ملف `.env` معد بشكل صحيح
- [ ] `APP_URL` يحتوي على المسار الكامل مع `/` في النهاية
- [ ] `DB_HOST` هو `mysql_db`
- [ ] قاعدة البيانات موجودة ومعدة
- [ ] تم بناء الصورة بنجاح
- [ ] الحاويات تعمل (Up)
- [ ] تم تشغيل composer install
- [ ] تم تشغيل Migrations
- [ ] تم إنشاء vendor
- [ ] الصلاحيات صحيحة
- [ ] تم تفعيل الكاش
- [ ] التطبيق يعمل على https://furqanshop.com/unified-registration/

---

## 🐛 استكشاف الأخطاء الشائعة

### المشكلة: vendor غير موجود

```bash
# الحل: تشغيل composer install
docker exec -it unified-registration-app composer install --ignore-platform-reqs --no-dev --optimize-autoloader --no-interaction
```

### المشكلة: Database Connection Error

```bash
# التحقق من DB_HOST في .env
cat .env | grep DB_HOST
# يجب أن يكون: DB_HOST=mysql_db

# اختبار الاتصال
docker exec -it unified-registration-app php artisan tinker
# DB::connection()->getPdo();
```

### المشكلة: Permission Denied

```bash
# إصلاح الصلاحيات
sudo chown -R hatem:hatem /docker/furqan-shop/registration-forms/unified-registration-system
docker exec -it unified-registration-app chmod -R 775 storage bootstrap/cache
docker exec -it unified-registration-app chown -R hatem:hatem storage bootstrap/cache
```

### المشكلة: Nginx Restarting

```bash
# إنشاء ملفات السجلات
sudo touch storage/logs/nginx/error.log storage/logs/nginx/access.log
sudo chmod 666 storage/logs/nginx/*.log

# أو إزالة ربط السجلات من docker-compose.yml
```

---

## 📝 ملاحظات مهمة

1. **النسخ الاحتياطي**: قم بعمل نسخ احتياطي لقاعدة البيانات بانتظام
2. **الأمان**: استخدم كلمات مرور قوية في `.env`
3. **المراقبة**: راقب السجلات بانتظام
4. **التحديثات**: استخدم `git_pull.sh` للتحديثات

---

## 🎯 الخلاصة

بعد إكمال جميع الخطوات أعلاه، المشروع سيكون:
- ✅ جاهز للتشغيل
- ✅ متصل بقاعدة البيانات
- ✅ يعمل على https://furqanshop.com/unified-registration/
- ✅ جاهز للتحديثات عبر git_pull.sh
