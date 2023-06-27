@extends('frontend.layouts.master')
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
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('frontend/reservations_trans.All_Reservations') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('frontend/reservations_trans.Reservations') }}</li>
            </ol>
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

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>#</th>
                            @if (App::getLocale() == 'ar')
                                <th>{{ trans('frontend/reservations_trans.Number_of_Reservation') }}</th>
                            @endif

                            <th>{{ trans('frontend/reservations_trans.Reservation_Date') }}</th>
                            @if (App::getLocale() == 'ar')
                                <th>{{ trans('frontend/reservations_trans.Reservation_Type') }}</th>
                            @endif

                            <th>{{ trans('frontend/reservations_trans.Payment') }}</th>

                            <th>{{ trans('frontend/reservations_trans.Reservation_Status') }}</th>

                            @if ($setting['show_ray'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Rays_Analysis') }}</th>
                            @endif
                            @if ($setting['show_chronic_diseases'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Chronic_Diseases') }}</th>
                            @endif
                            @if ($setting['show_glasses_distance'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Glasses_Distance') }}</th>
                            @endif
                            @if ($setting['show_prescription'] == 1)
                                <th>{{ trans('frontend/reservations_trans.Prescription') }}</th>
                            @endif
                            {{-- <th>{{trans('frontend/reservations_trans.Control')}}</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->reservation_id }}
                                </td>
                                @if (App::getLocale() == 'ar')
                                    <td>{{ $reservation->res_num }}</td>
                                @endif

                                <td>{{ $reservation->res_date }}</td>

                                @if (App::getLocale() == 'ar')
                                    <td>
                                        @if ($reservation->res_type == 'check')
                                            {{ trans('frontend/reservations_trans.Check') }}
                                        @elseif ($reservation->res_type == 'recheck')
                                            {{ trans('frontend/reservations_trans.Recheck') }}
                                        @elseif ($reservation->res_type == 'consultation')
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
                                    @if ($reservation->res_status == 'waiting')
                                        <span class="badge badge-rounded badge-warning text-white p-2 mb-2">
                                            {{ trans('frontend/reservations_trans.Waiting') }}
                                        </span>
                                    @elseif ($reservation->res_status == 'entered')
                                        <span class="badge badge-rounded badge-success p-2 mb-2">
                                            {{ trans('frontend/reservations_trans.Entered') }}
                                        </span>
                                    @elseif ($reservation->res_status == 'finished')
                                        <span class="badge badge-rounded badge-danger p-2 mb-2">
                                            {{ trans('frontend/reservations_trans.Finished') }}
                                        </span>
                                    @endif


                                </td>

                                @if ($setting['show_ray'] == 1)
                                    <td>
                                        @if (App\Models\Ray::class::where('reservation_id',$reservation->reservation_id)->first())
                                            <div class="res_control">
                                                <a href="{{ Route('frontend.appointment.show_ray', $reservation->reservation_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ trans('frontend/reservations_trans.Show') }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                @endif

                                @if ($setting['show_chronic_diseases'] == 1)
                                    <td>
                                        @if (App\Models\ChronicDisease::where('reservation_id',$reservation->reservation_id)->first())
                                        <div class="res_control">
                                            <a href="{{ Route('frontend.appointment.show_chronic_disease', $reservation->reservation_id) }}"
                                                class="btn btn-info btn-sm">
                                                {{ trans('frontend/reservations_trans.Show') }}
                                            </a>
                                        </div>
                                        @endif
                                    </td>   
                                @endif

                                @if ($setting['show_glasses_distance'] == 1)
                                <td>
                                    @if (\App\Models\GlassesDistance::class::where('reservation_id',$reservation->reservation_id)->first() )
                                    <div class="res_control">
                                        <a href="{{ Route('frontend.appointment.show_glasses_distance', $reservation->reservation_id) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('frontend/reservations_trans.Show') }}
                                        </a>
                                    </div>
                                    @endif
                                </td>
                                @endif

                                @if ($setting['show_prescription'] == 1)
                                <td>
                                    @if (App\Models\Drug::class::where('reservation_id',$reservation->reservation_id)->first())
                                    <div class="res_control">
                                        <a href="{{ Route('frontend.appointment.english_prescription_pdf', $reservation->reservation_id) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('frontend/reservations_trans.English') }}
                                        </a>

                                        <a href="{{ Route('frontend.appointment.arabic_prescription_pdf', $reservation->reservation_id) }}"
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
<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            // "scrollX": true
        });
    });
</script>
@endsection
