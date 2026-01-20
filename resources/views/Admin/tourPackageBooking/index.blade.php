@extends('Admin.common.layout')
@section('content')
@php
$active = 'tour_package_booking';
@endphp

<div class="row">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                    <h4 class="card-title mb-0">TourPackge Booking List</h4>
                    {{-- <a href="{{route('tourPackages.create')}}" class="btn btn-sm btn-primary ms-auto align-item-right">Add</a> --}}
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
                    <table class="table table-bordered display" id="myTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>Order ID</th>
                                <th>Package Name</th>
                                <th>Mobile</th>
                                <th>Pick Up Date</th>
                                <th>Total Fair</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['list'] as $key => $value)
                            @if($key%2 == '0')
                            <tr class="table-info">
                                @else
                            <tr class="table-warning">
                                @endif
                                <td>{{$key+1}}</td>
                                <td>{{$value->orderId}}</td>
                                <td>{{$value->tourPackage->name}}</td>
                                <td>{{$value->mobile}}</td>
                                <td>{{$value->pickUp_date}}</td>
                                <td>{{$value->total_faire}}</td>
                                <td>
                                    <a href="{{route('statusUpate',['table'=>'loaclPackage','id'=>$value->id])}}">
                                        @if($value->status == '0')
                                        <div class="badge badge-opacity-primary text-white">
                                            Initiated
                                        </div>
                                        @elseif($value->status == '1')
                                        <div class="badge badge-opacity-secndary">
                                            Accepted
                                        </div>
                                        @elseif($value->status == '2')
                                        <div class="badge badge-opacity-success">
                                            Completed
                                        </div>
                                        @else
                                        <div class="badge badge-opacity-danger">
                                            Rejected
                                        </div>
                                        <span class="badge badge-pill badge-danger">Rejected</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('tourPkgDetail',['id'=>$value->id])}}">
                                        <button type="button" class="btn btn-success">View</button>
                                    </a>
                                    {{-- <a href="{{route('globalDelete',['model'=> 'localPackage','id'=>$value->id])}}" class="btn btn-danger btn-rounded btn-icon p-3" onclick="return confirm('Are you sure to wan to delete this data!')"><i class="ti-trash"></i></a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });

</script>
@endsection
