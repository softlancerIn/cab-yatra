@extends('Admin.common.layout')
@section('content')
@php
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
                <h6 class="card-title mb-2 small">Invoice / Bill Generation</h6>
                <form action="{{route('billGenerate.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Invoice Header -->
                    <div class="row mb-1">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="type" class="small mb-0">Type</label>
                                <select name="type" id="type" class="form-control form-select">
                                    <option value="" selected disabled>Select Tax Type</option>
                                    <option value="1">GST</option>
                                    <option value="0">Without GST</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="date" class="small mb-0">Date</label>
                                <input type="date" class="form-control form-control-sm" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="carCategoryId" class="small mb-0">Car Category</label>
                                <select name="carCategoryId" id="carCategoryId" class="form-control form-control-sm">
                                    <option value="" selected disabled>Select</option>
                                    <option value="Swift">Swift</option>
                                    <option value="Swift Dzire">Swift Dzire</option>
                                    <option value="Xcent">Xcent</option>
                                    <option value="Aura">Aura</option>
                                    <option value="Ertiga">Ertiga</option>
                                    <option value="Kiya Carens">Kiya Carens</option>
                                    <option value="Innova">Innova</option>
                                    <option value="Innova Crista">Innova Crista</option>
                                    <option value="Tampoo traveller 12+1">Tampoo traveller 12+1</option>
                                    <option value="Setting">Setting</option>
                                    <option value="Tampoo traveller 16+1">Tampoo traveller 16+1</option>
                                    <option value="Bus">Bus</option>
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
                                    <input type="text" class="form-control form-control-sm" id="recipient_name" name="recipient_name" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="recipient_gstNo" class="small mb-0">GST No</label>
                                    <input type="text" class="form-control form-control-sm" id="recipient_gstNo" name="recipient_gstNo">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="recipient_address" class="small mb-0">Address</label>
                                    <input type="text" class="form-control form-control-sm" id="recipient_address" name="recipient_address">
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- <div class="d-flex"> -->
                                <div class="form-group">
                                    <label for="goods_description" class="small mb-0">Goods Description</label>
                                    <input type="text" class="form-control form-control-sm" id="goods_description" name="goods_description">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="vehicleNumber" class="small mb-0">Vehicle Number</label>
                                    <input
                                        type="text"
                                        id="vehicleNumber"
                                        name="vehicleNumber"
                                        class="form-control form-control-sm"
                                        placeholder="Enter vehicle number (e.g. MH12AB1234)"
                                        style="text-transform:uppercase;"
                                        oninput="formatVehicleNumber(this)">
                                    <small class="form-text text-muted">Only uppercase letters, numbers, spaces and hyphen allowed.</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <!-- Flexible Route Section -->
                                <div class="card mt-2">
                                    <div class="card-header py-1 px-2 bg-light">
                                        <strong class="small">Route Details (Pickup/Destination in Order)</strong>
                                    </div>
                                    <div class="card-body py-1 px-2">
                                        <div id="route-flex-list">
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
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" id="perKmCost" name="perKmCost" required></td>
                                </tr>
                                <tr>
                                    <td class="small">Total KM</td>
                                    <td><input type="number" class="form-control form-control-sm" id="total_km" name="total_km" required></td>
                                </tr>
                                <tr>
                                    <td class="small">Total Value</td>
                                    <td><input type="number" step="0.01" class="form-control form-control-sm" id="total_value" name="total_value" required></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Fair Per KM</td>
                                    <td><input type="text" class="form-control form-control-sm" id="extraFairPerKm" name="extraFairPerKm"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra KM</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraKm" name="extraKm"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra KM Cost</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraKmCost" name="extraKmCost"></td>
                                </tr>
                                <tr>
                                    <td class="small">Final Total KM</td>
                                    <td><input type="number" class="form-control form-control-sm" id="finalTotalKm" name="finalTotalKm" required></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Hour Per KM</td>
                                    <td><input type="text" class="form-control form-control-sm" id="extraHourPerKm" name="extraHourPerKm"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Hour</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraHour" name="extraHour"></td>
                                </tr>
                                <tr>
                                    <td class="small">Extra Hour Charge</td>
                                    <td><input type="number" class="form-control form-control-sm" id="extraHourCharge" name="extraHourCharge"></td>
                                </tr>
                                <tr>
                                    <td class="small">Fuel Charge</td>
                                    <td><input type="text" class="form-control form-control-sm" id="fuelCharge" name="fuelCharge"></td>
                                </tr>
                                <tr>
                                    <td class="small">Driver Charge</td>
                                    <td><input type="text" class="form-control form-control-sm" id="driverCharge" name="driverCharge"></td>
                                </tr>
                                <tr>
                                    <td class="small">Toll</td>
                                    <td><input type="text" class="form-control form-control-sm" id="toll" name="toll"></td>
                                </tr>
                                <tr>
                                    <td class="small">State Tax</td>
                                    <td><input type="text" class="form-control form-control-sm" id="tax" name="tax"></td>
                                </tr>
                                <tr>
                                    <td class="small">Parking</td>
                                    <td><input type="text" class="form-control form-control-sm" id="parking" name="parking"></td>
                                </tr>
                                <tr>
                                    <td class="small">Sub Total</td>
                                    <td><input type="text" class="form-control form-control-sm" id="subTotal" name="subTotal"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Tax & Total Section -->
                    <div class="row mb-1">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="cgst" class="small mb-0">CGST%</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="cgst" name="cgst" value="0">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="sgst" class="small mb-0">SGST%</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="sgst" name="sgst" value="0">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="igst" class="small mb-0">IGST%</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="igst" name="igst" value="5">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="grandTotal" class="small mb-0"><strong>Grand Total</strong></label>
                                <input type="number" step="0.01" class="form-control form-control-sm" id="grandTotal" name="grandTotal" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-sm px-3 py-1">Generate Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const carCategories = @json($data['category'] ?? []);

    function setField(fieldId, value) {
        const field = document.getElementById(fieldId);
        if (!field) return;
        const val = (typeof value === 'string') ? value.trim().toLowerCase() : '';
        if (val === 'inclusive' || val === 'included') {
            field.value = 0;
        } else if (val === 'exclusive' || val === 'extra') {
            field.value = '';
        } else {
            field.value = value || '';
        }
        field.disabled = false;
    }

    function calculateTotalValue() {
        const perKmCost = parseFloat(document.getElementById('perKmCost').value) || 0;
        const totalKm = parseFloat(document.getElementById('total_km').value) || 0;
        document.getElementById('total_value').value = perKmCost * totalKm;
    }

    function calculateFinalTotalKm() {
        const totalKm = parseFloat(document.getElementById('total_km').value) || 0;
        const extraKm = parseFloat(document.getElementById('extraKm').value) || 0;
        document.getElementById('finalTotalKm').value = totalKm + extraKm;
    }

    function calculateExtraHourCharge() {
        const extraHourPerKm = parseFloat(document.getElementById('extraHourPerKm').value) || 0;
        const extraHour = parseFloat(document.getElementById('extraHour').value) || 0;
        document.getElementById('extraHourCharge').value = extraHourPerKm * extraHour;
    }

    function calculateExtraKmCost() {
        const extraFairPerKmRaw = document.getElementById('extraFairPerKm').value;
        const extraFairPerKm = parseFloat(extraFairPerKmRaw) || 0;
        const extraKm = parseFloat(document.getElementById('extraKm').value) || 0;
        document.getElementById('extraKmCost').value = extraFairPerKm * extraKm;
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
        document.getElementById('subTotal').value = subTotal;

        calculateGrandTotal();
    }

    // Grand total: only apply taxes when type === '1' (GST). For "Without GST" taxes are ignored.
    function calculateGrandTotal() {
        const subTotal = parseFloat(document.getElementById('subTotal').value) || 0;
        const cgst = parseFloat(document.getElementById('cgst').value) || 0;
        const sgst = parseFloat(document.getElementById('sgst').value) || 0;
        const igst = parseFloat(document.getElementById('igst').value) || 0;
        const typeEl = document.getElementById('type');
        const type = typeEl ? typeEl.value : '1';

        let cgstAmount = 0;
        let sgstAmount = 0;
        let igstAmount = 0;

        if (type === '1') {
            // GST flow: prefer IGST if > 0 else CGST+SGST
            if (igst > 0) {
                igstAmount = subTotal * (igst / 100);
            } else {
                cgstAmount = subTotal * (cgst / 100);
                sgstAmount = subTotal * (sgst / 100);
            }
        } else {
            // Without GST: explicitly ignore tax inputs (do not alter their stored values)
            cgstAmount = 0;
            sgstAmount = 0;
            igstAmount = 0;
        }

        const grandTotal = subTotal + cgstAmount + sgstAmount + igstAmount;
        document.getElementById('grandTotal').value = grandTotal.toFixed(2);
    }

    document.getElementById('carCategoryId').addEventListener('change', function() {
        const selectedId = this.value;
        const selectedCat = carCategories.find(cat => cat.id == selectedId);

        if (selectedCat) {
            setField('perKmCost', selectedCat.per_km_cost);
            setField('extraFairPerKm', selectedCat.extra_fair_perKm);
            setField('extraHourPerKm', selectedCat.extra_fair_perHour);
            setField('fuelCharge', selectedCat.fuel_charge);
            setField('driverCharge', selectedCat.driver_charge);
            setField('toll', selectedCat.toll);
            setField('tax', selectedCat.tax);
            setField('parking', selectedCat.parking);

            calculateTotalValue();
            calculateSubTotal();
        }
    });

    ['perKmCost', 'total_km', 'extraKm', 'extraHourPerKm', 'extraHour', 'extraFairPerKm',
        'total_value', 'extraKmCost', 'extraHourCharge', 'fuelCharge', 'driverCharge', 'toll', 'tax', 'parking'
    ].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('input', function() {
            // trigger dependent calculations safely
            calculateTotalValue();
            calculateFinalTotalKm();
            calculateExtraKmCost();
            calculateExtraHourCharge();
            calculateSubTotal();
        });
    });

    // Mutual exclusivity for tax inputs
    const cgstEl = document.getElementById('cgst');
    const sgstEl = document.getElementById('sgst');
    const igstEl = document.getElementById('igst');

    cgstEl && cgstEl.addEventListener('input', function() {
        const v = parseFloat(this.value) || 0;
        if (v > 0) {
            igstEl && (igstEl.value = 0);
        }
        calculateGrandTotal();
    });

    sgstEl && sgstEl.addEventListener('input', function() {
        const v = parseFloat(this.value) || 0;
        if (v > 0) {
            igstEl && (igstEl.value = 0);
        }
        calculateGrandTotal();
    });

    igstEl && igstEl.addEventListener('input', function() {
        const v = parseFloat(this.value) || 0;
        if (v > 0) {
            cgstEl && (cgstEl.value = 0);
            sgstEl && (sgstEl.value = 0);
        }
        calculateGrandTotal();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type') || document.querySelector('select[name="type"]');
        const recipientGstInput = document.getElementById('recipient_gstNo');
        const recipient_gstNoDiv = recipientGstInput ? recipientGstInput.closest('.form-group') : null;

        const cgstDiv = cgstEl ? cgstEl.closest('.form-group') : null;
        const sgstDiv = sgstEl ? sgstEl.closest('.form-group') : null;
        const igstDiv = igstEl ? igstEl.closest('.form-group') : null;

        function toggleTaxFields() {
            if (!typeSelect) return;
            const isGst = typeSelect.value === '1';

            // Show/hide recipient GST
            if (recipient_gstNoDiv) recipient_gstNoDiv.style.display = isGst ? '' : 'none';

            // Show/hide and enable/disable tax inputs (do not overwrite IGST default)
            if (cgstDiv) cgstDiv.style.display = isGst ? '' : 'none';
            if (sgstDiv) sgstDiv.style.display = isGst ? '' : 'none';
            if (igstDiv) igstDiv.style.display = isGst ? '' : 'none';

            if (isGst) {
                // enable and set defaults if empty
                if (cgstEl) {
                    cgstEl.disabled = false;
                    if (cgstEl.value === '' || isNaN(parseFloat(cgstEl.value))) cgstEl.value = 0;
                }
                if (sgstEl) {
                    sgstEl.disabled = false;
                    if (sgstEl.value === '' || isNaN(parseFloat(sgstEl.value))) sgstEl.value = 0;
                }
                if (igstEl) {
                    igstEl.disabled = false;
                    if (igstEl.value === '' || isNaN(parseFloat(igstEl.value))) igstEl.value = 5;
                }
                // ensure no double tax
                if (igstEl && parseFloat(igstEl.value) > 0) {
                    cgstEl && (cgstEl.value = 0);
                    sgstEl && (sgstEl.value = 0);
                }
            } else {
                // Without GST: disable tax fields and hide them, but do NOT change their stored values (keeps IGST default 5)
                if (cgstEl) cgstEl.disabled = true;
                if (sgstEl) sgstEl.disabled = true;
                if (igstEl) igstEl.disabled = true;

                if (recipientGstInput) recipientGstInput.value = '';
            }

            calculateGrandTotal();
        }

        typeSelect && typeSelect.addEventListener('change', function() {
            toggleTaxFields();
            // Recalculate after change
            calculateSubTotal();
            calculateGrandTotal();
        });

        function initDefaults() {
            if (cgstEl && (cgstEl.value === '' || isNaN(parseFloat(cgstEl.value)))) cgstEl.value = 0;
            if (sgstEl && (sgstEl.value === '' || isNaN(parseFloat(sgstEl.value)))) sgstEl.value = 0;

            // Only default IGST to 5% when GST is selected; otherwise keep the input's current/default value untouched
            const isGst = typeSelect && typeSelect.value === '1';
            if (igstEl) {
                if (isGst && (igstEl.value === '' || isNaN(parseFloat(igstEl.value)))) {
                    igstEl.value = 5;
                }
                // if not GST, leave igstEl.value as-is (do not set to 0)
            }

            if (igstEl && parseFloat(igstEl.value) > 0) {
                cgstEl && (cgstEl.value = 0);
                sgstEl && (sgstEl.value = 0);
            }

            calculateTotalValue();
            calculateFinalTotalKm();
            calculateExtraKmCost();
            calculateExtraHourCharge();
            calculateSubTotal();
            calculateGrandTotal();

            toggleTaxFields();
        }

        initDefaults();
    });

    function addPickup() {
        var container = document.getElementById('pickups');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'pickups[]';
        input.className = 'form-control form-control-sm mb-1';
        input.placeholder = 'Pickup Location';
        container.appendChild(input);
    }

    function addDestination() {
        var container = document.getElementById('destinations');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'destinations[]';
        input.className = 'form-control form-control-sm mb-1';
        input.placeholder = 'Destination Location';
        container.appendChild(input);
    }

    function addRouteRow() {
        var container = document.getElementById('route-list');
        var row = document.createElement('div');
        row.className = 'row mb-1 route-row';
        row.innerHTML = `
            <div class="col-6">
                <input type="text" name="route_pickup[]" class="form-control form-control-sm" placeholder="Pickup Location">
            </div>
            <div class="col-6">
                <input type="text" name="route_destination[]" class="form-control form-control-sm" placeholder="Destination Location">
            </div>
        `;
        container.appendChild(row);
    }

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