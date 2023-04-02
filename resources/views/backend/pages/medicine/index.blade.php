@extends('backend.layouts.master')
@section('css')

@section('title')
{{trans('medicines_trans.Medicines')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('medicines_trans.Medicines')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('medicines_trans.All_Medicines')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('medicines_trans.Medicines')}}</li>
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
                <div style="  display: flex;
                align-items: center; 
                justify-content:left;
                ">
                    <div style="margin:5px; height:50px; width:150px; background-color:bisque;  position: relative;" >
                        <a style=" margin: 0;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%); " 
                        href="https://go.drugbank.com/" target="blank" > Drug Bank </a>
                    </div>
                    <div style="margin:5px; height:50px; width:150px; background-color:bisque;  position: relative;" >
                        <a style=" margin: 0;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);" 
                        href="https://www.webteb.com/drug" target="blank" > Web Teb </a>
                    </div>
                </div>

              
               
                    <table id="table_id" class="display">
                              <thead>
                                  <tr>
                                      <th style="width: 100px">{{trans('medicines_trans.Id')}}</th>
                                      <th style="width: 150px">{{trans('medicines_trans.DrugBank_Id')}}</th>
                                      <th style="width: 150px">{{trans('medicines_trans.Drug_Name')}}</th>
                                      <th style="width: 150px">{{trans('medicines_trans.Brand_Name')}}</th>
                                      <th style="width: 150px">{{trans('medicines_trans.Drug_Dose')}}</th>
                                      <th style="width: 250px">{{trans('medicines_trans.Categories')}}</th>
                                      <th style="width: 150px">{{trans('medicines_trans.Control')}}</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($medicines as $medicine)
                                  <tr>
                                      <td style="width: 100px">{{ $medicine->id }}</td>
                                      <td style="width: 150px">{{ $medicine->drugbank_id }}</td>
                                      <td style="width: 150px">{{ $medicine->name }}</td>
                                      <td style="width: 150px">{{ $medicine->brand_name }}</td>
                                      <td style="width: 150px">{{ $medicine->drug_dose }}</td>
                                      <td style="width: 250px">{{ $medicine->categories }}</td>
                                      
                                      <td style="width: 150px">
                                          <a href="{{Route('backend.medicines.show',$medicine->id)}}" class="btn btn-primary btn-sm">
                                              <i class="fa fa-eye"></i>
                                          </a>
                                          <a href="{{Route('backend.medicines.edit',$medicine->id)}}" class="btn btn-warning btn-sm">
                                              <i class="fa fa-edit"></i>
                                          </a>
                                         
                                          <form action="{{Route('backend.medicines.destroy',$medicine->id)}}" method="post" style="display:inline">
                                              @csrf
                                              @method('delete')
                                              
                                              <button type="submit" class="btn btn-danger btn-sm">
                                                  <i class="fa fa-trash"></i> 
                                              </button>   
                                          </form>
          
                                         
                                      </td>
                                      
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
          $(document).ready( function () {
              $('#table_id').DataTable();
          } );
      </script>
@endsection
