@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Today_Reservations') }}
@stop

@endsection

@section('page-header')

<h4 class="page-title">{{ trans('backend/reservations_trans.Today_Reservations') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div
                    style="display: flex;
                align-items: center; 
                justify-content:center; margin-bottom:20px">
                    <a href="{{ Route('clinic.reservations.today_reservation_report') }}" class="btn btn-info ">
                        {{ trans('backend/reservations_trans.Daily_Report') }}
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="table_id" class="table nowrap table-hover table-sm p-0">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/reservations_trans.Id') }}</th>
                                <th>{{ trans('backend/reservations_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/reservations_trans.Reservation_Type') }}</th>
                                <th>{{ trans('backend/reservations_trans.Payment') }}</th>
                                <th>{{ trans('backend/reservations_trans.Reservation_Status') }}</th>
                                <th>{{ trans('backend/reservations_trans.Acceptance') }}</th>
                                @if ($reservation_settings['show_ray'] == 1)
                                    <th>{{ trans('backend/reservations_trans.Rays') }}</th>
                                @endif
                                <th>{{ trans('backend/reservations_trans.Analysis') }}</th>
                                @if ($reservation_settings['show_chronic_diseases'] == 1)
                                    <th>{{ trans('backend/reservations_trans.Chronic_Diseases') }}</th>
                                @endif
                                @if ($clinic_type == 'عيون')
                                    <th>{{ trans('backend/reservations_trans.Glasses_Distance') }}</th>
                                @endif
                                @if ($reservation_settings['show_prescription'] == 1)
                                    <th>{{ trans('backend/reservations_trans.Prescription') }}</th>
                                @endif
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
                                            <a href="{{ Route('clinic.reservations_options.payment_status', [$reservation->id, 'paid']) }}"
                                                class="btn btn-success btn-sm">
                                                {{-- {{ trans('backend/reservations_trans.Done') }} --}}
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            <a href="{{ Route('clinic.reservations_options.payment_status', [$reservation->id, 'not paid']) }}"
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

                                            <a href="{{ Route('clinic.reservations_options.reservation_status', [$reservation->id, 'waiting']) }}"
                                                class="btn btn-warning btn-sm text-white">
                                                {{ trans('backend/reservations_trans.Waiting') }}
                                            </a>
                                            <a href="{{ Route('clinic.reservations_options.reservation_status', [$reservation->id, 'entered']) }}"
                                                class="btn btn-success btn-sm">
                                                {{ trans('backend/reservations_trans.Entered') }}
                                            </a>
                                            <a href="{{ Route('clinic.reservations_options.reservation_status', [$reservation->id, 'finished']) }}"
                                                class="btn btn-info btn-sm">
                                                {{ trans('backend/reservations_trans.Finished') }}
                                            </a>
                                            <a href="{{ Route('clinic.reservations_options.reservation_status', [$reservation->id, 'cancelled']) }}"
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
                                                <a href="{{ Route('clinic.reservations_options.reservation_acceptance', [$reservation->id, 'approved']) }}"
                                                    class="btn btn-success btn-sm text-white">
                                                    {{-- {{ trans('backend/reservations_trans.Approved') }} --}}
                                                    <i class="fa-solid fa-check"></i>
                                                </a>

                                                <a href="{{ Route('clinic.reservations_options.reservation_acceptance', [$reservation->id, 'not_approved']) }}"
                                                    class="btn btn-danger btn-sm text-white">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    {{-- {{ trans('backend/reservations_trans.Not_Approved') }} --}}
                                                </a>
                                            </div>
                                        @endif


                                    </td>

                                    @if ($reservation_settings['show_ray'] == 1)
                                        <td>
                                            @if (App\Models\Ray::where('id', $reservation->id)->first())
                                                <div class="res_control">
                                                    <a href="{{ Route('clinic.rays.add', $reservation->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        {{ trans('backend/reservations_trans.Add') }}
                                                    </a>
                                                    <a href="{{ Route('clinic.rays.show', $reservation->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        {{ trans('backend/reservations_trans.Show') }}
                                                    </a>
                                                </div>
                                            @else
                                                <div class="res_control">
                                                    <a href="{{ Route('clinic.rays.add', $reservation->id) }}"
                                                        class="btn btn-dark btn-sm">
                                                        {{ trans('backend/reservations_trans.Add') }}
                                                    </a>

                                                </div>
                                            @endif
                                        </td>
                                    @endif

                                    {{-- Analysis --}}
                                    <td>
                                        @if (App\Models\MedicalAnalysis::where('id', $reservation->id)->first())
                                            <div class="res_control">
                                                <a href="{{ Route('clinic.analysis.add', $reservation->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>
                                                <a href="{{ Route('clinic.analysis.show', $reservation->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ trans('backend/reservations_trans.Show') }}
                                                </a>
                                            </div>
                                        @else
                                            <div class="res_control">
                                                <a href="{{ Route('clinic.analysis.add', $reservation->id) }}"
                                                    class="btn btn-dark btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>

                                            </div>
                                        @endif
                                    </td>

                                    @if ($reservation_settings['show_chronic_diseases'] == 1)
                                        <td>
                                            <div class="res_control">


                                                @if (App\Models\ChronicDisease::where('id', $reservation->id)->first())
                                                    <a href="{{ Route('clinic.chronic_diseases.add', $reservation->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        {{ trans('backend/reservations_trans.Add') }}
                                                    </a>
                                                    <a href="{{ Route('clinic.chronic_diseases.show', $reservation->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        {{ trans('backend/reservations_trans.Show') }}
                                                    </a>
                                                @else
                                                    <a href="{{ Route('clinic.chronic_diseases.add', $reservation->id) }}"
                                                        class="btn btn-dark btn-sm">
                                                        {{ trans('backend/reservations_trans.Add') }}
                                                    </a>
                                                @endif

                                            </div>

                                        </td>
                                    @endif

                                        <td>
                                            @if (App\Models\GlassesDistance::where('id', $reservation->id)->first())
                                                <div class="res_control">
                                                    <a href="{{ Route('clinic.glasses_distance.edit', $reservation->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        {{ trans('backend/reservations_trans.Edit') }}
                                                    </a>
                                                    <a href="{{ Route('clinic.glasses_distance.glasses_distance_pdf', $reservation->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        {{ trans('backend/reservations_trans.Show') }}
                                                    </a>
                                                </div>
                                            @else
                                                <a href="{{ Route('clinic.glasses_distance.add', $reservation->id) }}"
                                                    class="btn btn-dark btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>
                                            @endif
                                        </td>

                                    @if ($reservation_settings['show_prescription'] == 1)
                                        <td>
                                            <div class="res_control">

                                                @if (App\Models\Drug::where('id', $reservation->id)->first())
                                                    <a href="{{ Route('clinic.prescription.arabic_prescription_pdf', $reservation->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        {{ trans('backend/reservations_trans.Arabic') }}
                                                    </a>

                                                    <a href="{{ Route('clinic.prescription.english_prescription_pdf', $reservation->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        {{ trans('backend/reservations_trans.English') }}
                                                    </a>
                                                    <a href="{{ Route('clinic.prescription.add', $reservation->id) }}"
                                                        class="btn btn-dark btn-sm">
                                                        {{ trans('backend/reservations_trans.Add') }}
                                                    </a>
                                                @else
                                                    <a href="{{ Route('clinic.prescription.add', $reservation->id) }}"
                                                        class="btn btn-dark btn-sm">
                                                        {{ trans('backend/reservations_trans.Add') }}
                                                    </a>
                                                    {{-- <a href="{{ Route('clinic.prescription.showPrescription', $reservation->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            {{ trans('backend/reservations_trans.Add') }}
                                                        </a> --}}
                                                @endif


                                            </div>
                                        </td>
                                    @endif


                                    <td>
                                        <div class="res_control">
                                            <a href="{{ Route('clinic.reservations.show', $reservation->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ Route('clinic.reservations.edit', $reservation->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ Route('clinic.reservations.destroy', $reservation->id) }}"
                                                method="post" style="display:inline">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
            stateSave: true,
            sortable: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },

                'colvis'
            ],
            responsive: true,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 1
                },
                {
                    responsivePriority: 2,
                    targets: 3
                },
                {
                    responsivePriority: 3,
                    targets: 5
                },
                {
                    responsivePriority: 4,
                    targets: 9
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
