<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Invoices</title>
    <style>
        @media screen, print {
            body {
                font-family: Arial, sans-serif;
                font-size: 16px; /* Base font size */
            }
            h2, .tracking-number, .value, p {
                font-size: 1em; /* Double the base font size for emphasis */
            }
            .description {
                font-size: 0.5em; /* Double the base font size for emphasis */
            }
            img.invoice-image, img.package-image {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 20px auto; /* Increased margin to accommodate larger text */
            }
        }

        @media print {
            body, html {
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .invoice {
                page-break-after: always;
                page-break-inside: avoid;
                width: 100%;
            }
            .invoice:last-child {
                page-break-after: auto;
            }
            img.invoice-image {
                max-height: 525px; /* You might need to adjust this based on new text sizes */
                width: auto;
                display: block;
                margin: 0 auto 20px; /* Adjusted margin */
            }
            img.package-image {
                max-height: 175px; /* You might need to adjust this as well */
                width: auto;
                display: block;
                margin: 0 auto 20px; /* Adjusted margin */
            }
            body * {
                visibility: visible;
            }
            .invoice, .invoice * {
                visibility: visible;
            }
            .invoice {
                position: relative;
                display: block;
            }
        }
    </style>
</head>
<body>
    @foreach ($packages as $package)
    <div class="invoice">
        <h2>Customer: {{ auth()->user()->name }}</h2> <!-- Fetch the name of the authenticated user -->
        <p class="tracking-number">Tracking Number: {{ $package->TrackingNumber }}</p>
        <p class="tracking-number">Carrier: {{ $package->Carrier }}</p>
        <p class="value">Value: ${{ number_format($package->PackageValue, 2) }}</p>
        <p class="description">Description: {!! nl2br(e($package->Description)) !!}</p>
        <div>
            <strong>Invoice Image:</strong><br>
            @if (!empty($package->PackageInvoiceImage))
                <img src="{{ asset('storage/' . $package->PackageInvoiceImage) }}" alt="Invoice Image" class="invoice-image">
            @else
                No image available.
            @endif
        </div>
        <div>
            <strong>Package Image:</strong><br>
            @if (!empty($package->PackageImage))
                <img src="{{ asset('storage/' . $package->PackageImage) }}" alt="Package Image" class="package-image">
            @else
                No image available.
            @endif
        </div>
    </div>
    @endforeach
</body>
</html>

