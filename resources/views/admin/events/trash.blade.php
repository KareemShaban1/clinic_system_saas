@extends('layouts.master')
@section('css')

@section('title')
    {{trans('events_trans.Deleted_Events')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"></h4> {{trans('events_trans.Deleted_Events')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('events_trans.Deleted_Events')}}</a></li>
                <li class="breadcrumb-item active">{{trans('events_trans.Events')}}</li>
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
                            <th>{{trans('events_trans.Id')}}</th>
                            <th>{{trans('events_trans.Event_Title')}}</th>
                            <th>{{trans('events_trans.Event_Date')}} </th>
                            <td>{{trans('events_trans.Control')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$event->title}}</td>
                        <td>{{$event->start}}</td>
                            <td>
                               
                                <form action="{{Route('admin.events.restore',$event->id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-success btn-sm" >
                                        <i class="fa fa-edit"></i>
                                        {{trans('events_trans.Restore')}}
                                    </button>   
                                </form>
                               

                                <form action="{{Route('admin.events.forceDelete',$event->id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash"></i> 
                                         {{trans('events_trans.Delete_Forever')}}
                                    </button>   
                                </form>

                                {{-- <a href="" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> 
                                    
                                </a>     --}}
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
