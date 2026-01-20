@extends('web.layout.layout')
@section('content')

<style>
    .day.inactive>span {
        opacity: 0.5;
    }

    .calendar.show {
        /* display: block; */
    }

    .calendar {
        /* display: none; */
        background-color: white;
        padding: 10px;
        z-index: 10;
    }

    #preloader {
        height: 100vh;
        width: 100vw;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999999;
        background: #00000069;
        color: #ffff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ======================= */

    /* =========================== */
    .pick-info-form::before {
        content: "";
        position: absolute;
        width: 3px;
        height: 100%;
        background: #B0B0B0;
        top: 0px;
        left: 19px;
    }

    .pick-info-form li:first-child::before {
        background: #D47716;
        top: 0px;
        left: -29px;
        border-radius: 50%;

    }

    .pick-info-form li::before {
        position: absolute;
        content: "";
        width: 15px;
        height: 15px;
        bottom: 0px;
        left: -29px;
    }

    .pick-info-form li::before {
        background: #C51C1C;
        border-radius: 3px;
        bottom: 3px;
    }

    .pick-info-form li:last-child::before {
        background: #D47716;
        border-radius: 50%;
    }



    .date_and-time input[type="time"],
    .date_and-time input[type="date"] {
        width: 100%;
        padding: 3px;
        font-size: 16px;
        border: 1px solid #000;
        border-radius: 5px;
    }

    #timeInput {
        padding: 3px;
        border: 1px solid #000;

    }

    @media (max-width: 620px) {

        .margin-105 {
            margin-top: 72px;
        }

        .bg-green.w-50 {
            width: 100%;
        }

    }
</style>

@include('web.components.loader')
<section class="pt-0 pt-lg-3 py-3 margin-105">
    <div class="container">

        <div class="row mt-3 justify-content-between align-items-center">
            @if(isset($data['pickup']))
            <div class="col-12 col-lg-10">
                <h4 class="fs-13 mb-0  row flex-nowrap   pickup-destination">
                    @foreach($data['pickup'] as $key => $item)
                    <span
                        class="px-3 mb-2 mb-lg-0 text-wrap w-auto bg-green text-white py-1 d-flex align-items-center justify-content-center border border-ligth rounded-pill">
                        {{Illuminate\Support\Str::limit($item, 25)}}
                    </span>
                    @endforeach
                    <span class="w-auto px-0 text-wrap mb-2 mb-lg-0 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                            <path
                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                        </svg>
                    </span>
                    <span
                        class="border mb-2 text-wrap mb-lg-0 w-auto bg-green text-white px-3 py-1 d-flex align-items-center justify-content-center border-ligth rounded-pill">{{$data['destination']}}</span>
                </h4>

            </div>
            @endif
            <div class="col-12 col-lg-1 text-center text-lg-end">
                <h4 class="mb-0 fs-13 mobile-view-trip-type"><span class=" ">One way trip</span>
                </h4>
            </div>
        </div>
        <!-- ======================= Pick up time table section  ============== -->
        <div class="row mt-lg-3">
            <div class="col-12 ">
                <div class=" date_and-time" id="dateTimeSection">
                    <div class="container px-0 px-lg-3">

                        <div class="row mt-3 justify-content-between justify-content-lg-start">
                            <div class="col-12">
                                <label class=" fs-13"><span class="fs-16">Pick Up</span></label>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="input-container mt-0">
                                    <input type="date" class="form-control text-green  " id="selected-date">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="time-picker-container mt-0">
                                    <input type="time" id="timeInput"
                                        class="form-control  ms-auto me-lg-auto text-green bg-transparent" min="01:00"
                                        max="12:00" value="10:45">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calender Formate -->


    </div>
    <div class="container mt-lg-5 bg-green-light p-3 d-none calenderDiv" id="calenderDiv">
        <div class="row bg-white rounded  ">

            <div class="col-12">
                <!-- month name -->
                <!-- Custom Calendar -->
                <div class="calendar" id="custom-calendar">
                    <div class="month scrollbar py-2 overflow-x-scroll d-flex" id="months"></div>
                    <div class="dates" id="dates">
                        <div class="weekdays">
                        </div>
                        <div class="days scrollbar row gx-lg-4" id="days"></div>
                    </div>
                    <div id="customTimePicker" class="time-picker hidden">
                        <!-- Am/Pm Toggle -->
                        <label class="ampm-toggle my-3 rounded-pill">
                            <!--  disabled attr also supported  -->
                            <input type="checkbox" id="" name="" value="">
                            <span class="toggle-button selected" data-period="AM"></span>
                            <span class="toggle-off-txt" data-period="PM"></span>
                        </label>

                        <div class="time-options scrollbar py-2 d-flex overflow-x-scroll">
                            <span data-time="01:00">01:00</span>
                            <span data-time="02:00">02:00</span>
                            <span data-time="03:00">03:00</span>
                            <span data-time="04:00">04:00</span>
                            <span data-time="05:00">05:00</span>
                            <span data-time="06:00">06:00</span>
                            <span data-time="07:00">07:00</span>
                            <span data-time="08:00">08:00</span>
                            <span data-time="09:00">09:00</span>
                            <span data-time="10:00">10:00</span>
                            <span data-time="11:00" class="selected">11:00</span>
                            <span data-time="12:00">12:00</span>
                            <span data-time="13:00">13:00</span>
                            <span data-time="14:00">14:00</span>
                            <span data-time="15:00">15:00</span>
                            <span data-time="16:00">16:00</span>
                            <span data-time="17:00">17:00</span>
                            <span data-time="18:00">18:00</span>
                            <span data-time="19:00">19:00</span>
                            <span data-time="20:00">20:00</span>
                            <span data-time="21:00">21:00</span>
                            <span data-time="22:00">22:00</span>
                            <span data-time="23:00">23:00</span>
                            <span data-time="24:00">24:00</span>

                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn text-white mt-2 mx-auto rounded-pill bg-green"
                            id="btnSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!--  pakages Listing  -->
