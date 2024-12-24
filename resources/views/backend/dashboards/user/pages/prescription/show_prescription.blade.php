<div class="row pt-4">
          @forelse ($prescriptions as $key => $prescription)
              <div class="col-md-6 mb-30">
                  <div class="card card-statistics h-100">
                      <h5 class="card-header">
                          <span class="badge badge-rounded badge-warning">
                              <h5>{{ trans('backend/drugs_trans.Prescription_Number') }} {{ $key + 1 }}
                              </h5>
                          </span>
                      </h5>
                      <div class="card-body">
                          <div class="row mb-4">
                              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                  <h5 class="f-w-500">{{ trans('backend/drugs_trans.Notes') }}<span
                                          class="pull-left">:</span></h5>
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-6 col-12">
                                  <span>{{ $prescription->notes }}</span>
                              </div>
                          </div>
                          <div class="row mb-4">
                              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                  <h5 class="f-w-500">{{ trans('backend/drugs_trans.Prescription_Image') }}<span
                                          class="pull-left">:</span></h5>
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-6 col-12">
                                  <?php $images = explode('|', $prescription->images); ?>
                                  @foreach ($images as $value)
                                  <a  href="{{ URL::asset('storage/prescriptions/' . $value) }}" download
                                  title="تحميل الصورة">
                                      <img class="prescription-image" src="{{ URL::asset('storage/prescriptions/' . $value) }}"
                                      alt="تحميل الصورة"   width="350" height="500">
                                  </a>        
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              @if (($key + 1) % 2 === 0)
      </div>
      <div class="row pt-4">
          @endif
      @empty
          <div class="col-md-12">
              <p>No prescriptions found.</p>
          </div>
          @endforelse
      </div>