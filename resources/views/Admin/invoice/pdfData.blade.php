<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
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

    @media print {
        .no-print {
            display: none;
        }
    }
</style>
</head>

<body>
    <div class="invoice-container">
        
        <div
            class="invoice-header d-flex justify-content-between align-items-center">
            <div>
                <h1 class="invoice-title">Invoice</h1>
                <p class="mb-0">
                    <strong>Invoice ID:</strong> <span id="id">INV-001</span>
                </p>
                <p class="mb-0">
                    <strong>Bill No:</strong> <span id="billNo">BILL-1001</span>
                </p>
                <p class="mb-0"><strong>Type:</strong> <span id="type">GST</span></p>
            </div>
            <div class="text-end">
                <p class="mb-0">
                    <strong>Date:</strong> <span id="date">05-Oct-2025</span>
                </p>
                <p class="mb-0">
                    <strong>Status:</strong> <span id="status">Active</span>
                </p>
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-md-6">
                <h5 class="mb-2" style="color: var(--theme-color)">Bill To:</h5>
                <p class="mb-1">
                    <strong>Name:</strong> <span id="recipient_name">John Doe</span>
                </p>
                <p class="mb-1">
                    <strong>Address:</strong>
                    <span id="recipient_address">123 Main Street, City</span>
                </p>
                <p class="mb-1">
                    <strong>GST No:</strong>
                    <span id="recipient_gstNo">22AAAAA0000A1Z5</span>
                </p>
            </div>
            <div class="col-md-6">
                <h5 class="mb-2" style="color: var(--theme-color)">Trip Info:</h5>
                <p class="mb-1">
                    <strong>Car Category ID:</strong>
                    <span id="carCategoryId">SUV-101</span>
                </p>
                <p class="mb-1">
                    <strong>Final Total KM:</strong>
                    <span id="finalTotalKm">150</span> km
                </p>
                <p class="mb-1">
                    <strong>Goods Description:</strong>
                    <span id="goods_description">Logistics Delivery</span>
                </p>
            </div>
        </div>

        
        <div class="mb-3">
            <h5 class="mb-2" style="color: var(--theme-color)">
                Pickup & Destination Route:
            </h5>
            <div class="timeline">
                
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <h6>Pickup: Warehouse A, Sector 10</h6>
                        <p>05-Oct-2025 | 10:00 AM</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <h6>Destination: Retail Store B, City Center</h6>
                        <p>05-Oct-2025 | 11:30 AM</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <h6>Destination: Retail Store C, Industrial Area</h6>
                        <p>05-Oct-2025 | 1:00 PM</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Per Km Cost</th>
                        <th>Total KM</th>
                        <th>Total Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Main Trip</td>
                        <td id="perKmCost">₹12.00</td>
                        <td id="total_km">150</td>
                        <td id="total_value">₹1800.00</td>
                    </tr>
                    <tr>
                        <td>Extra KM</td>
                        <td id="extraFairPerKm">₹15.00</td>
                        <td id="extraKm">10</td>
                        <td id="extraKmCost">₹150.00</td>
                    </tr>
                    <tr>
                        <td>Extra Hours</td>
                        <td id="extraHourPerKm">₹100.00</td>
                        <td id="extraHour">2</td>
                        <td id="extraHourCharge">₹200.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        
        <div class="table-responsive mb-3">
            <table class="table table-bordered amount-table">
                <tbody>
                    <tr>
                        <th>Fuel Charge</th>
                        <td id="fuelCharge">₹300.00</td>
                    </tr>
                    <tr>
                        <th>Driver Charge</th>
                        <td id="driverCharge">₹400.00</td>
                    </tr>
                    <tr>
                        <th>Toll</th>
                        <td id="toll">₹150.00</td>
                    </tr>
                    <tr>
                        <th>Parking</th>
                        <td id="parking">₹50.00</td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td id="subTotal">₹3050.00</td>
                    </tr>
                    <tr>
                        <th>CGST</th>
                        <td id="cgst">₹150.00</td>
                    </tr>
                    <tr>
                        <th>SGST</th>
                        <td id="sgst">₹150.00</td>
                    </tr>
                    <tr>
                        <th>IGST</th>
                        <td id="igst">₹0.00</td>
                    </tr>
                    <tr>
                        <th><strong>Grand Total</strong></th>
                        <td id="grandTotal"><strong>₹3350.00</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Invoice</title>
    <style>
        :root {
            --theme-color: #00a743;
        }

        body {
            background: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
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
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .invoice-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--theme-color);
            margin: 0 0 10px 0;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--theme-color);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col-half {
            width: 50%;
            padding: 0 10px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 8px 10px;
            border: 1px solid #ccc;
            vertical-align: middle;
        }

        table th {
            background-color: var(--theme-color);
            color: #fff;
            text-align: left;
        }

        .amount-table th {
            text-align: left;
        }

        .amount-table td {
            text-align: right;
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

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div>
                <h1 class="invoice-title">Invoice</h1>
                <p><strong>Invoice ID:</strong> INV-001</p>
                <p><strong>Bill No:</strong> BILL-1001</p>
                <p><strong>Type:</strong> GST</p>
            </div>
            <div style="text-align: right;">
                <p><strong>Date:</strong> 05-Oct-2025</p>
                <p><strong>Status:</strong> Active</p>
            </div>
        </div>

        <!-- Recipient -->
        <div class="row">
            <div class="col-half">
                <h5 class="section-title">Bill To:</h5>
                <p><strong>Name:</strong> John Doe</p>
                <p><strong>Address:</strong> 123 Main Street, City</p>
                <p><strong>GST No:</strong> 22AAAAA0000A1Z5</p>
            </div>
            <div class="col-half">
                <h5 class="section-title">Trip Info:</h5>
                <p><strong>Car Category ID:</strong> SUV-101</p>
                <p><strong>Final Total KM:</strong> 150 km</p>
                <p><strong>Goods Description:</strong> Logistics Delivery</p>
            </div>
        </div>

        <!-- Timeline -->
        <h5 class="section-title">Pickup & Destination Route:</h5>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-icon"></div>
                <div class="timeline-content">
                    <h6>Pickup: Warehouse A, Sector 10</h6>
                    <p>05-Oct-2025 | 10:00 AM</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-icon"></div>
                <div class="timeline-content">
                    <h6>Destination: Retail Store B, City Center</h6>
                    <p>05-Oct-2025 | 11:30 AM</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-icon"></div>
                <div class="timeline-content">
                    <h6>Destination: Retail Store C, Industrial Area</h6>
                    <p>05-Oct-2025 | 1:00 PM</p>
                </div>
            </div>
        </div>

        <!-- Cost Table -->
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Per Km Cost</th>
                    <th>Total KM</th>
                    <th>Total Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Main Trip</td>
                    <td>₹12.00</td>
                    <td>150</td>
                    <td>₹1800.00</td>
                </tr>
                <tr>
                    <td>Extra KM</td>
                    <td>₹15.00</td>
                    <td>10</td>
                    <td>₹150.00</td>
                </tr>
                <tr>
                    <td>Extra Hours</td>
                    <td>₹100.00</td>
                    <td>2</td>
                    <td>₹200.00</td>
                </tr>
            </tbody>
        </table>

        <!-- Charges Table -->
        <table class="amount-table">
            <tbody>
                <tr>
                    <th>Fuel Charge</th>
                    <td>₹300.00</td>
                </tr>
                <tr>
                    <th>Driver Charge</th>
                    <td>₹400.00</td>
                </tr>
                <tr>
                    <th>Toll</th>
                    <td>₹150.00</td>
                </tr>
                <tr>
                    <th>Parking</th>
                    <td>₹50.00</td>
                </tr>
                <tr>
                    <th>Subtotal</th>
                    <td>₹3050.00</td>
                </tr>
                <tr>
                    <th>CGST</th>
                    <td>₹150.00</td>
                </tr>
                <tr>
                    <th>SGST</th>
                    <td>₹150.00</td>
                </tr>
                <tr>
                    <th>IGST</th>
                    <td>₹0.00</td>
                </tr>
                <tr>
                    <th><strong>Grand Total</strong></th>
                    <td><strong>₹3350.00</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>