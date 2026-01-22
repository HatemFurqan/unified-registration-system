# تحديث المسارات في ملفات الواجهات (Views)

## ✅ الملفات التي تم تعديلها بنجاح:

### 1. `regular/index.blade.php`
- ✅ `route('submit.re-subscribe')` → `route('registration.regular.resubscribe')`
- ✅ `route('apply.coupon')` → `route('registration.regular.applyCoupon')`
- ✅ `route('semester.registration.getStudentInfo')` → `route('registration.regular.getStudentInfo')`

### 2. `new-students/index.blade.php`
- ✅ `route('semester.subscribe')` → `route('registration.new-students.resubscribe')`
- ✅ `route('apply.coupon')` → `route('registration.new-students.applyCoupon')`
- ✅ `route('semester.registration.getStudentInfo')` → `route('registration.new-students.getStudentInfo')`

### 3. `one-to-one/index.blade.php`
- ✅ `route('semester.subscribeOneToOne')` → `route('registration.one-to-one.resubscribe')`
- ✅ `route('apply.coupon')` → `route('registration.one-to-one.applyCoupon')`
- ✅ `route('semester.registration.getStudentInfo')` → `route('registration.one-to-one.getStudentInfo')`

### 4. `workshops/index.blade.php`
- ✅ `route('semester.subscribeOneToOne')` → `route('registration.workshops.resubscribe')`
- ✅ `route('apply.coupon')` → `route('registration.workshops.applyCoupon')`
- ✅ `route('semester.registration.getStudentInfo')` → `route('registration.workshops.getStudentInfo')`

### 5. `daily-wird/index.blade.php`
- ✅ `route('semester.subscribe')` → `route('registration.daily-wird.resubscribe')`
- ✅ `route('apply.coupon')` → `route('registration.daily-wird.applyCoupon')`
- ✅ `route('semester.registration.getStudentInfo')` → `route('registration.daily-wird.getStudentInfo')`

### 6. `founding-day/index.blade.php`
- ✅ `route('semester.subscribe')` → `route('registration.founding-day.resubscribe')`
- ✅ `route('apply.coupon')` → `route('registration.founding-day.applyCoupon')`

## ⚠️ ملف يحتاج إلى مراجعة:

### `thank-you.blade.php`
هذا الملف يحتوي على مسارات قديمة:
- `route('submit.re-subscribe')` - يحتاج إلى تعديل
- `route('semester.registration.index')` - يحتاج إلى تعديل
- `route('apply.coupon')` - يحتاج إلى تعديل
- `route('semester.registration.getStudentInfo')` - يحتاج إلى تعديل

**ملاحظة:** Controllers تشير إلى ملفات thank-you في المجلدات الفرعية (مثل `registration.regular.thank-you`)، لذا قد يكون هذا الملف قديم أو غير مستخدم. يُنصح بإنشاء ملفات thank-you منفصلة لكل استمارة أو جعل المسارات ديناميكية.

## 📋 المسارات الجديدة الموحدة:

جميع المسارات تتبع النمط التالي:
- `registration.{form-type}.resubscribe` - لإرسال النموذج
- `registration.{form-type}.getStudentInfo` - للحصول على معلومات الطالب
- `registration.{form-type}.applyCoupon` - لتطبيق الكوبون
- `registration.{form-type}.thankYouPage` - لصفحة الشكر

حيث `{form-type}` هو أحد:
- `regular`
- `new-students`
- `one-to-one`
- `workshops`
- `daily-wird`
- `founding-day`
