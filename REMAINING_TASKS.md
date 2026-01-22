# المهام المتبقية في عملية دمج وتوحيد المشروع

**تاريخ التحديث**: 15 يناير 2026  
**الحالة الحالية**: تم نسخ ملفات الترجمة (lang) ✅

---

## 📊 ملخص الحالة العامة

### ✅ ما تم إنجازه (100%)

1. ✅ **البنية الأساسية**: المشروع الموحد جاهز
2. ✅ **Controllers**: جميع Controllers موجودة (17/17)
3. ✅ **Models**: جميع Models موجودة (15/15)
4. ✅ **Migrations**: جميع Migrations موجودة (23/23)
5. ✅ **Routes**: جميع Routes موجودة ومحدثة
6. ✅ **Views**: جميع Views موجودة (Registration Forms + Dashboard)
7. ✅ **Services**: جميع Services موجودة
8. ✅ **Helpers & Traits**: جميع Helpers موجودة
9. ✅ **Dashboard**: مكتمل 100% (Controllers, Views, Routes)
10. ✅ **Permissions Middleware**: مفعّل في Routes
11. ✅ **Translations**: تم نسخ ملفات الترجمة (ar.json, en.json) ✅

---

## 🔴 أولوية عالية - يجب إكمالها قبل التشغيل

### 1. إعداد ملف `.env` ⚠️

**الحالة**: ❌ غير موجود أو غير مكتمل

**المتغيرات المطلوبة:**

```env
# Laravel Basic
APP_NAME="Unified Registration System"
APP_ENV=local
APP_KEY=                    # يجب توليده: php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=unified_registration
DB_USERNAME=root
DB_PASSWORD=

# Checkout.com Payment Gateway
CHECKOUT_PK=               # Public Key
CHECKOUT_SK=               # Secret Key
CHECKOUT_MODE=sandbox      # أو live

# PayPal Payment Gateway
PAYPAL_MODE=sandbox        # أو live
PAYPAL_CLIENT_ID=
PAYPAL_CLIENT_SECRET=
PAYPAL_APP_ID=

# Google Sheets Integration
GOOGLE_SHEET_ID=
GOOGLE_CREDENTIALS_PATH=   # مسار ملف credentials.json
GOOGLE_TOKEN_PATH=         # مسار ملف token.json

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"

# Queue Configuration
QUEUE_CONNECTION=database   # أو redis, sync

# Serial Numbers (من المشاريع الأصلية)
LAST_NEW_SERIAL_NUMBER_MALES=0
LAST_NEW_SERIAL_NUMBER_FEMALES=0
```

**الخطوات:**
1. نسخ `.env.example` إلى `.env`
2. ملء جميع المتغيرات المطلوبة
3. تشغيل `php artisan key:generate`

---

### 2. تشغيل Migrations ⚠️

**الحالة**: ❌ لم يتم تشغيل Migrations بعد

**الأوامر المطلوبة:**
```bash
cd "D:\Furqan Group\unified-registration-system"
php artisan migrate
```

**الجداول التي سيتم إنشاؤها:**
- `subscribes` - الاشتراكات
- `students` - الطلاب المنتظمين
- `new_students` - الطلاب الجدد
- `registers` - التسجيلات
- `countries` - الدول
- `courses` - الدورات
- `coupons` - الكوبونات
- `favorite_times` - الأوقات المفضلة
- `admins` - المسؤولين
- `users` - المستخدمين
- `failed_jobs` - المهام الفاشلة
- `permission_tables` - جداول الصلاحيات (Spatie)
- `custom_prices` - الأسعار المخصصة
- `stopped_students` - الطلاب المتوقفين
- `coupon_student` - علاقة الكوبونات والطلاب
- `usage_coupons` - استخدام الكوبونات
- `configs` - الإعدادات
- `governorates` - المحافظات
- `coupon_logs` - سجل الكوبونات (جديد)

---

### 3. تثبيت الحزم (Composer) ⚠️

**الحالة**: ⚠️ قد تحتاج تحديث

**الأوامر المطلوبة:**
```bash
cd "D:\Furqan Group\unified-registration-system"
composer install
# أو
composer update
```

**الحزم المطلوبة:**
- `checkout/checkout-sdk-php` - Checkout.com
- `srmklive/paypal` - PayPal
- `google/apiclient` - Google Sheets
- `maatwebsite/excel` - Excel Import/Export
- `mcamara/laravel-localization` - الترجمة
- `spatie/laravel-permission` - الصلاحيات
- `spatie/laravel-translatable` - الترجمة
- `laravel/ui` - Laravel UI
- `guzzlehttp/guzzle` - HTTP Client
- `symfony/intl` - Internationalization
- `jenssegers/agent` - Device Detection (جديد)

---

### 4. إعداد الصلاحيات والأدوار ⚠️

**الحالة**: ❌ لم يتم إنشاء الصلاحيات بعد

