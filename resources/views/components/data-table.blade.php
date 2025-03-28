@props([
    'id',
    'route',
    'columns',
    'title',
    'createRoute' => null,
    'createText' => 'Add New'
])

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        @if($createRoute)
            <div class="card-tools">
                <a href="{{ $createRoute }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ $createText }}
                </a>
            </div>
        @endif
    </div>
    <div class="card-body">
        <table id="{{ $id }}" class="table table-bordered table-striped">
            <thead>
                <tr>
                    @foreach($columns as $column)
                        <th>{{ $column['title'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        $('#{{ $id }}').DataTable({
            ajax: "{{ $route }}",
            columns: @json($columns)
        });
    });
</script>
@endpush
