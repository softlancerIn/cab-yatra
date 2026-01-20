@extends('web.layout.layout')
@section('content')

<style>
    * {
        user-select: none !important;
    }

    .day.inactive>span {
        opacity: 0.5;
    }

    @media (max-width: 620px) {

        .margin-105 {
            margin-top: 105px;
        }

        .bg-green.w-50 {
            width: 100% !important;
        }
    }

    /* ======================== */
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
</style>


<section class="mt-5 py-3">
    <div class="container">
        <div class="row mt-3 justify-content-between align-items-center">
            @if(isset($data['pickup']))
            <div class="col-12 col-lg-10">
                <h4 class="fs-13 mb-0  row flex-nowrap   pickup-destination">
                    <span
                        class="px-3 mb-2 mb-lg-0 text-wrap w-auto bg-green text-white py-1 d-flex align-items-center justify-content-center border border-ligth rounded-pill">{{$data['pickup']}}</span>
                    <span class="w-auto px-0 mb-2 mb-lg-0 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20">
                            <path
                                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                        </svg>
                    </span>
                    <span
                        class="px-3 mb-2 mb-lg-0 text-wrap w-auto bg-green text-white py-1 d-flex align-items-center justify-content-center border border-ligth rounded-pill">Local
                        Sighseeing</span>
                </h4>

            </div>
            @endif
            <div class="col-12 col-lg-1 text-center text-lg-end">
                <h4 class="mb-0 fs-13 mobile-view-trip-type"><span class=" ">Local Trip</span>
                </h4>
            </div>
        </div>
        <!-- ======================= Pick up time table section  ============== -->
        <div class="row mt-lg-3">
            <div class="col-12 ">
                <div class=" date_and-time">
                    <div class="container px-0 px-lg-3">

                        <div class="row mt-3 justify-content-between justify-content-lg-start">
                            <div class="col-5">
                                <label class=" fs-13"><span class="fs-16">Select PickUp Time</span></label>
                            </div>
                            <div class="col-7 text-end">
                                <label class=" fs-13"><span class="fs-16">{{$data['destination']}}</span></label>
                            </div>
                            <div class="col-6 col-md-3">

                                <div class="input-container mt-0">
                                    <input type="date" class="form-control w-100 ms-auto me-lg-auto text-green "
                                        id="selected-date">

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
                    <div id="customTimePicker" class="time-picker">
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
                </div>
                <div class="text-center">
                    <button type="submit" class="btn text-white my-2 mx-auto rounded-pill bg-green"
                        id="btnSubmit">Submit</button>
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
            if (!empty($value->timeschaduleData->off)) {
            $fair = $value->timeschaduleData->fair;
            $off_amt = ($fair * $value->timeschaduleData->off) / 100;
            $discounted_fair = ($fair - $off_amt);
            } else {
            $discounted_fair = $value->timeschaduleData->fair;
            }

            $gst = ($discounted_fair * 5) / 100;
            $gst_fair = $discounted_fair + $gst;
            @endphp
            <div class="col-md-4 col-lg-3 dd mb-5">
                <div class="packages-box p-3 mx-auto position-relative">
                    <div class="offer-badge-img position-absolute ">
                        <img src="{{ env('ASSET_URL') }}assets/images/img/offer-badge.png" alt="offer-badge"
                            class="position-relative" width="100" height="100">
                        <p class="offer-value position-absolute top-50 start-50 translate-middle text-white">
                            <span>{{$value->timeschaduleData->off ?? '0'}}% <br><span>off</span></span>
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
                        <h3 class="text-center">{{$value->car->name ?? '--'}}</h3>
                        <h5 class="mt-3  text-green text-center">{{$value->name}} (AC)</h5>
                        <h6 class="price text-danger mb-0 text-center mt-3 "
                            style="text-decoration-line: line-through; text-decoration-style: double;">₹
                            {{$value->timeschaduleData->fair}}
                        </h6>
                        <h6 class="price text-green text-center mt-2">₹

                            {{$discounted_fair}}
                        </h6>
                    </div>
                    <div class="package-details">
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Included</span>
                            <span class="text-green" id="incudedTime">{{$value->timeschaduleData->time_id}}</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Extra fare/Km</span>
                            <span
                                class="text-green">{{!empty($value->timeschaduleData->extra_fair_perKm) ? '₹' . $value->timeschaduleData->extra_fair_perKm : 'excluded'}}/<span>km</span></span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Extra fare/Hour</span>
                            <span
                                class="text-green">{{!empty($value->timeschaduleData->extra_fair_perHour) ? '₹' . $value->timeschaduleData->extra_fair_perHour : 'excluded'}}/<span>hour</span>
                            </span>
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
                            onclick="bookMoadl({{$value->id}},{{$discounted_fair}},'{{$value->timeschaduleData->extra_fair_perKm}}')"
                            data-bs-toggle="modal" data-bs-target="#bookModal" data-id="{{$value->id}}">Book
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




