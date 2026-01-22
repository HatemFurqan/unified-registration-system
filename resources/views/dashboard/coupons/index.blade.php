@extends('dashboard.layouts.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">جميع كوبونات الخصم</h4>
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

                                @can('اضافة-الكوبونات')
                                    <a class="btn btn-success mb-2" href="{{ route('dashboard.coupons.create') }}"> إنشاء كوبون جديد</a>
                                @endcan

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>كود الكوبون</th>
                                        <th>النوع</th>
                                        <th>القيمة</th>
                                        <th>الدورة</th>
                                        <th>تعديل</th>
                                        <th>اضيف بواسطة</th>
                                        <th>اخر تحديث</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupon)
                                        <tr>
                                            <th scope="row">{{ $coupon->id }}</th>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->type }}</td>
                                            <td>{{ ($coupon->type == 'fixed') ? ($coupon->value/100) . '$' : $coupon->value}}</td>
                                            <td>{{ @$coupon->course->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboard.coupons.edit', $coupon->id) }}" class="btn btn-warning">
                                                    تعديل
                                                    <i class="ft ft-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <label class="badge badge-success">{{ @$coupon->adminCreatedBy->name }}</label>
                                                <br>
                                                {{ @$coupon->created_at->format('Y-d-m h:m') }}
                                                {{--                                                <form action="{{ route('dashboard.coupons.destroy', $coupon->id) }}" method="POST">--}}
                                                {{--                                                    @csrf--}}
                                                {{--                                                    @method('DELETE')--}}

                                                {{--                                                    <button type="submit" class="btn btn-danger">--}}
                                                {{--                                                        <i class="la la-trash"></i>--}}
                                                {{--                                                        حذف--}}
                                                {{--                                                    </button>--}}

                                                {{--                                                </form>--}}
                                            </td>
                                            <td>
                                                <label class="badge badge-danger">{{ @$coupon->adminUpdatedBy->name }}</label>
                                                <br>
                                                {{ @$coupon->adminUpdatedBy->name ? $coupon->updated_at->format('Y-d-m h:m') : '' }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                                    {!! $coupons->links('pagination::bootstrap-4') !!}
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
