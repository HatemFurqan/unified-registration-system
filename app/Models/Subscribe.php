<?php

namespace App\Models;

use App\Notifications\SubscribeNotification;
use App\Services\GoogleSheet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\FormType;
use App\Models\Course;
use App\Models\Country;

class Subscribe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function newStudent()
    {
        return $this->belongsTo(NewStudent::class, 'new_student_id');
    }

    public function stoppedStudent()
    {
        return $this->belongsTo(StoppedStudent::class, 'student_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function customPrice()
    {
        return $this->belongsTo(CustomPrice::class, 'custom_price_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return int|string
     */
    public static function generateReferenceNumber() {
        $now = Carbon::now();
        $reference_number = self::whereYear('created_at', '=', $now->year)->max('reference_number');
        return $reference_number ? intval($reference_number) + 1 : $now->year . '0001';
    }

    /**
     * @param $request
     * @param $student
     * @param $coupon
     * @param $haveDiscount
     * @param $discount
     * @param string $referenceNumber
     * @param string $paymentMethod
     * @param string $paymentId
     * @param string $paymentStatus
     * @param string $formType
     * @return Builder|Model
     */
    public static function createNewSubscribe($request, $student, $coupon, $haveDiscount, $discount, string $referenceNumber, string $paymentMethod, string $paymentId, string $paymentStatus, string $formType) {
        
        $data = [
            'country_id' => $request->residence_country ?? $request->country_residence ?? null,
            'email' => $request->email ?? $request->father_email ?? null,
            'payment_method' => $paymentMethod,
            'payment_id' => $paymentId,
            'reference_number' => $referenceNumber,
            'payment_status' => $paymentStatus,
            'form_type' => $formType,
            'response_code' => '-',
            'coupon_id' => $coupon->id ?? null,
            'discount_value' => $discount ?? 0.00,
            'coupon_code' => $coupon->code ?? null,
        ];

        // إضافة student_id أو new_student_id حسب form_type
        if (in_array($formType, [FormType::REGULAR, FormType::ONE_TO_ONE])) {
            $data['student_id'] = $student->id;
        } else {
            $data['new_student_id'] = $student->id;
        }

        // إضافة حقول إضافية حسب form_type
        if ($formType == FormType::ONE_TO_ONE) {
            $data['favorite_time'] = $request->favorite_time ?? null;
            $data['custom_price_id'] = $haveDiscount ? $student->customPrice->id : null;
            $data['discount_reason_image'] = $request->hasFile('discount_reason_image') ? $request->file('discount_reason_image')->store('public/discount_reason_image') : null;
        }

        if (in_array($formType, [FormType::NEW_STUDENTS, FormType::STOPPED_STUDENTS])) {
            $data['arabic_level'] = $request->arabic_level ?? null;
            $data['quran_level'] = $request->quran_level ?? null;
            $data['national_address'] = $request->national_address ?? null;
            $data['branch'] = getBranchNum($request->branch ?? 'all', $request->new_student_section ?? 1);
        }

        return self::query()->create($data);
    }

    public static function booted()
    {
        static::created(function($subscribe) {
            // استخدام form_type للتمييز بين أنواع الاستمارات
            switch($subscribe->form_type) {
                case FormType::REGULAR:
                    self::handleRegularStudentGoogleSheet($subscribe);
                    break;
                case FormType::NEW_STUDENTS:
                    self::handleNewStudentGoogleSheet($subscribe);
                    break;
                case FormType::STOPPED_STUDENTS:
                    self::handleStoppedStudentGoogleSheet($subscribe);
                    break;
                case FormType::ONE_TO_ONE:
                    self::handleOneToOneGoogleSheet($subscribe);
                    break;
                case FormType::WORKSHOPS:
                    self::handleWorkshopsGoogleSheet($subscribe);
                    break;
                case FormType::DAILY_WIRD:
                    self::handleDailyWirdGoogleSheet($subscribe);
                    break;
                case FormType::FOUNDING_DAY:
                    self::handleFoundingDayGoogleSheet($subscribe);
                    break;
                case FormType::FOUNDING_DAY_EG:
                    self::handleFoundingDayEgGoogleSheet($subscribe);
                    break;
                default:
                    Log::warning("Unknown form_type: {$subscribe->form_type}");
                    break;
            }
        });

        static::updated(function($subscribe) {
            // نفس المنطق للـ updated
            if ($subscribe->payment_method == 'checkout_gateway' || $subscribe->payment_method == 'paypal') {
                switch($subscribe->form_type) {
                    case FormType::REGULAR:
                        self::handleRegularStudentGoogleSheet($subscribe);
                        break;
                    case FormType::NEW_STUDENTS:
                        self::handleNewStudentGoogleSheet($subscribe);
                        break;
                    case FormType::STOPPED_STUDENTS:
                        self::handleStoppedStudentGoogleSheet($subscribe);
                        break;
                    case FormType::ONE_TO_ONE:
                        self::handleOneToOneGoogleSheet($subscribe);
                        break;
                    case FormType::WORKSHOPS:
                        self::handleWorkshopsGoogleSheet($subscribe);
                        break;
                    case FormType::DAILY_WIRD:
                        self::handleDailyWirdGoogleSheet($subscribe);
                        break;
                    case FormType::FOUNDING_DAY:
                        self::handleFoundingDayGoogleSheet($subscribe);
                        break;
                    case FormType::FOUNDING_DAY_EG:
                        self::handleFoundingDayEgGoogleSheet($subscribe);
                        break;
                    default:
                        Log::warning("Unknown form_type: {$subscribe->form_type}");
                        break;
                }
            }
        });
    }

    /**
     * معالجة Google Sheets لاستمارة المنتظمين
     */
    private static function handleRegularStudentGoogleSheet($subscribe)
    {
        $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
        $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

        $course = Course::query()->where('code', '=', 'regular')->first();

        if (@$subscribe->customPrice->discount_value){
            $discount_value = ($subscribe->discount_value/100) + $subscribe->customPrice->discount_value;
        }elseif (@$subscribe->customPrice->discount_percent){
            $discount_value = ($subscribe->discount_value/100) + ($course->price* ($subscribe->customPrice->discount_percent/100) );
        }else{
            $discount_value = ($subscribe->discount_value/100);
        }

        $price = $course->price - $discount_value;
        $net_price = $course->price - $discount_value - 15;

        $image_path = '-';
        $discount_reason_image = '-';
        if ($subscribe->discount_reason_image) {
            $discount_reason_image = url(Storage::url($subscribe->discount_reason_image));
        }

        $googleSheet = new GoogleSheet();
        $values = [
            [
                $created_at ?? '-', $subscribe->reference_number ?? '-', $created_at_formatted ?? '-',
                'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', 'نعم',
                $subscribe->student->section == 1 ? 'بنين' : 'بنات', $subscribe->student->serial_number ?? '-',
                $subscribe->student->name ?? '-', $subscribe->country->name, $subscribe->email,
                $image_path ?? '-', $subscribe->bank_name ?? '-', $subscribe->account_owner ?? '-',
                $subscribe->transfer_date ?? '-', $subscribe->bank_reference_number ?? '-', $subscribe->payment_method ?? '-',
                $subscribe->payment_id ?? '-', $subscribe->payment_status ?? '-', $subscribe->response_code ?? '-', $subscribe->coupon_code ?? '-', ($subscribe->discount_value / 100) ?? '0.0',
                $subscribe->student->client_zoho_id ?? '-', $course->price, $price, $net_price,
                $subscribe->customPrice->discount_value ?? '-', $subscribe->customPrice->discount_percent ?? '-',
                $subscribe->customPrice->discount_reason ?? '-', $discount_reason_image ?? '-',
                $subscribe->favorite_time ?? '-',
                $subscribe->paypal_fee ?? '-',
            ],
        ];

        try {
            $googleSheet->saveDataToSheet($values);
            if (in_array($subscribe->payment_status, ['Captured', 'Authorized'])) {
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * معالجة Google Sheets للطلاب الجدد
     */
    private static function handleNewStudentGoogleSheet($subscribe)
    {
        if (in_array($subscribe->branch, ['01020106', '01020107'])){
            $course = Course::query()->where('code', 'new-students-eg')->first();
        }else{
            $course = Course::query()->where('code', 'new-students-all')->first();
        }

        if ( (($subscribe->payment_method == 'checkout_gateway' || $subscribe->payment_method == 'paypal') && in_array($subscribe->payment_status, ['Captured', 'Authorized'])) || $subscribe->payment_method == 'hsbc' || $subscribe->discount_value == $course->amount) {

            $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
            $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

            $price = $course->price - ($subscribe->discount_value / 100);

            $image_path = '-';
            if ($subscribe->money_transfer_image_path) {
                $image_path = url(Storage::url($subscribe->money_transfer_image_path));
            }

            $relation = 'newStudent';
            if ($subscribe->{$relation}) {
                // إنشاء name attribute ديناميكي للاستخدام في Google Sheets
                $name = $subscribe->{$relation}->first_name . ' ' . 
                        $subscribe->{$relation}->father_name . ' ' . 
                        $subscribe->{$relation}->grandfather_name . ' ' . 
                        $subscribe->{$relation}->family_name;
            } else {
                $name = '-';
            }

            $student_id_image = '-';
            if ($subscribe->{$relation} && $subscribe->{$relation}->student_id_image) {
                $student_id_image = url(Storage::url($subscribe->{$relation}->student_id_image));
            }

            $certificate_file = '-';
            if ($subscribe->{$relation} && ($subscribe->{$relation}->certificate_file ?? null)) {
                $certificate_file = url(Storage::url($subscribe->{$relation}->certificate_file));
            }

            $googleSheet = new GoogleSheet();
            $values = [
                [
                    $created_at ?? '-', $subscribe->reference_number ?? '-', $created_at_formatted ?? '-',
                    'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', 'لا',
                    ($subscribe->{$relation}->section ?? '-'), ($subscribe->{$relation}->serial_number ?? '-'),
                    ($name ?? '-'), ($subscribe->{$relation}->first_name ?? '-'), ($subscribe->{$relation}->father_name ?? '-'),
                    ($subscribe->{$relation}->grandfather_name ?? '-'), ($subscribe->{$relation}->family_name ?? '-'),
                    ($subscribe->{$relation}->favorite_time ?? '-'), ($subscribe->{$relation}->bod ?? '-'),
                    ($subscribe->payment_method ?? '-'), ($subscribe->payment_id ?? '-'), ($subscribe->payment_status ?? '-'),
                    ($subscribe->response_code ?? '-'), ($subscribe->coupon_code ?? '-'), (($subscribe->discount_value / 100) ?? '0.0'),
                    ($image_path ?? '-'), ($subscribe->account_owner ?? '-'), ($subscribe->transfer_date ?? '-'), ($subscribe->bank_reference_number ?? '-'),
                    ($subscribe->bank_name ?? '-'), ($subscribe->{$relation}->country->code ?? '-'), ($subscribe->{$relation}->residenceCountry->name ?? '-'),
                    ($subscribe->{$relation}->city ?? '-'), ($subscribe->{$relation}->address ?? '-'), ($subscribe->{$relation}->postal_code ?? '-'),
                    '',
                    ($subscribe->{$relation}->id_number ?? '-'), ($subscribe->{$relation}->father_whatsApp_number ?? '-'),
                    ($subscribe->{$relation}->mother_whatsApp_number ?? '-'), ($subscribe->{$relation}->father_email ?? '-'),
                    ($subscribe->{$relation}->mother_email ?? '-'),
                    ($subscribe->{$relation}->preferred_language ?? '-'), '',
                    '', '',
                    '', '',
                    '', '',
                    '', '',
                    '',
                    ($student_id_image ?? '-'), '',
                    ($subscribe->{$relation}->residenceCountry->code ?? '-'), $price, $subscribe->id, ($subscribe->{$relation}->hear_about ?? '-'),
                    ($subscribe->arabic_level ?? '-'), ($subscribe->quran_level ?? '-'),
                    ($certificate_file ?? '-'),
                    ($subscribe->{$relation}->memorized_parts_count ?? '-'),
                    ($subscribe->branch ?? '-'),
                    ($subscribe->national_address ?? '-'),
                    ($subscribe->paypal_fee ?? '-'),
                ],
            ];
            try {
                $googleSheet->saveDataToSheet($values);
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }

    /**
     * معالجة Google Sheets للطلاب المتوقفين
     */
    private static function handleStoppedStudentGoogleSheet($subscribe)
    {
        // نفس منطق handleNewStudentGoogleSheet مع تعديلات بسيطة
        self::handleNewStudentGoogleSheet($subscribe);
    }

    /**
     * معالجة Google Sheets للدروس الفردية
     */
    private static function handleOneToOneGoogleSheet($subscribe)
    {
        $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
        $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

        $image_path = '-';
        $discount_reason_image = '-';
        if ($subscribe->discount_reason_image) {
            $discount_reason_image = url(Storage::url($subscribe->discount_reason_image));
        }

        $course = Course::query()->where('code', '=', 'one_to_one')->first();

        if (@$subscribe->customPrice->discount_value){
            $discount_value = ($subscribe->discount_value/100) + $subscribe->customPrice->discount_value;
        }elseif (@$subscribe->customPrice->discount_percent){
            $discount_value = ($subscribe->discount_value/100) + ($course->price* ($subscribe->customPrice->discount_percent/100) );
        }else{
            $discount_value = ($subscribe->discount_value/100);
        }

        $price = $course->price - $discount_value;
        $net_price = $course->price - ($discount_value / 100) - 45;

        $googleSheet = new GoogleSheet();
        $values = [
            [
                $created_at ?? '-', $subscribe->reference_number ?? '-', $created_at_formatted ?? '-',
                'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', 'نعم',
                $subscribe->student->section == 1 ? 'بنين' : 'بنات', $subscribe->student->serial_number ?? '-',
                $subscribe->student->name ?? '-', $subscribe->country->name, $subscribe->email,
                $image_path ?? '-', $subscribe->bank_name ?? '-', $subscribe->account_owner ?? '-',
                $subscribe->transfer_date ?? '-', $subscribe->bank_reference_number ?? '-', $subscribe->payment_method ?? '-',
                $subscribe->payment_id ?? '-', $subscribe->payment_status ?? '-', $subscribe->response_code ?? '-', $subscribe->coupon_code ?? '-',
                ($subscribe->discount_value/100) ?? '0.0',
                $subscribe->student->client_zoho_id ?? '-', $course->price ?? '-', $price ?? '-', $net_price ?? '-',
                $subscribe->customPrice->discount_value ?? '-', $subscribe->customPrice->discount_percent ?? '-',
                $subscribe->customPrice->discount_reason ?? '-', $discount_reason_image ?? '-',
                $subscribe->favorite_time ?? '-',
                $subscribe->paypal_fee ?? '-',
            ],
        ];

        try{
            $googleSheet->saveDataToSheet($values);
            if (in_array($subscribe->payment_status, ['Captured', 'Authorized']) ){
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * معالجة Google Sheets للورش
     */
    private static function handleWorkshopsGoogleSheet($subscribe)
    {
        if (($subscribe->payment_method == 'checkout_gateway' && is_numeric($subscribe->response_code) && in_array($subscribe->payment_status, ['Captured', 'Authorized'])) || $subscribe->payment_method == 'hsbc') {

            $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
            $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

            $course = Course::query()->where('code', '=', 'new-students-warsh')->first();
            $price = $course->price - ($subscribe->discount_value / 100);

            $image_path = '-';
            if ($subscribe->money_transfer_image_path) {
                $image_path = url(Storage::url($subscribe->money_transfer_image_path));
            }

            $relation = 'stoppedStudent';
            $is_new = 'لا';
            if ($subscribe->form_type == FormType::STOPPED_STUDENTS) {
                $relation = 'stoppedStudent';
                $is_new = 'نعم';
            }

            if ($subscribe->form_type == FormType::WORKSHOPS) {
                $relation = 'newStudent';
            }

            // إنشاء name attribute ديناميكي
            $name = '-';
            if ($subscribe->{$relation}) {
                if ($subscribe->form_type == FormType::STOPPED_STUDENTS && $subscribe->stoppedStudent && $subscribe->stoppedStudent->student) {
                    $name = $subscribe->stoppedStudent->student->name ?? '-';
                } elseif ($subscribe->form_type == FormType::WORKSHOPS && $subscribe->{$relation}) {
                    $name = ($subscribe->{$relation}->first_name ?? '') . ' ' . 
                            ($subscribe->{$relation}->father_name ?? '') . ' ' . 
                            ($subscribe->{$relation}->grandfather_name ?? '') . ' ' . 
                            ($subscribe->{$relation}->family_name ?? '');
                }
            }

            $guardian_id_image = '-';
            if ($subscribe->{$relation} && $subscribe->{$relation}->guardian_id_image) {
                $guardian_id_image = url(Storage::url($subscribe->{$relation}->guardian_id_image));
            }

            $student_id_image = '-';
            if ($subscribe->{$relation} && $subscribe->{$relation}->student_id_image) {
                $student_id_image = url(Storage::url($subscribe->{$relation}->student_id_image));
            }

            // الحصول على section و serial_number
            $section = '-';
            $serial_number = '-';
            if ($subscribe->form_type == FormType::STOPPED_STUDENTS && $subscribe->stoppedStudent && $subscribe->stoppedStudent->student) {
                $section = $subscribe->stoppedStudent->student->section ?? '-';
                $serial_number = $subscribe->stoppedStudent->student->serial_number ?? '-';
            } elseif ($subscribe->{$relation}) {
                $section = $subscribe->{$relation}->section ?? '-';
                $serial_number = $subscribe->{$relation}->serial_number ?? '-';
            }

            $googleSheet = new GoogleSheet();
            $values = [
                [
                    $created_at ?? '-', $subscribe->reference_number ?? '-', $created_at_formatted ?? '-',
                    'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', $is_new ?? '-',
                    $section, $serial_number,
                    $name, ($subscribe->{$relation}->first_name ?? '-'), ($subscribe->{$relation}->father_name ?? '-'),
                    ($subscribe->{$relation}->grandfather_name ?? '-'), ($subscribe->{$relation}->family_name ?? '-'),
                    ($subscribe->{$relation}->favorite_time ?? '-'), ($subscribe->{$relation}->bod ?? '-'),
                    ($subscribe->payment_method ?? '-'), ($subscribe->payment_id ?? '-'), ($subscribe->payment_status ?? '-'),
                    ($subscribe->response_code ?? '-'), ($subscribe->coupon_code ?? '-'), (($subscribe->discount_value / 100) ?? '0.0'),
                    ($image_path ?? '-'), ($subscribe->account_owner ?? '-'), ($subscribe->transfer_date ?? '-'), ($subscribe->bank_reference_number ?? '-'),
                    ($subscribe->bank_name ?? '-'), ($subscribe->{$relation}->country->code ?? '-'), ($subscribe->{$relation}->residenceCountry->name ?? '-'),
                    ($subscribe->{$relation}->city ?? '-'), ($subscribe->{$relation}->address ?? '-'), ($subscribe->{$relation}->postal_code ?? '-'),
                    '',
                    ($subscribe->{$relation}->id_number ?? '-'), ($subscribe->{$relation}->father_whatsApp_number ?? '-'),
                    ($subscribe->{$relation}->mother_whatsApp_number ?? '-'), ($subscribe->{$relation}->father_email ?? '-'),
                    ($subscribe->{$relation}->mother_email ?? '-'),
                    ($subscribe->{$relation}->preferred_language ?? '-'), '',
                    '', '',
                    '', '',
                    '', '',
                    '', '',
                    '',
                    ($student_id_image ?? '-'), '',
                    ($subscribe->{$relation}->residenceCountry->code ?? '-'), $price, $subscribe->id, ($subscribe->{$relation}->hear_about ?? '-')
                ],
            ];

            try {
                $googleSheet->saveDataToSheet($values);
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }

    /**
     * معالجة Google Sheets للورد اليومي
     */
    private static function handleDailyWirdGoogleSheet($subscribe)
    {
        if (($subscribe->payment_method == 'checkout_gateway' && is_numeric($subscribe->response_code) && in_array($subscribe->payment_status, ['Captured', 'Authorized'])) || $subscribe->payment_method == 'hsbc' || ($subscribe->course && $subscribe->discount_value == $subscribe->course->amount)) {

            $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
            $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

            $price = ($subscribe->course ? $subscribe->course->price : 0) - ($subscribe->discount_value / 100);

            $image_path = '-';
            if ($subscribe->money_transfer_image_path) {
                $image_path = url(Storage::url($subscribe->money_transfer_image_path));
            }

            $relation = 'stoppedStudent';
            $is_new = 'لا';
            if ($subscribe->form_type == FormType::STOPPED_STUDENTS) {
                $relation = 'stoppedStudent';
                $is_new = 'نعم';
            }

            if ($subscribe->form_type == FormType::DAILY_WIRD) {
                $relation = 'newStudent';
            }

            // إنشاء name attribute ديناميكي
            $name = '-';
            if ($subscribe->{$relation}) {
                if ($subscribe->form_type == FormType::STOPPED_STUDENTS && $subscribe->stoppedStudent && $subscribe->stoppedStudent->student) {
                    $name = $subscribe->stoppedStudent->student->name ?? '-';
                } elseif ($subscribe->form_type == FormType::DAILY_WIRD && $subscribe->{$relation}) {
                    $name = ($subscribe->{$relation}->first_name ?? '') . ' ' . 
                            ($subscribe->{$relation}->father_name ?? '') . ' ' . 
                            ($subscribe->{$relation}->grandfather_name ?? '') . ' ' . 
                            ($subscribe->{$relation}->family_name ?? '');
                }
            }

            $student_id_image = '-';
            if ($subscribe->{$relation} && $subscribe->{$relation}->student_id_image) {
                $student_id_image = url(Storage::url($subscribe->{$relation}->student_id_image));
            }

            // الحصول على section و serial_number
            $section = '-';
            $serial_number = '-';
            if ($subscribe->form_type == FormType::STOPPED_STUDENTS && $subscribe->stoppedStudent && $subscribe->stoppedStudent->student) {
                $section = $subscribe->stoppedStudent->student->section ?? '-';
                $serial_number = $subscribe->stoppedStudent->student->serial_number ?? '-';
            } elseif ($subscribe->{$relation}) {
                $section = $subscribe->{$relation}->section ?? '-';
                $serial_number = $subscribe->{$relation}->serial_number ?? '-';
            }

            $googleSheet = new GoogleSheet();
            $values = [
                [
                    $created_at ?? '-', $subscribe->reference_number ?? '-', $created_at_formatted ?? '-',
                    'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', $is_new ?? '-',
                    $section, $serial_number,
                    $name, ($subscribe->{$relation}->first_name ?? '-'), ($subscribe->{$relation}->father_name ?? '-'),
                    ($subscribe->{$relation}->grandfather_name ?? '-'), ($subscribe->{$relation}->family_name ?? '-'),
                    ($subscribe->{$relation}->favorite_time ?? '-'), ($subscribe->{$relation}->bod ?? '-'),
                    ($subscribe->payment_method ?? '-'), ($subscribe->payment_id ?? '-'), ($subscribe->payment_status ?? '-'),
                    ($subscribe->response_code ?? '-'), ($subscribe->coupon_code ?? '-'), (($subscribe->discount_value / 100) ?? '0.0'),
                    ($image_path ?? '-'), ($subscribe->account_owner ?? '-'), ($subscribe->transfer_date ?? '-'), ($subscribe->bank_reference_number ?? '-'),
                    ($subscribe->bank_name ?? '-'), ($subscribe->{$relation}->country->code ?? '-'), ($subscribe->{$relation}->residenceCountry->name ?? '-'),
                    ($subscribe->{$relation}->city ?? '-'), ($subscribe->{$relation}->address ?? '-'), ($subscribe->{$relation}->postal_code ?? '-'),
                    '',
                    ($subscribe->{$relation}->id_number ?? '-'), ($subscribe->{$relation}->father_whatsApp_number ?? '-'),
                    ($subscribe->{$relation}->mother_whatsApp_number ?? '-'), ($subscribe->{$relation}->father_email ?? '-'),
                    ($subscribe->{$relation}->mother_email ?? '-'),
                    ($subscribe->{$relation}->preferred_language ?? '-'), '',
                    '', '',
                    '', '',
                    '', '',
                    '', '',
                    '',
                    ($student_id_image ?? '-'), '',
                    ($subscribe->{$relation}->residenceCountry->code ?? '-'), $price, $subscribe->id, ($subscribe->{$relation}->hear_about ?? '-'),
                    ($subscribe->arabic_level ?? '-'), ($subscribe->quran_level ?? '-'), ($subscribe->branch ?? '-'), ($subscribe->course ? $subscribe->course->name : '-')
                ],
            ];

            try {
                $googleSheet->saveDataToSheet($values);
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }

    /**
     * معالجة Google Sheets ليوم التأسيس
     */
    private static function handleFoundingDayGoogleSheet($subscribe)
    {
        // نفس منطق يوم التأسيس مصر
        self::handleFoundingDayEgGoogleSheet($subscribe);
    }

    /**
     * معالجة Google Sheets ليوم التأسيس مصر
     */
    private static function handleFoundingDayEgGoogleSheet($subscribe)
    {
        if (($subscribe->payment_method == 'checkout_gateway' && is_numeric($subscribe->response_code) && in_array($subscribe->payment_status, ['Captured', 'Authorized'])) || $subscribe->payment_method == 'hsbc') {

            $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
            $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

            $price = $subscribe->last_payment / 100;

            $image_path = '-';
            if ($subscribe->money_transfer_image_path) {
                $image_path = url(Storage::url($subscribe->money_transfer_image_path));
            }

            $relation = 'newStudent';
            $is_new = '-';
            if ($subscribe->form_type == FormType::FOUNDING_DAY_EG || $subscribe->form_type == FormType::FOUNDING_DAY) {
                $relation = 'newStudent';
            }

            // إنشاء name attribute ديناميكي
            $name = '-';
            if ($subscribe->{$relation}) {
                $name = ($subscribe->{$relation}->first_name ?? '') . ' ' . 
                        ($subscribe->{$relation}->father_name ?? '') . ' ' . 
                        ($subscribe->{$relation}->grandfather_name ?? '') . ' ' . 
                        ($subscribe->{$relation}->family_name ?? '');
            }

            $student_id_image = '-';
            if ($subscribe->{$relation} && $subscribe->{$relation}->student_id_image) {
                $student_id_image = url(Storage::url($subscribe->{$relation}->student_id_image));
            }

            $certificate_file = '-';
            if ($subscribe->{$relation} && $subscribe->{$relation}->certificate_file) {
                $certificate_file = url(Storage::url($subscribe->{$relation}->certificate_file));
            }

            $googleSheet = new GoogleSheet();
            $values = [
                [
                    $created_at ?? '-', $subscribe->reference_number ?? '-', $created_at_formatted ?? '-',
                    'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', $is_new ?? '-',
                    ($subscribe->{$relation}->section ?? '-'), ($subscribe->{$relation}->serial_number ?? '-'),
                    $name, ($subscribe->{$relation}->first_name ?? '-'), ($subscribe->{$relation}->father_name ?? '-'),
                    ($subscribe->{$relation}->grandfather_name ?? '-'), ($subscribe->{$relation}->family_name ?? '-'),
                    ($subscribe->{$relation}->favorite_time ?? '-'), ($subscribe->{$relation}->bod ?? '-'),
                    ($subscribe->payment_method ?? '-'), ($subscribe->payment_id ?? '-'), ($subscribe->payment_status ?? '-'),
                    ($subscribe->response_code ?? '-'), ($subscribe->coupon_code ?? '-'), (($subscribe->discount_value / 100) ?? '0.0'),
                    ($image_path ?? '-'), ($subscribe->account_owner ?? '-'), ($subscribe->transfer_date ?? '-'), ($subscribe->bank_reference_number ?? '-'),
                    ($subscribe->bank_name ?? '-'), ($subscribe->{$relation}->country->code ?? '-'), ($subscribe->{$relation}->residenceCountry->name ?? '-'),
                    ($subscribe->{$relation}->city ?? '-'), ($subscribe->{$relation}->address ?? '-'), ($subscribe->{$relation}->postal_code ?? '-'),
                    '',
                    ($subscribe->{$relation}->id_number ?? '-'), ($subscribe->{$relation}->father_whatsApp_number ?? '-'),
                    ($subscribe->{$relation}->mother_whatsApp_number ?? '-'), ($subscribe->{$relation}->father_email ?? '-'),
                    ($subscribe->{$relation}->mother_email ?? '-'),
                    ($subscribe->{$relation}->preferred_language ?? '-'), '',
                    '', '',
                    '', '',
                    '', '',
                    '', '',
                    '',
                    ($student_id_image ?? '-'), '',
                    ($subscribe->{$relation}->residenceCountry->code ?? '-'), $price, $subscribe->id, ($subscribe->{$relation}->hear_about ?? '-'),
                    ($subscribe->arabic_level ?? '-'), ($subscribe->quran_level ?? '-'),
                    ($certificate_file ?? '-'),
                    ($subscribe->{$relation}->memorized_parts_count ?? '-'),
                    ($subscribe->branch ?? '-'),
                    ($subscribe->student_referral ?? '-')
                ],
            ];

            try {
                $googleSheet->saveDataToSheet($values);
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
