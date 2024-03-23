@extends('layout')

@section('title', 'Display Packages')

@section('content')

@foreach ($statuses as $status)

    <div class="status-section">
        <div class="status-title">{{ $status->package_status_name }}</div>
        <table>
            <tr>
                <th>Package ID</th>
                <th>User ID</th>
                <th>Tracking Number</th>
                <th>Carrier</th>
                <th>Description</th>
                <th>Package Image</th>
                <th>Package Invoice Image</th>
                <th>Package Value</th>
                <!-- Add more table headers as needed -->
            </tr>
            @foreach ($status->packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->UserID }}</td>
                <td>{{ $package->TrackingNumber }}</td>
                <td>{{ $package->Carrier }}</td>
                <td>{!! nl2br(e($package->Description)) !!}</td>
                <td>{{ $package->PackageImage }}</td>
                <td>{{ $package->PackageInvoiceImage }}</td>
                <td>{{ $package->PackageValue }}</td>
                <!-- Add more table cells as needed -->
            </tr>
            @endforeach
        </table>
    </div>
@endforeach






    @endsection
