@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/glasses_distance_trans.Glasses_Distance') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/glasses_distance_trans.Glasses_Distance') }}</h4>
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

                <form action="{{ Route('backend.glasses_distance.store') }}" method="post" enctype="multipart/form-data">
                    @csrf



                    <br>

                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                            <table style="direction: ltr" class="table table-bordered table-responsive" id="table">

                                <thead>
                                    <tr style="text-align: center">
                                        <th><input class="form-control" name="reservation_id" hidden
                                                value="{{ $reservation->reservation_id }}" type="text"></th>
                                        <th colspan="3">{{ trans('backend/glasses_distance_trans.Right') }}</th>
                                        <th colspan="3">{{ trans('backend/glasses_distance_trans.Left') }}</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody">
                                    <tr>
                                        <td></td>
                                        <td>SPH</td>
                                        <td>CYL</td>
                                        <td>AX</td>
                                        <td>SPH</td>
                                        <td>CYL</td>
                                        <td>AX</td>
                                    </tr>

                                    <tr>


                                        <td>Diest</td>

                                        <td>
                                            <input type="text" name="SPH_R_D" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.SPH_R_D') }}">
                                            @error('SPH_R_D')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="CYL_R_D" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.CYL_R_D') }}">
                                            @error('CYL_R_D')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="AX_R_D" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.AX_R_D') }}">
                                            @error('AX_R_D')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="SPH_L_D" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.SPH_L_D') }}">
                                            @error('SPH_L_D')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="CYL_L_D" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.CYL_L_D') }}">
                                            @error('CYL_L_D')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="AX_L_D" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.AX_L_D') }}">
                                            @error('AX_L_D')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                    </tr>


                                    <tr>


                                        <td>Near</td>

                                        <td>
                                            <input type="text" name="SPH_R_N" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.SPH_R_N') }}">
                                            @error('SPH_R_N')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="CYL_R_N" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.CYL_R_N') }}">
                                            @error('CYL_R_N')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="AX_R_N" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.AX_R_N') }}">
                                            @error('AX_R_N')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="SPH_L_N" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.SPH_L_N') }}">
                                            @error('SPH_L_N')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="CYL_L_N" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.CYL_L_N') }}">
                                            @error('CYL_L_N')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text" name="AX_L_N" class="form-control"
                                                placeholder="{{ trans('backend/glasses_distance_trans.AX_L_N') }}">
                                            @error('AX_L_N')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                    </tr>


                                </tbody>


                            </table>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn btn-primary">{{ trans('backend/glasses_distance_trans.Add') }}</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script></script>
@endsection