**الخطوات:**

#### أ) إنشاء Seeder للصلاحيات

إنشاء ملف `database/seeders/PermissionSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // إنشاء الصلاحيات
        $permissions = [
            'عرض-الاشتراكات',
            'تعديل-حالة-الدفع',
            'إرسال-إلى-جوجل-شيت',
            'عرض-الكوبونات',
            'اضافة-الكوبونات',
            'تعديل-الكوبونات',
            'حذف-الكوبونات',
            'استيراد-البيانات',
            'تصدير-البيانات',
            'عرض-الأدوار',
            'اضافة-الادوار',
            'تعديل-الادوار',
            'حذف-الادوار',
            'عرض-المسؤولين',
            'اضافة-المسؤولين',
            'تعديل-المسؤولين',
            'حذف-المسؤولين',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }

        // إنشاء دور Super Admin
        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin'
        ]);
        $superAdmin->givePermissionTo(Permission::all());

        // إنشاء دور Admin (صلاحيات محدودة)
        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'admin'
        ]);
        $admin->givePermissionTo([
            'عرض-الاشتراكات',
            'عرض-الكوبونات',
            'تصدير-البيانات',
        ]);

        $this->command->info('Permissions and Roles created successfully!');
    }
}
```

#### ب) تشغيل Seeder

```bash
php artisan db:seed --class=PermissionSeeder
```

#### ج) ربط Admin بالدور

```bash
php artisan tinker
```

```php
use App\Models\Admin;
use Spatie\Permission\Models\Role;

$admin = Admin::first();
$superAdmin = Role::where('name', 'Super Admin')->first();
$admin->assignRole($superAdmin);
```

---

### 5. مراجعة Helper Functions ⚠️

**الحالة**: ✅ موجودة لكن تحتاج مراجعة

**الملفات:**
- `app/Helpers/helper.php` - ✅ موجود
- `app/Traits/FilesHelper.php` - ✅ موجود

**ما يجب مراجعته:**
- ✅ التأكد من أن جميع الـ functions موجودة
- ✅ التأكد من أن المسارات صحيحة
- ✅ اختبار الـ functions الأساسية

---

### 6. مراجعة Config Files ⚠️

**الحالة**: ✅ موجودة لكن تحتاج مراجعة

**الملفات المطلوبة:**
- `config/checkoutpayment.php` - ✅ موجود
- `config/paypal.php` - ✅ موجود
- `config/google.php` - ✅ موجود
- `config/permission.php` - ✅ موجود
- `config/laravellocalization.php` - ✅ موجود

**ما يجب مراجعته:**
- ✅ التأكد من أن جميع الإعدادات صحيحة
- ✅ التأكد من أن المسارات في `google.php` صحيحة
- ✅ التأكد من أن guard في `permission.php` هو `admin`

---

## 🟡 أولوية متوسطة - يجب إكمالها قبل الإنتاج

### 7. مراجعة Email Templates ⚠️

**الحالة**: ✅ موجودة لكن تحتاج مراجعة

**الملفات:**
- `resources/views/emails/new-card-subscribe.blade.php` - ✅ موجود
- `resources/views/emails/new-bank-subscribe.blade.php` - ⚠️ قد يكون في `emails/emails/`

**ما يجب مراجعته:**
- ✅ التأكد من أن جميع templates موجودة
- ✅ التأكد من أن المسارات في templates صحيحة
- ✅ اختبار إرسال الإيميلات

---

### 8. مراجعة Google Sheets Integration ⚠️

**الحالة**: ✅ موجودة لكن تحتاج مراجعة

**الملفات:**
- `app/Services/GoogleSheet.php` - ✅ موجود
- `app/Models/Subscribe.php` - ✅ موجود (booted() method)

**ما يجب مراجعته:**
- ✅ التأكد من أن `GOOGLE_CREDENTIALS_PATH` صحيح في `.env`
- ✅ التأكد من أن `GOOGLE_TOKEN_PATH` صحيح في `.env`
- ✅ التأكد من أن `GOOGLE_SHEET_ID` صحيح
- ✅ اختبار الإرسال إلى Google Sheets لكل form_type

---

### 9. مراجعة Payment Gateways ⚠️

**الحالة**: ✅ موجودة لكن تحتاج مراجعة

**الملفات:**
- `app/Service/Payment/Checkout.php` - ✅ موجود
- `app/Http/Controllers/PaymentController.php` - ✅ موجود

**ما يجب مراجعته:**
- ✅ التأكد من أن `CHECKOUT_PK` و `CHECKOUT_SK` صحيحة في `.env`
- ✅ التأكد من أن `PAYPAL_*` صحيحة في `.env`
- ✅ اختبار Checkout.com (Sandbox)
- ✅ اختبار PayPal (Sandbox)
- ✅ اختبار Apple Pay / Google Pay

---

### 10. مراجعة Notifications ⚠️

