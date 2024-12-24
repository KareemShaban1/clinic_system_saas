@extends('backend.dashboards.user.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/medicines_trans.Edit_Medicines') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/medicines_trans.Edit_Medicines') }} </h4>
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

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('backend.medicines.update', $medicine->id) }}" autocomplete="off">

                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="drugbank_id"> {{ trans('backend/medicines_trans.DrugBank_Id') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="drugbank_id" name="drugbank_id" type="text"
                                    value="{{ old('drugbank_id', $medicine->drugbank_id) }}">
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">{{ trans('backend/medicines_trans.Drug_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $medicine->name) }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="brand_name"> {{ trans('backend/medicines_trans.Brand_Name') }} <span
                                        class="text-danger">*</span></label>
                                <textarea style="text-align:left;" id="brand_name" name="brand_name" class="form-control" id="textAreaExample6" rows="3">
                                                    {{ old('brand_name', $medicine->brand_name) }}  
                                                </textarea>
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="drug_dose">{{ trans('backend/medicines_trans.Drug_Dose') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="drug_dose" id="drug_dose" class="form-control"
                                    value="{{ old('drug_dose', $medicine->drug_dose) }} ">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type"> {{ trans('backend/medicines_trans.Type') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="type" id="type" type="text"
                                    value="{{ old('type', $medicine->type) }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="categories"> {{ trans('backend/medicines_trans.Categories') }} <span
                                        class="text-danger">*</span></label>
                                <textarea style="text-align:left;" id="categories" name="categories" class="form-control" id="textAreaExample6" rows="3">
                                    {{ old('categories', $medicine->categories) }}
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description"> {{ trans('backend/medicines_trans.Description') }} <span
                                        class="text-danger">*</span></label>
                                <textarea style="text-align:left;" id="description" name="description" class="form-control" id="textAreaExample6" rows="3">
                                                {{ old('description', $medicine->description) }}
                                        </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="side_effect"> {{ trans('backend/medicines_trans.Side_Effect') }} <span
                                        class="text-danger">*</span></label>
                                <textarea style="text-align:left;" id="side_effect" name="side_effect" class="form-control" id="textAreaExample6" rows="3">
                                                {{ old('side_effect', $medicine->side_effect) }}
                                        </textarea>
                            </div>
                        </div>


                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/medicines_trans.Edit') }}</button>
                </form>

            </div>






        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
