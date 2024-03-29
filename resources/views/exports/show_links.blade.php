@extends('layout')

@section('title', 'Export Receipts')

@section('content')
<div class="light-status-section">
    <p>You currently have <b>{{ $packageCount }} {{ $packageCount === 1 ? 'invoice' : 'invoices' }}</b> with the status of <b>{{ $statusName }}</b></p>


<p>Parcel Pirate offers a versatile receipt export feature, tailored to streamline your interactions with freight forwarders and customs authorities. You have the option to export receipts in either PDF format, which incorporates images, or in a spreadsheet format for text-only content. Despite the difference in presentation, both formats deliver identical data, allowing you to choose based on your freight forwarder's preferences.</p>

<p>The process begins on the "Display Parcels" page, where you can sort your parcels before exporting the receipts. After printing, you have the convenience of advancing all parcels to the next status with a single click, efficiently preparing you for the next set of shipments. Should any discrepancies arise, it's easy to revert the parcels to their previous status, make necessary adjustments, and re-export the receipts.</p>

<p>It's important to note that exporting receipts does not alter the status of your parcels. This feature gives you the flexibility to fine-tune the details of your exports, ensuring accuracy before final submission.</p>



    @if($hasDataForExport)
        Here are different formats to export containing the same information
        <ul>
            <li><a href="{{ auth()->user()->hasVerifiedEmail() ? '/print-invoices' : '#' }}">Receipts PDF</a></li>
            <li><a href="{{ auth()->user()->hasVerifiedEmail() ? '/export-receipts' : '#' }}">Receipts Spreadsheet</a></li>
        </ul>
    @else
        <p>No data available for export.</p>
    @endif
</div>
@endsection
