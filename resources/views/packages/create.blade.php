@extends('layout')

@section('title', 'Enter New Parcel')

@section('content')

<div class="light-status-section" style="display: flex; flex-direction: row; justify-content: start; align-items: flex-start; max-width:900px; margin: 0 auto;">

<div class="flex-container">
    <div style="flex: 0 1 250px; padding-right: 20px;">
        <p>Parcel Pirate simplifies the process of adding parcels to the system. Only the 'description' is required to create a new entry. You can add more details like tracking number, carrier, value, and images later. This feature allows you to log new parcels or insert placeholders that you can update or remove anytime. Start by entering a description, selecting the parcel status, and clicking 'Create Parcel.' Entries can be deleted at any time.</p>
    </div>

    <!-- Form Container Adjustments -->
    <div class="custom-form-container" style="flex: 0 1 600px; margin-left: 20px; margin-right: 0; /* Adjusted margins for layout */">
        <form action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Form fields similar to the edit form, but empty by default -->
            <label for="trackingNumber">Tracking Number:</label><br>
            <input type="text" id="trackingNumber" name="trackingNumber" value=""><br><br>

            <!-- Repeat for other package attributes -->
            <label for="carrier">Carrier:</label><br>
            <input type="text" id="carrier" name="carrier" value=""><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br><br>

            <label for="packageValue">Parcel Value:</label><br>
            <input type="number" id="packageValue" name="packageValue" value="" step="0.01"><br><br>

            <label for="statusID">Parcel Status:</label><br>
            <select id="statusID" name="statusID">
                @foreach ($statusNames as $status)
                    <option value="{{ $status->id }}" >
                        {{ $status->package_status_name }}
                    </option>
                @endforeach
            </select><br><br>

            <label for="packageInvoiceImage">Parcel Invoice (PDF or JPG image):</label><br>
            <input type="file" id="packageInvoiceImage" name="packageInvoiceImage"><br><br>

            <label for="packageImage">Parcel Image (JPG image):</label><br>
            <input type="file" id="packageImage" name="packageImage"><br><br>

            @auth
                @if(auth()->user()->hasVerifiedEmail())
                    <input type="submit" value="Create Parcel">
                @else
                    <div class="info">Please verify your email to create a parcel.</div>
                @endif
            @endauth
            @guest
                <div class="info">Please <a href="{{ route('login') }}" style="color: #E5BE01; text-decoration: underline;">login</a> to create a parcel.</div>
            @endguest

        </form>
    </div>
</div>



    
</div>


@endsection

