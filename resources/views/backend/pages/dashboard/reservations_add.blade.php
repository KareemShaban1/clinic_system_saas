<div class="row card-body p-2">

    <x-backend.alert />
    
    <div class="col-12 col-xl-12 col-md-12 col-sm-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <div class="tab nav-border" style="position: relative;">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block w-100 col-3 col-sm-3">
                            <h5 class="card-title"> الحجز بطريقة سريعة أخر 7 أيام </h5>
                        </div>

                        <div class="d-block d-md-flex nav-tabs-custom col-9 col-sm-9">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                @php
                                    $daysBeforeToday = 3;
                                    $daysAfterToday = 3;
                                @endphp
                                @for ($i = -$daysBeforeToday; $i <= $daysAfterToday; $i++)
                                    @php
                                        // $date = now()->subDays($i);
                                        $date = now()->addDays($i);
                                        $dateFormatted = $date->format('Y-m-d');
                                        $activeClass = $i == 0 ? 'active show' : '';
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link {{ $activeClass }}" id="{{ $dateFormatted }}-tab"
                                            data-toggle="tab" href="#{{ $dateFormatted }}" role="tab"
                                            aria-controls="{{ $dateFormatted }}"
                                            aria-selected="{{ $activeClass ? 'true' : 'false' }}">
                                            {{ $dateFormatted }}
                                        </a>
                                    </li>
                                @endfor

                            </ul>
                        </div>

                    </div>



                    <div  class="tab-content" id="myTabContent">

                        @php
                            $daysBeforeToday = 3;
                            $daysAfterToday = 3;
                        @endphp
                        @for ($i = -$daysBeforeToday; $i <= $daysAfterToday; $i++)
                            @php
                                // $date = now()->subDays($i);
                                $date = now()->addDays($i);
                                $dateFormatted = $date->format('Y-m-d');
                                $activeClass = $i == 0 ? 'active show' : '';
                                $number_of_reservations = App\Models\NumberOfReservations::where('reservation_date', $dateFormatted)->value('num_of_reservations');
                                $number_of_slot = App\Models\ReservationSlots::where('date', '=', $dateFormatted)->first();
                                $slots = $number_of_slot ? App\Http\Traits\TimeSlotsTrait::getTimeSlot($number_of_slot->duration, $number_of_slot->start_time, $number_of_slot->end_time) : [];
                            @endphp
                            @foreach ($slots as $slot)
                                {{ is_array($slot) ? null : htmlspecialchars($slot) }}
                            @endforeach


                            <div class="tab-pane fade {{ $activeClass }}" id="{{ $dateFormatted }}" role="tabpanel"
                                aria-labelledby="{{ $dateFormatted }}-tab">
                                <div>

                                    @if ($number_of_reservations)

                                        @for ($j = 1; $j <= $number_of_reservations; $j++)
                                            @php
                                                $reserved = App\Models\Reservation::where('res_date', $dateFormatted)
                                                    ->where('res_num', $j)
                                                    ->value('res_num');
                                            @endphp

                                            @if ($reserved == $j)
                                                <a class="btn btn-danger btn-lg text-white" disabled="disabled">
                                                    {{ $reserved }}
                                                </a>
                                            @else
                                                <a class="btn btn-info btn-lg text-white" data-toggle="modal"
                                                    data-target="#addReservationModal{{ $dateFormatted }}_{{ $j }}">
                                                    {{ $j }}
                                                </a>
                                            @endif

                                            <!-- Add Reservation Modal -->
                                            <div class="modal fade"
                                                id="addReservationModal{{ $dateFormatted }}_{{ $j }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="addReservationModalLabel{{ $dateFormatted }}_{{ $j }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="addReservationModalLabel{{ $dateFormatted }}_{{ $j }}">
                                                                {{ trans('backend/dashboard_trans.Add_Reservation') }}
                                                                {{ $j }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <!-- Add reservation form goes here -->
                                                            

                                                            <form method="post" enctype="multipart/form-data"
                                                                action="{{ Route('backend.reservations.store') }}"
                                                                autocomplete="off">
                                                                @csrf
                                                                <div class="row">

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-control-label">{{ trans('backend/reservations_trans.Patient_Name') }}
                                                                            </label>
                                                                            <select name="patient_id"
                                                                                class="custom-select mr-sm-2">
                                                                                <option disabled selected>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                @foreach ($patients as $patient)
                                                                                    <option
                                                                                        value="{{ $patient->patient_id }}">
                                                                                        {{ $patient->name }}</option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                {{ trans('backend/reservations_trans.Reservation_Date') }}
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input class="form-control" name="res_date"
                                                                                id="datepicker-action"
                                                                                value="{{ $dateFormatted }}"
                                                                                data-date-format="yyyy-mm-dd">

                                                                        </div>
                                                                    </div>



                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                {{ trans('backend/reservations_trans.Number_of_Reservation') }}
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <select name="res_num"
                                                                                class="custom-select mr-sm-2">
                                                                                <option selected>
                                                                                    {{ $j }}
                                                                                </option>

                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                </div>





                                                                <div class="row">

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-label">{{ trans('backend/reservations_trans.Reservation_Type') }}
                                                                            </label>
                                                                            <select name="res_type"
                                                                                class="custom-select mr-sm-2">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="check">
                                                                                    {{ trans('backend/reservations_trans.Check') }}
                                                                                </option>
                                                                                <option value="recheck">
                                                                                    {{ trans('backend/reservations_trans.Recheck') }}
                                                                                </option>
                                                                                <option value="consultation">
                                                                                    {{ trans('backend/reservations_trans.Consultation') }}
                                                                                </option>
                                                                            </select>


                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                {{ trans('backend/reservations_trans.Cost') }}<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input class="form-control" name="cost"
                                                                                type="number">

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-label">{{ trans('backend/reservations_trans.Payment') }}</label>
                                                                            <select name="payment"
                                                                                class="custom-select mr-sm-2">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="paid">
                                                                                    {{ trans('backend/reservations_trans.Paid') }}
                                                                                </option>
                                                                                <option value="not paid">
                                                                                    {{ trans('backend/reservations_trans.Not_Paid') }}
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="res_status">
                                                                                {{ trans('backend/reservations_trans.Reservation_Status') }}<span
                                                                                    class="text-danger">*</span></label>
                                                                            <select class="custom-select mr-sm-2"
                                                                                name="res_status" id="res_status">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="waiting">
                                                                                    {{ trans('backend/reservations_trans.Waiting') }}
                                                                                </option>
                                                                                <option value="entered">
                                                                                    {{ trans('backend/reservations_trans.Entered') }}
                                                                                </option>
                                                                                <option value="finished">
                                                                                    {{ trans('backend/reservations_trans.Finished') }}
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="acceptance">
                                                                                {{ trans('backend/reservations_trans.Acceptance') }}<span
                                                                                    class="text-danger">*</span></label>
                                                                            <select class="custom-select mr-sm-2"
                                                                                name="acceptance" id="acceptance">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="approved">
                                                                                    {{ trans('backend/reservations_trans.Approved') }}
                                                                                </option>
                                                                                <option value="not_approved">
                                                                                    {{ trans('backend/reservations_trans.Not_Approved') }}
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>{{ trans('backend/reservations_trans.First_Diagnosis') }}
                                                                            </label>
                                                                            <textarea class="summernote" name="first_diagnosis"
                                                                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                            </textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <button type="submit"
                                                                    class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/reservations_trans.Add') }}</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </form>

                                                        </div>

                                                        {{-- <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button"
                                                                class="btn btn-primary">Save</button>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @elseif ($number_of_slot)
                                        @foreach ($slots as $slot)
                                            @php
                                                $reserved_slot = App\Models\Reservation::where('res_date', $dateFormatted)
                                                    ->where('slot', $slot['slot_start_time'])
                                                    ->value('slot');
                                            @endphp

                                            @if ($reserved_slot == $slot['slot_start_time'])
                                                <a class="btn btn-danger btn-lg text-white" disabled="disabled">
                                                    {{ $slot['slot_start_time'] }} - {{ $slot['slot_end_time'] }}
                                                </a>
                                            @else
                                                <a class="btn btn-info btn-lg text-white" data-toggle="modal"
                                                    data-target="#addReservationModal{{ $dateFormatted }}_{{ $loop->index }}">

                                                    {{ $slot['slot_start_time'] }} - {{ $slot['slot_end_time'] }}

                                                </a>
                                            @endif

                                            <!-- Add Reservation Modal -->
                                            <div class="modal fade"
                                                id="addReservationModal{{ $dateFormatted }}_{{ $loop->index }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="addReservationModalLabel{{ $dateFormatted }}_{{ $loop->index }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="addReservationModalLabel{{ $dateFormatted }}_{{ $loop->index }}">
                                                                Add Reservation {{ $loop->index }}
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <!-- Add reservation form goes here -->
                                                            <x-backend.alert />

                                                            <form method="post" enctype="multipart/form-data"
                                                                action="{{ Route('backend.reservations.store') }}"
                                                                autocomplete="off">
                                                                @csrf
                                                                <div class="row">

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-control-label">{{ trans('backend/reservations_trans.Patient_Name') }}
                                                                            </label>
                                                                            <select name="patient_id"
                                                                                class="custom-select mr-sm-2">
                                                                                <option disabled selected>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                @foreach ($patients as $patient)
                                                                                    <option
                                                                                        value="{{ $patient->patient_id }}">
                                                                                        {{ $patient->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                {{ trans('backend/reservations_trans.Reservation_Date') }}
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input class="form-control"
                                                                                name="res_date" id="datepicker-action"
                                                                                value="{{ $dateFormatted }}"
                                                                                data-date-format="yyyy-mm-dd">

                                                                        </div>
                                                                    </div>

                                                                    {{-- @if ($settings['reservation_slots'] == 1) --}}
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                {{ trans('backend/reservations_trans.Reservation_Slots') }}
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <select name="slot" id="slot-select"
                                                                                class="custom-select mr-sm-2">
                                                                                <option selected
                                                                                    value="{{ $slot['slot_start_time'] }}">
                                                                                    {{ $slot['slot_start_time'] }} -
                                                                                    {{ $slot['slot_end_time'] }}
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                    {{-- @else --}}

                                                                    {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label>
                                                                                    {{ trans('backend/reservations_trans.Number_of_Reservation') }}
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select name="res_num"
                                                                                    class="custom-select mr-sm-2">
                                                                                    <option selected>
                                                                                        {{ $j }}
                                                                                    </option>

                                                                                </select>

                                                                            </div>
                                                                        </div> --}}
                                                                    {{-- @endif --}}

                                                                </div>





                                                                <div class="row">

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-label">{{ trans('backend/reservations_trans.Reservation_Type') }}
                                                                            </label>
                                                                            <select name="res_type"
                                                                                class="custom-select mr-sm-2">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="check">
                                                                                    {{ trans('backend/reservations_trans.Check') }}
                                                                                </option>
                                                                                <option value="recheck">
                                                                                    {{ trans('backend/reservations_trans.Recheck') }}
                                                                                </option>
                                                                                <option value="consultation">
                                                                                    {{ trans('backend/reservations_trans.Consultation') }}
                                                                                </option>
                                                                            </select>


                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>
                                                                                {{ trans('backend/reservations_trans.Cost') }}<span
                                                                                    class="text-danger">*</span></label>
                                                                            <input class="form-control" name="cost"
                                                                                type="number">

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-label">{{ trans('backend/reservations_trans.Payment') }}</label>
                                                                            <select name="payment"
                                                                                class="custom-select mr-sm-2">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="paid">
                                                                                    {{ trans('backend/reservations_trans.Paid') }}
                                                                                </option>
                                                                                <option value="not paid">
                                                                                    {{ trans('backend/reservations_trans.Not_Paid') }}
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="res_status">
                                                                                {{ trans('backend/reservations_trans.Reservation_Status') }}<span
                                                                                    class="text-danger">*</span></label>
                                                                            <select class="custom-select mr-sm-2"
                                                                                name="res_status" id="res_status">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="waiting">
                                                                                    {{ trans('backend/reservations_trans.Waiting') }}
                                                                                </option>
                                                                                <option value="entered">
                                                                                    {{ trans('backend/reservations_trans.Entered') }}
                                                                                </option>
                                                                                <option value="finished">
                                                                                    {{ trans('backend/reservations_trans.Finished') }}
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="acceptance">
                                                                                {{ trans('backend/reservations_trans.Acceptance') }}<span
                                                                                    class="text-danger">*</span></label>
                                                                            <select class="custom-select mr-sm-2"
                                                                                name="acceptance" id="acceptance">
                                                                                <option selected disabled>
                                                                                    {{ trans('backend/reservations_trans.Choose') }}
                                                                                </option>
                                                                                <option value="approved">
                                                                                    {{ trans('backend/reservations_trans.Approved') }}
                                                                                </option>
                                                                                <option value="not_approved">
                                                                                    {{ trans('backend/reservations_trans.Not_Approved') }}
                                                                                </option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>{{ trans('backend/reservations_trans.First_Diagnosis') }}
                                                                            </label>

                                                                            {{-- <textarea id="summernote" name="first_diagnosis" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea> --}}

                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <button type="submit"
                                                                    class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/reservations_trans.Add') }}</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </form>

                                                        </div>

                                                        {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button"
                                                        class="btn btn-primary">Save</button>
                                                </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    @endif


                                </div>
                            </div>
                        @endfor

                    </div>


                </div>


            </div>
        </div>
    </div>


</div>