<section class="">
    <div class="container">
        <div class="row packages g-lg-5">
            @foreach($data['CarCategory'] as $key => $value)
            @php
            $array = json_decode($value->oneWayAirport->min_distance, true); // Ensure $array is an associative array
            $totalKm = $data['totalKm']; // Rename variable for clarity

            if (is_array($array)) {
            $collection = collect($array);

            $index = $collection->search(function ($item) use ($totalKm) {
            return $item > $totalKm;
            });

            $min_price = json_decode($value->oneWayAirport->min_fair, true);

            if ($index === false) {
            $fair = (int) $value->oneWayAirport->extra_fair_perKm * (int) $data['totalKm'];


            } else {
            $fair = $min_price[$index];
            }


            } else {
            // $fair = (int) $value->oneWayAirport->extra_fair_perKm * (int) $data['totalKm'];
            $fair = (int) $value->oneWayAirport->per_km_cost * (int) $data['totalKm'];
            // dd($value->oneWayAirport, $value->oneWayAirport->extra_fair_perKm, $data['totalKm']);
            }

            if (($value->oneWayAirport->is_fixed_price) && $value->oneWayAirport->is_fixed_price != 0) {
            $fair = $value->oneWayAirport->is_fixed_price;
            }

            if (!empty($value->oneWayAirport->off)) {
            $off_amt = ($fair * $value->oneWayAirport->off) / 100;
            $discount_fair = ($fair - $off_amt);
            } else {
            $discount_fair = $fair;
            }
            @endphp

            <div class="col-md-4 col-lg-3 dd mb-5">
                <div class="packages-box p-3 mx-auto position-relative">
                    @if(!empty($value->oneWayAirport->off))
                    <div class="offer-badge-img position-absolute ">
                        <img src="{{ env('ASSET_URL') }}assets/images/img/offer-badge.png" alt="offer-badge" width="100"
                            height="100" class="position-relative">
                        <p class="offer-value position-absolute top-50 start-50 translate-middle text-white">
                            <span>{{$value->oneWayAirport->off}}% <br><span>off</span></span>
                        </p>

                    </div>
                    @endif
                    <div class="car-img position-absolute start-50 translate-middle">
                        @if(!empty($value->car->image))
                        <img src="{{ $value->car->image}}" alt="car1" class="" width="200">
                        @else
                        <img src="{{ env('ASSET_URL') }}assets/images/img/car1.png" alt="car1" class="" width="200">
                        @endif
                    </div>
                    <div class="packages-text mt-5">
                        <h3 class="text-center">{{$value->car->name}}</h3>
                        <h5 class="mt-3  text-green text-center">{{$value->name}} (AC)</h5>
                        @if(!empty($value->oneWayAirport->off))
                        <h6 class="price text-danger mb-0 text-center mt-3 "
                            style="text-decoration-line: line-through; text-decoration-style: double;">₹ {{$fair}}</h6>
                        @endif
                        <h6 class="price text-green text-center mt-2">₹
                            {{$discount_fair}}
                        </h6>
                    </div>
                    <div class="package-details">
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Included Km</span>
                            <span class="text-green">{{$data['distanceKm']}}</span>
                        </p>
                        @if(!empty($value->oneWayAirport->extra_fair_for_showing) && $value->oneWayAirport->extra_fair_for_showing != '0')
                        <p class="d-flex justify-content-between align-items-center mb-1"><span>Extra fare/Km</span>
                            <span
                                class="text-green">{{!empty($value->oneWayAirport->extra_fair_for_showing) ? '₹' . $value->oneWayAirport->extra_fair_for_showing : 'excluded'}}</span>
                        </p>
                        @endif
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Toll</span>
                            <span class="text-green">Included</span>
                        </p>
                        @if(!empty($value->toll) && $value->toll != '0')
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>State-Tax</span>
                            <span class="text-green">Included</span>
                        </p>
                        @endif
                        @if(!empty($value->driver_charge) && $value->driver_charge != '0')
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Driver Charges</span>
                            <span class="text-green">Included</span>
                        </p>
                        @endif
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Parking</span>
                            <span class="text-green">Excluded, if applicable</span>
                        </p>
                    </div>
                    <p class="text-center mt-3"><a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                            data-bs-target="#otherdetails{{$value->id}}">Other Details</a></p>
                    <div class="text-center">
                        <button
                            class="btn bg-black text-white w-75 rounded-pill"
                            data-id="{{ $value->id }}"
                            onclick="bookMoadl({{ $value->id }}, {{ $discount_fair }}, '{{ $value->oneWayAirport->extra_fair_for_showing }}'); ">
                            Book Now
                        </button>

                    </div>
                    <div class="social-media-icon mt-3">
                        <ul class="nav justify-content-center">
                            <li class="me-3">
                                <a
                                    href="https://api.whatsapp.com/send/?phone=9911995523&text=Hello%20I%20Want%20Cab+&type=phone_number&app_absent=0">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/whatsapp.png"
                                        alt="whatsapp icon" height="30" width="30">
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="https://www.instagram.com/cabyatra/">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/insta.png" alt="instagram icon"
                                        height="30" width="30">
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="mailto:cabyatra6244@gmail.com">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/message.png" alt="message icon"
                                        class=" " height="30" width="30">
                                </a>
                            </li>
                            <li class="me-3">
                                <a href="#">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/facebook.png"
                                        alt="facebook icon" height="30" width="30">
                                </a>
                            </li>

                            <li class="me-3">
                                <a href="tel:+91 9911995523">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/call.png" alt="call icon"
                                        height="28" width="28">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ==================== other Details Modal ================== -->
