@extends('layout')

@section('title', 'Import Amazon Parcels')

@section('content')

<div class="light-status-section">

<div class="flex-container">
    <div style="flex-grow: 1; padding-right: 20px;">
        <div class="md:w-3/4 p-4">
            <!-- Your content here -->
            <div class="light-status-title">How to Use the Parcel Pirate Import Feature for Amazon Orders</div>
            <p>Parcel Pirate simplifies your online shopping by importing your Amazon orders, separating them by shipments, and calculating the total costs for each shipment. This feature is particularly beneficial for accurately informing your freight forwarder of each package's value, ensuring the correct duties are charged without hassle.</p>

            <div class="light-status-title">Step-by-Step Instructions:</div>
            <ol>
                <li><strong>Wait for Complete Shipment:</strong> Begin by waiting until Amazon has dispatched all items within your order. Initially, when you place an order, the invoice aggregates the entire order without breaking it down by individual shipments. It is crucial to delay the import process until Amazon has completed the shipment of all items in the order. This ensures the invoice accurately reflects the breakdown of shipments.</li>
                <li><strong>Prepare the Invoice:</strong>Once your order is fully shipped, your next step is to generate the invoice in a format that Parcel Pirate can interpret. Parcel Pirate requires a text-only PDF version of your Amazon invoice, which details your order across the different shipments. <br>
                To create this:<br>
                    <strong>ON A COMPUTER:</strong>
                    <ol>
                        <li>From Amazon.com click on <a href="https://www.amazon.com/gp/css/order-history?ref_=nav_orders_first"><b>Returns &amp; Orders</b></a></li>
                        <li>Choose the order you want to import and click on <b>View invoice</b><li>
                        <li>Select the option to view or download the invoice for your order.</li>
                        <li>Choose the "Print as PDF" option in your browser or PDF viewer. This action creates a PDF version of your invoice, which retains only the essential text details of your order and its shipment breakdown.</li>
                    </ol>
                    <strong>ON A PHONE:</strong>
                    <ol>
                        <li>From the mobile menu click on <a href="https://www.amazon.com/your-orders/deliveries?_encoding=UTF8&ref_=navm_accountmenu_orders_track_manage"><b>Track &amp; Manage Your Orders</b></a></li>
                        <li>Click on an item in the order</li>
                        <li>Scroll down and click on <b>View order details</b></li>
                        <li>Click on <b>View invoice</b></li>
                        <li>On the top of the page, click on <b>Print this page for your records</b>.</li>
                        <li>Save the printout as a PDF file.</li>
                    </ol>
                </li>
                <li><strong>Import the Invoice into Parcel Pirate:</strong> With your PDF invoice ready, proceed to import it into the Parcel Pirate system. Parcel Pirate will analyze the text-only receipt, separating the order into its respective shipments and calculating the total costs for each. This information is crucial for seamless communication with your freight forwarder regarding the value and duties of each package.</li>
            </ol>
        </div>
    </div>
    <div style="flex-grow: 0; flex-shrink: 0; display: flex; justify-content: center; align-items: start;">
        <a href="/amazon-instructions.png" target="_blank">
            <img src="/amazon-instructions.png" alt="Amazon Instructions" style="max-width: 100%; height: auto; width: 350px;">
        </a>
    </div>
</div>








    <div class="custom-form-container">
        <form action="{{ route('amazon.invoice') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="light-status-title">Select the Amazon invoice to upload</div>
            <div class="form-group">
                <label for="pdfFile" class="form-label">PDF File:</label>
                <input type="file" id="pdfFile" name="pdfFile" class="form-control" required>
                @error('pdfFile')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group" style="text-align: right;">
                @auth
                    @if(auth()->user()->hasVerifiedEmail())
                        <input type="submit" value="Upload Invoice" class="form-button">
                    @else
                        <div class="info">Please verify your email to upload an invoice.</div>
                    @endif
                @endauth
                @guest
                    <div class="info">Please <a href="{{ route('login') }}" style="color: #E5BE01; text-decoration: underline;">login</a> to upload an invoice.</div>
                @endguest
            </div>
        </form>
    </div>
</div>
@endsection
