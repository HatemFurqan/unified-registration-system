<?php

namespace App\Exports;

use App\Models\Subscribe;
use App\Enums\FormType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubscribesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $form_type;
    protected $formTypes;

    public function __construct($form_type, $formTypes)
    {
        $this->form_type = $form_type;
        $this->formTypes = $formTypes;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Subscribe::query()->with(['student', 'newStudent', 'country']);

        if ($this->form_type && $this->form_type != '' && $this->form_type != 'all') {
            if ($this->form_type == 'new_students_all') {
                $query->whereIn('form_type', [FormType::STOPPED_STUDENTS, FormType::NEW_STUDENTS]);
            } elseif ($this->form_type == 'new_students_eg_all') {
                $query->whereIn('form_type', [FormType::NEW_STUDENTS_EG, FormType::STOPPED_STUDENTS_EG]);
            } elseif ($this->form_type == 'one_to_one_all') {
                $query->whereIn('form_type', [FormType::ONE_TO_ONE]);
            } else {
                $query->where('form_type', $this->form_type);
            }
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'الاسم رباعي',
            'الرقم التسلسلي',
            'حالة التسجيل',
            'Payment ID',
            'الرقم المرجعي للعملية',
            'نوع الاستمارة',
            'التاريخ',
            'الايميل',
            'الدولة'
        ];
    }

    public function map($subscribe): array
    {
        $studentName = '-';
        if ($subscribe->student) {
            $studentName = $subscribe->student->name;
        } elseif ($subscribe->newStudent) {
            $studentName = $subscribe->newStudent->first_name . ' ' . 
                          $subscribe->newStudent->father_name . ' ' . 
                          $subscribe->newStudent->grandfather_name . ' ' . 
                          $subscribe->newStudent->family_name;
        }

        return [
            $subscribe->id,
            $studentName,
            $subscribe->reference_number ?? '-',
            $subscribe->payment_status ?? '-',
            $subscribe->payment_id ?? '-',
            $subscribe->bank_reference_number ?? '-',
            $this->formTypes[$subscribe->form_type] ?? $subscribe->form_type,
            $subscribe->created_at->format('Y-m-d H:i'),
            $subscribe->email,
            $subscribe->country ? $subscribe->country->name : '-'
        ];
    }
}
