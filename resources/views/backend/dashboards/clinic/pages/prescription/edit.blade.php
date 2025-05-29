@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{ trans('backend/drugs_trans.Prescription') }}
@stop
@endsection

@section('page-header')
<h4 class="page-title">{{ trans('backend/drugs_trans.Prescription') }}</h4>
@endsection

@section('content')

<!-- row -->
<div class="custom-tab-1">
    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a href="#drugs" data-toggle="tab" class="nav-link active show">
                {{ trans('backend/drugs_trans.Drugs') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="#add_prescription" data-toggle="tab" class="nav-link">
                {{ trans('backend/drugs_trans.Update_Prescription') }}
            </a>
        </li>


    </ul>

    <div class="tab-content">

        <div id="drugs" class="tab-pane fade active show">

            @include('backend.dashboards.clinic.pages.prescription.edit_drugs')

        </div>

        <div id="add_prescription" class="tab-pane fade">

            @include('backend.dashboards.clinic.pages.prescription.edit_prescription_image')

        </div>


    </div>


</div>

<!-- row closed -->
@endsection
{{-- Add this script --}}
@push('scripts')
<script>
    // Add new row
    $(document).on('click', '.addRow', function() {
        let row = `
            <tr>
                <input type="hidden" name="drug_id[]">
                <td><input type="text" name="name[]" class="form-control" style="width:120px" placeholder="{{ trans('backend/drugs_trans.Drug_Name') }}"></td>
                <td><input type="text" name="dose[]" class="form-control m-0" style="width:120px" placeholder="{{ trans('backend/drugs_trans.Drug_Dose') }}"></td>
                <td><input type="text" name="type[]" class="form-control m-0" style="width:120px" placeholder="{{ trans('backend/drugs_trans.Drug_Type') }}"></td>
                <td><input type="text" name="frequency[]" class="form-control m-0" style="width:120px" placeholder="{{ trans('backend/drugs_trans.Frequency') }}"></td>
                <td><input type="text" name="period[]" class="form-control m-0" style="width:120px" placeholder="{{ trans('backend/drugs_trans.Period') }}"></td>
                <td><input type="text" name="notes[]" class="form-control m-0" style="width:200px" placeholder="{{ trans('backend/drugs_trans.Notes') }}"></td>
                <td><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{ trans('backend/drugs_trans.Delete') }}</a></td>
            </tr>
        `;
        $('#tbody').append(row);
    });

    // Delete row
    $(document).on('click', '.deleteRow', function() {
        let $button = $(this);
        let drugId = $button.data('id');

        console.log(drugId);

        if (!drugId) {
            // No ID, just remove the row (new row not saved in DB yet)
            $button.closest('tr').remove();
            return;
        }

        if (confirm("Are you sure you want to delete this drug?")) {
            $.ajax({
                url: `/clinic/prescription/drugs/${drugId}`, // adjust route if necessary
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

    function previewImages(event) {
        const files = event.target.files;
        const container = document.getElementById('image-preview-container');
        container.innerHTML = ''; // Clear previous previews

        if (files.length > 0) {
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.classList.add('col-md-3', 'mb-3');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail');
                        img.style.maxHeight = '150px';

                        col.appendChild(img);
                        container.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }
</script>
@endpush