@extends('Admin.common.layout')
@section('content')
@php
$bill = $data['bill'];
$active = 'invoice';
@endphp

<style>
    :root {
        --theme-color: #00a743;
    }

    body {
        background: #f8f9fa;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        font-size: 14px;
    }

    .invoice-container {
        background: #fff;
        padding: 30px;
        margin: 30px auto;
        border-radius: 10px;
        max-width: 900px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .invoice-header {
        border-bottom: 2px solid var(--theme-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
    }

    .invoice-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--theme-color);
    }

    .table th {
        background-color: var(--theme-color);
        color: #fff;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .amount-table td {
        text-align: right;
    }

    .amount-table th {
        text-align: left;
    }

    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 25px;
        margin-top: 10px;
    }

    .timeline::before {
        content: "";
        position: absolute;
        top: 0;
        left: 7px;
        width: 2px;
        height: 100%;
        background: var(--theme-color);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 15px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        position: absolute;
        left: 0;
        top: 2px;
        width: 15px;
        height: 15px;
        background: #fff;
        border: 2px solid var(--theme-color);
        border-radius: 50%;
        z-index: 1;
    }

    .timeline-content {
        padding-left: 30px;
    }

    .timeline-content h6 {
        margin-bottom: 2px;
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--theme-color);
    }

    .timeline-content p {
        margin: 0;
        font-size: 0.75rem;
        color: #555;
    }

    /* Added styles for table padding */
    .table-sm>tbody>tr>td,
    .table-sm>thead>tr>th {
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        line-height: 1.2 !important;
    }

    /* Minimize height for all table rows and headers */
    .table>tbody>tr>td,
    .table>thead>tr>th {
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        line-height: 1.2 !important;
    }

    .amount-table>tbody>tr>td,
    .amount-table>tbody>tr>th {
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        line-height: 1.2 !important;
    }

    /* logo */
    .invoice-logo img {
        height: 60px;
        width: auto;
        display: block;
    }

    .invoice-header .header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>

