<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Subscribe;
use App\Services\GoogleSheet;

/**
 * فتح ملف JSON للترجمة
 * 
 * @param string $code - رمز اللغة (ar, en)
 * @param string|null $branch - نوع الفرع (all, eg, null)
 * @return array
 */
function openJSONFile($code, $branch = null)
{
    $jsonString = [];
    $filtered_data = [];
    $json_data = [];

    if(File::exists(base_path('resources/lang/'.$code.'.json'))){
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $json_data = json_decode($jsonString, true);

        // دعم فلترة حسب branch (للمشاريع التي تحتاجها)
        if (!is_null($branch)) {
            $search = 'EG-branch';
            if ($branch == 'all'){
                foreach ($json_data as $key => $value){
                    if (!str_contains($key, $search)){
                        $filtered_data[$key] = $value;
                    }
                }
            } else {
                foreach ($json_data as $key => $value){
                    if (str_contains($key, $search)){
                        $filtered_data[$key] = $value;
                    }
                }
            }
            return $filtered_data;
        }
    }
    
    return $json_data ?? [];
}

/**
 * حفظ ملف JSON للترجمة
 * 
 * @param string $code - رمز اللغة
 * @param array $data - البيانات
 * @return void
 */
function saveJSONFile($code, $data)
{
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
}

/**
 * الحصول على رقم الفرع
 * 
 * @param string $branch - نوع الفرع (eg, all)
 * @param int $section - القسم (1 = Male, 2 = Female)
 * @return string
 */
function getBranchNum($branch, $section)
{
    $branches = [
        'all' => ['1' => '01020101', '2' => '01020102'],
        'eg' => ['1' => '01020106', '2' => '01020107'],
    ];

    return $branches[$branch][$section] ?? '';
}

/**
 * التحقق من اسم المسار (للوحة التحكم)
 * 
 * @param string $route_name
 * @return string
 */
function checkRouteName($route_name)
{
    return Route::is($route_name) ? 'active' : '';
}

/**
 * التحقق من صلاحيات المحاسب
 * 
 * @return bool
 */
function isAccountant()
{
    $emails = [
        'admin@a.a',
        'accounting@furqangroup.com',
        'admin.accounting@furqangroup.com',
        'abdelaleem.shaban@furqangroup.com',
        'othman@furqangroup.com',
        'hatim201499@gmail.com',
    ];
    return auth()->check() && in_array(auth()->user()->email, $emails);
}

/**
 * التحقق من صلاحيات الشؤون
 * 
 * @return bool
 */
function isAffairs()
{
    $emails = [
        'admin@a.a',
        'support.admin.affairs@furqangroup.com',
        'hatim201499@gmail.com',
    ];
    return auth()->check() && in_array(auth()->user()->email, $emails);
}

/**
 * حساب رقم القسط (للمشاريع التي تدعم الأقساط)
 * 
 * @param Subscribe $subscribe
 * @return string
 */
function installmentNum($subscribe)
{
    if (!isset($subscribe->balance) || !isset($subscribe->total_amount)) {
        return '-';
    }

    if ($subscribe->balance == $subscribe->total_amount * (60/100)) {
        return 'القسط الأول';
    } else if($subscribe->balance == $subscribe->total_amount * (30/100)) {
        return 'القسط الثاني';
    }

    return 'القسط الثالث';
}

/**
 * حالة القسط الثاني
 * 
 * @param Subscribe $subscription
 * @return array
 */
function instalmentSecondStatus($subscription)
{
    if ($subscription->source_id ?? false) {
        if($subscription->second_installment_status ?? false) {
            return ['class' => 'warning', 'data' => 'مستحقة'];
        } else {
            return ['class' => 'success', 'data' => 'مسددة'];
        }
    }

    return ['class' => 'danger', 'data' => '-'];
}

/**
 * حالة القسط الثالث
 * 
 * @param Subscribe $subscription
 * @return array
 */
function instalmentThirdStatus($subscription)
{
    if ($subscription->source_id ?? false) {
        if($subscription->third_installment_status ?? false) {
            return ['class' => 'warning', 'data' => 'مستحقة'];
        } else {
            return ['class' => 'success', 'data' => 'مسددة'];
        }
    }

    return ['class' => 'danger', 'data' => '-'];
}

/**
 * الحصول على الاسم الكامل للطالب الجديد
 * 
 * @param object $student
 * @return string
 */
function newStudentFullName($student)
{
    return ($student->first_name ?? '') . ' ' . 
           ($student->father_name ?? '') . ' ' . 
           ($student->grandfather_name ?? '') . ' ' . 
           ($student->family_name ?? '');
}

/**
 * الحصول على الطالب الصحيح (للمشاريع التي تدعم stopped students)
 * 
 * @param Subscribe $subscribe
 * @return object|null
 */
function getCorrectStudent($subscribe)
{
    if ($subscribe->stoppedStudent ?? null) {
        return $subscribe->stoppedStudent->student;
    }

    return $subscribe->student ?? null;
}

/**
 * معالجة الاشتراك وإرساله إلى Google Sheets
 * 
 * @param Subscribe $subscribe
 * @return void
 */
function processSubscription($subscribe)
{
    // هذه الدالة موجودة في Subscribe Model booted() method
    // يمكن استخدامها يدوياً إذا لزم الأمر
    // المنطق موجود في Subscribe::booted() method
}