<!-- Button trigger modal -->

<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " style="background-color: #E7E7E7;">
        <div class="modal-content">
            <div class="modal-header pb-1 d-block">
                <button type="button" class="btn-close position-absolute " data-bs-dismiss="modal" aria-label="Close"
                    style="top:10px; right:10px;"></button>
                <h6 class=" text-center text-uppercase">Oneway Trip</h6>
                <h6 class="fs-14   mb-2 mt-3 mb-0 d-flex">
                    <div>
                        <span class="text-uppercase text-white p-1 bg-green ">Date & Time
                            :</span> <span class="text-dark" id="departureDate">12/01/2025</span>@<span class="text-dark"
                            id="departureTime">07:35AM</span>
                    </div>
                    <!-- <a type="button" class="btn btn-success text-end" id="modifyBtn" style="padding: 0px;
                        padding-left: 3px;
                        padding-right: 2px;
                        padding-bottom: 1px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                    </a> -->
                </h6>
                <div id="modifyForm">
                    <form id="dateTimeModifyForm">
                        <div class="col-12">
                            <div class="d-flex sm-gap-2 flex-wrap">
                                <div class="col-lg-6 col-md-5 col-sm-6 sm-ms-5">
                                    <label class="fs-14 mb-2 ms-4">Edit Time</label>
                                    <input type="time" class="form-control rounded-pill" id="modifyTime" style="background-color: #ffc107;">
                                </div>
                                <div class="col-lg-6 col-md-5 col-sm-6">
                                    <label class="fs-14 mb-2 ms-4">Edit Date</label>
                                    <input type="date" class="form-control rounded-pill" id="modifyDate" style="background-color: #ffc107;">
                                </div>
                                <!-- <div class="col-12 col-md-2 d-flex align-items-end mx-lg-2 my-lg-2">
                                    <button type="button" class="btn btn-success w-100" id="updateDateTimeBtn">Update</button>
                                </div> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-body px-lg-5">
                <ul class="pick-info-form">
                    @foreach($data['pickup'] as $key => $pData2)
                    <li class="row align-items-center fs-14  ">
                        <div class="col-lg-3">
                            @if($key == 0)
                            <span class="text-truncate d-block" style="color:#D47716">Pick Up :
                                {{$pData2}}</span>
                            @else
                            <span class="text-truncate d-block" style="color:#C51C1C">Stop:
                                {{$pData2}}</span>
                            @endif
                        </div>
                        <div class="col-3"><input type="hidden"
                                class=" bg-transparent form-control border-0 text-green  "></div>
                    </li>
                    @endforeach
                    <li class="row align-items-center fs-14  ">
                        <div class="col-lg-3"> <span class="text-truncate d-block" style="color:#D47716">Drop:
                                {{$data['destination']}}</span> </div>
                        <div class="col-3">
                            <input type="hidden" class=" bg-transparent form-control border-0 text-green">
                        </div>
                    </li>
                </ul>

                <form action="{{route('cabBooking')}}" class="row g-3  fill-pic-info" method="POST"
                    id="outStationOneway">
                    @csrf
                    <input type="hidden" name="type" id="type" value="outstation">
                    <input type="hidden" name="subType" id="subType" value="oneway">
                    <input type="hidden" name="pickupLoc" id="pickupLoc" value="{{json_encode($data['pickup'])}}">
                    <input type="hidden" name="destination" id="destination" value="{{$data['destination']}}">
                    <input type="hidden" name="carCategorId" id="carCategorId">
                    <input type="hidden" name="travelDate" id="travel_Date">
                    <input type="hidden" name="travelTime" id="travel_Time">
                    <input type="hidden" name="razorpay_no" id="razorpay_no">
                    <input type="hidden" name="included_km" id="included_km" value="{{$data['distanceKm'] ?? '0'}}">
                    <input type="hidden" name="extra_fair_perKm" id="extra_fair_perKm"
                        value="{{$value->oneWayAirport->extra_fair_for_showing ?? ''}}">
                    <div class="col-12">
                        <input type="text" class="form-control  rounded-pill" placeholder="Enter Your Phone Number"
                            name="phone" id="phone">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control  rounded-pill" placeholder="Enter Your Name" name="name"
                            id="name">
                    </div>
                    <div class="col-12">
                        <input type="email" class="form-control  rounded-pill" placeholder="Enter Your Email Address"
                            name="email" id="email">
                    </div>

                    <div class="col-12">
                        <input type="text" class="form-control  rounded-pill" placeholder=" Enter Your Full Address"
                            name="address" id="address">
                    </div>

                    <div class="col-12">
                        <input type="text" class="form-control  rounded-pill" placeholder=" Enter Additional Detail's"
                            name="adDetail" id="adDetail">
                    </div>
                    <!-- ========= new Changes  -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent  p-0" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                    aria-controls="collapseOne">
                                    <h5 class="fs-14 mb-3 fw-bold">Have Coupon ?</h5>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse  "
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row coupon">
                                        <div class="col-8 col-md-6">
                                            <input type="text" class="form-control" id="formGroupExampleInput"
                                                placeholder="Enter Coupon Code" name="coupon_id">
                                        </div>
                                        <div class="col-4 col-md-4">
                                            <button class="btn  bg-green text-white">
                                                Apply
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent   p-0" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    <h5 class="fs-14 fw-bold mb-0">Billing Information</h5>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row coupon mt-3 gy-3">

                                        <div class="col-12 col-md-4">
                                            <input type="text" class="form-control " id="billingName"
                                                placeholder="Enter Name" name="biling_name">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <input type="text" class="form-control " id="billingGstNumber"
                                                placeholder="Enter GST Number" name="biling_gstNo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                    <!-- ================ Add on Services ============= -->
                    <h5 class="fs-14 fw-bold mt-2">Add on Services</h5>
                    <div class="form-check">
                        <input class="form-check-input border-dark" type="checkbox" value="assured_laugage"
                            id="flexCheckDefault" name="add_on_services[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            Assured luggage space (either carrier or boot space) for Free
                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input border-dark" type="checkbox" value="pet_allowed"
                            id="flexCheckChecked" name="add_on_services[]">
                        <label class="form-check-label" for="flexCheckChecked">
                            Pet Allowed for Rs. 300
                        </label>
                    </div>
                    <h5 class="fs-14 fw-bold">Payment Mode</h5>
                    <div class="form-check mt-1">
                        <input class="form-check-input border-dark" type="radio" name="payment_mode"
                            id="flexRadioDefault1" value="0" checked>
                        <label class="form-check-label fw-bold" for="flexRadioDefault1">
                            Pay 15% minimum amount of your booking. </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input border-dark" type="radio" name="payment_mode"
                            id="flexRadioDefault2" value="1">
                        <label class="form-check-label fw-bold" for="flexRadioDefault2">
                            Pay 100% amount of your booking. </label>
                    </div>
                    <input type="hidden" name="total_fair" id="total_fair">
                    <input type="hidden" name="total_fairs" id="updated_amt">
                    <button type="button" class="btn bg-green w-50 mx-auto text-white rounded-pill payNow">Pay ₹
                        <span id="totalFair">{{$discount_fair}}</span>
                    </button>

                    <span class="text-center fs-12 fw-bold">5% GST Included This Fair </span>



                    <p class="fs-12 text-center">We will send your booking details via SMS and Email.</p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal  -->
