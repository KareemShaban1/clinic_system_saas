<div class="row justify-content-center">
          <div class="col-md-4 col-12">
              <div class="card" style="height: 300px">
                  <div class="card-header">{{ trans('backend/dashboard_trans.Patients_Statistics') }}</div>

                  <div class="card-body">

                      {{-- {!! $user_chart->renderHtml() !!} --}}
                      <canvas id="patients_by_months" width="300" height="200">

                      </canvas>

                  </div>
                  
              </div>
          </div>

          <div class="col-md-4 col-12">
              <div class="card" style="height: 300px">
                  <div class="card-header">{{ trans('backend/dashboard_trans.Reservations_Statistics') }}</div>

                  <div class="card-body">

                      {{-- <h1>{{ $reservation_chart->options['chart_title'] }}</h1> --}}
                          {{-- {!! $reservation_chart->renderHtml() !!} --}}
                          <canvas id="res_by_months" width="300" height="200">
                          
                  </div>

              </div>
          </div>                    
      </div>


      {!! $reservation_chart->renderChartJsLibrary() !!}
    {!! $reservation_chart->renderJs() !!} 
    {!! $user_chart->renderJs() !!} 