@props(['id', 'editRoute', 'deleteRoute'])

<div class="d-flex gap-2">
    <a href="{{ $editRoute }}" class="action-icon">
        <i class="mdi mdi-square-edit-outline"></i>
    </a>
    <a href="javascript:void(0);" class="action-icon" onclick="deleteRecord({{ $id }}, '{{ $deleteRoute }}')">
        <i class="mdi mdi-delete"></i>
    </a>
</div>
