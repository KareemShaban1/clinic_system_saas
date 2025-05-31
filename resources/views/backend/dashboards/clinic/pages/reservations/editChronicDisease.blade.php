@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{trans('backend/chronic_diseases_trans.Edit_Chronic')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/chronic_diseases_trans.Edit_Chronic')}}</h4>
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

                <x-backend.alert />

                <form action="{{Route('clinic.reservations.updateChronicDisease',$reservation->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    @method('PUT')
                    <input type="text" name="patient_id" hidden value="{{$reservation->patient_id}}" type="text">
                    <input type="text" name="reservation_id" hidden value="{{$reservation->id}}" type="text">

                    <br>

                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                            <table class="table table-bordered table-responsive" id="table">

                                <thead>
                                    <tr>
                                        <th>{{trans('backend/chronic_diseases_trans.Disease_Name')}}</th>
                                        <th>{{trans('backend/chronic_diseases_trans.Disease_Measure')}}</th>
                                        <th>{{trans('backend/chronic_diseases_trans.Disease_Date')}}</th>
                                        <th>{{trans('backend/chronic_diseases_trans.Notes')}}</th>
                                        <th>
                                            <a href="javascript:void(0)" class="btn btn-success addRow">
                                                {{trans('backend/chronic_diseases_trans.Add_Disease')}}
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ($chronic_diseases as $chronic_disease)
                                    <tr>
                                        <td><input type="text" name="name[]" value="{{ old('name', $chronic_disease->name) }}" class="form-control"></td>
                                        <td><input type="text" name="measure[]" value="{{ old('measure', $chronic_disease->measure) }}" class="form-control"></td>
                                        <td><input type="date" name="date[]" value="{{ old('date', $chronic_disease->date) }}" class="form-control"></td>
                                        <td><input type="text" name="notes[]" value="{{ old('notes', $chronic_disease->notes) }}" class="form-control"></td>
                                        <td><button type="button" class="btn btn-danger deleteRow"
                                        data-id="{{ $chronic_disease->id ?? '' }}"
                                        >{{trans('backend/chronic_diseases_trans.Delete')}}</button></td>
                                        <input type="hidden" name="id[]" value="{{ $chronic_disease->id }}">
                                    </tr>
                                    @endforeach

                                </tbody>


                            </table>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{trans('backend/chronic_diseases_trans.Edit')}}</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tbody = document.getElementById('tbody');

        // Handle Add Row
        document.querySelector('.addRow').addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" name="name[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Name')}}"></td>
                <td><input type="text" name="measure[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Measure')}}"></td>
                <td><input type="date" name="date[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Date')}}"></td>
                <td><input type="text" name="notes[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Notes')}}"></td>
                <td><button type="button" class="btn btn-danger deleteRow">{{trans('backend/chronic_diseases_trans.Delete')}}</button></td>
                <input type="hidden" name="id[]" value="">
            `;
            tbody.appendChild(newRow);
        });

        // Handle Delete Row
        // Delete row
        $(document).on('click', '.deleteRow', function() {
            let $button = $(this);
            let chronicDiseaseId = $button.data('id');

            console.log(chronicDiseaseId);

            if (!chronicDiseaseId) {
                // No ID, just remove the row (new row not saved in DB yet)
                $button.closest('tr').remove();
                return;
            }

            if (confirm("Are you sure you want to delete this drug?")) {
                $.ajax({
                    url: `/clinic/chronic_diseases/${chronicDiseaseId}`, // adjust route if necessary
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $button.closest('tr').remove();
                        toastr.success(response.message || 'Deleted successfully');
                    },
                    error: function() {
                        toastr.error('Failed to delete. Try again.');
                    }
                });
            }
        });

    });
</script>
@endpush