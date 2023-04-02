@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('drugs_trans.Prescription')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('drugs_trans.Prescription')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('drugs_trans.Add_Prescription')}}</a></li>
                <li class="breadcrumb-item active">{{trans('drugs_trans.Prescription')}}</li>
            </ol>
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

                <form action="{{Route('backend.drugs.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    
                   
             

                <br>
 
                <div class="row">
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                        <table class="table table-bordered table-responsive" id="table">
                            
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{trans('drugs_trans.Drug_Name')}}</th>
                                    <th>{{trans('drugs_trans.Drug_Dose')}}</th>
                                    <th>{{trans('drugs_trans.Drug_Type')}}</th>
                                    <th>{{trans('drugs_trans.Frequency')}}</th>
                                    <th>{{trans('drugs_trans.Period')}}</th>
                                    <th>{{trans('drugs_trans.Notes')}}</th>
                                    <th><a href="javascript:void(0)" class="btn btn-success addRow">
                                        {{trans('drugs_trans.Add_Drug')}}
                                    </a></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>

                                    <td>
                                        <input class="form-control" name="reservation_id[]" hidden value="{{$reservation->reservation_id}}"  type="text">
                                    </td>
                                    <td>
                                        <input type="text" name="drug_name[]" class="form-control" placeholder="{{trans('drugs_trans.Drug_Name')}}">
                                        @error('drug_name')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input type="text" name="drug_dose[]" class="form-control" placeholder="{{trans('drugs_trans.Drug_Dose')}}">
                                        @error('drug_dose')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input type="text" name="drug_type[]" class="form-control" placeholder="{{trans('drugs_trans.Drug_Type')}}">
                                        @error('drug_type')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input type="text" name="frequency[]" class="form-control" placeholder="{{trans('drugs_trans.Frequency')}}">
                                        @error('frequency')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input type="text" name="period[]" class="form-control" placeholder="{{trans('drugs_trans.Period')}}">
                                        @error('period')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <td>
                                        <input type="text" name="notes[]" class="form-control" placeholder="{{trans('drugs_trans.Notes')}}">
                                        @error('notes')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{trans('drugs_trans.Delete')}} </a></th>
                                    
                                </tr>
                            </tbody>


                        </table>
                    </div>
                </div>

             <button type="submit" class="btn btn-primary">{{trans('drugs_trans.Save')}}</button>

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
            '<td><input class="form-control" hidden value="{{$reservation->reservation_id}}"  name="reservation_id[]" type="text" ></td>'+
            '<td><input type="text" name="drug_name[]" class="form-control" placeholder="{{trans('drugs_trans.Drug_Name')}}"></td>' +
            '<td><input type="text" name="drug_dose[]" class="form-control" placeholder="{{trans('drugs_trans.Drug_Dose')}}"></td>' +
            '<td><input type="text" name="drug_type[]" class="form-control" placeholder="{{trans('drugs_trans.Drug_Type')}}"></td>' +
            '<td><input type="text" name="frequency[]" class="form-control" placeholder="{{trans('drugs_trans.Frequency')}}"></td>' +
            '<td><input type="text" name="period[]" class="form-control" placeholder="{{trans('drugs_trans.Period')}}"></td>' +
            '<td><input type="text" name="notes[]" class="form-control" placeholder="{{trans('drugs_trans.Notes')}}"></td>' +
            '<th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{trans('drugs_trans.Delete')}} </a></th>' +
            '<input class="form-control" hidden name="reservation_id[]" type="text" value="{{$reservation->reservation_id}}">'+
            '</tr>'
            $('#tbody').append(tr);
    });

    $('tbody').on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
    });

</script>
@endsection
