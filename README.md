# نظام التسجيل الموحد - Unified Registration System

## نظرة عامة

هذا المشروع هو نظام موحد لدمج جميع استمارات التسجيل الستة في مشروع Laravel واحد. تم إنشاء هذا المشروع بناءً على تحليل شامل للمشاريع الأصلية.

## المشاريع المدمجة

1. **استمارة-المنتظمين** (Regular Students)
2. **الفردي** (One-to-One)
3. **طلاب-جدد-اونلاين** (New Students Online)
4. **طلاب-جدد-ورش** (New Students Workshops)
5. **الورد-اليومي** (Daily Wird)
6. **يوم-التأسيس** (Founding Day)

## البنية الأساسية

### Models
- ✅ `Subscribe` - جدول موحد لجميع أنواع التسجيلات مع `form_type` للتمييز
- ✅ `Student` - الطلاب المنتظمين
- ✅ `NewStudent` - الطلاب الجدد
- ✅ `StoppedStudent` - الطلاب المتوقفين
- ✅ `Country` - الدول
- ✅ `Course` - الدورات
- ✅ `Coupon` - الكوبونات
- ✅ `CustomPrice` - الأسعار المخصصة
- ✅ `FavoriteTime` - الأوقات المفضلة
- ✅ `Admin` - المسؤولين
- ✅ `Register` - التسجيلات القديمة

### Controllers

#### Registration Controllers
- ✅ `RegularStudentsController` - استمارة المنتظمين
- ✅ `NewStudentsController` - طلاب جدد أونلاين
- ✅ `OneToOneController` - الدروس الفردية
- ✅ `WorkshopsController` - ورش الطلاب الجدد
- ✅ `DailyWirdController` - الورد اليومي
- ✅ `FoundingDayController` - يوم التأسيس

#### Shared Controllers
- ✅ `PaymentController` - معالجة Apple Pay و Google Pay الموحدة
- ✅ `CouponController` - إدارة الكوبونات

#### Dashboard Controllers
- ✅ `HomeController` - الصفحة الرئيسية للوحة التحكم
- ✅ `SubscribeController` - إدارة التسجيلات
- ✅ `CouponController` - إدارة الكوبونات
- ✅ `CourseController` - إدارة الدورات
- ✅ `FavoriteTimeController` - إدارة الأوقات المفضلة
- ✅ `RoleController` - إدارة الأدوار
- ✅ `AdminController` - إدارة المسؤولين
- ✅ `TranslateController` - إدارة الترجمات
- ✅ `ImportExportController` - الاستيراد والتصدير

### Services
- ✅ `GoogleSheet` - خدمة موحدة لإرسال البيانات إلى Google Sheets
- ✅ `TranslationService` - خدمة إدارة الترجمات
- ✅ `Checkout` - خدمة بوابات الدفع (Checkout.com, PayPal)

### Helpers & Traits
- ✅ `app/Helpers/helper.php` - دوال مساعدة موحدة
- ✅ `app/Traits/FilesHelper.php` - trait لرفع الملفات

### Enums
- ✅ `FormType` - Enum لتحديد أنواع الاستمارات

### Routes

#### Registration Routes
كل استمارة لها prefix خاص:
- `/regular` - استمارة المنتظمين
- `/new-students` - طلاب جدد أونلاين
- `/one-to-one` - الدروس الفردية
- `/workshops` - ورش الطلاب الجدد
- `/daily-wird` - الورد اليومي
- `/founding-day` - يوم التأسيس

#### Dashboard Routes
- `/dashboard/home` - الصفحة الرئيسية
- `/dashboard/subscribes` - إدارة التسجيلات
- `/dashboard/coupons` - إدارة الكوبونات
- `/dashboard/courses` - إدارة الدورات
- `/dashboard/favorite-times` - إدارة الأوقات المفضلة
- `/dashboard/roles` - إدارة الأدوار
- `/dashboard/admins` - إدارة المسؤولين

### Migrations
تم إنشاء جميع Migrations الأساسية:
- ✅ `create_subscribes_table` - جدول التسجيلات الموحد
- ✅ `create_students_table` - جدول الطلاب المنتظمين
- ✅ `create_new_students_table` - جدول الطلاب الجدد
- ✅ `create_stopped_students_table` - جدول الطلاب المتوقفين
- ✅ `create_courses_table` - جدول الدورات
- ✅ `create_coupons_table` - جدول الكوبونات
- ✅ `create_countries_table` - جدول الدول
- ✅ `create_custom_prices_table` - جدول الأسعار المخصصة
- ✅ `create_favorite_times_table` - جدول الأوقات المفضلة
- ✅ `create_admins_table` - جدول المسؤولين
- ✅ `create_coupon_student_table` - جدول العلاقة بين الكوبونات والطلاب
- ✅ `create_usage_coupons_table` - جدول استخدام الكوبونات
- ✅ `create_permission_tables` - جداول الصلاحيات (Spatie)

## الميزات الرئيسية

### 1. Subscribe Model الموحد
- استخدام `form_type` للتمييز بين أنواع الاستمارات
- `booted()` method يستخدم `match` expression لمعالجة كل نوع بشكل منفصل
- دعم `student_id` و `new_student_id` حسب نوع الاستمارة

### 2. Payment Gateway الموحد
- `PaymentController` موحد لـ Apple Pay و Google Pay
- دعم Checkout.com و PayPal و HSBC Bank Transfer
- معالجة موحدة لجميع أنواع الدفع

### 3. Google Sheets Integration
- خدمة موحدة `GoogleSheet`
- معالجة مختلفة لكل `form_type` في `Subscribe` model
- تنسيق البيانات حسب نوع الاستمارة

### 4. Dashboard الموحد
- لوحة تحكم واحدة لجميع أنواع التسجيلات
- فلترة حسب `form_type`
- إدارة موحدة للكوبونات والدورات
- نظام صلاحيات باستخدام Spatie Laravel Permission

### 5. Localization
- دعم العربية والإنجليزية
- استخدام `mcamara/laravel-localization`
- ترجمات موحدة عبر `TranslationService`

## التثبيت

1. تثبيت الحزم:
```bash
composer install
```

2. إعداد `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

3. تشغيل Migrations:
```bash
php artisan migrate
```

4. نشر ملفات التكوين:
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider"
```

## الحزم المستخدمة

- `laravel/framework: ^8.65`
- `checkout/checkout-sdk-php: ^3.0`
- `srmklive/paypal: ~3.0`
- `google/apiclient: ^2.11`
- `maatwebsite/excel: ^3.1`
- `mcamara/laravel-localization: ^1.6`
- `spatie/laravel-permission: ^5.5`
- `spatie/laravel-translatable: ^4.6`
- `laravel/ui: ^3.4`

## الخطوات التالية

1. إنشاء Views لكل نوع استمارة
2. إنشاء Views للوحة التحكم
3. إعداد Google Sheets credentials
4. إعداد Checkout.com و PayPal credentials
5. إعداد Queue system
6. إعداد Email notifications
7. إضافة Tests

## ملاحظات مهمة

- جميع Controllers لكل نوع استمارة منفصلة للحفاظ على المنطق البرمجي الأصلي
- Routes تستخدم prefix لكل نوع استمارة
- `Subscribe` model يحتوي على منطق معقد في `booted()` method لمعالجة Google Sheets حسب `form_type`
- Payment validation methods موحدة في `PaymentController`

## الدعم

للمزيد من التفاصيل، راجع ملف التحليل الأصلي: `../README.md`
