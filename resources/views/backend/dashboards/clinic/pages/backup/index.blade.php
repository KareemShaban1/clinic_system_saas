@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/backups_trans.Backups') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/backups_trans.Backups') }} </h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->


<div class="row">
    <div class="col-xs-12 col-md-12 clearfix">
        <form action="{{ route('backend.backups.create') }}" method="GET" class="add-new-backup"
            enctype="multipart/form-data" id="CreateBackupForm">
            {{ csrf_field() }}
            <input type="submit" name="submit" class="theme-button btn btn-primary pull-right"
                style="margin-bottom:2em;" value="{{ trans('backend/backups_trans.Create_Backup') }}">
        </form>
    </div>
    <div class="col-xs-12 col-md-12">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('update'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('update') }}
            </div>
        @endif

        @if (Session::has('delete'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('delete') }}
            </div>
        @endif

        @if (count($backups))
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>{{ trans('backend/backups_trans.File_Name') }}</th>
                        <th>{{ trans('backend/backups_trans.File_Size') }}</th>
                        <th>{{ trans('backend/backups_trans.Created_Date') }}</th>
                        <th>{{ trans('backend/backups_trans.Create_Age') }}</th>
                        <th>{{ trans('backend/backups_trans.Processes') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>
                            <td>{{ \App\Http\Controllers\Backend\BackupController::humanFilesize($backup['file_size']) }}
                            </td>
                            <td>
                                {{ date('F jS, Y, g:ia (T)', $backup['last_modified']) }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }}
                            </td>
                            <td class="text-right">
                                <a class="btn btn-success"
                                    href="{{ route('backend.backups.download', $backup['file_name']) }}"><i
                                        class="fa fa-cloud-download"></i>
                                    {{ trans('backend/backups_trans.Download') }}</a>
                                <a class="btn btn-danger"
                                    onclick="return confirm('Do you really want to delete this file')"
                                    data-button-type="delete"
                                    href="{{ url('backup/delete/' . $backup['file_name']) }}"><i
                                        class="fa fa-trash-o"></i>
                                    {{ trans('backend/backups_trans.Delete') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="well">
                <h4>No backups</h4>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#CreateBackupForm").on('submit', function(e) {
        $('.theme-button').attr('disabled', 'disabled');
    });
</script>
@endpush
