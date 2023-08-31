@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Show_Reservation') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservations_trans.Show_Reservation') }}</h4>
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

                <div class="content-body">
                    <div class="container-fluid">
                        <div class="row">



                            <div class="col-xl-12 col-xxl-8 col-lg-8 col-12 p-0">

                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#info" data-toggle="tab" class="nav-link active show">
                                                    {{ trans('backend/reservations_trans.Reservation_Information') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#chronic_disease" data-toggle="tab" class="nav-link">
                                                    {{ trans('backend/reservations_trans.Chronic_Diseases') }}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#rays" data-toggle="tab" class="nav-link">
                                                    {{ trans('backend/reservations_trans.Rays_Analysis') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#prescription" data-toggle="tab" class="nav-link">
                                                    {{ trans('backend/reservations_trans.Prescription') }}
                                                </a>
                                            </li>

                                        </ul>

                                        <div class="tab-content">

                                            <div id="info" class="tab-pane fade active show">


                                                <div class="my-post-content pt-4">


                                                    <h5 class="card-header">
                                                        <span class="badge badge-rounded badge-warning ">
                                                            <h5> {{ trans('backend/reservations_trans.Reservation_Information') }}
                                                            </h5>
                                                        </span>
                                                    </h5>

                                                    <div class="card-body">

                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.Id') }}
                                                                    <span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                <span>{{ $reservation->reservation_id }}</span>
                                                            </div>
                                                        </div>


                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.Number_of_Reservation') }}<span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                <span>{{ $reservation->res_num }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.First_Diagnosis') }}
                                                                    <span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                <span>{{ $reservation->first_diagnosis }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.Reservation_Type') }}<span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>
                                                                    <p>

                                                                        @if ($reservation->res_type == 'check')
                                                                            {{ trans('backend/reservations_trans.Check') }}
                                                                        @elseif($reservation->res_type == 'recheck')
                                                                            {{ trans('backend/reservations_trans.Recheck') }}
                                                                        @elseif($reservation->res_type == 'consultation')
                                                                            {{ trans('backend/reservations_trans.Consultation') }}
                                                                        @endif
                                                                    </p>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.Reservation_Status') }}<span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>
                                                                    <p>
                                                                        @if ($reservation->status == 'waiting')
                                                                            <span
                                                                                class="badge badge-rounded badge-warning text-white p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Waiting') }}
                                                                            </span>
                                                                        @elseif($reservation->status == 'entered')
                                                                            <span
                                                                                class="badge badge-rounded badge-success p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Entered') }}
                                                                            </span>
                                                                        @elseif($reservation->status == 'finished')
                                                                            <span
                                                                                class="badge badge-rounded badge-danger p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Finished') }}
                                                                            </span>
                                                                        @endif
                                                                    </p>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.Payment') }}<span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>
                                                                    <p>
                                                                        @if ($reservation->payment == 'paid')
                                                                            <span
                                                                                class="badge badge-rounded badge-success">{{ trans('backend/reservations_trans.Paid') }}</span>
                                                                        @elseif($reservation->payment == 'not paid')
                                                                            <span
                                                                                class="badge badge-rounded badge-danger">{{ trans('backend/reservations_trans.Not_Paid') }}</span>
                                                                        @endif
                                                                    </p>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.Reservation_Date') }}<span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                <span>{{ $reservation->res_date }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                <h5 class="f-w-500">
                                                                    {{ trans('backend/reservations_trans.Final_Diagnosis') }}<span
                                                                        class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                <span>{{ $reservation->final_diagnosis }}</span>
                                                            </div>
                                                        </div>



                                                    </div>


                                                </div>


                                            </div>


                                            <div id="chronic_disease" class="tab-pane fade">

                                                <div class="my-post-content pt-4">


                                                    @forelse($chronic_diseases as $chronic_disease)
                                                        <h5 class="card-header">
                                                            <span class="badge badge-rounded badge-warning ">
                                                                <h5> {{ trans('backend/reservations_trans.Chronic_Diasease_Number') }}
                                                                    {{ $loop->index + 1 }} </h5>
                                                            </span>
                                                        </h5>
                                                        <div class="card-body">

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">{{ __('ID') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $chronic_disease->reservation_id }}</span>
                                                                </div>
                                                            </div>


                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Disease_Name') }}<span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $chronic_disease->title }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Disease_Measure') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $chronic_disease->measure }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Disease_Date') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $chronic_disease->date }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Notes') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $chronic_disease->notes }}</span>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    @empty

                                                        <div>لا يوجد أمراض مزمنة لهذا الكشف</div>
                                                    @endforelse
                                                </div>


                                            </div>






                                            <div id="prescription" class="tab-pane fade">

                                                <div class="my-post-content pt-4">


                                                    @forelse($drugs as $drug)
                                                        <h5 class="card-header">
                                                            <span class="badge badge-rounded badge-warning ">
                                                                <h5> {{ trans('backend/reservations_trans.Prescription_Number') }}
                                                                    {{ $loop->index + 1 }} </h5>
                                                            </span>
                                                        </h5>
                                                        <div class="card-body">

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Id') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $drug->id }}</span>
                                                                </div>
                                                            </div>


                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Drug_Name') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $drug->drug_name }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Drug_Dose') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $drug->drug_dose }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Quantity') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $drug->quantity }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Notes') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $drug->notes }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @empty

                                                        <div>لا يوجد روشتة لهذا الكشف</div>
                                                    @endforelse
                                                </div>


                                            </div>

                                            <div id="rays" class="tab-pane fade">

                                                <div class="my-post-content pt-4">

                                                    @forelse($rays as $ray)

                                                        <h5 class="card-header">
                                                            <span class="badge badge-rounded badge-warning ">
                                                                <h5> {{ trans('backend/reservations_trans.Rays_Number') }}
                                                                    {{ $loop->index + 1 }} </h5>
                                                            </span>
                                                        </h5>
                                                        <div class="card-body">

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Id') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $ray->id }}</span>
                                                                </div>
                                                            </div>


                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Rays_Name') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $ray->ray_name }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Rays_Date') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $ray->ray_date }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Rays_Type') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>{{ $ray->ray_type }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">
                                                                        {{ trans('backend/reservations_trans.Rays_Image') }}
                                                                        <span
                                                                            class="{{ trans('backend/reservations_trans.pull') }}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <?php $images = explode('|', $ray->image); ?>
                                                                    @foreach ($images as $key => $value)
                                                                        <img src="{{ URL::asset('storage/rays/' . $value) }}"
                                                                            width="200" height="200">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>



                                                    @empty

                                                    @endforelse


                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
