<div class="row pt-4">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form method="post" enctype="multipart/form-data"
                    action="{{ route('clinic.prescription.updatePrescription', $prescription->id) }}" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="reservation_id" value="{{ $prescription->reservation_id }}">
                    <input type="hidden" name="patient_id" value="{{ $prescription->patient_id }}">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="notes">
                                    {{ trans('backend/drugs_trans.Notes') }}
                                </label>
                                <textarea name="notes" class="form-control" id="notes" rows="3">{{ old('notes', $prescription->notes) }}</textarea>
                                @error('notes')
                                <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Existing images display --}}
                    @if($prescription->images && count($prescription->images) > 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label">{{ trans('backend/drugs_trans.Current_Images') }}</label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($prescription->images as $image)
                                <div>
                                    <img src="{{  $image }}" alt="Prescription Image" width="100" class="img-thumbnail">
                                   
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Upload new images --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/drugs_trans.Prescription_Image') }}</label>
                                <input class="form-control" name="images[]" type="file"
                                    accept="image/*" multiple onchange="previewImages(event)">
                                @error('images')
                                <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3" id="image-preview-container"></div>



                    <button type="submit"
                        class="btn btn-primary btn-md btn-lg">{{ trans('backend/drugs_trans.Update') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>