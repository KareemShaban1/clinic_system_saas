@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Reservations') }}
@stop

@endsection

@section('page-header')

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservations_trans.Reservations') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('backend/reservations_trans.All_Reservations') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('backend/reservations_trans.Reservations') }}</li>
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
                            <th></th>
                            <th>{{ trans('backend/reservations_trans.Patient_Name') }}</th>
                            @if (App::getLocale() == 'ar')
                                <th>{{ trans('backend/reservations_trans.Reservation_Type') }}</th>
                            @endif
                            <th>{{ trans('backend/reservations_trans.Payment') }}</th>
                            <th>{{ trans('backend/reservations_trans.Reservation_Status') }}</th>
                            <th>{{ trans('backend/reservations_trans.Acceptance') }}</th>

                            @if ($reservation_settings['show_ray'] == 1)
                                <th>{{ trans('backend/reservations_trans.Rays_Analysis') }}</th>
                            @endif
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
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $reservation->patient->name }}</td>

                                @if (App::getLocale() == 'ar')
                                    <td>
                                        @if ($reservation->res_type == 'check')
                                            {{ trans('backend/reservations_trans.Check') }}
                                        @elseif ($reservation->res_type == 'recheck')
                                            {{ trans('backend/reservations_trans.Recheck') }}
                                        @elseif ($reservation->res_type == 'consultation')
                                            {{ trans('backend/reservations_trans.Consultation') }}
                                        @endif
                                    </td>
                                @endif

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
                                        <a href="{{ Route('backend.reservations_options.payment_status', [$reservation->reservation_id, 'paid']) }}"
                                            class="btn btn-success btn-sm">{{ trans('backend/reservations_trans.Done') }}
                                        </a>
                                        <a href="{{ Route('backend.reservations_options.payment_status', [$reservation->reservation_id, 'not paid']) }}"
                                            class="btn btn-danger btn-sm">{{ trans('backend/reservations_trans.Not_Done') }}
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

                                        <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'waiting']) }}"
                                            class="btn btn-warning btn-sm text-white">
                                            {{ trans('backend/reservations_trans.Waiting') }}
                                        </a>
                                        <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'entered']) }}"
                                            class="btn btn-success btn-sm">
                                            {{ trans('backend/reservations_trans.Entered') }}
                                        </a>
                                        <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'finished']) }}"
                                            class="btn btn-info btn-sm">
                                            {{ trans('backend/reservations_trans.Finished') }}
                                        </a>
                                        <a href="{{ Route('backend.reservations_options.reservation_status', [$reservation->reservation_id, 'cancelled']) }}"
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
                                    @endif

                                    <div class="res_control">
                                        <a href="{{ Route('backend.reservations_options.reservation_acceptance', [$reservation->reservation_id, 'approved']) }}"
                                            class="btn btn-success btn-sm text-white">
                                            {{ trans('backend/reservations_trans.Approved') }}
                                        </a>

                                        <a href="{{ Route('backend.reservations_options.reservation_acceptance', [$reservation->reservation_id, 'not_approved']) }}"
                                            class="btn btn-danger btn-sm text-white">
                                            {{ trans('backend/reservations_trans.Not_Approved') }}
                                        </a>
                                    </div>


                                </td>

                                @if ($reservation_settings['show_ray'] == 1)
                                    <td>
                                        @if (App\Models\Ray::where('reservation_id', $reservation->reservation_id)->first())
                                            <div class="res_control">
                                                <a href="{{ Route('backend.rays.add', $reservation->reservation_id) }}"
                                                    class="btn btn-success btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>
                                                <a href="{{ Route('backend.rays.show', $reservation->reservation_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ trans('backend/reservations_trans.Show') }}
                                                </a>
                                            </div>
                                        @else
                                            <div class="res_control">
                                                <a href="{{ Route('backend.rays.add', $reservation->reservation_id) }}"
                                                    class="btn btn-success btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>

                                            </div>
                                        @endif
                                    </td>
                                @endif

                                @if ($reservation_settings['show_chronic_diseases'] == 1)
                                    <td>
                                        <div class="res_control">


                                            @if (App\Models\ChronicDisease::where('reservation_id', $reservation->reservation_id)->first())
                                                <a href="{{ Route('backend.chronic_diseases.add', $reservation->reservation_id) }}"
                                                    class="btn btn-success btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>
                                                <a href="{{ Route('backend.chronic_diseases.show', $reservation->reservation_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ trans('backend/reservations_trans.Show') }}
                                                </a>
                                            @else
                                                <a href="{{ Route('backend.chronic_diseases.add', $reservation->reservation_id) }}"
                                                    class="btn btn-success btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>
                                            @endif

                                        </div>

                                    </td>
                                @endif

                                @if ($clinic_type == 'عيون')
                                    <td>
                                        @if (App\Models\GlassesDistance::where('reservation_id', $reservation->reservation_id)->first())
                                            <div class="res_control">
                                                <a href="{{ Route('backend.glasses_distance.edit', $reservation->reservation_id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    {{ trans('backend/reservations_trans.Edit') }}
                                                </a>
                                                <a href="{{ Route('backend.glasses_distance.glasses_distance_pdf', $reservation->reservation_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ trans('backend/reservations_trans.Show') }}
                                                </a>
                                            </div>
                                        @else
                                            <a href="{{ Route('backend.glasses_distance.add', $reservation->reservation_id) }}"
                                                class="btn btn-success btn-sm">
                                                {{ trans('backend/reservations_trans.Add') }}
                                            </a>
                                        @endif
                                    </td>
                                @endif

                                @if ($reservation_settings['show_prescription'] == 1)
                                    <td>
                                        <div class="res_control">



                                            @if (App\Models\Drug::where('reservation_id', $reservation->reservation_id)->first())
                                                <a href="{{ Route('backend.drugs.arabic_prescription_pdf', $reservation->reservation_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ trans('backend/reservations_trans.Arabic') }}
                                                </a>

                                                <a href="{{ Route('backend.drugs.english_prescription_pdf', $reservation->reservation_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    {{ trans('backend/reservations_trans.English') }}
                                                </a>
                                            @else
                                                <a href="{{ Route('backend.drugs.add', $reservation->reservation_id) }}"
                                                    class="btn btn-success btn-sm">
                                                    {{ trans('backend/reservations_trans.Add') }}
                                                </a>
                                            @endif


                                        </div>
                                    </td>
                                @endif


                                <td>
                                    <div class="res_control">
                                        <a href="{{ Route('backend.reservations.show', $reservation->reservation_id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ Route('backend.reservations.edit', $reservation->reservation_id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ Route('backend.reservations.destroy', $reservation->reservation_id) }}"
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
<!-- row closed -->
@endsection
@section('js')

@endsection
