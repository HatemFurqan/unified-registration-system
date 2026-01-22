@extends('dashboard.layouts.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">سجل حركة التعامل مع الكوبونات</h4>
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
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                            <div class="box-body">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>كود القسيمة</th>
                                        <th>التوقيت</th>
                                        <th>الجهاز</th>
                                        <th>رابط الصفحة</th>
                                        <th>عرض</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <th scope="row">{{ $log->id }}</th>
                                            <td>
                                                <span class="badge badge-primary">{{ $log->coupon_code }}</span>
                                            </td>
                                            <td>{{ $log->created_at->format('h:i d-m-Y') }}</td>
                                            <td>{{ $log->device }}</td>
                                            <td>{{ $log->url }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.coupon-logs.show', $log->id) }}" target="_blank" class="btn btn-warning">
                                                    عرض
                                                    <i class="ft ft-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>

                                {!! $logs->links('pagination::bootstrap-4') !!}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')

        <script type="text/javascript">
        </script>

    @endpush

@endsection