<div id="invoicePrintArea">
    <div class="invoice-header d-flex justify-content-between align-items-center">
        <div class="header-left">
            <div class="invoice-logo">
                <img src="{{ asset('admin_logo.jpeg') }}" alt="Brand Logo" style="height: 60px; width: auto; display: block;">
            </div>
            <div>
                <!-- <h1 class="invoice-title">Invoice</h1>
                <p class="mb-0">
                    <strong>Invoice ID:</strong> <span id="id">INV-001</span>
                </p> -->
                <p class="mb-0">
                    <strong>Bill No:</strong> <span id="billNo">{{ $bill->billNo ?? '--' }}</span>
                </p>
                @if($bill->type != "0")
                <p class="mb-0"><strong>GST NO:</strong> <span id="type">23CGKPD1284K1ZF</span></p>
                @endif
                <p class="mb-0">
                    <strong>Contact us:</strong>
                    @if($bill->type != "0")
                    <span>9911995523</span>
                    @else
                    <span>7011873145, 9911106244</span>
                    @endif
                </p>
                <p class="mb-0">
                    <strong>Address:</strong>
                    @if($bill->type != "0")
                    <span id="gstAddress">DAKKHANA CHAURAHA, Bijawar, Chhatarpur, Madhya Pradesh 471405</span>
                    @else
                    <span id="nonGstAddress">Sector 3 Vasundhara Ghaziabad uttarpradesh 201012</span>
                    @endif
                </p>

            </div>
        </div>

        <div class="text-end">

            <p class="mb-0">
                <strong>Billing Date:</strong> <span id="date">{{ now()->toDateString() }}</span>
            </p>
            <p class="mb-0">
                <strong>Booking Date:</strong> <span id="date">{{ $bill->date ?? '--' }}</span>
            </p>
        </div>
    </div>

    <!-- Recipient -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h5 class="mb-2" style="color: var(--theme-color)">Bill To:</h5>
            <p class="mb-1">
                <strong>Name:</strong> <span id="recipient_name">{{ $bill->recipient_name ?? '--' }}</span>
            </p>
            @if($bill->recipient_address != '')
            <p class="mb-1">
                <strong>Address:</strong>
                <span id="recipient_address">{{ $bill->recipient_address ?? '--' }}</span>
            </p>
            @endif
            @if($bill->type != "0")
            <p class="mb-1">
                <strong>GST No:</strong>
                <span id="recipient_gstNo">{{ $bill->recipient_gstNo ?? '--' }}</span>
            </p>
            @endif
        </div>
        <div class="col-md-6">
            <h5 class="mb-2" style="color: var(--theme-color)">Trip Info:</h5>
            <p class="mb-1">
                <strong>Car Category:</strong>
                <span id="carCategoryId">{{ $bill->carCategoryId ?? '--' }}</span>
            </p>
            <p class="mb-1">
                <strong>Vehicle Number:</strong>
                <span id="vehicle_no">{{ strtoupper($bill->vehicleNumber ?? '--') }}</span>
            </p>
            <p class="mb-1">
                <strong>Final Total KM:</strong>
                <span id="finalTotalKm">{{($bill->total_km ?? 0) + ($bill->extraKm ?? 0)}}</span> km
            </p>
            <p class="mb-1">
                <strong>Goods Description:</strong>
                <span id="goods_description">{{$bill->goods_description ?? ''}}</span>
            </p>
        </div>
    </div>

    <!-- Pickup & Destination Timeline -->
    <div class="mb-3">
        <h5 class="mb-2" style="color: var(--theme-color)">
            Route (Pickup Location & Drop Location)
        </h5>
        <div class="timeline">

            @php
            $route = json_decode($bill->route);
            @endphp
            @if($route && isset($route->name) && is_array($route->name))
            @foreach ($route->name as $key=>$item)
            @php
            $rawType = isset($route->type[$key]) ? strtolower($route->type[$key]) : '';
            if (strpos($rawType, 'pick') !== false) {
            $label = 'Pickup Location';
            } elseif (strpos($rawType, 'drop') !== false || strpos($rawType, 'dest') !== false) {
            $label = 'Drop Location';
            } else {
            $label = ucfirst($route->type[$key] ?? 'Point');
            }
            @endphp
            @if($route->name[$key] != '')
            <div class="timeline-item">
                <div class="timeline-icon"></div>
                <div class="timeline-content">
                    <h6>{{ $label }} || {{ $route->name[$key] }}</h6>
                </div>
            </div>
            @endif
            @endforeach
            @else
            <p class="mb-0">No route available</p>
            @endif
        </div>
    </div>

    <!-- Cost Table -->
    <div class="table-responsive mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Per Km/Hour Cost</th>
                    <th>Total KM/Hour</th>
                    <th>Total Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Main Trip</td>
                    <td id="perKmCost">{{ $bill->perKmCost ?? '--' }}</td>
                    <td id="total_km">{{ $bill->total_km ?? '--' }}</td>
                    <!-- {{ $bill->finalTotalKm ?? '--' }} -->
                    <td id="total_value">₹{{ ($bill->perKmCost ?? 0) * ($bill->total_km ?? 0)}}</td>
                </tr>
                <tr>
                    <td>Extra KM</td>
                    <td id="extraFairPerKm">{{ $bill->extraKm ?? '--' }}</td>
                    <td id="extraKm">{{ $bill->extraKmCost ?? '--' }}</td>
                    <td id="extraKmCost">₹{{($bill->extraKm ?? 0) * ($bill->extraKmCost ?? 0)}}</td>
                </tr>
                <tr>
                    <td>Extra Hours</td>
                    <td id="extraHourPerKm">{{ $bill->extraHour ?? '--' }}</td>
                    <td id="extraHour">{{ $bill->extraHourPerKm ?? '--' }}</td>
                    <td id="extraHourCharge">₹{{ $bill->extraHourCharge ?? '--' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Additional Charges and Totals Table -->
    <div class="table-responsive mb-3">
        <table class="table table-bordered amount-table">
            <tbody>
                <tr>
                    <th>Fuel Charge</th>
                    <td id="fuelCharge">₹{{ $bill->fuelCharge ?? '--' }}</td>
                </tr>
                <tr>
                    <th>Driver Charge</th>
                    <td id="driverCharge">₹{{ $bill->driverCharge ?? '--' }}</td>
                </tr>
                <tr>
                    <th>Toll</th>
                    <td id="toll">₹{{ $bill->toll ?? '--' }}</td>
                </tr>
                <tr>
                    <th>State Tax</th>
                    <td id="toll">₹{{ $bill->tax ?? '--' }}</td>
                </tr>
                <tr>
                    <th>Parking</th>
                    <td id="parking">₹{{ $bill->parking ?? '--' }}</td>
                </tr>
                @php
                $subTotal = 0;
                $subTotal = (($bill->perKmCost ?? 0) * ($bill->total_km ?? 0)) + (($bill->extraKm ?? 0) * ($bill->extraKmCost ?? 0)) + ($bill->extraHourCharge ?? 0) + ($bill->fuelCharge ?? 0) + ($bill->driverCharge ?? 0) + ($bill->toll ?? 0) + ($bill->parking ?? 0);

                $igstVal = ($subTotal * ($bill->igst ?? 0))/100;
                $sgstVal = ($subTotal * ($bill->sgst ?? 0))/100;
                $cgstVal = ($subTotal * ($bill->cgst ?? 0))/100;
                $grandTotal = $subTotal + $igstVal + $sgstVal + $cgstVal;
                @endphp
                <tr>
                    <th>Subtotal</th>
                    <td id="subTotal">₹{{ $subTotal }}</td>
                </tr>
                @if($bill->type != "0")
                <tr>
                    <th>CGST (2.5%)</th>
                    <td id="cgst">₹{{ $cgstVal ?? '--' }}</td>
                </tr>
                <tr>
                    <th>SGST (2.5%)</th>
                    <td id="sgst">₹{{ $sgstVal ?? '--' }}</td>
                </tr>
                <tr>
                    <th>IGST (5%)</th>
                    <td id="igst">₹{{ $igstVal ?? '--' }}</td>
                </tr>
                @endif
                <tr>
                    <th><strong>Grand Total</strong></th>
                    <td id="grandTotal"><strong>₹{{ $grandTotal}}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Note & Signature Section -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-body p-2">
                    <strong>Note:</strong>
                    <p class="mb-0" style="font-size: 0.95rem; color: #555;">
                        {{ $bill->note ?? 'Thank you for your Booking. Please contact us for any queries regarding this invoice.' }}
                    </p>
                    <p>
                        <strong>Website:</strong>
                        <a href="https://cabyatra.com/">https://cabyatra.com/</a>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-md-4 text-end">
            <div class="card border-0">
                <div class="card-body p-2">
                    <strong>Authorized Signature</strong>
                    <div style="height: 58px; border-bottom: 1px solid #aaa; margin-bottom: 5px;">
                        <img src="{{asset('/signature_new.jpeg')}}" style="height: 58px;
    width: 150px;">
                    </div>
                    <span style="font-size: 0.8rem; color: #555;">(Signature)</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-end">
    <button class="btn btn-secondary" onclick="printInvoice()">Print Invoice</button>
</div>

<script>
    function printInvoice() {
        var printContents = document.getElementById('invoicePrintArea').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
@endsection