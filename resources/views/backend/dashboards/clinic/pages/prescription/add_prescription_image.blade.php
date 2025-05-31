<div class="row pt-4">
          <div class="col-md-12 mb-30">
              <div class="card card-statistics h-100">
                  <div class="card-body">

                      <form method="post" enctype="multipart/form-data"
                          action="{{ Route('clinic.prescription.storePrescription') }}" autocomplete="off">

                          @csrf
                          

                          <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                          <input type="hidden" name="patient_id" value="{{ $reservation->patient_id }}">

                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-outline mb-4">
                                      <label class="form-label"
                                          for="notes">{{ trans('backend/drugs_trans.Notes') }}</label>
                                      <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>
                                      @error('notes')
                                          <p class="alert alert-danger">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>
                          </div>

                          <div class="row">

                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <label> {{ trans('backend/drugs_trans.Prescription_Image') }}<span
                                              class="text-danger">*</span></label>
                                      <input class="form-control" name="images[]" type="file"
                                          accept="image/*" multiple="multiple">
                                      @error('images')
                                          <p class="alert alert-danger">{{ $message }}</p>
                                      @enderror
                                  </div>
                              </div>

                          </div>


                          <button type="submit"
                              class="btn btn-success btn-md nextBtn btn-lg">{{ trans('backend/drugs_trans.Add') }}</button>


                      </form>

                  </div>
              </div>
          </div>
      </div>