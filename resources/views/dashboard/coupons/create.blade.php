@extends('dashboard.layouts.master')

<style>
    /* خلفية الصفحة */
    .content-wrapper {
        background: #f5f7fa;
        min-height: calc(100vh - 60px);
    }
    
    .content-body {
        background: transparent;
        padding: 20px;
    }

    /* تنسيق النموذج */
    .form {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-bottom: 20px;
    }

    .form-body {
        background: transparent;
    }

    /* العنوان الرئيسي */
    .form-section {
        background: #666EE8;
        color: #ffffff;
        padding: 15px 20px;
        border-radius: 6px;
        margin: -30px -30px 30px -30px;
        font-size: 18px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(102, 110, 232, 0.25);
    }

    .form-section i {
        margin-left: 10px;
        font-size: 20px;
    }

    /* الأقسام */
    .section-card {
        background: #ffffff;
        border: 1px solid #e8ecef;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .section-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: #d0d7de;
    }

    .section-title {
        color: #2c3e50;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e8ecef;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-left: 8px;
        color: #666EE8;
        font-size: 18px;
    }

    /* الحقول */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .form-group label i {
        margin-left: 6px;
        color: #666EE8;
        font-size: 14px;
    }

    .form-group .text-danger {
        color: #e74c3c !important;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #d0d7de;
        border-radius: 4px;
        padding: 10px 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .form-control:focus {
        border-color: #666EE8;
        box-shadow: 0 0 0 3px rgba(102, 110, 232, 0.1);
        outline: none;
    }

    .form-text {
        font-size: 12px;
        margin-top: 5px;
        color: #6c757d;
    }

    /* Select2 */
    #specific_users + .select2.select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #d0d7de;
        border-radius: 4px;
        min-height: 38px;
    }

    .select2-container--default .select2-selection--single:focus,
    .select2-container--default .select2-selection--multiple:focus {
        border-color: #666EE8;
        box-shadow: 0 0 0 3px rgba(102, 110, 232, 0.1);
    }

    /* Checkbox */
    .form-group .mt-2 {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 4px;
        border: 1px solid #e8ecef;
    }

    /* أزرار الإجراءات */
    .form-actions {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 6px;
        margin-top: 30px;
        border-top: 2px solid #e8ecef;
    }

    .btn {
        padding: 10px 25px;
        font-weight: 600;
        border-radius: 4px;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .btn-primary {
        background: #666EE8;
        border: none;
        box-shadow: 0 2px 8px rgba(102, 110, 232, 0.25);
    }

    .btn-primary:hover {
        background: #5E66E5;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 110, 232, 0.35);
    }

    .btn-warning {
        background: #ffc107;
        border: none;
        color: #212529;
    }

    .btn-warning:hover {
        background: #e0a800;
        transform: translateY(-2px);
    }

    /* توزيع العناصر */
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }

    .row > [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form {
            padding: 20px 15px;
        }

        .form-section {
            margin: -20px -15px 20px -15px;
            padding: 12px 15px;
            font-size: 16px;
        }

        .section-card {
            padding: 15px;
        }
    }

    /* تحسينات إضافية */
    .form-group input[type="date"] {
        position: relative;
    }

    .form-group input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        opacity: 0.6;
    }

    .form-group input[type="date"]::-webkit-calendar-picker-indicator:hover {
        opacity: 1;
    }
