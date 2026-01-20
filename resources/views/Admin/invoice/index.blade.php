@extends('Admin.common.layout')
@section('content')
@php
$active = 'invoice';
@endphp
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="col-lg-6">
            <form action="{{ route('billGenerate.index') }}" class="d-flex">
                <input type="text" class="form-control" placeholder="Search Here" name="search">
                <button class="btn btn-primary ms-4">Search</button>
            </form>
        </div>
    </div>
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                    <h4 class="card-title mb-0 ">Invoice List</h4>
                    <a href="{{route('billGenerate.create')}}"
                        class="btn btn-sm btn-primary ms-auto align-item-right">Add</a>
                </div>

                @if(Session::has('success'))
                <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bill No</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <!-- <th>GST No</th> -->
                                <th>Address</th>
                                <th>Car Category</th>
                                <th>Goods Description</th>
                                <th>Total KM</th>
                                <th>Final Total KM</th>
                                <th>Amount</th>
                                <th>GST Type</th>
                                <th>CGST (%)</th>
                                <th>SGST (%)</th>
                                <th>IGST (%)</th>
                                <th>Grand Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['bill'] as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->billNo ?? '--' }}</td>
                                <td>{{ $value->date ?? '--' }}</td>
                                <td>{{ $value->recipient_name ?? '--' }}</td>
                                <!-- <td>{{ $value->recipient_gstNo ?? '--' }}</td> -->
                                <td>{{ $value->recipient_address ?? '--' }}</td>
                                <td>{{ $value->carCategoryId ?? '--' }}</td>
                                <td>{{ $value->goods_description ?? '--' }}</td>
                                <td>{{ $value->total_km ?? '--' }}</td>
                                <td>{{ $value->finalTotalKm ?? '--' }}</td>
                                <td>{{ $value->subTotal ?? $value->total_value ?? '--' }}</td>
                                <td>
                                    @if($value->type == "1")
                                    GST
                                    @else
                                    Non GST
                                    @endif
                                </td>
                                <td>{{ $value->cgst ?? '--' }}</td>
                                <td>{{ $value->sgst ?? '--' }}</td>
                                <td>{{ $value->igst ?? '--' }}</td>
                                <td>{{ $value->grandTotal ?? '--' }}</td>
                                <td>
                                    <!-- <a href="{{ route('BillDownload',['id'=>$value->id]) }}" id="download-pdf"
                                        class="btn btn-primary btn-rounded btn-icon py-1 px-3"><i class="ti-download"></i></a> -->
                                    <a href="{{ route('billGenerate.show', $value->id) }}"
                                        class="btn btn-info btn-rounded btn-icon py-1 px-3"><i class="ti-eye"></i></a>
                                    <a href="{{route('billGenerate.edit', $value->id)}}"
                                        class="btn btn-dark btn-rounded btn-icon py-1 px-3"><i
                                            class="ti-pencil"></i></a>
                                    <a href="{{route('globalDelete', ['model' => 'billGenerate', 'id' => $value->id])}}"
                                        class="btn btn-danger py-1 px-3 btn-rounded btn-icon"
                                        onclick="return confirm('Are you sure to wan to delete this data!')"><i
                                            class="ti-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $data['bill']->links('Admin.common.pagination')}}
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    // Attach click event to the download button
    document.getElementById('download-pdf').addEventListener('click', function() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Get the HTML content from the Blade view
        const content = document.getElementById('invoice-content').innerHTML;

        // Add the HTML content to the PDF
        doc.html(content, {
            callback: function(doc) {
                // After content is added, save the PDF as "invoice.pdf"
                doc.save('invoice.pdf');
            },
            margin: [10, 10, 10, 10], // Define margins for the PDF
            x: 10,
            y: 10
        });
    });
</script>

@endsection