@foreach($data['CarCategory'] as $key => $value)
<div class="modal fade" id="otherdetails{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="background-color: #E7E7E7;">
        <div class="modal-content border-0 rounded-0">
            <div class="modal-header border-0 justify-content-center">
                <h5 class="modal-title fs-5 text-center" id="exampleModalLabel">Other Charges and Taxes</h5>
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body px-lg-5">{!! $value->oneWayAirport->other_details !!}</div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn bg-green w-50  text-white rounded-pill"
                    data-bs-dismiss="modal">okay</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- =================== Book modals End ================== -->


<!-- =================== Custom Calendar Script  ================== -->
<script>
    // Get current year, month, and date
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth(); // 0 = January
    const currentDay = currentDate.getDate();

    // Month names array
    const months = [
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
    ];

    // Weekday names array
    const weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    // Get elements
    const calendarIcon = document.getElementById("calendar-icon");
    const customCalendar = document.getElementById("custom-calendar");
    const monthsContainer = document.getElementById("months");
    const daysContainer = document.getElementById("days");
    const datesContainer = document.getElementById("dates");
    const selectedDateInput = document.getElementById("selected-date");
    const bookingDateInput = document.getElementById("travel_Date");
    const bookingTime = document.getElementById("travel_Time");
    const travelDate = document.getElementById("travelDate");
    const travelTime = document.getElementById("travelTime");

    // Variable to store the currently selected date (day and month)
    let selectedDate = null;

    // Generate months dynamically and highlight the current month
    months.forEach((month, index) => {
        const monthDiv = document.createElement("div");
        monthDiv.classList.add("month");
        monthDiv.innerText = month;
        monthDiv.setAttribute("data-month-index", index);

        // Highlight the current month
        if (index === currentMonth) {
            monthDiv.classList.add("active");
        }

        // When a month is clicked
        monthDiv.addEventListener("click", () => {
            // Remove the active class from all months
            document.querySelectorAll('.month').forEach(m => m.classList.remove("active"));
            monthDiv.classList.add("active"); // Add active class to clicked month

            showDates(index); // Show dates for the clicked month
        });

        monthsContainer.appendChild(monthDiv);
    });

    // Show calendar on icon click
    calendarIcon.addEventListener("click", () => {
        if (calenderDiv.classList.contains('d-none')) {
            $('.calenderDiv').removeClass('d-none');
        } else {
            $('.calenderDiv').addClass('d-none');
        }
        showDates(currentMonth);


    });

    function showDates(monthIndex) {
        daysContainer.innerHTML = "";

        const firstDay = new Date(currentYear, monthIndex, 1).getDay();
        const daysInMonth = new Date(currentYear, monthIndex + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            const blankDay = document.createElement("div");
            blankDay.classList.add("day");
            daysContainer.appendChild(blankDay);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayDiv = document.createElement("div");
            dayDiv.classList.add("day");
            dayDiv.innerHTML = `
                                                                                                                                                                                                                                                                                                                                                                                        <span>${day}</span>
                                                                                                                                                                                                                                                                                                                                                                                        <div class="day-name">${weekdays[new Date(currentYear, monthIndex, day).getDay()]}</div>
                                                                                                                                                                                                                                                                                                                                                                                    `;

            const isPastDate = new Date(currentYear, monthIndex, day) < new Date(currentYear, currentMonth, currentDay);

            if (isPastDate) {
                dayDiv.classList.add("d-none");
            } else {
                dayDiv.addEventListener("click", () => {
                    document.querySelectorAll(".day").forEach(d => d.classList.remove("active"));
                    dayDiv.classList.add("active");
                    selectDate(monthIndex, day);
                });
            }

            if (monthIndex === currentMonth && day === currentDay) {
                dayDiv.classList.add("active");
                selectDate(monthIndex, day);
            }

            daysContainer.appendChild(dayDiv);
        }
    }

    // Select a date and update input field
    function selectDate(monthIndex, day) {
        const formattedMonth = (monthIndex + 1).toString().padStart(2, '0'); // Format month as MM
        const formattedDay = day.toString().padStart(2, '0'); // Format day as DD
        const formattedDate = `${currentYear}-${formattedMonth}-${formattedDay}`; // YYYY-MM-DD

        selectedDateInput.value = formattedDate; // Set value in input field
        bookingDateInput.value = formattedDate;
        travelDate.value = formattedDate;
        $('#travel_Date').val(formattedDate);
        // Store the selected date
        selectedDate = {
            month: monthIndex,
            day: day
        };
    }
