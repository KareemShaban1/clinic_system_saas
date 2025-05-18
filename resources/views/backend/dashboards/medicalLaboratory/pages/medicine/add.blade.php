@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/medicines_trans.Add_Medicines') }}
@stop
@endsection
@section('page-header')

<h4 class="page-title"> {{ trans('backend/medicines_trans.Add_Medicines') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data" action="{{ Route('clinic.medicines.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="drugbank_id"> {{ trans('backend/medicines_trans.DrugBank_Id') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="drugbank_id" name="drugbank_id" type="text">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">{{ trans('backend/medicines_trans.Drug_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="brand_name"> {{ trans('backend/medicines_trans.Brand_Name') }} <span
                                        class="text-danger">*</span></label>
                                <textarea style="text-align:left;" id="brand_name" name="brand_name" class="form-control" id="textAreaExample6" rows="3">
                                </textarea>
                                
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="drug_dose">{{ trans('backend/medicines_trans.Drug_Dose') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="drug_dose" name="drug_dose" class="form-control">
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type"> {{ trans('backend/medicines_trans.Type') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="type" name="type" type="text">
                                
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="categories"> {{ trans('backend/medicines_trans.Categories') }} <span
                                        class="text-danger">*</span></label>
                                <textarea style="text-align:left;" id="categories" name="categories" class="form-control" id="textAreaExample6" rows="3">
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description"> {{ trans('backend/medicines_trans.Description') }} <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" id="textAreaExample6" rows="3"></textarea>
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="side_effect"> {{ trans('backend/medicines_trans.Side_Effect') }} <span
                                        class="text-danger">*</span></label>
                                <textarea name="side_effect" id="side_effect" class="form-control" id="textAreaExample6" rows="3"></textarea>
                                
                            </div>
                        </div>


                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/medicines_trans.Add') }}</button>
                </form>

            </div>






        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
