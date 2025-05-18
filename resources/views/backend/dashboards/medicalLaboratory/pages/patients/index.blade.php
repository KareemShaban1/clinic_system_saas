@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')
<style>
    tfoot input {
        width: 70%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@section('title')
{{ trans('backend/patients_trans.Patients') }}
@stop
@endsection
@section('page-header')

<h4 class="page-title">{{ trans('backend/patients_trans.Patients') }}</h4>

@endsection

@section('content')

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive p-0">
                    <table id="patients_table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/patients_trans.Id') }}</th>
                                <th>{{ trans('backend/patients_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/patients_trans.Number_of_Reservations') }}</th>
                                <th>{{ trans('backend/patients_trans.Email') }}</th>
                                <th>{{ trans('backend/patients_trans.Phone') }}</th>
                                <th>{{ trans('backend/patients_trans.Address') }}</th>
                                <th>{{ trans('backend/patients_trans.Age') }}</th>
                                <!-- <th>{{ trans('backend/patients_trans.Add_Reservation') }}</th> -->
                                <!-- <th>{{ trans('backend/patients_trans.Add_Online_Reservation') }}</th> -->
                                <th>{{ trans('backend/patients_trans.Patient_Card') }}</th>
                                <th>{{ trans('backend/patients_trans.Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td>{{ $patient->name }}</td>
                                <th>
                                    {{ count(App\Models\Reservation::where('id', $patient->id)->get()) }}
                                </th>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->phone }}</td>
                                <td>{{ $patient->address }}</td>
                                <td>{{ $patient->age }}</td>
                                <td>
                                    <a href="{{ Route('medicalLaboratory.reservations.add', $patient->id) }}"
                                        class="btn btn-info btn-sm">
                                        {{ trans('backend/patients_trans.Add_Reservation') }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ Route('medicalLaboratory.online_reservations.add', $patient->id) }}"
                                        class="btn btn-info btn-sm">
                                        {{ trans('backend/patients_trans.Add_Online_Reservation') }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ Route('medicalLaboratory.patients.patient_pdf', $patient->id) }}"
                                        class="btn btn-primary btn-sm">
                                        {{ trans('Backend/patients_trans.Show_Patient_Card') }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ Route('medicalLaboratory.patients.show', $patient->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ Route('medicalLaboratory.patients.edit', $patient->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    @if (count($patient->reservations) == 0)
                                    <form
                                        action="{{ Route('medicalLaboratory.patients.destroy', $patient->id) }}"
                                        method="post" style="display:inline">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif


                                </td>

                            </tr>
                            @endforeach -->
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

        var table = $('#patients_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('medicalLaboratory.patients.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'number_of_reservations',
                    name: 'number_of_reservations',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'age',
                    name: 'age'
                },
                // {
                //     data: 'add_reservation',
                //     name: 'add_reservation',
                //     orderable: false,
                //     searchable: false
                // },
                // {
                //     data: 'add_online_reservation',
                //     name: 'add_online_reservation',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    data: 'patient_card',
                    name: 'patient_card',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ],
            language: languages[language],
            pageLength: 10,
            responsive: true,
            "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
    });
</script>
@endpush