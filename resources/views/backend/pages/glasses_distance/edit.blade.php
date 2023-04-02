@extends('backend.layouts.master')
@section('css')

@section('title')
{{trans('glasses_distance_trans.Glasses_Distance')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('glasses_distance_trans.Glasses_Distance')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('glasses_distance_trans.Add_Glasses_Distance')}}</a></li>
                <li class="breadcrumb-item active">{{trans('glasses_distance_trans.Glasses_Distance')}}</li>
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

                <form action="{{Route('backend.glasses_distance.update',$glasses_distance->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    
             

                <br>

                <div class="row">
                    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                        <table style="direction: ltr" class="table table-bordered table-responsive" id="table">
                            
                            <thead>
                                <tr>
                                    <th><input class="form-control" name="reservation_id" hidden value="{{$glasses_distance->reservation_id}}"  type="text"></th>
                                    <th colspan="3">{{trans('glasses_distance_trans.Right')}}</th>
                                    <th colspan="3">{{trans('glasses_distance_trans.Left')}}</th>
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
                                        value="{{old('SPH_R_D',$glasses_distance->SPH_R_D)}}" 
                                        placeholder="{{trans('glasses_distance_trans.SPH_R_D')}}">
                                        @error('SPH_R_D')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="CYL_R_D" class="form-control"
                                        value="{{old('CYL_R_D',$glasses_distance->CYL_R_D)}}" 
                                        placeholder="{{trans('glasses_distance_trans.CYL_R_D')}}">
                                        @error('CYL_R_D')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="AX_R_D" class="form-control"
                                        value="{{old('AX_R_D',$glasses_distance->AX_R_D)}}"  
                                        placeholder="{{trans('glasses_distance_trans.AX_R_D')}}">
                                        @error('AX_R_D')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="SPH_L_D" class="form-control"
                                        value="{{old('SPH_L_D',$glasses_distance->SPH_L_D)}}"   
                                        placeholder="{{trans('glasses_distance_trans.SPH_L_D')}}">
                                        @error('SPH_L_D')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="CYL_L_D" class="form-control"
                                        value="{{old('CYL_L_D',$glasses_distance->CYL_L_D)}}"    
                                        placeholder="{{trans('glasses_distance_trans.CYL_L_D')}}">
                                        @error('CYL_L_D')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="AX_L_D" class="form-control" 
                                        value="{{old('AX_L_D',$glasses_distance->AX_L_D)}}"    
                                        placeholder="{{trans('glasses_distance_trans.AX_L_D')}}">
                                        @error('AX_L_D')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                </tr>


                                <tr>

                                    
                                    <td>Near</td>

                                    <td>
                                        <input type="text" name="SPH_R_N" class="form-control" 
                                        value="{{old('SPH_R_N',$glasses_distance->SPH_R_N)}}"    
                                        placeholder="{{trans('glasses_distance_trans.SPH_R_N')}}">
                                        @error('SPH_R_N')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="CYL_R_N" class="form-control"
                                        value="{{old('CYL_R_N',$glasses_distance->CYL_R_N)}}"     
                                        placeholder="{{trans('glasses_distance_trans.CYL_R_N')}}">
                                        @error('CYL_R_N')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="AX_R_N" class="form-control"
                                        value="{{old('AX_R_N',$glasses_distance->AX_R_N)}}"      
                                        placeholder="{{trans('glasses_distance_trans.AX_R_N')}}">
                                        @error('AX_R_N')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="SPH_L_N" class="form-control"
                                        value="{{old('SPH_L_N',$glasses_distance->SPH_L_N)}}"       
                                        placeholder="{{trans('glasses_distance_trans.SPH_L_N')}}">
                                        @error('SPH_L_N')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="CYL_L_N" class="form-control"
                                        value="{{old('CYL_L_N',$glasses_distance->CYL_L_N)}}"        
                                        placeholder="{{trans('glasses_distance_trans.CYL_L_N')}}">
                                        @error('CYL_L_N')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="AX_L_N" class="form-control"
                                        value="{{old('AX_L_N',$glasses_distance->AX_L_N)}}"         
                                        placeholder="{{trans('glasses_distance_trans.AX_L_N')}}">
                                        @error('AX_L_N')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror 
                                    </td>
                                    
                                </tr>


                            </tbody>


                        </table>
                    </div>
                </div>

             <button type="submit" class="btn btn-primary">{{trans('glasses_distance_trans.Edit')}}</button>

            </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>



</script>
@endsection
