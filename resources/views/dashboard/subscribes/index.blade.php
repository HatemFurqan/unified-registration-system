@extends('dashboard.layouts.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">جميع الاشتراكات</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>

                @include('dashboard.partials.success')

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        
                        <form action="{{ route('dashboard.subscribes.index') }}" method="GET" class="mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="form_type">فلترة حسب نوع الاستمارة</label>
                                        <select name="form_type" id="form_type" class="form-control" onchange="this.form.submit()">
                                            <option value="all">عرض الكل</option>
                                            @foreach($filterTypes as $key => $value)
                                                <option value="{{ $key }}" {{ request('form_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="reference_number">الرقم التسلسلي</label>
                                        <input type="text" name="reference_number" id="reference_number" value="{{ request('reference_number') }}" class="form-control" placeholder="بحث بالرقم التسلسلي">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">البريد الالكتروني</label>
                                        <input type="text" name="email" id="email" value="{{ request('email') }}" class="form-control" placeholder="بحث بالبريد الالكتروني">
                                    </div>
                                </div>
                                <div class="col-md-1" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-info">بحث</button>
                                </div>
                                <div class="col-md-2 text-left" style="margin-top: 25px;">
                                    <a href="{{ route('dashboard.subscribes.export', request()->query()) }}" class="btn btn-success">
                                        <i class="ft ft-download"></i> تصدير اكسيل
                                    </a>
                                </div>
                            </div>
                        </form>

                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                            <div class="box-body table-responsive">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>الاسم رباعي</th>
                                        <th>البريد الالكتروني</th>
                                        <th>الرقم المرجعي للعملية</th>
                                        <th>حالة التسجيل</th>
                                        <th>مُعرف الدفع (Payment ID)</th>
                                        <th>نوع الاستمارة</th>
                                        <th>التاريخ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($subscribes as $subscribe)
                                        <tr>
                                            <th scope="row">{{ $subscribe->id }}</th>
                                            <td>{{ $subscribe->student_name }}</td>
                                            <td>{{ $subscribe->email ?? '-' }}</td>
                                            <td>{{ $subscribe->reference_number ?? '-' }}</td>
                                            <td>
                                                <span class="badge badge-{{ $subscribe->payment_status == 'Approved' || $subscribe->payment_status == 'Authorized' || $subscribe->payment_status == 'Captured' ? 'success' : 'danger' }}">
                                                    {{ $subscribe->payment_status ?? '-' }}
                                                </span>
                                            </td>
                                            <td>{{ $subscribe->payment_id ?? '-' }}</td>
                                            <td>{{ $formTypes[$subscribe->form_type] ?? $subscribe->form_type }}</td>
                                            <td style="direction: ltr; text-align: right;">{{ $subscribe->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">لا توجد اشتراكات متاح حالياً</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                
                                {!! $subscribes->appends(request()->query())->links('pagination::bootstrap-4') !!}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
