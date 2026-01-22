@extends('dashboard.layouts.master')

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <form class="form" method="POST" action="{{ route('dashboard.config.storeTimeTable') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-body">
            <h4 class="form-section"><i class="ft-user"></i>تحديث صورة الأزمنة (الجدول الزمني)استمارة العامة</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الصورة - عربي</label>
                        <input type="file" id="code" class="form-control" name="time_table_image_ar">
                        <br>
                        @if($time_table_image_ar)
                            <img src="{{ $time_table_image_ar }}" width="250px" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الصورة - انجلش</label>
                        <input type="file" id="code" class="form-control" name="time_table_image_en">
                        <br>
                        @if($time_table_image_en)
                            <img src="{{ $time_table_image_en }}" width="250px" alt="">
                        @endif
                    </div>
                </div>
            </div>

            <br>

            <h4 class="form-section"><i class="ft-user"></i>تحديث صورة الأزمنة (الجدول الزمني)استمارة مصر</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الصورة - عربي</label>
                        <input type="file" id="code" class="form-control" name="eg_time_table_image_ar">
                        <br>
                        @if($eg_time_table_image_ar)
                            <img src="{{ $eg_time_table_image_ar }}" width="250px" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code">الصورة - انجلش</label>
                        <input type="file" id="code" class="form-control" name="eg_time_table_image_en">
                        <br>
                        @if($eg_time_table_image_en)
                            <img src="{{ $eg_time_table_image_en }}" width="250px" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> تحديث
            </button>
            <button type="reset" class="btn btn-warning mr-1">
                <i class="ft-x"></i> إلغاء
            </button>
        </div>

    </form>

@endsection
