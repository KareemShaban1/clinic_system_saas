@extends('backend.dashboards.patient.layouts.master')
@section('css')

@section('title')
{{ trans('frontend/reservations_trans.Reservations') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('frontend/reservations_trans.Reservations') }}</h4>
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
                    <table id="table_id" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>{{ trans('frontend/reservations_trans.Number_of_Reservation') }}</th>


                                <th>{{ trans('frontend/reservations_trans.Reservation_Date') }}</th>

                                <th>{{ trans('frontend/reservations_trans.Reservation_Type') }}</th>


                                <th>{{ trans('frontend/reservations_trans.Payment') }}</th>

                                <th>{{ trans('frontend/reservations_trans.Acceptance') }}</th>
                                <th>{{ trans('frontend/reservations_trans.Reservation_Status') }}</th>

                                @if (isset($setting['show_ray']) && $setting['show_ray'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Rays_Analysis') }}</th>
                                @endif
                                @if (isset($setting['show_chronic_diseases']) && $setting['show_chronic_diseases'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Chronic_Diseases') }}</th>
                                @endif
                                @if (isset($setting['show_glasses_distance']) && $setting['show_glasses_distance'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Glasses_Distance') }}</th>
                                @endif
                                @if (isset($setting['show_prescription']) && $setting['show_prescription'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Prescription') }}</th>
                                @endif
                                {{-- <th>{{trans('frontend/reservations_trans.Control')}}</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->id }}
                                </td>
                                @if (App::getLocale() == 'ar')
                                <td>{{ $reservation->reservation_number }}</td>
                                @endif

                                <td>{{ $reservation->date }}</td>

                                @if (App::getLocale() == 'ar')
                                <td>
                                    @if ($reservation->type == 'check')
                                    {{ trans('frontend/reservations_trans.Check') }}
                                    @elseif ($reservation->type == 'recheck')
                                    {{ trans('frontend/reservations_trans.Recheck') }}
                                    @elseif ($reservation->type == 'consultation')
                                    {{ trans('frontend/reservations_trans.Consultation') }}
                                    @endif
                                </td>
                                @endif

                                <td>
                                    @if ($reservation->payment == 'paid')
                                    <span class="badge badge-rounded badge-success p-2 mb-2">
                                        {{ trans('frontend/reservations_trans.Paid') }}
                                    </span>
                                    @elseif ($reservation->payment == 'not paid')
                                    <span class="badge badge-rounded badge-danger p-2 mb-2">
                                        {{ trans('frontend/reservations_trans.Not_Paid') }}
                                    </span>
                                    @endif

                                </td>

                                <td>
                                    @if ($reservation->acceptance == 'approved')
                                    <span class="badge badge-rounded badge-success text-white p-2 m-2">
                                        {{ trans('backend/reservations_trans.Approved') }}
                                    </span>
                                    @elseif ($reservation->acceptance == 'not_approved')
                                    <span class="badge badge-rounded badge-danger text-white p-2 m-2">
                                        {{ trans('backend/reservations_trans.Not_Approved') }}
                                    </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($reservation->status == 'waiting')
                                    <span class="badge badge-rounded badge-warning text-white p-2 mb-2">
                                        {{ trans('frontend/reservations_trans.Waiting') }}
                                    </span>
                                    @elseif ($reservation->status == 'entered')
                                    <span class="badge badge-rounded badge-success p-2 mb-2">
                                        {{ trans('frontend/reservations_trans.Entered') }}
                                    </span>
                                    @elseif ($reservation->status == 'finished')
                                    <span class="badge badge-rounded badge-danger p-2 mb-2">
                                        {{ trans('frontend/reservations_trans.Finished') }}
                                    </span>
                                    @endif


                                </td>

                                @if (isset($setting['show_ray']) && $setting['show_ray'] == 1)
                                <td>
                                    @if (App\Models\Ray::class::where('id',$reservation->id)->first())
                                    <div class="res_control">
                                        <a href="{{ Route('frontend.appointment.show_ray', $reservation->id) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('frontend/reservations_trans.Show') }}
                                        </a>
                                    </div>
                                    @endif
                                </td>
                                @endif

                                @if (isset($setting['show_chronic_diseases']) && $setting['show_chronic_diseases'] == 1)
                                <td>
                                    @if (App\Models\ChronicDisease::where('id',$reservation->id)->first())
                                    <div class="res_control">
                                        <a href="{{ Route('frontend.appointment.show_chronic_disease', $reservation->id) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('frontend/reservations_trans.Show') }}
                                        </a>
                                    </div>
                                    @endif
                                </td>
                                @endif

                                @if (isset($setting['show_glasses_distance']) && $setting['show_glasses_distance'] == 1)
                                <td>
                                    @if (\App\Models\GlassesDistance::class::where('id',$reservation->id)->first() )
                                    <div class="res_control">
                                        <a href="{{ Route('frontend.appointment.show_glasses_distance', $reservation->id) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('frontend/reservations_trans.Show') }}
                                        </a>
                                    </div>
                                    @endif
                                </td>
                                @endif

                                @if (isset($setting['show_prescription']) && $setting['show_prescription'] == 1)
                                <td>
                                    @if (App\Models\Drug::class::where('id',$reservation->id)->first())
                                    <div class="res_control">
                                        <a href="{{ Route('frontend.appointment.english_prescription_pdf', $reservation->id) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('frontend/reservations_trans.English') }}
                                        </a>

                                        <a href="{{ Route('frontend.appointment.arabic_prescription_pdf', $reservation->id) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('frontend/reservations_trans.Show') }}
                                        </a>
                                    </div>
                                    @endif
                                </td>
                                @endif



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
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 2
                },
                {
                    responsivePriority: 2,
                    targets: 3
                },
                {
                    responsivePriority: 3,
                    targets: 5
                },
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