<!-- ================================== Cabby cab information ========================== -->


<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " style="background-color: #E7E7E7;">
        <div class="modal-content">
            <div class="modal-header pb-1 d-block">
                <button type="button" class="btn-close position-absolute " data-bs-dismiss="modal" aria-label="Close"
                    style="top:10px; right:10px;"></button>
                <h6 class=" text-center text-uppercase">Local Trip</h6>
                <h6 class="fs-14   mb-2 mt-3 mb-0"><span class="text-uppercase text-white p-1 bg-green ">Departure
                        :</span> <span class="text-dark" id="selectedDate">12/01/2025</span>@<span class="text-dark"
                        id="selectedTime">07:35AM</span></h6>


            </div>
            <div class="modal-body px-lg-5">

                <ul class="pick-info-form">
                    <li class="row align-items-center fs-14 ">
                        <div class="col-lg-3 col-5"><span class="text-truncate d-block" style="color: #D47716;">Pickup:
                                {{$data['pickup']}} </span></div>
                    </li>
                    <li class="row align-items-center fs-14  ">
                        <div class="col-lg-3"> <span class="text-truncate d-block" style="color:#D47716">For: <span
                                    id="DropTimeData"></span>
                            </span> </div>
                        <div class="col-3"><input type="hidden"
                                class=" bg-transparent form-control border-0 text-green  "></div>
                    </li>
                </ul>
                <form action="{{route('cabBooking')}}" class="row g-3   fill-pic-info" method="POST"
                    id="localRouteTripForm">
                    @csrf
                    <input type="hidden" name="type" id="type" value="local">
                    <input type="hidden" name="subType" id="subType" value="route">
                    <input type="hidden" name="pickupLoc" id="pickupLoc" value="{{$data['pickup']}}">
                    <input type="hidden" name="timeScahduleId" id="timeScahduleId"
                        value="{{$data['timeschaduleId']->id}}">
                    <input type="hidden" name="carCategorId" id="carCategorId">
                    <input type="hidden" name="travelDate" id="travel_Date">
                    <input type="hidden" name="travelTime" id="travel_Time">
                    <input type="hidden" name="razorpayId" id="razorpayId">
                    <input type="hidden" name="included_km" id="included_km"
                        value="{{$value->timeschaduleData->time_id ?? ''}}">
                    <input type="hidden" name="extra_fair_perKm" id="extra_fair_perKm"
                        value="{{$value->timeschaduleData->extra_fair_perKm ?? ''}}">
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
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-transparent collapsed p-0" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                    aria-controls="collapseOne">
                                    <h5 class="fs-14 mb-3 fw-bold">Have Coupon ?</h5>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse  "
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row coupon">
                                        <div class="col-8 col-md-3">
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
                                <button class="accordion-button collapsed bg-transparent p-0" type="button"
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
                    <input type="hidden" name="total_fair" id="total_fair" value="{{$discounted_fair}}">
                    <input type="hidden" name="updated_amt" value="{{$discounted_fair}}" id="updated_amt">
                    <button type="button" class="btn bg-green w-50 mx-auto text-white rounded-pill payNow">Pay ₹<span
                            id="totalFair">
                            {{$discounted_fair}}</span>
                    </button>

                    <span class="text-center fs-12 fw-bold">5% GST Included This Fair</span>
                    <p class="fs-12 text-center">We will send your booking details via SMS and Email. </p>
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
            <div class="modal-body px-lg-5">{!! $value->timeschaduleData->other_details !!}</div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn bg-green w-50  text-white rounded-pill"
                    data-bs-dismiss="modal">Okay</button>
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
            dayDiv.innerHTML = `<span>${day}</span>
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
        console.log(formattedDate);
        selectedDateInput.value = formattedDate; // Set value in input field
        bookingDateInput.value = formattedDate;
        travelDate.value = formattedDate;
        // Store the selected date
        selectedDate = {
            month: monthIndex,
            day: day
        };
    }
</script>

<!-- ================== Set Default Value in input field Date/Time =================  -->
<script>
    // Array of IDs for the date input fields
    const dateInputIds = ["selected-date"]; // Add all your input IDs here

    // Function to set the current date in all inputs
    function setCurrentDate() {
        // Get the current date
        const currentDate = new Date();

        // Format the date to YYYY-MM-DD
        const formattedDate = currentDate.toISOString().split("T")[0];

        // Loop through each input ID and set the current date
        dateInputIds.forEach(id => {
            const dateInput = document.getElementById(id);
            const modalDate = document.getElementById('travelDate');
            if (dateInput) {
                dateInput.value = formattedDate;
                // modalDate.value = formattedDate;
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
        console.log(formattedTime);
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
                console.log(selectedTime);
                timeInput.value = selectedTime; // Set selected time
                bookingTime.value = selectedTime;
                travelTime.value = selectedTime;
                // Deselect all spans                
                document.querySelectorAll('.time-options span').forEach(function(span) {
                    span.classList.remove('selected');
                });

                // Select the clicked time
                this.classList.add('selected');

                // // Hide the custom time picker
                // timePicker.classList.add('hidden');
            });
        });

    });

    function bookMoadl(id, price, extra_fair_perKm) {
        fair_calculation(price);
        $('#carCategorId').val(id);
        $('#total_fair').val(price);
        var selectedDate = $('#selected-date').val();
        var selectedTime = $('#timeInput').val();
        var incudedTime = $('#incudedTime').html();

        var gst_amt = (parseInt(price) * 5) / 100;
        var gst_fair = parseInt(price) + parseInt(gst_amt);

        gst_fair = parseFloat(gst_fair.toFixed(2));

        var gst_fair = parseFloat((gst_fair * 15) / 100).toFixed(2);


        $('#gst_amt').html(gst_amt);
        $('#totalFair').html(gst_fair);
        $('#updated_amt').val(gst_fair);

        $('#total_fair').val(price);

        $('#travelDate').val(selectedDate);
        $('#travel_Date').val(selectedDate);
        $('#selectedDate').html(selectedDate);
        $('#selectedTime').html(selectedTime);
        $('#travel_Time').val(selectedTime);
        $('#DropTimeData').html(incudedTime);
        $('#extra_fair_perKm').val(extra_fair_perKm);
    }

    $('.payNow').on("click", function() {
        var payment_mode = $('input[name="payment_mode"]:checked').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#phone').val();
        var address = $('#address').val();
        var gstName = $('#biling_name').val();
        var gstNo = $('#biling_gstNo').val();
        var travelDate = $('#travel_Date').val();
        var travelTime = $('#travel_Time').val();
        var totalFair = $('#totalFair').html();
        console.log(name);
        console.log(email);
        console.log(mobile);
        console.log(travelDate);
        console.log(payment_mode);
        console.log(totalFair);

        if ((name != '') && (email != '') && (mobile != '') && (travelDate != '') && (payment_mode != '')) {
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
                            $('#razorpayId').val(response.razorpay_payment_id);
                            $('#localRouteTripForm').submit();
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



            // $('#localRouteTripForm').submit();
        } else {
            alert('Please FilL all the details!');
        }
    });


    // ========================== Hide Calendar click on submit button ====================
    $('#btnSubmit').on("click", function() {
        var startDate = $('#selected-date').val();
        var time = $('#timeInput').val();

        if (startDate != '' && time != '') {
            $('#calenderDiv').addClass('d-none');
            // $('#div').hide();
        } else {
            alert('please select  Pick up date and pick up time first!')
        }
    });

    $('input[name="add_on_services[]"]').on('change', function() {
        var totalFair = parseInt($('#total_fair').val()); // Original fare
        var final_price = fair_calculation(totalFair);

        $('#totalFair').html(final_price.toFixed(2));
        $('#updated_amt').val(final_price.toFixed(2));
    });

    $('input[name="payment_mode"]').on('change', function() {
        var totalFair = parseInt($('#total_fair').val());
        var final_price = fair_calculation(totalFair);

        $('#totalFair').html(final_price.toFixed(2));
    });


    function fair_calculation(base_price) {
        var update_price = $('#updated_amt').val();
        var addOnServiceCharge = 0;
        var partial_amount = 0;

        $('input[name="add_on_services[]"]:checked').each(function() {
            if ($(this).val() === 'pet_allowed') {
                addOnServiceCharge = 300;
            }
        });

        var payment_mode = $('input[name="payment_mode"]:checked').val();

        var fairWithAllCharges = parseInt(base_price) + parseInt(addOnServiceCharge);

        var gst_amt = (parseInt(fairWithAllCharges) * 5) / 100;
        var final_price = parseInt(fairWithAllCharges) + parseInt(gst_amt);
        if (payment_mode == '0') {
            partial_amount = (parseInt(final_price) * 15) / 100;

            final_price = partial_amount;
        }

        $('#gst_amt').html(gst_amt);

        final_price = parseFloat(final_price.toFixed(2));
        return final_price;
    }
</script>
@endsection