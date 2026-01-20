@extends('Admin.common.layout')
@section('content')
@php
    $active = 'cab_booking';
@endphp

<style>
    select.confirm-select-box.form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
        color: #000;
        outline: 1px solid #000;
        background-repeat: no-repeat;
    }
</style>
@if(Session::has('success'))
    <div class=" alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{Session::get('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
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
                        <p class="fs-5"><strong>Order Date</strong> <span>:</span>
                            <span>{{ \Carbon\Carbon::parse($data['details']->created_at)->addHours(5)->addMinutes(30) }}</span>
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="fs-6"><strong>Type</strong> <span>:</span>
                            <span>{{$data['details']->type == '1' ? 'Out Station' : 'Local'}}</span>
                        </p>
                        <p class="fs-6"><strong>Sub Type</strong> <span>:</span>
                            <span>
                                @if($data['details']->subType == '0')
                                    Route Trip
                                @elseif($data['details']->subType == '1')
                                    One Way
                                @else
                                    Airport ({{$data['details']->is_airpotToFrom == '0' ? 'To Airport' : 'From Airport'}})
                                @endif
                            </span>
                        </p>
                        <p class="fs-6"><strong>Driver Name</strong> <span>:</span>
                            <span>{{isset($data['details']->driver) ? $data['details']->driver->name : '--'}}</span>
                        </p>
                        <p class="fs-6"><strong>Driver Number</strong> <span>:</span>
                            <span>{{isset($data['details']->driver) ? $data['details']->driver->phone : '--'}}</span>
                        </p>
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
                                        <p class="fs-6"><strong>Email ID</strong><span>:</span><span
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
                                @if(isset($addOn[0]))
                                    <div class="form-check d-flex mb-2 align-items-lg-center">
                                        <label class="fs-6 form-check-label ms-0">
                                            Assured luggage space (either carrier or boot space) for Free
                                        </label>
                                    </div>
                                @endif
                                @if(isset($addOn[1]))
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
                                            15% miminum amount of Booking.
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
                                    {{-- @dd($data['details']); --}}
                                    <div class="row  ">
                                        <div class="col-6  ">
                                            <strong class="mb-2 d-block">
                                                <img src=" https://cabyatra.com/public//web/assets/images/icons/car-icon.png"
                                                    alt="car icon" height="20" width="20" class="me-2">
                                                Selected Car Category
                                            </strong>
                                            <p class=" fs-6">{{$data['details']->carCategory->name}}</p>
                                        </div>
                                        @if($data['details']->pickUpLoc)
                                            <div class="col-6  ">
                                                <strong class="mb-2 d-block">
                                                    <img src=" https://cabyatra.com/public//web/assets/images/icons/pickup-location.png"
                                                        alt="Pickup location" height="20" width="20" class="me-2">
                                                    Pick Up Location
                                                </strong>
                                                <p class=" fs-6">
                                                    @if(empty($data['details']->pickUpLoc))
                                                            {{$data['details']->address}}
                                                        </p>
                                                    @endif

                                                @if(is_array(json_decode($data['details']->pickUpLoc)))
                                                    <ol>
                                                        @foreach(json_decode($data['details']->pickUpLoc) as $item)
                                                            <li>
                                                                {{$item}}
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                @endif
                                                @if((json_decode($data['details']->pickUpLoc)) == null)
                                                    {{$data['details']->pickUpLoc}}
                                                @endif
                                            </div>
                                        @endif
                                        @if($data['details']->destinationLoc && is_array(json_decode($data['details']->destinationLoc)))
                                            <div class="col-6 mt-3">
                                                <strong class="mb-2 d-block">
                                                    <img src=" https://cabyatra.com/public//web/assets/images/icons/pickup-location.png"
                                                        alt="Pickup location" height="20" width="20" class="me-2">Desination
                                                    Loc
                                                </strong>
                                                <p class=" fs-6">
                                                <ol>
                                                    @foreach(json_decode($data['details']->destinationLoc) as $desName)
                                                        <li>
                                                            {{$desName}}
                                                        </li>
                                                    @endforeach
                                                </ol>
                                                </p>
                                            </div>
                                        @else
                                            <div class="col-6 mt-3">
                                                <strong class="mb-2 d-block">
                                                    <img src=" https://cabyatra.com/public//web/assets/images/icons/pickup-location.png"
                                                        alt="Pickup location" height="20" width="20" class="me-2">Desination
                                                    Loc
                                                </strong>
                                                <p class=" fs-6">{{$data['details']->destinationLoc}}</p>
                                            </div>
                                        @endif
                                        <div class="col-6 mt-3">
                                            <strong class="mb-2 d-block">
                                                <img src=" https://cabyatra.com/public//web/assets/images/icons/date-icon.png"
                                                    alt="date iocn" height="20" width="20" class="me-2">

                                                Traveling Date
                                            </strong>
                                            <p class=" fs-6">{{$data['details']->pickUp_date}}</p>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <strong class="mb-2 d-block">
                                                <img src=" https://cabyatra.com/public//web/assets/images/icons/date-icon.png"
                                                    alt="date iocn" height="20" width="20" class="me-2">

                                                Traveling Time
                                            </strong>
                                            <p class=" fs-6">{{$data['details']->pickUp_time ?? '--'}}</p>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6 mt-3">
                                            <strong>Include K/M</strong>
                                            <p>{{$data['details']->include_km}}</p>
                                        </div>

                                        <div class="col-6 mt-3">
                                            <strong>Extra K/M</strong>
                                            <p>{{$data['details']->extra_fair_perKm}}</p>
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
                                <div class="col-12 mt-3 d-flex ">
                                    <p class="fs-6 mb-0"><strong>Total Fair(₹)</strong><span>:</span> <span
                                            class="text-capitalize btn btn-primary ">
                                            <span class="me-1">₹</span>{{$data['details']->total_faire}}</span><br>
                                        <span style="font-size:10px; margin-left:103px" class=" ">5% GST included This
                                            Fair</span></br>
                                    </p>
                                    <div class="d-flex justify-content-between ms-4">
                                        <ul>
                                            <li>Paid amount :
                                                {{number_format($data['details']->online_payment, 2, '.', ',')}}
                                            </li>
                                            <li>Running Balance :
                                                @if($data['details']->is_driver_createBooking == 1)
                                                    {{$data['details']->offline_payment + $data['details']->driver_comission}}
                                                @else
                                                    {{number_format($data['details']->offline_payment, 2, '.', ',')}}
                                                @endif
                                            </li>
                                        </ul>
                                        {{-- <span></span>
                                        <span>Running Balance : {{number_format($data['details']->offline_payment, 2,
                                            '.', ',')}}</span> --}}
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <!-- ========================== Details Section End =================== -->
            </div>
        </div>
    </div>
</div>
<!-------------------- change status form --------------------------->
<form action="{{route('statusUpate',['table'=>'cabBooking','id'=>$data['details']->id])}}" method="POST"
    id="changeStatusForm">
    @csrf
    <input type="hidden" id="status_val" name="status">
</form>
<!-------------------- change status form --------------------------->
<script>
    $(document).ready(function () {
    });
    function chnageStatus(id) {
        var status = $('#status').val();
        if (status == '' || status == undefined) {
            alert('PLease Select a option!');
        } else {
            console.log(id);
            console.log(status);

            $('#id').val(id);
            $('#status_val').val(status);
            $('#changeStatusForm').submit();
        }
    }
</script>
@endsection