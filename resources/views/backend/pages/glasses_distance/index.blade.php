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
            <h4 class="mb-0">{{trans('glasses_distance_trans.Glasses_Distance')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('glasses_distance_trans.All_Glasses_Distance')}}</a></li>
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

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>{{trans('glasses_distance_trans.Id')}}</th>
                            <th>{{trans('glasses_distance_trans.Reservation_Id')}}</th>

                            <th>{{trans('glasses_distance_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($glasses_distances as $glasses_distance)
                        <tr>
                            <td>{{ $glasses_distance->id }}</td>
                            <td>{{ $glasses_distance->reservation_id }}</td>
                           
                           
                            <td>
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{Route('backend.glasses_distance.edit',$glasses_distance->id)}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                               
                               
                                <form action="" method="post" style="display:inline">
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
