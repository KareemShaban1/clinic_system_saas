@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{trans('backend/chronic_diseases_trans.Chronic')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/chronic_diseases_trans.Chronic')}}</h4>
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
                
                <x-backend.alert/>

                <form action="{{Route('backend.chronic_diseases.update',$chronic_disease->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    
            
                <br>

                <div class="row">
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                        <table class="table table-bordered table-responsive" id="table">
                            
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{trans('backend/chronic_diseases_trans.Disease_Name')}}</th>
                                    <th>{{trans('backend/chronic_diseases_trans.Disease_Measure')}}</th>
                                    <th>{{trans('backend/chronic_diseases_trans.Disease_Date')}}</th>
                                    <th>{{trans('backend/chronic_diseases_trans.Notes')}}</th>
                                    <th><a href="javascript:void(0)" class="btn btn-success addRow">
                                        {{trans('backend/chronic_diseases_trans.Add_Disease')}}
                                    </a></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>

                                    <td>
                                        <input class="form-control" name="id[]" hidden value="{{$chronic_disease->id}}"  type="text">
                                        <input class="form-control" name="id[]" hidden value="{{$chronic_disease->id}}"  type="text">

                                    </td>
                                    <td>
                                        <input type="text" name="title[]" value="{{old('title',$chronic_disease->title)}}" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Name')}}">
                                        @error('title')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input type="text" name="measure[]"  value="{{old('title',$chronic_disease->measure)}}"class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Measure')}}">
                                        @error('measure')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input id="datepicker-action" data-date-format="yyyy-mm-dd" name="date[]"  value="{{old('title',$chronic_disease->date)}}" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Date')}}">
                                        @error('date')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input type="text" name="notes[]" class="form-control" value="{{old('title',$chronic_disease->notes)}}" placeholder="{{trans('backend/chronic_diseases_trans.Notes')}}">
                                        @error('notes')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{trans('backend/chronic_diseases_trans.Delete')}} </a></th>
                                    
                                </tr>
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
@section('js')
<script>

    $('thead').on('click', '.addRow', function() {
        var tr = '<tr>' +
            '<td><input class="form-control" hidden value="{{$chronic_disease->id}}"  name="id[]" type="text" ></td>'+
            '<td><input class="form-control" hidden value="{{$chronic_disease->id}}"  name="id[]" type="text" ></td>'+
            '<td><input type="text" name="drug_name[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Name')}}"></td>' +
            '<td><input type="text" name="drug_dose[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Measure')}}"></td>' +
            '<td><input type="text" name="quantity[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Date')}}"></td>' +
            '<td><input type="text" name="notes[]" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Notes')}}"></td>' +
            '<th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{trans('backend/chronic_diseases_trans.Delete')}} </a></th>' +
            '</tr>'
            $('#tbody').append(tr);
    });

    $('tbody').on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
    });

</script>
@endsection
