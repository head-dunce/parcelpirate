@extends('layout')

@section('title', 'Edit Parcel')

@section('content')

@if($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="custom-form-container">
    <form method="POST" action="{{ route('packages.update', $package->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- If you're updating a resource, it's a good practice to use the PUT method --}}

        <label for="trackingNumber">Tracking Number:</label><br>
        <input type="text" id="trackingNumber" name="trackingNumber" value="{{ $package->TrackingNumber }}"><br><br>

        <label for="carrier">Carrier:</label><br>
        <input type="text" id="carrier" name="carrier" value="{{ $package->Carrier }}"><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{{ $package->Description }}</textarea><br><br>

        <label for="packageValue">Package Value:</label><br>
        <input type="number" id="packageValue" name="packageValue" value="{{ $package->PackageValue }}" step="0.01"><br><br>

        <label for="statusID">Package Status:</label><br>
        <select id="statusID" name="statusID">
            @foreach ($statusNames as $status)
                <option value="{{ $status->id }}" {{ $status->id == $package->status_id ? 'selected' : '' }}>
                    {{ $status->package_status_name }}
                </option>
            @endforeach
        </select><br><br>

        <label for="packageInvoiceImage">Package Invoice Image (current):</label><br>
        @if(!empty($package->PackageInvoiceImage))
        <a href="{{ asset('storage/' . $package->PackageInvoiceImage) }}"><img src="{{ asset('storage/' . $package->PackageInvoiceImage) }}" alt="Invoice Image" class="package-image"></a><br>
        @endif
        <input type="file" id="packageInvoiceImage" name="packageInvoiceImage"><br><br>

        <label for="packageImage">Package Image (current):</label><br>
        @if(!empty($package->PackageImage))
        <a href="{{ asset('storage/' . $package->PackageImage) }}"><img src="{{ asset('storage/' . $package->PackageImage) }}" alt="Package Image" class="package-image"></a><br>
        @endif
        <input type="file" id="packageImage" name="packageImage"><br><br>


        <input type="submit" value="Update Parcel">
    </form>
</div>

<div class="custom-form-container">
    <form action="{{ route('packages.destroy', $package->id) }}" method="POST">
        @csrf
        @method('DELETE')
        Do you want to delete this parcel?
        <button type="submit" onclick="return confirm('Are you sure you want to delete this parcel?');">Delete Parcel</button>
    </form>
</div>

@endsection

