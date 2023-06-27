@extends('backend.layouts.master')
@section('css')

@section('title')
{{trans('backend/medicines_trans.Add_Medicines')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('backend/medicines_trans.Add_Medicines')}}  </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/medicines_trans.Add_Medicines')}}          </a></li>
                <li class="breadcrumb-item active">{{trans('backend/medicines_trans.Medicines')}}</li>

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

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                <form method="post" enctype="multipart/form-data" action="{{Route('backend.medicines.store')}}" autocomplete="off">

                    @csrf
                    <div class="row">

                              <div class="col-md-4">
                                        <div class="form-group">
                                                  <label> {{trans('backend/medicines_trans.DrugBank_Id')}} <span class="text-danger">*</span></label>
                                                  <input  class="form-control" name="drugbank_id" type="text" >
                                                  @error('drugbank_id')
                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror
                                        </div>
                              </div>     

                              

                              <div class="col-md-4">
                                        <div class="form-group">
                                                  <label>{{trans('backend/medicines_trans.Drug_Name')}}<span class="text-danger">*</span></label>
                                                  <input  type="text" name="name"  class="form-control">
                                                  @error('name')
                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror
                                        </div>
                              </div>

                              <div class="col-md-12">
                                        <div class="form-group">
                                                  <label> {{trans('backend/medicines_trans.Brand_Name')}} <span class="text-danger">*</span></label>
                                                  <textarea style="text-align:left;" name="brand_name" class="form-control" id="textAreaExample6" rows="3">
                                                  </textarea>
                                                    @error('brand_name')
                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror
                                        </div>
                              </div>
                    
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('backend/medicines_trans.Drug_Dose')}} <span class="text-danger">*</span></label>
                                <input  type="text" name="drug_dose"  class="form-control">
                                @error('drug_dose')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{trans('backend/medicines_trans.Type')}} <span class="text-danger">*</span></label>
                                <input  class="form-control" name="type" type="text" >
                                @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label> {{trans('backend/medicines_trans.Categories')}}  <span class="text-danger">*</span></label>
                                <textarea style="text-align:left;" name="categories" class="form-control" id="textAreaExample6" rows="3">
                                </textarea>    
                                @error('categories')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                   <div class="row">

                              <div class="col-md-12">
                                        <div class="form-group">
                                        <label> {{trans('backend/medicines_trans.Description')}}  <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control" id="textAreaExample6" rows="3"></textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                              </div>
                              <div class="col-md-12">
                                        <div class="form-group">
                                        <label> {{trans('backend/medicines_trans.Side_Effect')}}  <span class="text-danger">*</span></label>
                                        <textarea name="side_effect" class="form-control" id="textAreaExample6" rows="3"></textarea>
                                        @error('side_effect')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                              </div>

                             
                    </div>
                          
                        
                    <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('backend/medicines_trans.Add')}}</button>
                    </form>

          </div> 





                
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
