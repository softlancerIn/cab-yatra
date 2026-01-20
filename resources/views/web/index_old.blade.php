@extends('web.layout.layout')
@section('content')
    <style>
        .current_location:hover {
            transform: scale(1.3);

        }

        .download-button {
            background-color: #DBEFFF;
            top: 0;
        }

        .download-button img {
            max-width: 85% !important;
            height: auto;
        }

        .download-button .nav li {
            width: 48%;
        }

        .input-box {
            height: 56px !important;
        }

        .input-box .form-control {
            color: #00A743;
            font-weight: 400;

        }

        .input-box .form-control::placeholder {
            font-weight: 400;

        }

        .journey-track-form form .submit-btn {
            height: 61px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        /* ================================== */

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

        .testimonial-box {
            height: 243px;
        }

        .top-nav {
            z-index: 112;
            ;
        }

        /* Extra Large Devices (very large screens, 1600px and up) */
        @media (min-width: 1200px) {
            .hero-banner {
                background-image: linear-gradient(rgb(0 0 0 / 59%), rgb(0 0 0 / 59%)),
                    url("https://cabyatra.com/public/web/assets/images/img/hero-banner.png");
                height: calc(100vh - 48px);
                background-size: cover !important;
            }

            .download-button {
                width: 100%;

            }

            .download-section {
                margin-top: -65px
            }
        }

        @media (max-width: 620px) {
            .packages-box {
                margin-bottom: 80px;
            }

            .margin-105 {
                margin-top: 72px;
            }


        }
    </style>
    <style>
        .lodar_box {
            width: 100%;
            height: 100vh;
            backdrop-filter: blur(10px);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;

        }

        .spin {

            box-sizing: border-box;
            display: block;
            height: 100px;
            width: 100px;
            border: 10px solid #c9c7c7;
            border-top: 10px solid #00A743;
            border-radius: 50%;
            -webkit-animation: loader-2-spin 0.5s linear infinite;
            animation: loader-2-spin 0.5s linear infinite;
        }

        @-webkit-keyframes loader-2-spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-2-spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <!-- lodar    -->
    <div class="lodar_box d-flex align-items-center justify-content-center d-none">
        <div class="spin"></div>
    </div>
    <!-- lodar end -->
    <section class="hero-banner position-relative overflow-hidden margin-105">
        <div class="container px-0 px-lg-2 p h-100">

            <div class="row justify-content-center align-items-center h-100">

                <div class="col-md-8">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <ul class="nav nav-pills top-nav mb-2 mt-2 mx-3 border rounded-pill position-relative "
                                style="height:50px; background:#b4f1be;">
                                <li class="nav-item flex-grow-1">
                                    <a href="#"
                                        class="nav-link text-center rounded-pill w-100 active d-flex align-items-center justify-content-center"
                                        style="height:50px;">OutStation</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-green text-white text-center p-1 my-1">Book a Cab at Best Price</div>
                    <div class="bg-white journey-track-form px-3 px-lg-5 pt-lg-4 pt-2 pb-3 mb-0">
                        <ul class="nav nav-pills rounded-pill mb-2" id="pills-tab" role="tablist">
                            <li class="nav-item flex-grow-1" role="presentation">
                                <button class="nav-link w-100 active" id="pills-outstation-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-outstation" type="button" role="tab"
                                    aria-controls="pills-outstation" aria-selected="true">OutStation</button>
                            </li>
                            <li class="nav-item flex-grow-1 rounded-pill" role="presentation">
                                <button class="nav-link w-100" id="pills-local-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-local" type="button" role="tab" aria-controls="pills-local"
                                    aria-selected="false">Hourly/Airport</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-outstation" role="tabpanel"
                                aria-labelledby="pills-outstation-tab" tabindex="0">
                                <div class="d-flex">
                                    <div class="form-check rounded-pill flex-grow-1 me-2 ps-2">
                                        <input type="radio" class="ms-2 form-check-input mt-0" name="flexRadioDefault1"
                                            id="showDiv" onclick="toggleDiv()" checked />
                                        <label class="ms-lg-3 ms-2 form-check-label" for="showDiv">
                                            One Way
                                        </label>
                                    </div>
                                    <div class="form-check rounded-pill flex-grow-1 ps-2 ms-2">
                                        <input class="ms-2 form-check-input mt-0" type="radio" name="flexRadioDefault1"
                                            id="hideDiv" onclick="toggleDiv()" />
                                        <label class="form-check-label ms-lg-3 ms-2" for="hideDiv">
                                            Round Trip
                                        </label>
                                    </div>
                                </div>
                                <div id="oneyWayTrip">
                                    <form id="outStationForm" action="{{route('searchCab')}}" class="row g-1 mt-1"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="distance" id="distance">
                                        <div class="col-md-6 outStattionPickupCityDiv">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill pickup_cities">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/pickup-location.png"
                                                    alt="Pickup location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    id="outStattionPickupCity" placeholder="Enter Pick Up Location">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    fill="currentColor" class="bi bi-geo-fill mx-2 current_location"
                                                    style="cursor: pointer;" viewBox="0 0 16 16" onclick="getLocation()">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                                                </svg>
                                            </div>
                                            <input type="hidden" name="hiddenOutStattionPickupCity[]"
                                                id="hiddenOutStattionPickupCity">
                                            <select
                                                class="form-control form-select d-none outStattionPickupCityDropDown"></select>
                                        </div>
                                        <div class="col-md-6  ">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/location-black.png"
                                                    alt="location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    id="onWayDestination" placeholder="Enter Destination Location">
                                            </div>
                                            <input type="hidden" name="hiddenOutStattionDestiCity"
                                                id="hiddenOutStattionDestiCity">
                                            <select
                                                class="form-control form-select d-none outStationOnWayDestCities_dropdown"></select>
                                        </div>

                                        <div class="col-md-6 addMoreOutStationPickUp ">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/plus.png"
                                                    alt="location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    id="inputEmail4" placeholder="Add More Citys " readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <div class="country-code-dropdown">
                                                    <img id="flag-image"
                                                        src="{{config('app.asset_url')}}assets/images/icons/ind-flag.png"
                                                        alt="Flag" class="flag-image" />
                                                    <select id="country-code" class="border-0 bg-transparent"
                                                        name="country-code">
                                                        <option value="+1" data-flag="https://flagcdn.com/us.svg">+1
                                                        </option>
                                                        <option value="+44" data-flag="https://flagcdn.com/gb.svg">+44
                                                        </option>
                                                        <option value="+91" data-flag="https://flagcdn.com/in.svg" selected>
                                                            +91</option>
                                                        <option value="+81" data-flag="https://flagcdn.com/jp.svg">+81
                                                        </option>
                                                        <option value="+61" data-flag="https://flagcdn.com/au.svg">+61
                                                        </option>
                                                        <!-- Add more countries as needed -->
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    name="phone" id="phone" placeholder="Enter Mobile Number">
                                                <a href="#"> <img
                                                        src="{{config('app.asset_url')}}assets/images/icons/arow-right-black.png"
                                                        alt="location" height="20" width="20" class="me-3">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <a type="button" class="btn bg-green submit-btn text-white w-100 rounded-pill"
                                                id="searchCab">Check Fair & Book</a>
                                        </div>
                                    </form>
                                </div>
                                <!-- Round Trip Div -->
                                <div id="roundTrip">
                                    <form action="{{route('outStationRoutesearch')}}" class="row g-1 mt-1" method="POST"
                                        id="outStationRouteForm">
                                        @csrf
                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/pickup-location.png"
                                                    alt="Pickup location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    name="pickUpLoc" id="outStationRoundPickUp"
                                                    placeholder="Enter Pick Up Location ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    fill="currentColor" class="bi bi-geo-fill mx-2 current_location"
                                                    style="cursor: pointer;" viewBox="0 0 16 16"
                                                    onclick="getLocationFroOSRT()">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                                                </svg>
                                            </div>
                                            <select
                                                class="form-control form-select d-none outStationRoundPickUpCitiesDropDown"></select>
                                        </div>
                                        <div class="col-md-6 addMoreRoundTripDestinationCity">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/location-black.png"
                                                    alt="location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    name="destination[]" id="outStationRoundDestination"
                                                    placeholder="Enter Destination Location">
                                            </div>
                                            <select
                                                class="form-control form-select d-none outStationRoundDestinationCitiesDropDown"></select>
                                        </div>
                                        <div class="col-md-6 addMoreRoundTripDestinationDiv">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/plus.png"
                                                    alt="location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    id="inputEmail4" placeholder="Add More Drop Location" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <div class="country-code-dropdown">
                                                    <img id="flag-image"
                                                        src="{{config('app.asset_url')}}assets/images/icons/ind-flag.png"
                                                        alt="Flag" class="flag-image" />
                                                    <select id="country-code" class="border-0 bg-transparent"
                                                        name="country-code">
                                                        <option value="+1" data-flag="https://flagcdn.com/us.svg">+91
                                                        </option>
                                                        <option value="+44" data-flag="https://flagcdn.com/gb.svg">+44
                                                        </option>
                                                        <option value="+91" data-flag="https://flagcdn.com/in.svg">+1
                                                        </option>
                                                        <option value="+81" data-flag="https://flagcdn.com/jp.svg">+81
                                                        </option>
                                                        <option value="+61" data-flag="https://flagcdn.com/au.svg">+61
                                                        </option>
                                                        <!-- Add more countries as needed -->
                                                    </select>
                                                </div>
                                                <input type="email" class="form-control ps-1 bg-transparent border-0 "
                                                    name="phone" id="outStationRoutePhone"
                                                    placeholder="Enter Mobile Number">
                                                <a href="#"> <img
                                                        src="{{config('app.asset_url')}}assets/images/icons/arow-right-black.png"
                                                        alt="location" height="20" width="20" class="me-3">
                                                </a>
                                            </div>
                                        </div>




                                        <div class="col-12 text-center">
                                            <button type="button"
                                                class="btn bg-green submit-btn text-white  w-100  rounded-pill outStationRouteSearchBtn">Check
                                                Fair & Book</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-local" role="tabpanel" aria-labelledby="pills-local-tab"
                                tabindex="0">
                                <div class="d-flex">
                                    <div class="form-check rounded-pill flex-grow-1 me-2 ps-2">
                                        <input class="form-check-input ms-2 mt-0" type="radio" name="flexRadioDefault"
                                            id="localDivShow" onclick="localTab()" checked />
                                        <label class="ms-lg-3 ms-2 form-check-label" for="localDivShow">
                                            Local Trip
                                        </label>
                                    </div>
                                    <div class="form-check rounded-pill flex-grow-1 ps-2 ms-2">
                                        <input class="ms-2 form-check-input mt-0" type="radio" name="flexRadioDefault"
                                            id="localDivHide" onclick="localTab()">
                                        <label class="form-check-label ms-lg-3 ms-2" for="localDivHide">
                                            Local Airport
                                        </label>
                                    </div>
                                </div>
                                <div id="routTrip">
                                    <form action="{{route('localRouteSearch')}}" class="row g-1 mt-1" id="localRouteTrpForm"
                                        method="POST">
                                        @csrf
                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/pickup-location.png"
                                                    alt="Pickup location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    id="localRoundPickupLoc" placeholder="Enter Pick Up Location"
                                                    name="pickUpLocation">
                                            </div>
                                            {{-- <select
                                                class="form-control form-select d-none localRoundPickupLocCitiesDropDown"
                                                name="pickUpLocation" id="localRouteTrpPickUpLocation"></select> --}}
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/location-black.png"
                                                    alt="location" height="20" width="20">
                                                <select
                                                    class="form-select fw-semibold text-dark form-control ps-1 bg-transparent border-0"
                                                    aria-label="Default select example" name="timeschaduleId"
                                                    id="timeschaduleId">
                                                    <option value="" selected disabled>Select Time</option>
                                                    @foreach($data['time'] as $key => $value)
                                                        <option value="{{$value->id}}">{{$value->time}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <div class="country-code-dropdown">
                                                    <img id="flag-image"
                                                        src="{{config('app.asset_url')}}assets/images/icons/ind-flag.png"
                                                        alt="Flag" class="flag-image" />
                                                    <select id="country-code" class="border-0 bg-transparent"
                                                        name="country-code">
                                                        <option value="+1" data-flag="https://flagcdn.com/us.svg">+91
                                                        </option>
                                                        <option value="+44" data-flag="https://flagcdn.com/gb.svg">+44
                                                        </option>
                                                        <option value="+91" data-flag="https://flagcdn.com/in.svg">+1
                                                        </option>
                                                        <option value="+81" data-flag="https://flagcdn.com/jp.svg">+81
                                                        </option>
                                                        <option value="+61" data-flag="https://flagcdn.com/au.svg">+61
                                                        </option>
                                                        <!-- Add more countries as needed -->
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    id="localRouteTrpPhone" placeholder="Enter Mobile Number" name="phone">
                                                <a href="#"> <img
                                                        src="{{config('app.asset_url')}}assets/images/icons/arow-right-black.png"
                                                        alt="location" height="20" width="20" class="me-3">
                                                </a>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <input type="email" class="form-control ps-1 bg-transparent border-0 "
                                                    id="inputEmail4" placeholder="OTP">
                                            </div>
                                        </div> --}}
                                        <div class="col-12 text-center">
                                            <button type="button"
                                                class="btn bg-green submit-btn text-white  w-100  rounded-pill"
                                                id="localRouteSearch">Check Fair & Book</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- ============= Airport section -->
                                <div id="airPort">
                                    <form action="{{route('airPortSearch')}}" class="row g-1 mt-1" id="airPortFrom"
                                        method="POST">
                                        @csrf
                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <select
                                                    class="form-select fw-semibold text-dark form-control ps-1 bg-transparent border-0"
                                                    id="is_airpotToFrom" name="is_airpotToFrom"
                                                    aria-label="Default select example">
                                                    <option value="1">To Airport</option>
                                                    <option value="0">From Airport</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/location-black.png"
                                                    alt="location" height="20" width="20">
                                                <input type="email" class="form-control ps-1 bg-transparent border-0 "
                                                    name="pickupLoc" id="outstationLocalPickUpLocation"
                                                    placeholder="Select Pickup Airport Local">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <img src="{{config('app.asset_url')}}assets/images/icons/location-black.png"
                                                    alt="location" height="20" width="20">
                                                <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                    name="destination" id="localAirportSelectAirport"
                                                    placeholder="Select Drop Airport Local">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                <div class="country-code-dropdown">
                                                    <img id="flag-image"
                                                        src="{{config('app.asset_url')}}assets/images/icons/ind-flag.png"
                                                        alt="Flag" class="flag-image" />
                                                    <select id="country-code" class="border-0 bg-transparent"
                                                        name="country-code">
                                                        <option value="+1" data-flag="https://flagcdn.com/us.svg">+91
                                                        </option>
                                                        <option value="+44" data-flag="https://flagcdn.com/gb.svg">+44
                                                        </option>
                                                        <option value="+91" data-flag="https://flagcdn.com/in.svg">+1
                                                        </option>
                                                        <option value="+81" data-flag="https://flagcdn.com/jp.svg">+81
                                                        </option>
                                                        <option value="+61" data-flag="https://flagcdn.com/au.svg">+61
                                                        </option>
                                                        <!-- Add more countries as needed -->
                                                    </select>
                                                </div>
                                                <input type="email" class="form-control ps-1 bg-transparent border-0 "
                                                    name="phone" id="airportPhone" placeholder="Enter Mobile Number">
                                                <a href="#"> <img
                                                        src="{{config('app.asset_url')}}assets/images/icons/arow-right-black.png"
                                                        alt="location" height="20" width="20" class="me-3">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="button"
                                                class="btn bg-green submit-btn text-white  w-100  rounded-pill"
                                                id="airportSearchBtn">Check Fair & Book</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!--  pakages Listing  -->
    <section class=" position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 text-center download-section ">


                    <div class="download-button rounded-pill  py-2">
                        <ul class="nav justify-content-center">
                            <li>
                                <a href="#">
                                    <img src="{{config('app.asset_url')}}assets/images/img/playstore.png"
                                        alt="playstore btn" height="100" width="200" class="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{config('app.asset_url')}}assets/images/img/app-store.png" alt="app store"
                                        height="100" width="200" class=" ">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <p class="text-center mb-2 text-dark text-uppercase mt-2 ">Download the App get ₹ 350 discount </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==== Popular Packages ==== -->
    <section class="sec-padding facility-section py-3">
        <div class="container">
            <div class="mt-lg-5">
                <h2 class="sec-title text-center text-dark">Our Services</h2>
                <p class="text-center text-dark"><span>Cab Yatra</span></p>
            </div>
            <div class="row justify-content-center gy-4">
                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/star-black.png" alt="Home pickup icon"
                                height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">Door to Door Pickup & Drop</h3>
                            <p class="text-dark">
                                Cab Yatra provide pickup and drop from your home location to exact drop location.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/professional-driver.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">well-trained Drivers</h3>
                            <p class="text-dark">
                                Cab Yatra provide professional-drivers to make your peacefull journey.
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/clean-car.png" alt="Home pickup icon"
                                height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">Neat & Clean Car</h3>
                            <p class="text-dark">
                                Cab Yatra provide Clean cabs & on time because every second is important in Our life.
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/billing.png" alt="Home pickup icon"
                                height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">Transparent Billing</h3>
                            <p class="text-dark">
                                Cab Yatra amount Billing is Transparent and no hidden Charges show.
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="sec-padding facility-section pt-0 pb-3">
        <div class="container">
            <div class="mt-lg-5">
                <h2 class="sec-title text-center text-dark">Book for outstation</h2>
                <p class="text-center text-dark"><span>Cab Yatra</span></p>
            </div>
            <div class="row justify-content-center gy-4">
                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/star-black.png" alt="Home pickup icon"
                                height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">One Way Outstation</h3>
                            <p class="text-dark">
                                Book a cab for oneway on cab yatra safe and reliable cab at best price.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/star-black.png" alt="Home pickup icon"
                                height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">Book for roundtrip</h3>
                            <p class="text-dark">
                                Book a cab for roundtrip at best price on cab yatra drivers charges and night charges
                                inclusive.
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/star-black.png" alt="Home pickup icon"
                                height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">Book Local cab</h3>
                            <p class="text-dark">
                                Book a cab for local sightseen in your city and hour's travel with a minimum fair.
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{config('app.asset_url')}}assets/images/icons/star-black.png" alt="Home pickup icon"
                                height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10">
                            <h3 class="text-green">Book Air Port Cab</h3>
                            <p class="text-dark">
                                Book a cab for Airport to near by drop location at best price.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <a href="{{route('home')}}" class="btn btn-light  text-white bg-green rounded ">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ -->
    <!-- <section class="d-none">
                                                            <div class="container">
                                                                <div class="mt-5">
                                                                    <h2 class="sec-title text-center">Our Packages</h2>
                                                                </div>
                                                                <div class="row packages g-lg-5">
                                                                    @foreach($data['package'] as $key => $value)
                                                                                @if($key % 2 == 0)
                                                                                            <div class="col-md-4 col-lg-3 dd">
                                                                                                <div class="packages-box mx-auto  p-3 position-relative">
                                                                                                    <div class="offer-badge-img position-absolute ">
                                                                                                        <img src="{{config('app.asset_url')}}assets/images/img/offer-badge.png" alt="offer-badge"class=" position-relative"
                                                                                                            width="100" height="100">
                                                                                                            <p class="offer-value position-absolute top-50 start-50 translate-middle text-white"><span >50% <br><span>off</span></span></p>
                                                                                                    </div>
                                                                                                    <div class="car-img position-absolute start-50 translate-middle">
                                                                                                        <img src="{{$value->image}}" alt="car1" class="" width="200">
                                                                                                    </div>
                                                                                                    <div class="packages-text mt-5">
                                                                                                        <h3 class="text-center">{{$value->name}}</h3>
                                                                                                        <h4 class="text-center"><span>{{$value->from}}</span><img
                                                                                                                src="{{config('app.asset_url')}}assets/images/icons/large-arrow.png" width="50" height=""
                                                                                                                alt="large-arrow" class="mx-2"> <span>{{$value->to}}</span></h4>
                                                                                                        <h5 class="mt-3  text-green text-center">Sedan (AC)</h5>
                                                                                                        <h6 class="price text-danger mb-0 text-center mt-3 " style="text-decoration-line: line-through; text-decoration-style: double;">₹ 2200</h6>
                                                                                                        <h6 class="price text-green text-center mt-3">
                                                                                                            @php
                                                                                                                $total_fair = $value->per_km_cost * $value->distance;
                                                                                                            @endphp
                                                                                                            ₹ {{$total_fair}}
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="package-details">
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Included Km</span>
                                                                                                            <span class="text-green">{{$value->distance}} km</span>
                                                                                                        </p>
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Extra
                                                                                                                fare/Km</span>
                                                                                                            <span class="text-green">₹ {{$value->per_km_cost}}/Km</span>
                                                                                                        </p>
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Driver
                                                                                                                Charges</span>
                                                                                                            <span
                                                                                                                class="text-green">{{!empty($value->driver_charge) ? $value->driver_charge : 'Included'}}</span>
                                                                                                        </p>
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Night
                                                                                                                Charges</span>
                                                                                                            <span
                                                                                                                class="text-green">{{!empty($value->night_charge) ? $value->night_charge : 'Included'}}</span>
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <p class="text-center mt-3"><a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                                                                                                            data-bs-target="#otherdetails{{$value->id}}">Other Details</a></p>
                                                                                                    <div class="text-center">
                                                                                                        <button class="btn bg-black text-white w-75 rounded-pill " data-bs-toggle="modal"
                                                                                                            data-bs-target="#bookmodals" onclick="bookMoadl({{$value->id}})">Book Now</button>

                                                                                                    </div>
                                                                                                    <div class="social-media-icon mt-3">
                                                                                                        <ul class="nav justify-content-around">
                                                                                                            <li>
                                                                                                                <a href="https://api.whatsapp.com/send/?phone=9911995523&text=Hello%20I%20Want%20Cab+&type=phone_number&app_absent=0">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/whatsapp.png"
                                                                                                                        alt="whatsapp icon" height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a href="https://www.instagram.com/cabyatra/">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/insta.png"
                                                                                                                        alt="instagram icon" height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a href="mailto:cabyatra6244@gmail.com">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/message.png"
                                                                                                                        alt="message icon" class=" " height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a href="#">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/facebook.png"
                                                                                                                        alt="facebook icon" height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>

                                                                                                            <li>
                                                                                                                <a href="tel:+91 9911995523">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/call.png"
                                                                                                                        alt="call icon" height="28" width="28">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                @else
                                                                                            <div class="col-md-4 col-lg-3 ">
                                                                                                <div class="packages-box green mx-auto   p-3 position-relative">
                                                                                                    <div class="offer-badge-img position-absolute ">
                                                                                                        <img src="{{config('app.asset_url')}}assets/images/img/offer-badge.png" alt="offer-badge"
                                                                                                            width="100" height="100" class="position-relative">
                                                                                                            <p class="offer-value position-absolute top-50 start-50 translate-middle text-white"><span >50% <br><span>off</span></span></p>
                                                                                                    </div>
                                                                                                    <div class="car-img position-absolute start-50 translate-middle">
                                                                                                        <img src="{{$value->image}}" alt="car1" class="" width="200">
                                                                                                    </div>
                                                                                                    <div class="packages-text mt-5">
                                                                                                        <h3 class="text-center">{{$value->name}}</h3>
                                                                                                        <h4 class="text-center"><span>{{$value->from}}</span><img
                                                                                                                src="{{config('app.asset_url')}}assets/images/icons/large-arrow.png" width="50" height=""
                                                                                                                alt="large-arrow" class="mx-2"> <span>{{$value->to}}</span></h4>
                                                                                                        <h5 class="mt-3  text-dark  text-center">Sedan (AC)</h5>
                                                                                                        <h6 class="price text-danger mb-0 text-center mt-3 " style="text-decoration-line: line-through; text-decoration-style: double;">₹ 2200</h6>

                                                                                                        <h6 class="price   text-center mt-3">
                                                                                                            @php
                                                                                                                $total_fair = $value->per_km_cost * $value->distance;
                                                                                                            @endphp
                                                                                                            ₹ {{$total_fair}}
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="package-details">
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Included Km</span>
                                                                                                            <span class=" ">{{$value->per_km_cost}}km</span>
                                                                                                        </p>
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Extra
                                                                                                                fare/Km</span>
                                                                                                            <span class=" ">₹ {{$value->per_km_cost}}/Km</span>
                                                                                                        </p>
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Driver
                                                                                                                Charges</span>
                                                                                                            <span
                                                                                                                class=" ">{{!empty($value->driver_charge) ? $value->driver_charge : 'Included'}}</span>
                                                                                                        </p>
                                                                                                        <p class="d-flex justify-content-between align-items-center mb-1 "><span>Night
                                                                                                                Charges</span>
                                                                                                            <span
                                                                                                                class=" ">{{!empty($value->night_charge) ? $value->night_charge : 'Included'}}</span>
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <p class="text-center mt-3"><a href="#" class="text-decoration-underline text-white"
                                                                                                            data-bs-toggle="modal" data-bs-target="#otherdetails{{$value->id}}">Other Details</a>
                                                                                                    </p>
                                                                                                    <div class="text-center">
                                                                                                        <button class="btn bg-white text-green fw-bold w-75 rounded-pill ">Book Now</button>

                                                                                                    </div>
                                                                                                    <div class="social-media-icon mt-3">
                                                                                                        <ul class="nav justify-content-around">
                                                                                                            <li>
                                                                                                                <a href="https://api.whatsapp.com/send/?phone=9911995523&text=Hello%20I%20Want%20Cab+&type=phone_number&app_absent=0">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/whatsapp-white.png"
                                                                                                                        alt="whatsapp icon" height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a href="https://www.instagram.com/cabyatra/">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/insta.png"
                                                                                                                        alt="whatsapp icon" height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a href="mailto:cabyatra6244@gmail.com">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/message.png"
                                                                                                                        alt="whatsapp icon" class="invert" height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                            <li>
                                                                                                                <a href="#">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/facebook.png"
                                                                                                                        alt="whatsapp icon" height="30" width="30">
                                                                                                                </a>
                                                                                                            </li>

                                                                                                            <li>
                                                                                                                <a href="tel:+91 9911995523">
                                                                                                                    <img src="{{config('app.asset_url')}}assets/images/icons/call-white.png"
                                                                                                                        alt="whatsapp icon" height="28" width="28">
                                                                                                                </a>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </section> -->

    <!-- ============ Testimonials ================== -->
    {{-- <section class="pt-3 testimonial">
        <div class="container">
            <div class="  mb-5">
                <h2 class="sec-title mb-5 text-center text-dark">What the people think about <span class="text-green">
                        Cab Yatra</span></h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="row testimonials">
                        <div class="col-12 col-md-4">
                            <div class="testimonial-box p-3">
                                <img src="{{config('app.asset_url')}}assets/images/img/testi-2.jpg" alt="testi-img"
                                    class="img-fluid rounded-circle">
                                <div class="testimonial-text">
                                    <h3>Kirti Singh</h3>
                                    <p>
                                        "I recently discovered this cab website, and I am thoroughly impressed with its
                                        services. The website is intuitive, easy to navigate, and very responsive,
                                        making booking a ride a seamless experience. I can easily schedule a ride in
                                        advance or book one on the spot, which is incredibly convenient.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="testimonial-box p-3">
                                <img src="{{config('app.asset_url')}}assets/images/img/testi-1.png" alt="testi-img"
                                    class="img-fluid rounded-circle">
                                <div class="testimonial-text">
                                    <h3>Gaurav Kumar</h3>
                                    <p>
                                        The information provided about different ride options is clear, including pricing
                                        details and vehicle choices. I love that they offer multiple payment methods,
                                        including credit cards, PayPal, and even mobile wallets, which makes paying for a
                                        ride quick and hassle-free.

                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="testimonial-box p-3">
                                <img src="{{config('app.asset_url')}}assets/images/img/testi-3.png" alt="testi-img"
                                    class="img-fluid rounded-circle">
                                <div class="testimonial-text">
                                    <h3>Vikash Dube</h3>
                                    <p>
                                        Customer support has been excellent as well; they're quick to respond to any queries
                                        and are always helpful. Additionally, the site's integration with live tracking
                                        means I can easily monitor my ride in real-time, ensuring peace of mind throughout
                                        the journey.

                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="testimonial-box p-3">
                                <img src="{{config('app.asset_url')}}assets/images/img/testi-img-1.png" alt="testi-img"
                                    class="img-fluid">
                                <div class="testimonial-text">
                                    <h3>Priyanka Dube</h3>
                                    <p>
                                        Overall, this website has made my transportation needs so much easier. It's
                                        reliable, efficient, and user-friendly, and I highly recommend it to anyone who
                                        wants a stress-free and professional cab service."

                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </section> --}}
    <!-- ================================== Cabby cab information ========================== -->
    <section class="sec-padding">
        <!-- Modal  -->
        @foreach($data['package'] as $key => $value)
            <div class="modal fade" id="otherdetails{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" style="background-color: #E7E7E7;">
                    <div class="modal-content ">
                        <div class="modal-header border-0 justify-content-center">
                            <h5 class="modal-title fs-5 text-center" id="exampleModalLabel">Other Charges and Taxes</h5>
                        </div>
                        <div class="modal-body px-lg-5">{!! $value->other_details !!}</div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn bg-green w-50  text-white rounded-pill">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- =================== Book modals ================== -->
        <div class="modal fade" id="bookmodals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg " style="background-color: #E7E7E7;">
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <button type="button" class="btn-close position-absolute " data-bs-dismiss="modal"
                            aria-label="Close" style="top:10px; right:10px;"></button>
                        <div class="row w-100">
                            <div class=" col-6 ">
                                <span>
                                    <input type="date" class=" bg-transparent form-control border-0 text-green "
                                        id="boking-date" value="2024-10-25">
                                </span>

                            </div>
                            <div class="col-6">
                                <span>
                                    <input type="time"
                                        class="form-control border-0 ms-auto me-lg-auto text-green bg-transparent"
                                        id="boking-time" value="10:45:00">


                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body px-lg-5">
                        <ul class="pick-info-form">
                            <li class="row align-items-center fs-14 ">
                                <div class="col-lg-3 col-5"><span style="color: #D47716;">Pickup: gujrat </span></div>

                            </li>
                            <li class="row align-items-center fs-14  ">
                                <div class="col-lg-3"> <span style="color:#D47716">Drop: Noida</span> </div>
                                <div class="col-3"><input type="hidden"
                                        class=" bg-transparent form-control border-0 text-green  "></div>
                            </li>
                        </ul>
                        <form class="row g-3 mt-3 fill-pic-info">
                            <input type="hidden" name="carCategorId" id="carCategorId">
                            <div class="col-12">
                                <input type="text" class="form-control  rounded-pill" id="inputEmail4"
                                    placeholder="Enter Your Phone Number">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control  rounded-pill" id="inputname"
                                    placeholder="Enter Your Name">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control  rounded-pill" id="inputEmail4"
                                    placeholder="Enter Your Email Address">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control  rounded-pill" id="inputaddress"
                                    placeholder=" Enter Your Address">
                            </div>

                            <!-- ================ Add on Services ============= -->
                            <h5 class="fs-14 fw-bold">Add on Services</h5>
                            <div class="form-check">
                                <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Assured luggage space (either carrier or boot space) for Free
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input class="form-check-input border-dark" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Pet Allowed for Rs. 300
                                </label>
                            </div>
                            <h5 class="fs-14 fw-bold">Payment Mode</h5>
                            <div class="form-check mt-1">
                                <input class="form-check-input border-dark" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Pay 10% minimum amount of your booking. </label>
                            </div>
                            <div class="form-check mt-1">
                                <input class="form-check-input border-dark" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Pay 100% amount of your booking. </label>
                            </div>
                            <div class="form-check mt-1">
                                <input class="form-check-input border-dark" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Pay later amount of your booking.
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn bg-green w-50 text-white rounded-pill">Pay <span>₹
                                5541.5</span></button>
                        <p class="fs-12 text-center">We will send booking details via SMS and Email.
                            Please pay balance payment directly to driver during the trip.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api_key') }}&libraries=places"></script>

    <script>
        @if(Session::has('error'))
            Swal.fire({
                icon: "error",
                title: "Not Found",
                text: "Data Not Found!",
            });
        @endif

            //============================ Out Station One Way pickup and destination ===========================//
            function outStationPickupLoc() {
                var input = document.getElementById('outStattionPickupCity');
                // Initialize Autocomplete without restricting to only cities
                var autocomplete = new google.maps.places.Autocomplete(input, {
                    componentRestrictions: { country: 'in' } // Restrict to India
                });

                // Listen for the 'place_changed' event
                autocomplete.addListener('place_changed', function () {

                    var place = autocomplete.getPlace();
                    document.querySelector('.lodar_box').classList.add('d-none'); // Hide loader
                    // Debugging: Log the entire place object
                    console.log(place);

                    if (!place.geometry) {
                        console.log("No details available for input: '" + input.value + "'");
                        return;
                    }

                    // Extract the name of the place
                    var locationName = place.formatted_address;

                    document.getElementById('outStattionPickupCity').value = locationName;
                    document.getElementById('hiddenOutStattionPickupCity').value = locationName;

                    console.log('Selected Location:', locationName);
                });
            }


        function outStationOneWayDestinationLoc() {
            var input = document.getElementById('onWayDestination');

            // Initialize Google Places Autocomplete
            var autocomplete = new google.maps.places.Autocomplete(input, {
                componentRestrictions: { country: 'in' } // Restrict to India
            });

            // Add listener for place selection
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();

                // Debugging: Log the entire place object
                console.log("Full Place Object:", place);

                if (!place.geometry) {
                    console.log("No details available for input: '" + input.value + "'");
                    return;
                }

                // Check if the place is in India
                var isInIndia = place.address_components.some(comp =>
                    comp.long_name === "India" || comp.short_name === "IN"
                );

                if (isInIndia) {
                    var locationName = place.formatted_address; // Get the name of the selected place
                    console.log("Selected Location:", locationName);

                    // Update hidden field with the selected location
                    document.getElementById('hiddenOutStattionDestiCity').value = locationName;
                } else {
                    console.log("The selected place is not in India.");
                }
            });
        }


        //============================ Out Station One Way pickup and destination ===========================//

        //============================ Out Station Round Trip pickup and destination ===========================//
        function outStationRoundPickUp() {
            var input = document.getElementById('outStationRoundPickUp');

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    console.log("No details available for input: '" + input.value + "'");
                    return;
                }

                // Check if the selected place is in India and is a city
                if (
                    place.address_components.some(comp => comp.long_name === "India") &&
                    place.types.includes("locality")
                ) {
                    var cityName = place.name;
                    document.getElementById('outStationRoundPickUp').value = cityName;
                    console.log('Selected City:', cityName);
                } else {
                    console.log("The selected place is not a city in India.");
                }
            });
        }

        function outStationRoundDestination() {
            var input = document.getElementById('outStationRoundDestination');

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    console.log("No details available for input: '" + input.value + "'");
                    return;
                }

                // Check if the selected place is in India and is a city
                if (
                    place.address_components.some(comp => comp.long_name === "India") &&
                    place.types.includes("locality")
                ) {
                    var cityName = place.name;
                    document.getElementById('outStationRoundDestination').value = cityName;
                    console.log('Selected City:', cityName);
                } else {
                    console.log("The selected place is not a city in India.");
                }
            });


        }


        function outstationLocalPickUpLocation() {
            var input = document.getElementById('outstationLocalPickUpLocation');

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    console.log("No details available for input: '" + input.value + "'");
                    return;
                }

                // Check if the selected place is in India and is a city
                if (
                    place.address_components.some(comp => comp.long_name === "India") &&
                    place.types.includes("locality")
                ) {
                    var cityName = place.name;
                    document.getElementById('outstationLocalPickUpLocation').value = cityName;
                    console.log('Selected City:', cityName);
                } else {
                    console.log("The selected place is not a city in India.");
                }
            });


        }

        function localAirportSelectAirport() {
            var input = document.getElementById("localAirportSelectAirport");
            console.log(input);
            var searchBox = new google.maps.places.SearchBox(input, {
                types: ["(airport)"],
            });

            searchBox.addListener("places_changed", function () {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }

                console.log(places);
                var place = places[0];
                if (place.geometry) {
                    var cityName = place.formatted_address;
                    document.getElementById("localAirportSelectAirport").value = cityName;
                }
            });
        }


        function hourlyPickupLoc() {
            var input = document.getElementById('localRoundPickupLoc');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    console.log("No details available for input: '" + input.value + "'");
                    return;
                }

                // Check if the selected place is in India and is a city
                if (
                    place.address_components.some(comp => comp.long_name === "India") &&
                    place.types.includes("locality")
                ) {
                    var cityName = place.name;
                    document.getElementById('localRoundPickupLoc').value = cityName;
                    console.log('Selected City:', cityName);
                } else {
                    console.log("The selected place is not a city in India.");
                }
            });
        }


        //============================ Out Station Round Trip pickup and destination ===========================//
        google.maps.event.addDomListener(window, 'load', outStationPickupLoc);
        google.maps.event.addDomListener(window, 'load', outStationOneWayDestinationLoc);
        google.maps.event.addDomListener(window, 'load', outStationRoundPickUp);
        google.maps.event.addDomListener(window, 'load', outStationRoundDestination);
        google.maps.event.addDomListener(window, 'load', localAirportSelectAirport);
        google.maps.event.addDomListener(window, 'load', outstationLocalPickUpLocation);
        google.maps.event.addDomListener(window, 'load', hourlyPickupLoc);


        $(".localRoundPickupLocCitiesDropDown").on("change", function () {
            var selectedValue = $(this).val();
            var selectedCityName = $(this).find("option:selected").text();
            $("#localRoundPickupLoc").val(selectedValue);
            $("#localRoundPickupLoc").val(selectedCityName);
            $(".localRoundPickupLocCitiesDropDown").addClass("d-none");
        });
        //=========================== local Round trip pick up location ===============//



        //================== search cab form ============//
        $(document).ready(function () {
            $('#searchCab').on("click", function () {
                var pickUp = $('#hiddenOutStattionPickupCity').val();
                var destination = $('#hiddenOutStattionDestiCity').val();
                var phone = $('#phone').val();
                console.log(phone.length);
                if (pickUp == '' || pickUp == undefined) {
                    alert('please choose pickup location');
                } else if (destination == '' || destination == undefined) {
                    alert('please choose destination location');
                } else if (phone == '' || phone == undefined) {
                    alert('please enter phone number');
                } else if (phone.length != '10') {
                    Swal.fire({
                        icon: "error",
                        title: "Invalid Phone Number",
                        text: "Please Enter 10 Digit Phone Number!",
                    });
                } else {
                    //calculateDistance(pickUp, destination, '#distance');

                    $('#outStationForm').submit();
                }
            });


            $('#localRouteSearch').on("click", function () {
                var pickUpLoc = $('#localRoundPickupLoc').val();
                var timsSchaduleId = $('#timeschaduleId').val();
                var phone = $('#localRouteTrpPhone').val();
                if (pickUpLoc == '' || pickUpLoc == undefined) {
                    alert('please choose pickup location');
                } else if (timsSchaduleId == '' || timsSchaduleId == undefined) {
                    alert('please choose destination location');
                } else if (phone == '' || phone == undefined) {
                    alert('please enter phone number');
                } else {
                    $('#localRouteTrpForm').submit();
                }
            });

            $('.outStationRouteSearchBtn').on("click", function () {
                var pickUpLoc = $('#outStationRoundPickUp').val();
                var destination = $('#outStationRoundDestination').val();
                var phone = $('#outStationRoutePhone').val();
                if (pickUpLoc == '' || pickUpLoc == undefined) {
                    alert('please choose pickup location');
                } else if (destination == '' || destination == undefined) {
                    alert('please choose destination location');
                } else if (phone == '' || phone == undefined) {
                    alert('please enter phone number');
                } else if (phone.length != '10') {
                    Swal.fire({
                        icon: "error",
                        title: "Invalid Phone Number",
                        text: "Please Enter 10 Digit Mobile Number!",
                    });
                } else {
                    $('#outStationRouteForm').submit();
                }
            });


            $('#airportSearchBtn').on("click", function () {
                var pickUpLoc = $('#outstationLocalPickUpLocation').val();
                var destination = $('#localAirportSelectAirport').val();
                var is_airpotToFrom = $('#is_airpotToFrom').val();
                var phone = $('#airportPhone').val();
                if (pickUpLoc == '' || pickUpLoc == undefined) {
                    alert('please choose pickup location');
                } else if (destination == '' || destination == undefined) {
                    alert('please choose destination location');
                } else if (phone == '' || phone == undefined) {
                    alert('please enter phone number');
                } else if (is_airpotToFrom == '' || is_airpotToFrom == undefined) {
                    alert('please select a option To airport or from airport');
                } else {
                    $('#airPortFrom').submit();
                }
            });
        });


        //========================== Get Current Location =======================//

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        console.log(`Latitude: ${lat}, Longitude: ${lng}`);

                        // Pass the coordinates to a reverse geocoding function
                        getAddressFromCoordinates(lat, lng);
                    },
                    (error) => {
                        console.error('Error getting location:', error.message);
                    }
                );
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }
        function getAddressFromCoordinates(lat, lng) {

            const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyDhTJHj8fT_dHJMkH0ndpW0guo4EQzXhHY`;

            fetch(url)
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === 'OK') {
                        console.log(data);
                        const address = getAddress(data.results[0].formatted_address);
                        $('#outStattionPickupCity').val(address);
                        $('#hiddenOutStattionPickupCity').val(data.results[0].formatted_address);
                    } else {
                        console.error('Geocoding failed:', data.status);
                    }
                })
                .catch((error) => console.error('Error:', error));
        }


        function getLocationFroOSRT() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        console.log(`Latitude: ${lat}, Longitude: ${lng}`);

                        // Pass the coordinates to a reverse geocoding function
                        getAddressFromCoordinatesForOsrt(lat, lng);
                    },
                    (error) => {
                        console.error('Error getting location:', error.message);
                    }
                );
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }

        function getAddressFromCoordinatesForOsrt(lat, lng) {
            const apiKey = {{ config('app.google_api_key') }};
            const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${apiKey}`;

            fetch(url)
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === 'OK') {
                        const address = getAddress(data.results[0].formatted_address);
                        console.log(data);
                        $('#outStationRoundPickUp').val(address);
                        $('#outStationRoundPickUp').val(data.results[0].formatted_address);
                    } else {
                        console.error('Geocoding failed:', data.status);
                    }
                })
                .catch((error) => console.error('Error:', error));
        }


        function getAddress(fullAddress) {
            // Split the address by commas
            const addressParts = fullAddress.split(',');

            // Extract the address part (first two or three parts depending on format)
            // Adjust the range based on your address format
            const filteredAddress = addressParts.slice(0, 2).join(',').trim();

            return filteredAddress;
        }
        //========================== Get Current Location =======================//

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

@endsection
@push('scripts')
    <script src="{{config('app.asset_url')}}assets/js/addMore1.js"></script>
    <script src="{{config('app.asset_url')}}assets/js/dropDownCitiesUsingGoogle.js"></script>
    <script src="{{config('app.asset_url')}}assets/js/distanceCalculator.js"></script>
@endpush