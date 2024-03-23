<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Packages</title>
    <!-- Include any CSS files or stylesheets here -->
</head>
<body>
    <div class="header">
        <img src="/parcelpirate.png" alt="Logo" class="logo">
        <div class="title-and-nav">
            <div class="site-title">Parcel Pirate</div>
            <!-- Include any navigation menu if needed -->
        </div>
    </div>
    <h2>Display Packages</h2>
    
    <div class="packages">
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
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->Userid }}</td>
                <td>{{ $package->TrackingNumber }}</td>
                <td>{{ $package->Carrier }}</td>
                <td>{{ $package->Description }}</td>
                <td>{{ $package->PackageImage }}</td>
                <td>{{ $package->PackageInvoiceImage }}</td>
                <td>{{ $package->PackageValue }}</td>
                <!-- Add more table cells as needed -->
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