</script>

<script>
    // Array of IDs for the date input fields
    const dateInputIds = ["selected-date"]; // Add all your input IDs here

    // Function to set the current date in all inputs
    function setCurrentDate() {
        const currentDate = new Date();
        const formattedDate = currentDate.toISOString().split("T")[0];
        dateInputIds.forEach(id => {
            const dateInput = document.getElementById(id);
            if (dateInput) {
                dateInput.value = formattedDate;
                $('#travel_Date').val(formattedDate);
                $('#travelDate').val(formattedDate);
            }
        });
    }

    // Call the function to initialize the date fields
    setCurrentDate();
    // ==================================== Current time updating in input field =================================
    // Array of IDs for the time input fields
    const timeInputIds = ["timeInput"]; // Add all your input IDs here

    // Function to set the current time in all time inputs
    function setCurrentTime() {
        // Get the current time
        const currentDate = new Date();

        // Add 1 hour
        currentDate.setHours(currentDate.getHours() + 1);

        // Format the time to HH:MM (24-hour format)
        const formattedTime = currentDate.toTimeString().slice(0, 5); // "HH:MM"

        // Loop through each input ID and set the current time
        timeInputIds.forEach(id => {
            const timeInput = document.getElementById(id);
            if (timeInput) {
                timeInput.value = formattedTime;
                $('#travel_Time').val(formattedTime);
                $('#travelTime').val(formattedTime);
            }
        });
    }

    // Call the function to initialize the time fields
    setCurrentTime();
