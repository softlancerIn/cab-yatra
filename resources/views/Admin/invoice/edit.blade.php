@extends('Admin.common.layout')
@section('content')
@php
$bill = $data['bill'] ?? null;
$active = 'invoice';
@endphp

<style>
    .form-control-sm,
    .table-sm,
    .btn-sm,
    .small {
        font-size: 0.85rem !important;
        padding: 0.15rem 0.5rem !important;
    }

    .form-group {
        margin-bottom: 0.5rem !important;
    }

    .card-body,
    .card-header {
        padding: 0.75rem !important;
    }

    .table th,
    .table td {
        padding: 0.25rem !important;
        vertical-align: middle !important;
    }
</style>

<div class="row">
    <div class="col-md-12 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body p-2">
                <h6 class="card-title mb-2 small">Edit Invoice / Bill</h6>

                <form action="{{ route('billGenerate.update', $bill->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Invoice Header -->
                    <div class="row mb-1">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="type" class="small mb-0">Type</label>
                                <select name="type" id="type" class="form-control form-select">
                                    <option value="" disabled>Select Tax Type</option>
                                    <option value="1" {{ $bill->type == '1' ? 'selected' : '' }}>GST</option>
                                    <option value="0" {{ $bill->type == '0' ? 'selected' : '' }}>Without GST</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="date" class="small mb-0">Date</label>
                                <input type="date" class="form-control form-control-sm" id="date" name="date"
                                    value="{{ $bill->date }}" required>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="carCategoryId" class="small mb-0">Car Category</label>
                                <select name="carCategoryId" id="carCategoryId" class="form-control form-control-sm">
                                    <option value="" disabled>Select</option>
                                    <option value="Swift" {{ $bill->carCategoryId == "Swift" ? 'selected':'' }}>Swift</option>
                                    <option value="Swift Dzire" {{ $bill->carCategoryId == "Swift Dzire" ? 'selected':'' }}>Swift Dzire</option>
                                    <option value="Xcent" {{ $bill->carCategoryId == "Xcent" ? 'selected':'' }}>Xcent</option>
                                    <option value="Aura" {{ $bill->carCategoryId == "Aura" ? 'selected':'' }}>Aura</option>
                                    <option value="Ertiga" {{ $bill->carCategoryId == "Ertiga" ? 'selected':'' }}>Ertiga</option>
                                    <option value="Kiya Carens" {{ $bill->carCategoryId == "Kiya Carens" ? 'selected':'' }}>Kiya Carens</option>
                                    <option value="Innova" {{ $bill->carCategoryId == "Innova" ? 'selected':'' }}>Innova</option>
                                    <option value="Innova Crista" {{ $bill->carCategoryId == "Innova Crista" ? 'selected':'' }}>Innova Crista</option>
                                    <option value="Tampoo traveller 12+1" {{ $bill->carCategoryId == "Tampoo traveller 12+1" ? 'selected':'' }}>Tampoo traveller 12+1</option>
                                    <option value="Setting" {{ $bill->carCategoryId == "Setting" ? 'selected':'' }}>Setting</option>
                                    <option value="Tampoo traveller 16+1" {{ $bill->carCategoryId == "Tampoo traveller 16+1" ? 'selected':'' }}>Tampoo traveller 16+1</option>
                                    <option value="Bus" {{ $bill->carCategoryId == "Bus" ? 'selected':'' }}>Bus</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Recipient Details -->
                    <div class="card mb-1">
                        <div class="card-header py-1 px-2 bg-light">
                            <strong class="small">Recipient Details</strong>
                        </div>
                        <div class="card-body py-1 px-2 row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="recipient_name" class="small mb-0">Name</label>
                                    <input type="text" class="form-control form-control-sm" id="recipient_name" name="recipient_name"
                                        value="{{ old('recipient_name', $bill->recipient_name ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="recipient_gstNo" class="small mb-0">GST No</label>
                                    <input type="text" class="form-control form-control-sm" id="recipient_gstNo" name="recipient_gstNo"
                                        value="{{ old('recipient_gstNo', $bill->recipient_gstNo ?? '') }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="recipient_address" class="small mb-0">Address</label>
                                    <input type="text" class="form-control form-control-sm" id="recipient_address" name="recipient_address"
                                        value="{{ old('recipient_address', $bill->recipient_address ?? '') }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="goods_description" class="small mb-0">Goods Description</label>
                                    <input type="text" class="form-control form-control-sm" id="goods_description" name="goods_description"
                                        value="{{ old('goods_description', $bill->goods_description ?? '') }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="vehicleNumber" class="small mb-0">Vehicle Number</label>
                                    <input type="text" id="vehicleNumber" name="vehicleNumber" class="form-control form-control-sm"
                                        placeholder="Enter vehicle number (e.g. MH12AB1234)"
                                        style="text-transform:uppercase;"
                                        oninput="formatVehicleNumber(this)"
                                        value="{{ old('vehicleNumber', $bill->vehicleNumber ?? '') }}">
                                    <small class="form-text text-muted">Only uppercase letters, numbers, spaces and hyphen allowed.</small>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card mt-2">
                                    <div class="card-header py-1 px-2 bg-light">
                                        <strong class="small">Route Details (Pickup/Destination in Order)</strong>
                                    </div>
                                    <div class="card-body py-1 px-2">
                                        <div id="route-flex-list">
                                            @php
                                            $route = json_decode($bill->route) ?? null;
                                            $routeTypes = $route && isset($route->type) ? $route->type : [];
                                            $routeNames = $route && isset($route->name) ? $route->name : [];
                                            @endphp

                                            @if(!empty($routeNames) && is_array($routeNames))
                                            @foreach($routeNames as $k => $rname)
                                            <div class="row mb-1 route-flex-row">
                                                <div class="col-6">
                                                    <select name="route[type][]" class="form-control form-control-sm">
                                                        <option value="pickup" {{ str_contains(strtolower($routeTypes[$k] ?? ''), 'pick') ? 'selected' : '' }}>Pickup</option>
                                                        <option value="destination" {{ (str_contains(strtolower($routeTypes[$k] ?? ''), 'drop') || str_contains(strtolower($routeTypes[$k] ?? ''), 'dest')) ? 'selected' : '' }}>Destination</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="route[name][]" class="form-control form-control-sm" placeholder="Enter Pickup or Destination" value="{{ old('route.name.'.$k, $rname) }}">
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row mb-1 route-flex-row">
                                                <div class="col-6">
                                                    <select name="route[type][]" class="form-control form-control-sm">
                                                        <option value="pickup">Pickup</option>
                                                        <option value="destination">Destination</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="route[name][]" class="form-control form-control-sm" placeholder="Enter Pickup or Destination">
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <button type="button" class="btn btn-sm btn-primary mt-1" onclick="addRouteFlexRow()">Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Table -->
                    <div class="table-responsive mb-1">
                        <table class="table table-bordered table-sm mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="small">Item</th>
                                    <th class="small">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="small">Per KM Cost</td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" id="perKmCost" name="perKmCost" required value="{{ old('perKmCost', $bill->perKmCost ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Total KM</td>
                                    <td><input type="number" class="form-control form-control-sm" id="total_km" name="total_km" required value="{{ old('total_km', $bill->total_km ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Total Value</td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" id="total_value" name="total_value" required value="{{ old('total_value', $bill->total_value ?? (($bill->perKmCost ?? 0) * ($bill->total_km ?? 0))) }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Fair Per KM</td>
                                    <td><input type="text" class="form-control form-control-sm" id="extraFairPerKm" name="extraFairPerKm" value="{{ old('extraFairPerKm', $bill->extraFairPerKm ?? $bill->extra_fair_perKm ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra KM</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraKm" name="extraKm" value="{{ old('extraKm', $bill->extraKm ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra KM Cost</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraKmCost" name="extraKmCost" value="{{ old('extraKmCost', $bill->extraKmCost ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Final Total KM</td>
                                    <td><input type="number" class="form-control form-control-sm" id="finalTotalKm" name="finalTotalKm" required value="{{ old('finalTotalKm', $bill->finalTotalKm ?? (($bill->total_km ?? 0) + ($bill->extraKm ?? 0))) }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Hour Per KM</td>
                                    <td><input type="text" class="form-control form-control-sm" id="extraHourPerKm" name="extraHourPerKm" value="{{ old('extraHourPerKm', $bill->extraHourPerKm ?? $bill->extra_fair_perHour ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Hour</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraHour" name="extraHour" value="{{ old('extraHour', $bill->extraHour ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Hour Charge</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraHourCharge" name="extraHourCharge" value="{{ old('extraHourCharge', $bill->extraHourCharge ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Fuel Charge</td>
                                    <td><input type="text" class="form-control form-control-sm" id="fuelCharge" name="fuelCharge" value="{{ old('fuelCharge', $bill->fuelCharge ?? $bill->fuel_charge ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Driver Charge</td>
                                    <td><input type="text" class="form-control form-control-sm" id="driverCharge" name="driverCharge" value="{{ old('driverCharge', $bill->driverCharge ?? $bill->driver_charge ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Toll</td>
                                    <td><input type="text" class="form-control form-control-sm" id="toll" name="toll" value="{{ old('toll', $bill->toll ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">State Tax</td>
                                    <td><input type="text" class="form-control form-control-sm" id="tax" name="tax" value="{{ old('tax', $bill->tax ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Parking</td>
                                    <td><input type="text" class="form-control form-control-sm" id="parking" name="parking" value="{{ old('parking', $bill->parking ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="small">Sub Total</td>
                                    <td><input type="text" class="form-control form-control-sm" id="subTotal" name="subTotal" value="{{ old('subTotal', $bill->subTotal ?? '') }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tax & Total Section -->
                    <div class="row mb-1">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="cgst" class="small mb-0">CGST%</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="cgst" name="cgst" value="{{ old('cgst', $bill->cgst ?? 0) }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="sgst" class="small mb-0">SGST%</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="sgst" name="sgst" value="{{ old('sgst', $bill->sgst ?? 0) }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="igst" class="small mb-0">IGST%</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="igst" name="igst" value="{{ old('igst', $bill->igst ?? 5) }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="grandTotal" class="small mb-0"><strong>Grand Total</strong></label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="grandTotal" name="grandTotal" required value="{{ old('grandTotal', $bill->grandTotal ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-sm px-3 py-1">Update Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const carCategories = @json($data['category'] ?? []);

    function formatVehicleNumber(el) {
        el.value = el.value.toUpperCase().replace(/[^A-Z0-9\s-]/g, '');
    }

    function setField(fieldId, value) {
        const field = document.getElementById(fieldId);
        if (!field) return;
        const val = (typeof value === 'string') ? value.trim().toLowerCase() : '';
        if (val === 'inclusive' || val === 'included') field.value = 0;
        else if (val === 'exclusive' || val === 'extra') field.value = '';
        else field.value = value || '';
        field.disabled = false;
    }

    function calculateTotalValue() {
        const perKmCost = parseFloat(document.getElementById('perKmCost').value) || 0;
        const totalKm = parseFloat(document.getElementById('total_km').value) || 0;
        document.getElementById('total_value').value = (perKmCost * totalKm).toFixed(2);
    }

    function calculateFinalTotalKm() {
        const totalKm = parseFloat(document.getElementById('total_km').value) || 0;
        const extraKm = parseFloat(document.getElementById('extraKm').value) || 0;
        document.getElementById('finalTotalKm').value = totalKm + extraKm;
    }

    function calculateExtraHourCharge() {
        const extraHourPerKm = parseFloat(document.getElementById('extraHourPerKm').value) || 0;
        const extraHour = parseFloat(document.getElementById('extraHour').value) || 0;
        document.getElementById('extraHourCharge').value = (extraHourPerKm * extraHour).toFixed(2);
    }

    function calculateExtraKmCost() {
        const extraFairPerKm = parseFloat(document.getElementById('extraFairPerKm').value) || 0;
        const extraKm = parseFloat(document.getElementById('extraKm').value) || 0;
        document.getElementById('extraKmCost').value = (extraFairPerKm * extraKm).toFixed(2);
    }

    function calculateSubTotal() {
        const totalValue = parseFloat(document.getElementById('total_value').value) || 0;
        const extraKmCost = parseFloat(document.getElementById('extraKmCost').value) || 0;
        const extraHourCharge = parseFloat(document.getElementById('extraHourCharge').value) || 0;
        const fuelCharge = parseFloat(document.getElementById('fuelCharge').value) || 0;
        const driverCharge = parseFloat(document.getElementById('driverCharge').value) || 0;
        const toll = parseFloat(document.getElementById('toll').value) || 0;
        const tax = parseFloat(document.getElementById('tax').value) || 0;
        const parking = parseFloat(document.getElementById('parking').value) || 0;
        const subTotal = totalValue + extraKmCost + extraHourCharge + fuelCharge + driverCharge + toll + tax + parking;
        document.getElementById('subTotal').value = subTotal.toFixed(2);
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        const subTotal = parseFloat(document.getElementById('subTotal').value) || 0;
        const cgst = parseFloat(document.getElementById('cgst').value) || 0;
        const sgst = parseFloat(document.getElementById('sgst').value) || 0;
        const igst = parseFloat(document.getElementById('igst').value) || 0;
        const typeEl = document.getElementById('type');
        const type = typeEl ? typeEl.value : 'gst';
        let cgstAmount = 0,
            sgstAmount = 0,
            igstAmount = 0;
        if (type === 'gst') {
            if (igst > 0) igstAmount = subTotal * (igst / 100);
            else {
                cgstAmount = subTotal * (cgst / 100);
                sgstAmount = subTotal * (sgst / 100);
            }
        } else {
            if (igst > 0) igstAmount = subTotal * (igst / 100);
        }
        const grandTotal = subTotal + cgstAmount + sgstAmount + igstAmount;
        document.getElementById('grandTotal').value = grandTotal.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Attach listeners (guard for element existence)
        ['perKmCost', 'total_km', 'extraKm', 'extraHourPerKm', 'extraHour', 'extraFairPerKm', 'total_value', 'extraKmCost', 'extraHourCharge', 'fuelCharge', 'driverCharge', 'toll', 'tax', 'parking', 'subTotal', 'cgst', 'sgst', 'igst'].forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('input', function() {
                calculateTotalValue();
                calculateFinalTotalKm();
                calculateExtraKmCost();
                calculateExtraHourCharge();
                calculateSubTotal();
            });
        });

        // Mutually exclusive tax fields
        const cgstEl = document.getElementById('cgst'),
            sgstEl = document.getElementById('sgst'),
            igstEl = document.getElementById('igst');
        if (cgstEl) cgstEl.addEventListener('input', () => {
            if (parseFloat(cgstEl.value) || 0 > 0) igstEl && (igstEl.value = 0);
            calculateGrandTotal();
        });
        if (sgstEl) sgstEl.addEventListener('input', () => {
            if (parseFloat(sgstEl.value) || 0 > 0) igstEl && (igstEl.value = 0);
            calculateGrandTotal();
        });
        if (igstEl) igstEl.addEventListener('input', () => {
            if (parseFloat(igstEl.value) || 0 > 0) {
                cgstEl && (cgstEl.value = 0);
                sgstEl && (sgstEl.value = 0);
            }
            calculateGrandTotal();
        });

        // Initialize calculations
        calculateTotalValue();
        calculateFinalTotalKm();
        calculateExtraKmCost();
        calculateExtraHourCharge();
        calculateSubTotal();
        calculateGrandTotal();
    });

    function addRouteFlexRow() {
        var container = document.getElementById('route-flex-list');
        var row = document.createElement('div');
        row.className = 'row mb-1 route-flex-row';
        row.innerHTML = `
                <div class="col-6">
                    <select name="route[type][]" class="form-control form-control-sm">
                        <option value="pickup">Pickup</option>
                        <option value="destination">Destination</option>
                    </select>
                </div>
                <div class="col-6">
                    <input type="text" name="route[name][]" class="form-control form-control-sm" placeholder="Enter Pickup or Destination">
                </div>
            `;
        container.appendChild(row);
    }
</script>

@endsection