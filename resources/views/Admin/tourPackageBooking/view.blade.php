@extends('Admin.common.layout')
@section('content')
    @php
        $active = 'tour_package_booking';
    @endphp

    <style>
        select.confirm-select-box.form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
            color: #000;
            outline: 1px solid #000;
            background-repeat: no-repeat;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex ">
                        <h4 class="card-title">TourPackge Booking Details</h4>
                    </div>
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6">
                            <p class="fs-5"><strong>Order Id</strong> <span>:</span>
                                <span>{{$data['details']->orderId}}</span>
                            </p>
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-end">
                            <p class="fs-5"><strong>Order Date</strong> <span>:</span> <span>12-11-2024</span></p>
                            <select class="form-select w-25 ms-3 confirm-select-box " aria-label="Default select example"
                                style="background-color: #43b9ad69;">
                                <option value="0" {{$data['details']->status == '0' ? 'selected' : ''}}>Pending</option>
                                <option value="1" {{$data['details']->status == '1' ? 'selected' : ''}}>Accepted</option>
                                <option value="2" {{$data['details']->status == '2' ? 'selected' : ''}}>Completed</option>
                                <option value="3" {{$data['details']->status == '3' ? 'selected' : ''}}>Reject</option>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <!-- ====================== Details Section  -->
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <form class="row g-3 ">

                                <div class="col-12 col-lg-6">
                                    <div class="row mt-3 gy-3">
                                        <div class="col-12">
                                            <h5 class="fs-5 fw-bold my-1">Personal Information</h5>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="fs-6"><strong>Name</strong><span>:</span> <span
                                                    class="text-capitalize">{{$data['details']->name}}</span></p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="fs-6"><strong>Mobile Number</strong><span>:</span> <span
                                                    class="text-capitalize">{{$data['details']->mobile}}</span></p>

                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="fs-6"><strong>Emial ID</strong><span>:</span><span
                                                    class="text-capitalize">{{$data['details']->email}}</span></p>
                                        </div>
                                    </div>
                                    <div class="row mt-3 gy-3 mb-3">
                                        <div class="col-12">
                                            <h5 class="fs-5 fw-bold my-1">Billing Information</h5>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="fs-6"><strong>Name</strong><span>:</span> <span
                                                    class="text-capitalize">{{$data['details']->biling_name}}</span></p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="fs-6"><strong>GST Number</strong><span>:</span> <span
                                                    class="text-capitalize">{{$data['details']->biling_gstNo}}</span></p>
                                        </div>
                                    </div>
                                    <hr />
                                    <!-- ================ Add on Services ============= -->
                                    <h5 class="fs-5 fw-bold mb-3">Add on Services</h5>
                                    @php
                                        $addOn = json_decode($data['details']->add_onService, true);
                                    @endphp
                                    @if($addOn['assuredLuggage'] == '1')
                                        <div class="form-check d-flex mb-2 align-items-lg-center">
                                            <label class="fs-6 form-check-label ms-0">
                                                Assured luggage space (either carrier or boot space) for Free
                                            </label>
                                        </div>
                                    @endif
                                    @if($addOn['isPet'] == '1')
                                        <div class="form-check mb-2  d-flex align-items-lg-center">
                                            <label class="fs-6 form-check-label ms-0">
                                                Pet Allowed for Rs. 300
                                            </label>
                                        </div>
                                    @endif

                                    <h5 class="fs-5 fw-bold my-4">Payment Mode</h5>

                                    <div class="form-check mb-2 d-flex align-items-lg-center">
                                        <label class="fs-6 form-check-label ms-0">
                                            @if($data['details']->payment_mode == '0')
                                                10% miminum amount of Booking.
                                            @elseif($data['details']->payment_mode == '1')
                                                Pay 100% amount of your booking.
                                            @else
                                                Pay later after Booking.
                                            @endif

                                        </label>
                                    </div>


                                </div>
                                <div class="col-1 text-center d-none d-lg-block">
                                    <div class="vr h-100"></div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class=" ">
                                        <h5 class="fs-5 fw-bold my-4 ">Travel Details</h5>

                                        <div class="row  ">
                                            <div class="col-6  ">
                                                <strong class="mb-2 d-block">
                                                    <img src=" https://cabyatra.com/public//web/assets/images/icons/car-icon.png"
                                                        alt="car icon" height="20" width="20" class="me-2">
                                                    Selected Car
                                                </strong>
                                                <p class=" fs-6">Innova Crysta,Xcent</p>
                                            </div>
                                            <div class="col-6  ">
                                                <strong class="mb-2 d-block">
                                                    <img src=" https://cabyatra.com/public//web/assets/images/icons/pickup-location.png"
                                                        alt="Pickup location" height="20" width="20" class="me-2">
                                                    Pick Up Location
                                                </strong>
                                                <p class=" fs-6">{{$data['details']->pickUpLoc}}</p>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <strong class="mb-2 d-block">
                                                    <img src=" https://cabyatra.com/public//web/assets/images/icons/date-icon.png"
                                                        alt="date iocn" height="20" width="20" class="me-2">

                                                    Traveling Date
                                                </strong>
                                                <p class=" fs-6">{{$data['details']->pickUp_date}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    @if($data['details']->coupon_id != NULL)
                                        <div class="row mt-3">
                                            <div class="col-6 col-md-6">
                                                <p class="fs-6"><strong>Used Coupon </strong><span>:</span> <span
                                                        class="text-capitalize">Welcome</span></p>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <p class="fs-6"><strong>Coupon Discount</strong><span>:</span> <span
                                                        class="text-capitalize">10%</span></p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 mt-3">
                                        <p class="fs-6"><strong>Total Fair(₹)</strong><span>:</span> <span
                                                class="text-capitalize btn btn-primary "><span
                                                    class="me-1">₹</span>{{$data['details']->total_faire}}</span></p>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- ========================== Details Section End =================== -->

                    @if(Session::has('success'))
                        <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- <div class="table-responsive pt-3">
                        <table class="table table-bordered">
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
                                    <td>{{$value->tour_pkgId}}</td>
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
                                        <a href="{{route('tourPackages.edit',$value->id)}}">
                                            <button type="button" class="btn btn-success">View</button>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection