# إعداد Views للمشروع الموحد

## ملاحظة مهمة
الملفات كبيرة جداً (أكثر من 2000 سطر لكل ملف)، لذا يجب نسخها يدوياً من المشاريع الأصلية وتعديل المسارات.

## الملفات المطلوبة

### 1. Views الاستمارات الرئيسية:
- `resources/views/regular/index.blade.php` (من `استمارة-المنتظمين/resources/views/old_students.blade.php`)
- `resources/views/new-students/index.blade.php` (من `طلاب-جدد-اونلاين/resources/views/index.blade.php`)
- `resources/views/one-to-one/index.blade.php` (من `الفردي/resources/views/one-to-one.blade.php`)
- `resources/views/workshops/index.blade.php` (من `طلاب-جدد-ورش/resources/views/one-to-one.blade.php`)
- `resources/views/daily-wird/index.blade.php` (من `الورد-اليومي/resources/views/index.blade.php`)
- `resources/views/founding-day/index.blade.php` (من `يوم-التأسيس/resources/views/index.blade.php`)

### 2. تعديلات المسارات المطلوبة:

#### للملفات الأصلية التي تستخدم:
- `route('submit.re-subscribe')` → `route('registration.{form-type}.resubscribe')`
- `route('semester.registration.getStudentInfo')` → `route('registration.{form-type}.getStudentInfo')`
- `route('apply.coupon')` → `route('registration.{form-type}.applyCoupon')`

حيث `{form-type}` هو:
- `regular` للمنتظمين
- `new-students` للطلاب الجدد
- `one-to-one` للفردي
- `workshops` للورش
- `daily-wird` للورد اليومي
- `founding-day` ليوم التأسيس

### 3. Views أخرى مطلوبة:
- `resources/views/emails/` (من أي مشروع)
- `resources/views/partials/` (من أي مشروع)
- `resources/views/auth/admins/login.blade.php` (من أي مشروع)
- `resources/views/thank-you.blade.php` (من أي مشروع)

### 4. Views لوحة التحكم:
يجب نسخ جميع ملفات `dashboard/` من أي مشروع يحتوي على لوحة تحكم (مثل `الفردي` أو `one-to-one`).

## خطوات النسخ:
1. نسخ الملفات من المشاريع الأصلية
2. تعديل جميع المسارات (routes) لتتوافق مع المشروع الموحد
3. التأكد من أن جميع المسارات تشير إلى الـ controllers الصحيحة
