@extends('layout')

@section('title', 'Edit Status Names')

@section('content')

<form action="{{ route('statusNames.update') }}" method="POST">
    @csrf
    @method('PUT') {{-- Use PUT method for updating --}}

    @foreach ($statusNames as $status)
        <div>
            <label for="statusName_{{ $status->id }}">Status Name:</label>
            <input type="text" id="statusName_{{ $status->id }}" name="statusNames[{{ $status->id }}][name]" value="{{ $status->package_status_name }}">

            <label for="sortOrder_{{ $status->id }}">Sort Order:</label>
            <input type="number" id="sortOrder_{{ $status->id }}" name="statusNames[{{ $status->id }}][sortOrder]" value="{{ $status->sort_order }}">

            <label for="printExport_{{ $status->id }}">Print Export:</label>
            <input type="radio" id="printExport_{{ $status->id }}" name="printExport" value="{{ $status->id }}" {{ $status->print_export ? 'checked' : '' }}>
            -- <a href="#" onclick="event.preventDefault(); deleteStatus('{{ route('statusNames.destroy', $status->id) }}');">Delete</a>
        </div>
    @endforeach

    <h3>Add New Status Name</h3>
    <div>
        <label for="newStatusName">New Status Name:</label>
        <input type="text" id="newStatusName" name="newStatusName[name]" value="">

        <label for="newSortOrder">Sort Order:</label>
        <input type="number" id="newSortOrder" name="newStatusName[sortOrder]" value="">
    </div>

    <input type="submit" value="Save Changes">
</form>

<script>
    function deleteStatus(action) {
        if (confirm('Are you sure you want to delete this status?')) {
            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = action;
            deleteForm.submit();
        }
    }
</script>

<form id="delete-form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