</style>

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <form class="form" method="POST" action="{{ route('dashboard.coupons.store') }}">
        @csrf
        @method('POST')

        <div class="form-body">
            <!-- العنوان الرئيسي -->
            <h4 class="form-section">
                <i class="ft-percent"></i> إضافة كوبون جديد
            </h4>

            <!-- معلومات الكوبون الأساسية -->
            <div class="section-card">
                <h5 class="section-title">
                    <i class="ft-info"></i> المعلومات الأساسية
                </h5>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="code">
                                <i class="ft-hash"></i> كود الخصم
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="code" class="form-control" 
                                   placeholder="أدخل كود الخصم" name="code" 
                                   value="{{ old('code') }}" required>
                            <small class="form-text text-muted">يجب أن يكون الكود فريداً</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="type">
                                <i class="ft-tag"></i> نوع الكوبون
                                <span class="text-danger">*</span>
                            </label>
                            <select name="type" id="type" class="form-control select2" required>
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>نسبة مئوية (%)</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>مبلغ ثابت</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="value">
                                <i class="ft-dollar-sign"></i> قيمة الخصم
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="value" class="form-control" 
                                   placeholder="أدخل قيمة الخصم" name="value" 
                                   value="{{ old('value') }}" step="0.01" min="0" required>
                            <small class="form-text text-muted" id="value_hint">
                                أدخل النسبة المئوية أو المبلغ بالريال
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- إعدادات الاستخدام -->
            <div class="section-card">
                <h5 class="section-title">
                    <i class="ft-settings"></i> إعدادات الاستخدام
                </h5>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="usage_limit">
                                <i class="ft-users"></i> عدد المستفيدين المسموح به
                            </label>
                            <input type="number" id="usage_limit" class="form-control" 
                                   placeholder="اتركه فارغاً للاستخدام غير المحدود" 
                                   name="usage_limit" value="{{ old('usage_limit') }}" min="1">
                            <small class="form-text text-muted">اتركه فارغاً للسماح بعدد غير محدود</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">
                                <i class="ft-calendar"></i> تاريخ البداية
                            </label>
                            <input type="date" id="start_date" class="form-control" 
                                   name="start_date" value="{{ old('start_date') }}">
                            <small class="form-text text-muted">تاريخ بدء صلاحية الكوبون</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">
                                <i class="ft-calendar"></i> تاريخ الانتهاء
                            </label>
                            <input type="date" id="end_date" class="form-control" 
                                   name="end_date" value="{{ old('end_date') }}">
                            <small class="form-text text-muted">تاريخ انتهاء صلاحية الكوبون</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="active">
                                <i class="ft-power"></i> حالة الكوبون
                                <span class="text-danger">*</span>
                            </label>
                            <select name="active" id="active" class="form-control select2" required>
                                <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>فعال</option>
                                <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>متوقف</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="limit_user">
                                <i class="ft-repeat"></i> قيود الاستخدام
                            </label>
                            <div class="mt-2">
                                <input type="checkbox" name="limit_user" id="limit_user" 
                                       data-color="danger" class="toggle-status switchery" 
                                       {{ old('limit_user') ? 'checked' : '' }} />
                                <label for="limit_user" class="ml-2" style="font-weight: normal;">
                                    صالح لمرة واحدة فقط لكل طالب
                                </label>
                            </div>
                            <small class="form-text text-muted">منع استخدام الكوبون أكثر من مرة لنفس الطالب</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- التخصيص -->
            <div class="section-card">
                <h5 class="section-title">
                    <i class="ft-sliders"></i> التخصيص
                </h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="specific_users_group">
                            <label for="specific_users">
                                <i class="ft-user"></i> تخصيص طلاب محددين
                            </label>
                            <select name="specific_users[]" id="specific_users" 
                                    class="form-control students-data-ajax" multiple="multiple">
                                @foreach($users as $user)
                                    {{-- سيتم تحميل الطلاب عبر AJAX --}}
                                @endforeach
                            </select>
                            <small class="form-text text-muted">
                                ابحث واختر الطلاب المحددين. اتركه فارغاً ليكون الكوبون متاحاً للجميع
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="course_id">
                                <i class="ft-book"></i> الدورة
                                <span class="text-danger">*</span>
                            </label>
                            <select name="course_id" id="course_id" class="form-control select2" required>
                                <option value="">اختر الدورة</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">الدورة التي ينطبق عليها هذا الكوبون</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- أزرار الإجراءات -->
        <div class="form-actions text-right">
            <a href="{{ route('dashboard.coupons.index') }}" class="btn btn-warning mr-2">
                <i class="ft-x"></i> إلغاء
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> حفظ الكوبون
            </button>
        </div>

    </form>

@endsection

@push('js')
<script>
    $(document).ready(function(){
        // تهيئة Select2 للطلاب
        $(".students-data-ajax").select2({
            ajax: {
                url: "{{ route('dashboard.students.names') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            placeholder: 'ابحث باستخدام اسم الطالب/ة',
            minimumInputLength: 2,
            language: {
                inputTooShort: function () {
                    return 'أدخل حرفين على الأقل للبحث';
                },
                noResults: function () {
                    return 'لا توجد نتائج';
                },
                searching: function () {
                    return 'جاري البحث...';
                }
            }
        });

        // تحديث نص التلميح حسب نوع الكوبون
        $('#type').on('change', function() {
            var type = $(this).val();
            var hint = $('#value_hint');
            if (type === 'percent') {
                hint.text('أدخل النسبة المئوية (مثال: 10 لخصم 10%)');
            } else {
                hint.text('أدخل المبلغ بالريال (مثال: 50 لخصم 50 ريال)');
            }
        });

        // التحقق من أن تاريخ الانتهاء بعد تاريخ البداية
        $('#start_date, #end_date').on('change', function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            
            if (startDate && endDate && startDate > endDate) {
                alert('تاريخ الانتهاء يجب أن يكون بعد تاريخ البداية');
                $(this).val('');
            }
        });

        // تهيئة Select2 للحقول الأخرى
        $('.select2').select2({
            language: {
                noResults: function () {
                    return 'لا توجد نتائج';
                }
            }
        });
    });
</script>
@endpush
