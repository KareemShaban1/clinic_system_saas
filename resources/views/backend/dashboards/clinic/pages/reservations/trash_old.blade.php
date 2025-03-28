@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Trash_Reservations') }}
@stop

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservations_trans.Trash_Reservations') }}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <div class="table-responsive">
                    <table id="table_id" class="table table-hover table-sm p-0">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/reservations_trans.Id') }}</th>
                                <th>{{ trans('backend/reservations_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/reservations_trans.Reservation_Type') }}</th>
                                <th>{{ trans('backend/reservations_trans.Payment') }}</th>
                                <th>{{ trans('backend/reservations_trans.Reservation_Status') }}</th>
                                <th>{{ trans('backend/reservations_trans.Acceptance') }}</th>
                                <th>{{ trans('backend/reservations_trans.Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $reservation->patient->name }}</td>
                                    <td>
                                        @if ($reservation->res_type == 'check')
                                            {{ trans('backend/reservations_trans.Check') }}
                                        @elseif ($reservation->res_type == 'recheck')
                                            {{ trans('backend/reservations_trans.Recheck') }}
                                        @elseif ($reservation->res_type == 'consultation')
                                            {{ trans('backend/reservations_trans.Consultation') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($reservation->payment == 'paid')
                                            <span class="badge badge-rounded badge-success p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Paid') }}
                                            </span>
                                        @elseif ($reservation->payment == 'not paid')
                                            <span class="badge badge-rounded badge-danger p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Not_Paid') }}
                                            </span>
                                        @endif
                                        <div class="res_control">
                                            <a href="{{ Route('backend.reservations_options.payment_status', [$reservation->id, 'paid']) }}"
                                                class="btn btn-success btn-sm">
                                                {{-- {{ trans('backend/reservations_trans.Done') }} --}}
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            <a href="{{ Route('backend.reservations_options.payment_status', [$reservation->id, 'not paid']) }}"
                                                class="btn btn-danger btn-sm">
                                                {{-- {{ trans('backend/reservations_trans.Not_Done') }} --}}
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </div>

                                    </td>
                                    <td>
                                        @if ($reservation->res_status == 'waiting')
                                            <span class="badge badge-rounded badge-warning text-white p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Waiting') }}
                                            </span>
                                        @elseif ($reservation->res_status == 'entered')
                                            <span class="badge badge-rounded badge-success p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Entered') }}
                                            </span>
                                        @elseif ($reservation->res_status == 'finished')
                                            <span class="badge badge-rounded badge-info p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Finished') }}
                                            </span>
                                        @elseif ($reservation->res_status == 'cancelled')
                                            <span class="badge badge-rounded badge-danger p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Cancelled') }}
                                            </span>
                                        @endif

                                        <div class="res_control">

                                            <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->id, 'waiting']) }}"
                                                class="btn btn-warning btn-sm text-white">
                                                {{ trans('backend/reservations_trans.Waiting') }}
                                            </a>
                                            <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->id, 'entered']) }}"
                                                class="btn btn-success btn-sm">
                                                {{ trans('backend/reservations_trans.Entered') }}
                                            </a>
                                            <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->id, 'finished']) }}"
                                                class="btn btn-info btn-sm">
                                                {{ trans('backend/reservations_trans.Finished') }}
                                            </a>
                                            <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->id, 'cancelled']) }}"
                                                class="btn btn-danger btn-sm">
                                                {{ trans('backend/reservations_trans.Cancelled') }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($reservation->acceptance == 'approved')
                                            <span class="badge badge-rounded badge-success text-white p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Approved') }}
                                            </span>
                                        @elseif ($reservation->acceptance == 'not_approved')
                                            <span class="badge badge-rounded badge-danger text-white p-2 mb-2">
                                                {{ trans('backend/reservations_trans.Not_Approved') }}
                                            </span>
                                        
                                            <div class="res_control">
                                                <a href="{{ Route('backend.reservations_options.reservation_acceptance', [$reservation->id, 'approved']) }}"
                                                    class="btn btn-success btn-sm text-white">
                                                    {{-- {{ trans('backend/reservations_trans.Approved') }} --}}
                                                    <i class="fa-solid fa-check"></i>
                                                </a>

                                                <a href="{{ Route('backend.reservations_options.reservation_acceptance', [$reservation->id, 'not_approved']) }}"
                                                    class="btn btn-danger btn-sm text-white">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    {{-- {{ trans('backend/reservations_trans.Not_Approved') }} --}}
                                                </a>
                                            </div>
                                        @endif


                                    </td>
                                    <td>
                                        <form action="{{Route('backend.reservations.restore',$reservation->id)}}" method="post" style="display:inline">
                                            @csrf
                                            @method('put')
                                            
                                            <button type="submit" class="btn btn-success btn-sm" >
                                                <i class="fa fa-edit"></i>
                                                إعادة
                                            </button>   
                                        </form>
                                        
                                        <form action="{{Route('backend.reservations.forceDelete',$reservation->id)}}" method="post" style="display:inline">
                                            @csrf
                                            @method('delete')
                                            
                                            <button type="submit" class="btn btn-danger btn-sm" >
                                                <i class="fa fa-trash"></i> 
                                                حذف نهائى
                                            </button>   
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var lang = "{{ App::getLocale() }}";
        var dataTableOptions = {
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 3 },
                { responsivePriority: 3, targets: 5 },
                { responsivePriority: 4, targets: 6 },
                // Add more columnDefs for other columns, if needed
            ],
            oLanguage: {
                sZeroRecords: lang === 'ar' ? 'لا يوجد سجل متطابق' : 'No matching records found',
                sEmptyTable: lang === 'ar' ? 'لا يوجد بيانات في الجدول' : 'No data available in table',
                oPaginate: {
                    sFirst: lang === 'ar' ? "الأول" : "First",
                    sLast: lang === 'ar' ? "الأخير" : "Last",
                    sNext: lang === 'ar' ? "التالى" : "Next",
                    sPrevious: lang === 'ar' ? "السابق" : "Previous",
                },
            },
        };

        $('#table_id').DataTable(dataTableOptions);
    });
</script>
@endpush