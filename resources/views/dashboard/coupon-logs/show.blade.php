@extends('dashboard.layouts.master')
<title>عرض سجل كوبون - {{ $log->coupon_code . ' ' . $log->created_at->format('d-m-Y') }}</title>
@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

        <div class="form-body">
            <h4 class="form-section"><i class="ft-monitor"></i> حركة كوبون {{ $log->coupon_code }} في توقيت {{ $log->created_at->format('h:i d-m-Y') }}</h4>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">بريد الطالب</label>
                        <input type="text" class="form-control" placeholder="بريد الطالب" value="{{ $log->email }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الرقم التسلسلي للطالب</label>
                        <input type="text" class="form-control" placeholder="الرقم التسلسلي" value="{{ $log->std_number }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">كود القسيمة</label>
                        <input type="text" class="form-control" placeholder="كود القسيمة" value="{{ $log->coupon_code }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">نوع الخصم</label>
                        <input type="text" class="form-control" placeholder="نوع الخصم" value="{{ $log->type }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">قيمة الخصم</label>
                        <input type="text" class="form-control" placeholder="قيمة الخصم" value="{{ $log->type == 'percent' ? $log->discount_value . '%' : ($log->discount_value/100) . '$' }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">تاريخ تفعيل الكوبون</label>
                        <input type="date" class="form-control" disabled placeholder="تاريخ تفعيل الكوبون" value="{{ $log->start_date ? \Carbon\Carbon::parse($log->start_date)->format('Y-m-d') : '' }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">تاريخ إنتهاء الكوبون</label>
                        <input type="date" class="form-control" disabled placeholder="تاريخ إنتهاء الكوبون" value="{{ $log->end_date ? \Carbon\Carbon::parse($log->end_date)->format('Y-m-d') : '' }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">عنوان IP الخاص بالطالب <a href="https://www.geolocation.com/?ip={{ $log->ip }}#ipresult" style="font-weight: bold" target="_blank">عرض بيانات IP</a></label>
                        <input type="text" class="form-control" placeholder="عنوان IP الخاص بالطالب" value="{{ $log->ip }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">جهاز الطالب</label>
                        <input type="text" class="form-control" placeholder="جهاز الطالب" value="{{ $log->device }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">المتصفح</label>
                        <input type="text" class="form-control" placeholder="المتصفح" value="{{ $log->browser_info }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">نظام التشغيل</label>
                        <input type="text" class="form-control" placeholder="نظام التشغيل" value="{{ $log->operating_system }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الرابط</label>
                        <input type="text" class="form-control" placeholder="الرابط" value="{{ $log->url }}" disabled>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('dashboard.coupon-logs.index') }}" class="btn btn-primary">
                <i class="la la-forward"></i> السابق
            </a>
        </div>
@endsection
