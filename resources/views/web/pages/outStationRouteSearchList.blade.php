@extends('web.layout.layout')
@section('content')

<style>
    * {
        user-select: none;
    }

    .calendar-icon {
        cursor: pointer;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .calendar-container {

        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }



    .month-bar {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: nowrap;
        margin-bottom: 20px;
    }

    .month {
        padding: 7px 15px;
        cursor: pointer;
        border-radius: 50px;
        width: 100%;
        text-align: center;
    }

    .month.active {
        background-color: #4caf50;
        color: white;
    }

    .date-grid {
        flex-wrap: nowrap;
        overflow-x: scroll;
        padding: 0 10px;
    }

    .date-cell {
        width: 40px;
        text-align: center;
        margin: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center
    }

    .date-cell>div:not(.day-name),
    .date-cell>div:not(.day-name) {

        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50px;
        text-align: center;
        margin: 5px;
        display: flex;
        cursor: pointer;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .selected>div:not(.day-name) {
        background-color: var(--color-green);
        color: #fff;
    }



    .in-range>div:not(.day-name) {
        background-color: var(--color-green);
        color: #fff;

    }

    .in-range>div:not(.day-name)::before {
        position: absolute;
        content: "";
        width: 50px;
        height: 3px;
        background-color: var(--color-green);
        top: 20px;
        left: -10px;
        z-index: -1;
    }

    .day-name {
        font-size: 12px;
        color: #555;
    }

    .range-line {
        position: absolute;
        top: 50%;
        height: 4px;
        background-color: var(--color-green);
        z-index: -1;
        width: 100%;
    }

    .time-selector {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .time-box {
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        border: 1px solid #ddd;
    }

    .time-box.selected {
        background-color: var(--color-green);
    }

    .date-inputs {
        margin-bottom: 10px;
    }

    input[type="date"],
    input[type="time"] {
        margin-right: 10px;
    }

    .time-options span.selected {
        background-color: var(--color-green);
        color: #fff;
        border: none;
        font-size: 15px;
        border-radius: 50px;
    }

    #difference:empty {
        display: none !important;
    }

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

    @media (max-width: 620px) {
        .margin-105 {
            margin-top: 72px;
        }

        .bg-green.w-50 {
            width: 100%;
        }

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
</style>


<section class="pt-0 py-3 margin-105">
    <div class="container">

        <div class="row mt-3 justify-content-between align-items-center">
            @if(isset($data['pickup']))
            <div class="col-12">
                <h4 class="fs-13 mb-0  row flex-nowrap   pickup-destination">
                    <span
                        class="px-3 mb-2 mb-lg-0 text-wrap w-auto bg-green text-white py-1 d-flex align-items-center justify-content-center border border-ligth rounded-pill text-truncate ">
                        {{$data['pickup']}}
                    </span>
                    <span class="w-auto px-0 mb-2 text-wrap mb-lg-0 d-flex align-items-center justify-content-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                            <path
                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                        </svg>

                    </span>
                    @foreach($data['destination'] as $key => $desName)
                    @if($key != '0')
                    <span class="w-auto px-0 mb-2 text-wrap mb-lg-0 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                            <path
                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                        </svg>

                    </span>
                    @endif
                    <span
                        class="border mb-2 mb-lg-0 text-wrap w-auto bg-green text-white px-3 py-1 d-flex align-items-center justify-content-center border-ligth rounded-pill">
                        {{$desName}}
                    </span>
                    @endforeach
                </h4>

            </div>
            @endif
            <div
                class="col-12 d-flex align-items-center mobile-view-trip-type justify-content-center text-center justify-content-lg-end">
                @if(isset($data['days_difference']))
                <span class="bg-green   text-white px-lg-4 p-2 ms-lg-5 me-3 fs-13 py-1 rounded-pill"
                    id="difference">{{$data['days_difference']}} days</span>
                @else
                <span class="bg-green   text-white px-lg-4 p-2 ms-lg-5 me-3 fs-13 py-1 rounded-pill" id="difference">1
                    days</span>
                @endif
                <h4 class="mb-0 fs-13"><span class=" ">Round-Trip</span>
                </h4>
            </div>

        </div>

        <!-- ======================= Pick up time table section  ============== -->
        <div class="row mt-lg-3">
            <div class="col-12 ">
                <div class=" date_and-time">
                    <div class="container px-0 px-lg-3">

                        <div class="row">
                            <div class="col-6 border-end border-3 border-green">
                                <div class="py-3 ">

                                    <div class="container">
                                        <h4 class="  fs-13"><span class="fs-16">Start Date</span>
                                        </h4>
                                        <div class="row gy-3 justify-content-between justify-content-lg-start">
                                            <div class="col-12 ">
                                                <div class="input-container mt-0 ">
                                                    @if(isset($data['filteredStartDate']))
                                                    <input type="date"
                                                        class="form-control  ms-auto me-lg-auto text-green "
                                                        id="start-date" value="{{$data['filteredStartDate']}}">
                                                    @else
                                                    <input type="date"
                                                        class="form-control  ms-auto me-lg-auto text-green "
                                                        id="start-date">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="time-picker-container mt-0">
                                                    <input type="time" id="timeInput"
                                                        class="form-control  ms-auto me-lg-auto text-green bg-transparent"
                                                        min="01:00" max="12:00" value="10:45">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- calender Formate -->
                            <div class="col-6">
                                <div class="py-3">

                                    <div class="container">
                                        <h4 class="  fs-13"><span class="fs-16">Return Date</span>
                                        </h4>
                                        <div class=" gy-3 row justify-content-between justify-content-lg-start">
                                            <div class="col-12  ">
                                                <div class="input-container mt-0 ">
                                                    @if(isset($data['filteredEndDate']))
                                                    <input type="date"
                                                        class="form-control  ms-auto me-lg-auto text-green bg-transparent"
                                                        id="end-date" value="{{$data['filteredEndDate']}}">
                                                    @else
                                                    <input type="date"
                                                        class="form-control  ms-auto me-lg-auto text-green bg-transparent"
                                                        id="end-date">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12  ">
                                                <div class="time-picker-container mt-0">
                                                    <input type="time"
                                                        class="form-control  ms-auto me-lg-auto text-green bg-transparent"
                                                        min="01:00" max="24:00" value="23:59" id="timeInput1">
                                                    <!-- <span>PM</span> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calender Formate -->


    </div>
    <div class="container mt-5 bg-green-light p-3 calenderDiv d-none" id="calenderDiv">
        <div class="row round-trip calender bg-white rounded ">
            <div class="col-12">
                <div class="calendar-container overflow-x-hidden w-100" id="calendar-container">
                    <div class="month-bar scrollbar  overflow-x-scroll w-100 py-2" id="month-bar">
                        <!-- Month buttons will be generated dynamically here -->
                    </div>
                    <div class="overflow-x-hidden w-100">
                        <div class="date-grid scrollbar w-100 row gx-lg-4 " id="date-grid">
                            <!-- Dates and day names will be generated dynamically here -->
                        </div>
                    </div>
                    <div id="customTimePicker" class="time-picker ">
                        <!-- Am/Pm Toggle -->
                        <label class="ampm-toggle my-3 rounded-pill">
                            <!--  disabled attr also supported  -->
                            <input type="checkbox" id="" name="" value="">
                            <span class="toggle-button selected" data-period="AM"></span>
                            <span class="toggle-off-txt" data-period="PM"></span>
                        </label>
                        <!-- ========== tiem section ================ -->
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
                        <button type="submit" class="btn text-white my-2 mx-auto rounded-pill bg-green"
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
            $fair = ((int) $value->per_km_cost * (int) $data['totalKm']);
            if (!empty($value->off)) {
            $off_amt = ($fair * $value->off) / 100;
            $discount_fair = ($fair - $off_amt);
            } else {
            $discount_fair = $fair;
            }
            @endphp
            <div class="col-md-4 col-lg-3 dd mb-5">
                <div class="packages-box p-3 mx-auto position-relative">
                    <div class="offer-badge-img position-absolute ">
                        <img src="{{ env('ASSET_URL') }}assets/images/img/offer-badge.png" alt="offer-badge" width="100"
                            height="100" class="position-relative">
                        <p class="offer-value position-absolute top-50 start-50 translate-middle text-white">
                            <span>{{$value->off}}% <br><span>off</span></span>
                        </p>

                    </div>
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
                        @if(!empty($value->off))
                        <h6 class="price text-danger mb-0 text-center mt-3 "
                            style="text-decoration-line: line-through; text-decoration-style: double;">₹
                            {{(int) $value->per_km_cost * (int) $data['totalKm']}}
                        </h6>
                        @endif
                        <h6 class="price text-green text-center mt-2">₹
                            {{$discount_fair}}
                        </h6>
                    </div>
                    <div class="package-details">
                        <p class="d-flex justify-content-between align-items-center mb-1"><span>Included Km</span>
                            <span class="text-green total_distance">{{$data['distanceKm']}}</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center mb-1"><span>Extra fare/Km</span>
                            <span
                                class="text-green">{{!empty($value->extra_fair_perKm) ? '₹' . $value->extra_fair_perKm : 'included'}}</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center mb-1"><span>Toll</span>
                            <span class="text-green">Excluded</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center mb-1"><span>State Tax</span>
                            <span class="text-green">Excluded</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center mb-1"><span>Driver Charge</span>
                            <span class="text-green">Included</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center mb-1"><span>Parking</span>
                            <span class="text-green">Excluded,if applicable</span>
                        </p>
                    </div>
                    <p class="text-center mt-3"><a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                            data-bs-target="#otherdetails{{$value->id}}">Other Details</a></p>
                    <div class="text-center">
                        <button class="btn bg-black text-white w-75 rounded-pill"
                            onclick="bookMoadl({{$value->id}},{{$discount_fair}},'{{$value->extra_fair_perKm}}')"
                            data-id="{{$value->id}}">Book
                            Now</button>

                    </div>
                    <div class="social-media-icon mt-3">
                        <ul class="nav justify-content-around">
                            <li>
                                <a
                                    href="https://api.whatsapp.com/send/?phone=9911995523&text=Hello%20I%20Want%20Cab+&type=phone_number&app_absent=0">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/whatsapp.png"
                                        alt="whatsapp icon" height="30" width="30">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/cabyatra/">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/insta.png" alt="instagram icon"
                                        height="30" width="30">
                                </a>
                            </li>
                            <li>
                                <a href="mailto:cabyatra6244@gmail.com">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/message.png" alt="message icon"
                                        class=" " height="30" width="30">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ env('ASSET_URL') }}assets/images/icons/facebook.png"
                                        alt="facebook icon" height="30" width="30">
                                </a>
                            </li>

                            <li>
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
            <div class="modal-header d-block">
                <button type="button" class="btn-close position-absolute " data-bs-dismiss="modal" aria-label="Close"
                    style="top:10px; right:10px;"></button>
                <h6 class=" text-center text-uppercase">Round Trip</h6>
                <h6 class="fs-14   mb-2 mt-3 mb-0"><span class="text-uppercase text-white p-1 bg-green ">Departure
                        :</span> <span class="text-dark departureDate">12/01/2025</span>@
                    @if(isset($data['filteredStartTime']))
                    <span class="text-dark departureTime">{{$data['filteredStartTime']}}</span>
                    @else
                    <span class="text-dark departureTime">07:35AM</span>
                    @endif
                </h6>
                <h6 class="fs-14   mb-2 mt-3 mb-0"><span class="text-uppercase text-white p-1 bg-green">Return :</span>
                    <span class="text-dark returnDate">{{$data['filteredEndDate'] ?? ''}}</span>@<span class="text-dark">11:59PM</span>
                </h6>

                <div id="modifyForm">
                    <form id="dateTimeModifyForm">
                        <div class="col-12">
                            <div class="d-flex sm-gap-2 flex-wrap">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="col-lg-6 col-md-5 col-sm-6 sm-ms-5">
                                        <label class="fs-14 mb-2 ms-4">Edit Departure Time</label>
                                        <input type="time" class="form-control rounded-pill startTimrPopup" id="modifyTime" style="background-color: #ffc107;" value="10:00">
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-sm-6">
                                        <label class="fs-14 mb-2 ms-4">Edit Departure Date</label>
                                        <input type="date" class="form-control rounded-pill departureDatePopup" id="departureDatePopup" style="background-color: #ffc107;">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="col-lg-6 col-md-5 col-sm-6 sm-ms-5">
                                        <label class="fs-14 mb-2 ms-4">Edit Return Time</label>
                                        <input type="time" class="form-control rounded-pill" id="" style="background-color: #ffc107;" value="23:59">
                                    </div>
                                    <div class="col-lg-6 col-md-5 col-sm-6">
                                        <label class="fs-14 mb-2 ms-4 returnDate">Edit Return Date</label>
                                        <input type="date" class="form-control rounded-pill returnDatePopup" id="returnDatePopup" style="background-color: #ffc107;">
                                    </div>
                                </div>
                                <!-- <div class="col-12 col-md-2 d-flex align-items-end mt-2">
                                    <button type="button" class="btn btn-success w-100" id="updateDateTimeBtn">Update</button>
                                </div> -->
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-body px-lg-5">
                <ul class="pick-info-form">
                    <li class="row align-items-center fs-14 ">
                        <div class="col-lg-3 col-5">
                            <span class="text-truncate d-block" style="color: #D47716;">Pickup: {{$data['pickup']}}
                            </span>
                        </div>
                    </li>

                    @php
                    $count = count($data['destination']);
                    @endphp
                    @foreach($data['destination'] as $key => $Dname)
                    @if($count == ($key + 1))
                    <li class="row align-items-center fs-14  ">
                        <div class="col-lg-3">
                            <span class="text-truncate d-block" style="color:#D47716">Drop:
                                {{$Dname}},</span>
                        </div>
                        <div class="col-3">
                            <input type="hidden" class=" bg-transparent form-control border-0 text-green">
                        </div>
                    </li>
                    @else
                    <li class="row align-items-center fs-14  ">
                        <div class="col-lg-3">
                            <span class="text-truncate d-block" style="color:#C51C1C">Stop:
                                {{$Dname}},</span>
                        </div>
                        <div class="col-3"><input type="hidden"
                                class=" bg-transparent form-control border-0 text-green  "></div>
                    </li>
                    @endif
                    @endforeach
                </ul>

                <form action="{{route('outStationRouteBooking')}}" class="row g-3  fill-pic-info" method="POST"
                    id="outStationRouteTripForm">
                    @csrf
                    <input type="hidden" name="type" id="type" value="outstation">
                    <input type="hidden" name="subType" id="subType" value="route">
                    <input type="hidden" name="pickupLoc" id="pickupLoc" value="{{$data['pickup']}}">
                    <input type="hidden" name="destination" id="destination"
                        value="{{json_encode($data['destination'])}}">
                    <input type="hidden" name="carCategorId" id="carCategorId">
                    <input type="hidden" name="bookingDate" id="start_travel_Date">
                    <input type="hidden" name="endBookingDate" id="end_travel_Date">
                    <input type="hidden" name="bookingTime" id="travel_Time">
                    <input type="hidden" name="razorpay_paymentId" id="razorpay_paymentId">
                    <input type="hidden" name="included_km" id="included_km" value="{{$data['distanceKm'] ?? '0'}}">
                    <input type="hidden" name="extra_fair_perKm" id="extra_fair_perKm"
                        value="{{$value->extra_fair_perKm ?? ''}}">
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
                    <!-- ==================== Fule type container ====================== -->
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
                                            <button class="btn  bg-green text-white" type="button"> Apply </button>
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
                                    <h5 class="fs-14 fw-bold">Billing Information</h5>
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
                    <h5 class="fs-14 fw-bold">Add on Services</h5>
                    <div class="form-check">
                        <input class="form-check-input border-dark" type="checkbox" value="assured_laugage"
                            id="flexCheckDefault" name="add_on_services[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            Get carrier and boot space in car for free

                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input border-dark" type="checkbox" value="pet_allowed"
                            id="flexCheckChecked" name="add_on_services[]">
                        <label class="form-check-label " for="flexCheckChecked">
                            Pet Allowed for Rs. 300
                        </label>
                    </div>
                    <h5 class="fs-14 fw-bold">Payment Mode</h5>
                    <div class="form-check mt-1">
                        <input class="form-check-input border-dark" type="radio" name="payment_mode"
                            id="flexRadioDefault1" value="0" checked>
                        <label class="form-check-label fw-bold" for="flexRadioDefault1">
                            Pay 15% amount & book your cab. </label>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input border-dark " type="radio" name="payment_mode"
                            id="flexRadioDefault2" value="1">
                        <label class="form-check-label fw-bold" for="flexRadioDefault2">
                            Pay 100% amount & book your cab. </label>
                    </div>
                    <input type="hidden" name="total_fair" id="total_fair">
                    <input type="hidden" name="updated_amt" id="updated_amt">
                    <button type="button" class="btn bg-green w-50  mx-auto text-white rounded-pill payNow">Pay ₹<span
                            id="totalFair">
                            {{$discount_fair}}</span>
                        <!-- <span>/Inc.Gst</span> -->
                    </button>
                    <span class="text-center fs-12 fw-bold">5% GST Included This Fair
                        <!--₹<span id="gst_amt"> 50</span>--></span>
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
            <div class="modal-body px-lg-5">{!! $value->other_details !!}</div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn bg-green w-50  text-white rounded-pill"
                    data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- =================== Book modals End ================== -->

<!-----------------------  Date filter form ---------------------------->
<form action="{{route('outStationRoutesearch')}}" method="POST" id="hiddenDateFilterForm">
    @csrf
    <input type="hidden" name="pickUpLoc" id="pickupLoc" value="{{$data['pickup']}}">
    <input type="hidden" name="destination" id="destination" value="{{json_encode($data['destination'])}}">
    <input type="hidden" name="datFIlterdDistance" id="datFIlterdDistance">
    <input type="hidden" name="filter_request" id="filter_request" value="Yes">
    <input type="hidden" name="filteredStartDate" id="filteredStartDate">
    <input type="hidden" name="filteredEndDate" id="filteredEndDate">
    <input type="hidden" name="filteredStartTime" id="filteredStartTime">
    <input type="hidden" name="totalDistance" id="totalDistance">
</form>
<script>
    let data = @json($data);
    console.log(data);

    // // Use the parent elements to access the input fields
    // const startDateInput = document.getElementById('start-date');
    // const endDateInput = document.getElementById('end-date');

    // Result display element
    const differenceDisplay = document.getElementById('difference');
</script>
<script>
    const calendarContainer = document.getElementById('calendar-container');
    const calendarIcons = document.querySelectorAll('.calendars'); // Select all triggers by class
    const monthBar = document.getElementById('month-bar');
    const dateGrid = document.getElementById('date-grid');
    const startDateInput = document.getElementById('start-date');
    const endDateInput = document.getElementById('end-date');
    const startTimeInput = document.getElementById('start-time');
    const endTimeInput = document.getElementById('end-time');
    const dateCountDisplay = document.getElementById('date-count'); // Element to display date count


    const departureDate = document.querySelector('.departureDate');
    const departureTime = document.querySelector('.departureTime');
    const returnDate = document.getElementById('returnDateDrop');

    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    const dayNames = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];

    let selectedMonth = new Date().getMonth();
    let selectedStartDate = null;
    let selectedEndDate = null;

    // Add click event listeners to all calendar icons
    calendarIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            if (calenderDiv.classList.contains('d-none')) {
                $('.calenderDiv').removeClass('d-none');
            } else {
                $('.calenderDiv').addClass('d-none');
            }

            // Show current month’s dates when calendar is opened
            generateDates(selectedMonth);
        });
    });

    // Generate months bar dynamically
    function generateMonths() {
        months.forEach((month, index) => {
            const monthDiv = document.createElement('div');
            monthDiv.classList.add('month');
            monthDiv.innerText = month;
            monthDiv.addEventListener('click', () => selectMonth(index));
            if (index === selectedMonth) {
                monthDiv.classList.add('active');
            }
            monthBar.appendChild(monthDiv);
        });
    }

    // Generate date cells dynamically
    function generateDates(monthIndex) {
        dateGrid.innerHTML = '';
        const year = new Date().getFullYear();
        const daysInMonth = new Date(year, monthIndex + 1, 0).getDate();
        const today = new Date();

        for (let day = 1; day <= daysInMonth; day++) {
            const dateCell = document.createElement('div');
            dateCell.classList.add('date-cell');

            const date = new Date(year, monthIndex, day);
            const dayOfWeek = date.getDay();

            const dayNumber = document.createElement('div');
            dayNumber.innerText = day;

            const dayName = document.createElement('div');
            dayName.innerText = dayNames[dayOfWeek];
            dayName.classList.add('day-name');

            dateCell.appendChild(dayNumber);
            dateCell.appendChild(dayName);
            // =========== inactive past date only select current date or future date
            if (date < today.setHours(0, 0, 0, 0)) {
                dateCell.style.pointerEvents = 'none';
                dateCell.style.opacity = '0.8';
            } else {
                dateCell.addEventListener('click', () => selectDate(date));
            }

            if (selectedStartDate && isSameDate(date, selectedStartDate)) {
                dateCell.classList.add('selected');
            }
            if (selectedEndDate && isSameDate(date, selectedEndDate)) {
                dateCell.classList.add('in-range');
            }
            if (selectedStartDate && selectedEndDate && date > selectedStartDate && date < selectedEndDate) {
                dateCell.classList.add('in-range');
            }

            dateGrid.appendChild(dateCell);
        }
    }

    // Select month
    function selectMonth(monthIndex) {
        selectedMonth = monthIndex;
        document.querySelectorAll('.month').forEach((month, index) => {
            month.classList.toggle('active', index === monthIndex);
        });
        generateDates(monthIndex);
    }

    // Calculate the difference in days between two dates
    function calculateDateCount(start, end) {
        if (!start || !end) return 0; // Return 0 if either date is missing
        const msPerDay = 24 * 60 * 60 * 1000; // Milliseconds in a day
        return Math.ceil((end - start) / msPerDay) + 1; // Include both start and end dates
    }

    // Update the selected date and display the count
    function selectDate(date) {
        if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
            selectedStartDate = date;
            selectedEndDate = null;
            startDateInput.value = formatDate(date);
            endDateInput.value = '';
        } else if (date > selectedStartDate) {
            selectedEndDate = date;
            endDateInput.value = formatDate(date);
        } else {
            selectedStartDate = date;
            startDateInput.value = formatDate(date);
        }

        // Calculate and display the number of selected days
        const dateCount = calculateDateCount(selectedStartDate, selectedEndDate);
        dateCountDisplay.innerText = `${dateCount} Days`;

        generateDates(selectedMonth); // Refresh the calendar UI
    }

    // Check if two dates are the same
    function isSameDate(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getDate() === date2.getDate();
    }

    // Format date as 'YYYY-MM-DD'
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${day}-${month}-${year}`;
    }

    // Initialize calendar
    generateMonths();
    generateDates(selectedMonth);
</script>
<script>
    // Array of IDs for the date input fields
    const dateInputIds = ["start-date", "end-date"]; // Add all your input IDs here

    // Function to set the current date in all inputs
    function setCurrentDate() {
        // Get the current date
        const currentDate = new Date();

        // Format the date to YYYY-MM-DD
        const formattedDate = currentDate.toISOString().split("T")[0];

        // Loop through each input ID and set the current date
        dateInputIds.forEach(id => {
            const dateInput = document.getElementById(id);
            if (dateInput) {
                dateInput.value = formattedDate;
            }
        });
    }

    // Call the function to initialize the date fields
    if (typeof data['filteredStartDate'] === 'undefined' || !data['filteredStartDate']) {
        setCurrentDate();
    }

    //  Set Current time in input field Bydefault ==============
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
        const updateDateTimeBtn = document.getElementById('updateDateTimeBtn');

        // Toggle the custom time picker when clicking the button
        timePickerButton.addEventListener('click', () => {
            if (calenderDiv.classList.contains('d-none')) {
                $('.calenderDiv').removeClass('d-none');
            } else {
                $('.calenderDiv').addClass('d-none');
            }
        });

        // Add event listener to each time option
        document.querySelectorAll('.time-options span').forEach(function(span) {
            span.addEventListener('click', function() {
                let selectedTime = this.getAttribute('data-time');
                timeInput.value = selectedTime; // Set selected time

                // Deselect all spans                
                document.querySelectorAll('.time-options span').forEach(function(span) {
                    span.classList.remove('selected');
                });

                // Select the clicked time
                this.classList.add('selected');
            });
        });

    });

    function bookMoadl(id, price, extra_fairPerKm) {
        console.log(price);
        var startTravelDate = $('#start-date').val();
        var endTravelDate = $('#end-date').val();
        var travelTime = $('#timeInput').val();
        if ((startTravelDate == '') || (startTravelDate == undefined) || (endTravelDate == '') || (endTravelDate == undefined) || (travelTime == '') || (travelTime == undefined)) {
            Swal.fire({
                icon: "error",
                title: "Invalid DateTime",
                text: "Please Select Date Time!",
            });
        } else {
            console.log(startTravelDate);
            $('.departureDate').html(startTravelDate);

            $('.departureDatePopup').val(startTravelDate);
            $('.returnDatePopup').val(endTravelDate);

            $('.departureTime').html(travelTime);
            $('#start_travelDate').val(startTravelDate);
            $('#end_travelDate').val(endTravelDate);
            $('#travelTime').val(travelTime);

            $('#start_travel_Date').val(startTravelDate);
            $('#end_travel_Date').val(endTravelDate);
            $('#travel_Time').val(travelTime);
            $('#extra_fair_perKm').val(extra_fairPerKm);


            var gst_amt = (price * 5) / 100;
            var with_gst_price = (price + gst_amt);
            with_gst_price = parseFloat(with_gst_price.toFixed(2));

            var with_gst_price = parseFloat((with_gst_price * 15) / 100).toFixed(2);
            console.log(price);
            console.log(with_gst_price);

            $('#bookModal').modal('show');
            $('#gst_amt').html(gst_amt);

            $('#totalFair').html(with_gst_price);
            $('#total_fair').val(price);
            $('#carCategorId').val(id);
        }
    }

    $('.payNow').on("click", function() {
        var payment_mode = $('input[name="payment_mode"]:checked').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#phone').val();
        var address = $('#address').val();
        var travelDate = $('#start_travelDate').val();
        var travelTime = $('#timeInput').val();
        var totalFair = $('#totalFair').html();

        console.log(travelDate);
        console.log(travelTime);

        if ((name != '') && (email != '') && (mobile != '') && (travelDate != '') && (payment_mode != '')) {
            totalFair = parseInt(totalFair);

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
                },
                success: function(res) {
                    var options = {
                        "key": "rzp_live_0eAwBezccR23jF",
                        "currency": "INR",
                        "name": name,
                        "email": email,
                        "phone": mobile,
                        "amount": totalFair * 100,
                        "image": "https://cabyatra.com/public/admin/assets/images/admin_logo.png",
                        "order_id": res.id,
                        "handler": function(response) {
                            console.log(response);
                            $('#razorpay_paymentId').val(response.razorpay_payment_id);
                            $('#outStationRouteTripForm').submit();
                        },
                        "modal": {
                            "ondismiss": function() {
                                console.log("Payment popup closed by the user.");
                                alert("Payment was not completed. Please try again.");
                            }
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            });
        } else {
            alert('Please FilL all the details!');
        }
    });

    // ========================== Hide Calendar click on submit button ====================
    $('#btnSubmit').on("click", function() {
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();
        var time = $('#timeInput').val();

        const parts = startDate.split("-");
        const formattedDate = `${parts[2]}-${parts[1]}-${parts[0]}`; // yyyy-mm-dd

        // Set the value to the input field
        document.getElementById("travelDate").value = formattedDate;

        console.log(startDate);
        $('#travelTime').val(time);
        $('#travel_Time').val(time);
        $('.travelDate').val(formattedDate);
        $('#start_travel_Date').val(formattedDate);

        if (startDate != '' && time != '' && endDate !== '') {
            $('.calenderDiv').addClass('d-none');
        } else {
            alert('please select  date ans time first!')
        }
    });

    $('input[name="add_on_services[]"]').on('change', function() {
        var totalFair = parseInt($('#total_fair').val()); // Original fare
        var final_price = fair_calculation(totalFair);
        $('#totalFair').html(final_price);
        $('#updated_amt').val(final_price);
    });


    $('#start-date').on("change", function() {
        var currentDate = new Date();
        var start_date = $('#start-date').val();

        var startDateObj = new Date(start_date);
        var currentDateOnly = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        var currentDateFormatted = currentDate.toISOString().split('T')[0];
        if (startDateObj < currentDateOnly) {
            Swal.fire({
                icon: "error",
                title: "Invalid Date Time",
                text: "Please Select Valid Date!",
            });
            $('#start-date').val(currentDateFormatted);
        }
    });

    $('#end-date').on("change", function() {
        var currentDate = new Date();
        var start_date = $('#start-date').val();
        var end_date = $('#end-date').val();
        var timeInput = $('#timeInput').val();
        var total_distance = $('.total_distance').html();

        var startDateObj = new Date(end_date);
        var currentDateOnly = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        var currentDateFormatted = currentDate.toISOString().split('T')[0];
        if (startDateObj < currentDateOnly || start_date > end_date) {
            Swal.fire({
                icon: "error",
                title: "Invalid Date Time",
                text: "Please Select Valid Date!",
            });
            $('#end-date').val(start_date);
        }

        var difference = getDateDifference(start_date, end_date);

        if (startDateObj > currentDateOnly && start_date < end_date) {
            $('#difference').html(difference + ' days');
        } else {
            $('#difference').html('1 days');
        }

        // var totalDistance = $('.total_distance').html();

        if (difference == 0) {
            difference = 1;
        }
        var distanceAccordingToDays = (difference * 250);
        $('#datFIlterdDistance').val(distanceAccordingToDays);
        $('#filteredStartDate').val(start_date);
        $('#filteredEndDate').val(end_date);
        $('#filteredStartTime').val(timeInput);
        console.log(total_distance);
        $("#totalDistance").val(total_distance);
        $('#hiddenDateFilterForm').submit();
    });

    function getDateDifference(date1, date2) {
        // Convert both dates to milliseconds
        var d1 = new Date(date1);
        var d2 = new Date(date2);

        // Calculate the time difference in milliseconds
        var timeDifference = Math.abs(d2 - d1);

        // Convert the difference to days and add 1 to include both dates
        var dayDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) + 1;

        return dayDifference;
    }

    $('input[name="payment_mode"]').on('change', function() {
        var total_fair = $('#total_fair').val();
        var final_price = fair_calculation(total_fair);
        $('#totalFair').html(final_price.toFixed(2));
    });

    function fair_calculation(base_price) {
        console.log('base_price', base_price);
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
        // var gst_amt = '0';
        var final_price = parseInt(fairWithAllCharges) + parseInt(gst_amt);
        // $('#total_fair').val(final_price);
        if (payment_mode == '0') {
            partial_amount = (parseInt(final_price) * 15) / 100;

            final_price = partial_amount;
        }

        $('#gst_amt').html(gst_amt);
        console.log(final_price);

        final_price = parseFloat(final_price.toFixed(2));
        return final_price;
    }


    totalKmCalculation();

    function totalKmCalculation() {
        var total_distance = data['distanceData']['totalDistance'];
        var currentDate = new Date();
        var start_date = $('#start-date').val();
        var end_date = $('#end-date').val();
        var startDateObj = new Date(end_date);
        var currentDateOnly = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        var currentDateFormatted = currentDate.toISOString().split('T')[0];
        if (startDateObj < currentDateOnly || start_date > end_date) {
            //
        }

        var difference = getDateDifference(start_date, end_date);
        var distanceAccordingToDays = (difference * 250);

        if (distanceAccordingToDays > total_distance) {
            $('.total_distance').html(distanceAccordingToDays);
        } else {
            $('.total_distance').html(total_distance);
        }
    }

    const returnDatePopup = document.getElementById('returnDatePopup');
    if (returnDatePopup) {
        returnDatePopup.addEventListener('change', function(e) {
            e.preventDefault();

            const startTimrPopup = document.getElementById('modifyTime');
            const departureDatePopup = document.getElementById('departureDatePopup');

            const filteredStartTime = document.getElementById('filteredStartTime');
            const filteredEndDate = document.getElementById('filteredEndDate');
            const filteredStartDate = document.getElementById('filteredStartDate');

            if (startTimrPopup || departureDatePopup || returnDatePopup) {
                // Read values from the modal inputs
                const newTime = startTimrPopup ? startTimrPopup.value : '';
                const newStartDate = departureDatePopup ? departureDatePopup.value : '';
                const newEndDate = returnDatePopup ? returnDatePopup.value : '';

                // Helper to format YYYY-MM-DD -> DD/MM/YYYY for display
                function formatDisplayDate(isoDate) {
                    if (!isoDate) return '';
                    const parts = isoDate.split('-');
                    if (parts.length !== 3) return isoDate;
                    return parts[2] + '/' + parts[1] + '/' + parts[0];
                }

                // Update the visible modal header elements
                if (document.querySelector('.departureDate')) {
                    document.querySelector('.departureDate').textContent = formatDisplayDate(newStartDate) || document.querySelector('.departureDate').textContent;
                    filteredStartDate.value = newStartDate || filteredStartDate.value;
                }
                if (document.querySelector('.departureTime')) {
                    document.querySelector('.departureTime').textContent = newTime || document.querySelector('.departureTime').textContent;
                    filteredStartTime.value = newTime || filteredStartTime.value;
                }
                if (document.querySelector('.returnDate')) {
                    document.querySelector('.returnDate').textContent = formatDisplayDate(newEndDate) || document.querySelector('.returnDate').textContent;
                    filteredEndDate.value = newEndDate || filteredEndDate.value;
                }

                // Update hidden form inputs (set if they exist)
                const setIfExists = (id, val) => {
                    const el = document.getElementById(id);
                    if (el) el.value = val;
                };
                setIfExists('start_travel_Date', newStartDate);
                setIfExists('end_travel_Date', newEndDate);
                setIfExists('travel_Time', newTime);
                // Also update any similarly named IDs used elsewhere (tolerant)
                setIfExists('start_travelDate', newStartDate);
                setIfExists('end_travelDate', newEndDate);
                setIfExists('travelTime', newTime);

                // Show success message
                Swal.fire({
                    icon: "success",
                    title: "Updated",
                    text: "Date and time updated successfully!",
                    timer: 1600
                });

                $('#filteredStartDate').val(newStartDate);
                $('#filteredEndDate').val(newEndDate);
                $('#filteredStartTime').val(newTime);
                // console.log(total_distance);
                // $("#totalDistance").val(total_distance);
                $('#hiddenDateFilterForm').submit();

            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Invalid Input",
                    text: "Please select both date and time!",
                });
            }
        });
    }
</script>

@endsection