</script>
<!-- ============= Time Script ========== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timePicker = document.getElementById('customTimePicker');
        const timePickerButton = document.getElementById('timePickerButtons');
        const timeInput = document.getElementById('timeInput');

        // Toggle the custom time picker when clicking the button
        timePickerButton.addEventListener('click', () => {

            if (calenderDiv.classList.contains('d-none')) {
                $('.calenderDiv').removeClass('d-none');
            } else {
                $('.calenderDiv').addClass('d-none');
            }
            showDates(currentMonth);

        });

        // Add event listener to each time option
        document.querySelectorAll('.time-options span').forEach(function(span) {
            span.addEventListener('click', function() {
                let selectedTime = this.getAttribute('data-time');
                timeInput.value = selectedTime; // Set selected time
                bookingTime.value = selectedTime;
                travelTime.value = selectedTime;
                // Deselect all spans                
                document.querySelectorAll('.time-options span').forEach(function(span) {
                    span.classList.remove('selected');
                });

                // Select the clicked time
                this.classList.add('selected');
            });
        });

    });

    function bookMoadl(id, price, extr_fair) {
        var travelDate = $('#selected-date').val();
        var travelTime = $('#timeInput').val();

        if (travelDate == '' || travelDate == undefined || travelTime == '' || travelTime == undefined) {
            $('#bookModal').hide();
            Swal.fire({
                icon: "error",
                title: "Invalid Action",
                text: "Please Select Date and time first!",
            });
        } else {
            $('#travelDate').val(travelDate);
            $('#travelTime').val(travelTime);

            $('#departureDate').html(travelDate);
            $('#departureTime').html(travelTime);


            $('#bookModal').modal('show');

            // var price = (price*15)/100;

            var gst_amt = (price * 5) / 100;
            var with_gst_price = (price + gst_amt);
            with_gst_price = parseFloat(with_gst_price.toFixed(2));

            var with_gst_price = parseFloat((with_gst_price * 15) / 100).toFixed(2);

            $('#gst_amt').html(gst_amt);
            $('#totalFair').html(with_gst_price);

            $('#extra_fair_perKm').val(extr_fair);
            $('#total_fair').val(price);


            $('#carCategorId').val(id);
            $('#cng_price').html('Rs.' + price);
            $('#diesel_price').html('Rs.' + price + ' + 1000 Extra');
        }
    }

    $('.payNow').on("click", function() {
        try {
            var payment_mode = $('input[name="payment_mode"]:checked').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var mobile = $('#phone').val();
            var address = $('#address').val();
            var gstName = $('#biling_name').val();
            var gstNo = $('#biling_gstNo').val();
            var travelDate = $('#travel_Date').val();
            var travelTime = $('#travel_Time').val();
            var total_fair = $('#total_fair').val();
            var totalFair = $('#totalFair').html();

            console.log(name);
            console.log(email);
            console.log(mobile);
            console.log(travelDate);
            console.log(payment_mode);
            console.log(total_fair);
            console.log(totalFair);

            if ((name != '') && (email != '') && (mobile != '') && (travelDate != '') && (payment_mode != '') && (total_fair != '') && (address != '')) {
                totalFair = parseInt(totalFair);
                $('#preloader').show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('createRazorpayOrderId')}}",
                    method: "POST",
                    data: {
                        amount: totalFair,
                        // amount: 1,
                    },
                    beforeSend: function() {
                        // Show loader before the AJAX request is sent
                        $('.modal_loader_box').removeClass('d-none');
                    },
                    success: function(res) {
                        console.log(res);
                        // Show loader while waiting for Razorpay popup to open
                        $('.modal_loader_box').removeClass('d-none');

                        setTimeout(function() {
                            try {
                                var options = {
                                    "key": "rzp_live_0eAwBezccR23jF",
                                    "currency": "INR",
                                    "name": name,
                                    "email": email,
                                    "phone": mobile,
                                    "amount": totalFair * 100,
                                    // "amount": 1 * 100,
                                    "image": "https://cabyatra.com/public/admin/assets/images/admin_logo.png",
                                    "order_id": res.id,
                                    "handler": function(response) {
                                        $('.modal_loader_box').removeClass('d-none');
                                        console.log(response);
                                        $('#razorpay_no').val(response.razorpay_payment_id);
                                        $('#outStationOneway').submit();
                                    },
                                    "modal": {
                                        "ondismiss": function() {
                                            console.log("Payment popup closed by the user.");
                                            alert("Payment was not completed. Please try again.");
                                        }
                                    }
                                };
                                var rzp1 = new Razorpay(options);
                                // Open Razorpay popup after timeout
                                rzp1.open();

                                // Hide the loader once Razorpay popup is opened
                                $('.modal_loader_box').addClass('d-none');

                            } catch (razorpayError) {
                                $('.modal_loader_box').removeClass('d-none');
                                console.error("Error with Razorpay options or payment initiation:", razorpayError);
                                alert("Something went wrong while initiating the payment. Please try again.");
                            }
                        }, 300); // Small delay (300ms) to ensure loader shows up before Razorpay opens
                    },
                    error: function(xhr, status, error) {
                        $('.modal_loader_box').removeClass('d-none');
                        console.error("AJAX error:", error);
                        alert("Failed to create order. Please check your internet connection or try again later.");
                    },
                    complete: function() {
                        // Hide preloader after the request completes (either success or error)
                        $('#preloader').hide();
                    }
                });
            } else {
                alert('Please fill all the details!');
            }
        } catch (error) {
            console.error("Unexpected error:", error);
            alert("An unexpected error occurred. Please try again.");
        }
    });





    // ========================== Hide Calendar click on submit button ====================
    $('#btnSubmit').on("click", function() {
        var startDate = $('#selected-date').val();
        var time = $('#timeInput').val();

        if (startDate != '' && time != '') {
            $('#calenderDiv').addClass('d-none');
        } else {
            alert('please select  date ans time first!')
        }
    });

    $('input[name="add_on_services[]"]').on('change', function() {
        var total_fair = $('#total_fair').val();
        var final_price = fair_calculation(total_fair);

        $('#totalFair').html(final_price);
    });

    $('input[name="payment_mode"]').on('change', function() {
        var total_fair = $('#total_fair').val();
        var final_price = fair_calculation(total_fair);

        $('#totalFair').html(final_price.toFixed(2));
    });


    function fair_calculation(base_price) {
        console.log("base_price", base_price);
        var update_price = $('#updated_amt').val();
        var addOnServiceCharge = 0;
        var partial_amount = 0;

        $('input[name="add_on_services[]"]:checked').each(function() {
            if ($(this).val() === 'pet_allowed') {
                addOnServiceCharge = 300;
            }
        });
        console.log('addOnServiceCharge', addOnServiceCharge);
        var payment_mode = $('input[name="payment_mode"]:checked').val();

        var fairWithAllCharges = parseInt(base_price) + parseInt(addOnServiceCharge);
        console.log('fairWithAllCharges', fairWithAllCharges);
        var gst_amt = (parseInt(fairWithAllCharges) * 5) / 100;
        var final_price = parseInt(fairWithAllCharges) + parseInt(gst_amt);
        if (payment_mode == '0') {
            partial_amount = (parseInt(final_price) * 15) / 100;

            final_price = partial_amount;
        }

        $('#gst_amt').html(gst_amt);
        console.log(final_price);

        final_price = parseFloat(final_price.toFixed(2));
        return final_price;
    }


    if (document.readyState === 'loading') {
        // HTML is still loading
        console.log('Not loaded');
        //$('#preloader').removeClass('d-none');
    } else if (document.readyState === 'interactive' || document.readyState === 'complete') {
        // HTML is already loaded or fully loaded
        console.log('HTML is fully loaded');
        $('#preloader').addClass('d-none');
    }

    // ==================== Modify Date and Time Logic ====================
    document.addEventListener('DOMContentLoaded', function() {
        const modifyBtn = document.getElementById('modifyBtn');
        const modifyForm = document.getElementById('modifyForm');
        const updateDateTimeBtn = document.getElementById('updateDateTimeBtn');
        const modifyDate = document.getElementById('modifyDate');
        const modifyTime = document.getElementById('modifyTime');
        modifyDate.value = document.getElementById('travel_Date').value;
        modifyTime.value = document.getElementById('travel_Time').value;

        // Toggle modify form visibility
        if (modifyBtn) {
            modifyBtn.addEventListener('click', function(e) {
                e.preventDefault();

                if (modifyForm.classList.contains('d-none')) {
                    modifyForm.classList.remove('d-none');
                    // Pre-populate with current values
                    modifyDate.value = document.getElementById('travel_Date').value;
                    modifyTime.value = document.getElementById('travel_Time').value;
                    modifyBtn.textContent = 'Cancel';
                    modifyBtn.classList.add('btn-danger');
                    modifyBtn.classList.remove('btn-success');
                } else {
                    modifyForm.classList.add('d-none');
                    modifyBtn.textContent = 'edit';
                    modifyBtn.classList.remove('btn-danger');
                    modifyBtn.classList.add('btn-success');
                }
            });
        }

        // Update date and time when Update button is clicked
        if (modifyDate) {
            modifyDate.addEventListener('change', function(e) {
                e.preventDefault();

                const newDate = modifyDate.value;
                const newTime = modifyTime.value;

                if (newDate && newTime) {
                    // Format date for display (YYYY-MM-DD to a readable format)
                    const dateObj = new Date(newDate + 'T00:00:00');
                    const formattedDateDisplay = dateObj.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit'
                    });

                    // Update the display
                    document.getElementById('departureDate').textContent = formattedDateDisplay;
                    document.getElementById('departureTime').textContent = newTime;

                    // Update all hidden fields for date
                    document.getElementById('travel_Date').value = newDate;
                    $('#travel_Date').val(newDate);
                    $('#travelDate').val(newDate);
                    if (document.getElementById('travelDate')) {
                        document.getElementById('travelDate').value = newDate;
                    }

                    // Update all hidden fields for time
                    document.getElementById('travel_Time').value = newTime;
                    $('#travel_Time').val(newTime);
                    $('#travelTime').val(newTime);
                    if (document.getElementById('travelTime')) {
                        document.getElementById('travelTime').value = newTime;
                    }

                    // Hide the modify form
                    // modifyForm.classList.add('d-none');
                    modifyBtn.textContent = 'Modify';
                    modifyBtn.classList.remove('btn-danger');
                    modifyBtn.classList.add('btn-success');

                    // Show success message
                    Swal.fire({
                        icon: "success",
                        title: "Updated",
                        text: "Date and time updated successfully!",
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Invalid Input",
                        text: "Please select both date and time!",
                    });
                }
            });
        }
    });
</script>
@endsection