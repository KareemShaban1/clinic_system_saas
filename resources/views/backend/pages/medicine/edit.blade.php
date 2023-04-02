@extends('backend.layouts.master')
@section('css')

@section('title')
{{trans('medicines_trans.Edit_Medicines')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('medicines_trans.Edit_Medicines')}}  </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('medicines_trans.Edit_Medicines')}}          </a></li>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <form method="post" enctype="multipart/form-data" action="{{Route('backend.medicines.update',$medicine->id)}}" autocomplete="off">

                    @csrf
                    <div class="row">

                              <div class="col-md-4">
                                        <div class="form-group">
                                                  <label> {{trans('medicines_trans.DrugBank_Id')}} <span class="text-danger">*</span></label>
                                                  <input  class="form-control" name="drugbank_id" type="text"  value="{{old('drugbank_id',$medicine->drugbank_id)}}">
                                        </div>
                              </div>     

                              

                              <div class="col-md-4">
                                        <div class="form-group">
                                                  <label>{{trans('medicines_trans.Drug_Name')}}<span class="text-danger">*</span></label>
                                                  <input  type="text" name="name" class="form-control" value="{{old('name',$medicine->name)}}">
                                        </div>
                              </div>

                              <div class="col-md-12">
                                        <div class="form-group">
                                                  <label> {{trans('medicines_trans.Brand_Name')}} <span class="text-danger">*</span></label>
                                                  <textarea style="text-align:left;" name="brand_name" class="form-control" id="textAreaExample6" rows="3">
                                                    {{old('brand_name',$medicine->brand_name)}}  
                                                </textarea>
                                                  {{-- <input  class="form-control" name="brand_name" type="text" value="{{old('brand_name',$medicine->brand_name)}} "> --}}
                                        </div>
                              </div>
                    
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('medicines_trans.Drug_Dose')}} <span class="text-danger">*</span></label>
                                <input  type="text" name="drug_dose"  class="form-control" value="{{old('drug_dose',$medicine->drug_dose)}} ">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{trans('medicines_trans.Type')}} <span class="text-danger">*</span></label>
                                <input  class="form-control" name="type" type="text" value="{{old('type',$medicine->type)}}" >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label> {{trans('medicines_trans.Categories')}}  <span class="text-danger">*</span></label>
                                <textarea style="text-align:left;" name="categories" class="form-control" id="textAreaExample6" rows="3">
                                    {{old('categories',$medicine->categories)}}
                                </textarea>
                                {{-- <input  class="form-control" name="categories" type="text" value="{{old('categories',$medicine->categories)}}" > --}}
                            </div>
                        </div>
                    </div>

                   <div class="row">

                              <div class="col-md-12">
                                        <div class="form-group">
                                        <label> {{trans('medicines_trans.Description')}}  <span class="text-danger">*</span></label>
                                        <textarea style="text-align:left;" name="description" class="form-control" id="textAreaExample6" rows="3">
                                                  {{old('description',$medicine->description)}}
                                        </textarea>
                                        </div>
                              </div>
                              <div class="col-md-12">
                                        <div class="form-group">
                                        <label> {{trans('medicines_trans.Side_Effect')}}  <span class="text-danger">*</span></label>
                                        <textarea style="text-align:left;" name="side_effect" class="form-control" id="textAreaExample6" rows="3">
                                                  {{old('side_effect',$medicine->side_effect)}}
                                        </textarea>
                                        </div>
                              </div>

                             
                    </div>
                          
                        
                    <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('medicines_trans.Edit')}}</button>
                    </form>

          </div> 





                
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
