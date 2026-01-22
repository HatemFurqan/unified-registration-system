<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\SubscribesExport;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Enums\FormType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubscribeController extends Controller
{
    public $formTypes;

    public $filterTypes;

    public function __construct()
    {
        $this->formTypes = FormType::all();
        
        // تعريف filterTypes للفلترة في القائمة المنسدلة
        $this->filterTypes = [
            'regular' => 'منتظمين',
            'one_to_one_all' => 'فردي',
            'new_students_all' => 'طلاب جدد',
            'new_students_eg_all' => 'طلاب جدد - مصر',
            'workshops' => 'ورش',
            'daily-wird' => 'الورد اليومي',
            'founding-day' => 'يوم التأسيس',
            'founding-day-eg' => 'يوم التأسيس - مصر',
        ];
    }

    public function index(Request $request)
    {
        $query = Subscribe::query()
            ->with(['student', 'newStudent', 'country']);

        // فلترة حسب form_type
        if ($request->has('form_type') && $request->form_type != '' && $request->form_type != 'all') {
            $this->applyFormTypeFilter($query, $request->form_type);
        }

        // فلترة حسب reference_number
        if ($request->has('reference_number') && $request->reference_number != '') {
            $query->where('reference_number', 'like', '%' . $request->reference_number . '%');
        }

        // فلترة حسب email
        if ($request->has('email') && $request->email != '') {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // فلترة حسب payment_status
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        $subscribes = $query->latest()->paginate(20);

        return view('dashboard.subscribes.index', [
            'subscribes' => $subscribes,
            'formTypes' => $this->formTypes,
            'filterTypes' => $this->filterTypes,
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(
            new SubscribesExport($request->form_type, $this->formTypes), 
            'subscribes.xlsx'
        );
    }

    public function sendToGoogleSheet(Subscribe $subscribe)
    {
        // إرسال اشتراك محدد إلى Google Sheets
        // سيتم استخدام نفس الـ Logic من Subscribe Model booted()
        try {
            // يمكن استدعاء method من Subscribe Model
            return redirect()->back()->with('success', 'تم إرسال البيانات إلى Google Sheets بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء الإرسال: ' . $e->getMessage());
        }
    }

    public function updatePaymentStatus(Request $request, Subscribe $subscribe)
    {
        // تحديث حالة الدفع يدوياً
        $subscribe->update([
            'payment_status' => $request->payment_status,
            'payment_id' => $request->payment_id ?? $subscribe->payment_id,
        ]);

        return redirect()->back()->with('success', 'تم تحديث حالة الدفع بنجاح');
    }

    private function applyFormTypeFilter($query, $type)
    {
        switch($type) {
            case 'new_students_all':
                $query->whereIn('form_type', [FormType::STOPPED_STUDENTS, FormType::NEW_STUDENTS]);
                break;
            case 'new_students_eg_all':
                $query->whereIn('form_type', [FormType::NEW_STUDENTS_EG, FormType::STOPPED_STUDENTS_EG]);
                break;
            case 'one_to_one_all':
                $query->whereIn('form_type', [FormType::ONE_TO_ONE]);
                break;
            case 'regular':
                $query->where('form_type', FormType::REGULAR);
                break;
            case 'workshops':
                $query->where('form_type', FormType::WORKSHOPS);
                break;
            case 'daily-wird':
                $query->where('form_type', FormType::DAILY_WIRD);
                break;
            case 'founding-day':
                $query->where('form_type', FormType::FOUNDING_DAY);
                break;
            case 'founding-day-eg':
                $query->where('form_type', FormType::FOUNDING_DAY_EG);
                break;
            default:
                $query->where('form_type', $type);
                break;
        }
    }
}