**الحالة**: ✅ موجودة لكن تحتاج مراجعة

**الملفات:**
- `app/Notifications/SubscribeNotification.php` - ✅ موجود

**ما يجب مراجعته:**
- ✅ التأكد من أن `MAIL_*` صحيحة في `.env`
- ✅ اختبار إرسال الإشعارات
- ✅ التأكد من أن Queue يعمل (إذا كان `QUEUE_CONNECTION=database`)

---

### 11. مراجعة Service Providers ⚠️

**الحالة**: ✅ موجودة لكن تحتاج مراجعة

**الملفات:**
- `app/Providers/AppServiceProvider.php` - ✅ موجود
- `app/Providers/AuthServiceProvider.php` - ✅ موجود
- `app/Providers/RouteServiceProvider.php` - ✅ موجود

**ما يجب مراجعته:**
- ✅ التأكد من أن `helper.php` مسجل في `composer.json`
- ✅ التأكد من أن جميع Providers مسجلة في `config/app.php`

---

### 12. مراجعة المسارات في Views ⚠️

**الحالة**: ✅ تمت المراجعة لكن تحتاج اختبار

**ما يجب مراجعته:**
- ✅ جميع المسارات في Registration Forms
- ✅ جميع المسارات في Dashboard Views
- ✅ جميع المسارات في Email Templates

---

## 🟢 أولوية منخفضة - يمكن تأجيلها

### 13. إعداد Queue System ⚠️

**الحالة**: ⚠️ يحتاج إعداد

**الخطوات:**
1. إعداد `QUEUE_CONNECTION=database` في `.env`
2. تشغيل `php artisan queue:table`
3. تشغيل `php artisan migrate`
4. إعداد worker: `php artisan queue:work`

---

### 14. إعداد Cache ⚠️

**الحالة**: ⚠️ يحتاج إعداد

**الخطوات:**
1. إعداد `CACHE_DRIVER` في `.env`
2. تشغيل `php artisan config:cache`
3. تشغيل `php artisan route:cache`
4. تشغيل `php artisan view:cache`

---

### 15. إعداد Logging ⚠️

**الحالة**: ✅ موجود لكن يحتاج مراجعة

**ما يجب مراجعته:**
- ✅ التأكد من أن `storage/logs` قابل للكتابة
- ✅ مراجعة `config/logging.php`

---

### 16. إعداد Testing ⚠️

**الحالة**: ❌ لم يتم إعداد

**الخطوات:**
1. إنشاء Tests للـ Controllers
2. إنشاء Tests للـ Models
3. إنشاء Tests للـ Services
4. تشغيل `php artisan test`

---

## 📋 قائمة التحقق النهائية

### 🔴 قبل التشغيل الأول

- [ ] إعداد ملف `.env` مع جميع المتغيرات
- [ ] تشغيل `php artisan key:generate`
- [ ] تشغيل `composer install`
- [ ] تشغيل `php artisan migrate`
- [ ] إنشاء Seeder للصلاحيات والأدوار
- [ ] تشغيل Seeder
- [ ] ربط Admin بالدور

### 🟡 قبل الإنتاج

- [ ] مراجعة Helper Functions
- [ ] مراجعة Config Files
- [ ] مراجعة Email Templates
- [ ] مراجعة Google Sheets Integration
- [ ] مراجعة Payment Gateways
- [ ] مراجعة Notifications
- [ ] مراجعة Service Providers
- [ ] مراجعة المسارات في Views
- [ ] اختبار جميع استمارات التسجيل
- [ ] اختبار بوابات الدفع
- [ ] اختبار الإشعارات
- [ ] اختبار Google Sheets Integration
- [ ] اختبار Dashboard (جميع الصفحات)

### 🟢 بعد الإنتاج

- [ ] إعداد Queue System
- [ ] إعداد Cache
- [ ] إعداد Logging
- [ ] إعداد Testing
- [ ] مراقبة الأداء
- [ ] إصلاح المشاكل

---

## 🎯 الخلاصة

### ما تم إنجازه: ✅
- ✅ **البنية الأساسية**: 100%
- ✅ **الكود**: 100%
- ✅ **الواجهات**: 100%
- ✅ **Dashboard**: 100%
- ✅ **Translations**: 100% (تم النسخ)

### ما يتبقى: ⚠️
- ⚠️ **الإعداد**: `.env`, Migrations, Permissions
- ⚠️ **المراجعة**: Helper Functions, Config Files, Email Templates
- ⚠️ **الاختبار**: جميع الوظائف
- ⚠️ **الإنتاج**: Queue, Cache, Logging

### الحالة العامة:
**المشروع جاهز بنسبة ~95%** - يحتاج فقط إلى:
1. إعداد `.env` و Migrations
2. إعداد الصلاحيات والأدوار
3. المراجعة والاختبار

---

**تاريخ التحديث**: 15 يناير 2026
