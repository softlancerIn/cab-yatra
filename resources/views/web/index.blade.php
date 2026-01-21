@extends('web.layout.layout')
@section('content')
    <link href="https://unpkg.com/aos@@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@@11/swiper-bundle.min.css" />

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyO9SWzEn8SWchaaqa6T_yCmCD8cLHPfg&libraries=places">
    </script>


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
                background-image:
                    url("https://cabyatra.com/public/web/assets/images/img/cabyatra-hero-banner.avif");
                height: calc(100vh - 48px);
                /* height: auto; */
                background-size: cover !important;
            }

            .download-button {
                width: 100%;

            }

            .download-section {
                margin-top: -65px
            }

            .green-hr-line {
                background: #00A743;
                height: 2px;
                opacity: 1;
            }

        }

        hr.green-hr-line {
            display: none;
        }

        /* NEW STYLE 01-06-2025 */
        .sec-title {
            font-size: 45px;
            color: var(--color-black);
            border-left: 7px solid green;
            padding-left: 10px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;

        }

        .padding-Cont {
            padding-inline: 85px;
        }

        .bat_Cnt {
            padding-left: 85px;
        }



        .support {
            margin: 40px 150px 40px 0;
        }

        .line-green {
            position: relative;
        }

        .line-green:after {
            position: absolute;
            content: "";
            width: 5px;
            background: #00A743;
        }

        .abt.line-green:after {
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            height: 75%;

        }

        .facility-section .abt_Cnt_img {
            background: #F8F9FA;
            padding: 50px 35px;
            border-radius: 25px;
        }

        .facility-section.line-green::after {
            left: 0;
            top: 0;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            height: 100%;
        }

        .facility-section h2.sec-title {
            margin-bottom: 50px;
        }

        .cabs_Card {
            box-shadow: 0px 2px 4px 0px #00000013;
            background: #fff;
            border-radius: 10px;
            position: relative;
        }

        .stretched-link {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;

        }


        .vertical_line {
            height: 100%;
            width: 3px;
            background: #000;
        }

        .testi_cnt {
            line-height: 24px;
            font-size: 16px;
        }

        .testi_title {
            font
        }

        .reviews {
            margin-top: 50px;
        }

        .reviews p:first-child {
            font-size: 19px;
        }

        .reviews p:last-child {
            font-size: 16px;
        }

        .connect_with_us {
            margin-bottom: 70px;
        }

        .social-media {
            box-shadow: 0px 5px 10px 1px #00000040;
            background-color: #fff;
        }

        .social-media p {
            font-size: 12px;
            line-height: 24px;
            font-weight: 400;
        }

        .popular_cities strong {
            font-size: 15px;
            font-weight: 600;
            line-height: 24px;
        }

        .popular_cities p {
            font-size: 10px;
            font-weight: 400;
            line-height: 20px;
            text-align: center;
        }

        .popular_cities .border-dark {
            border-color: #00A743 !important;

        }

        .social_cnt {
            margin-top: 150px;
        }


        /* tour packages section on home page */
        .tour-packages .bg-white {
            box-shadow: 0px 16px 48px 0px #00000026;

        }

        .top-left-radius {
            border-top-left-radius: 50px
        }

        .bottom-left-radius {
            border-bottom-left-radius: 50px
        }

        .top-right-radius {
            border-top-right-radius: 50px
        }

        .bottom-right-radius {
            border-bottom-right-radius: 50px
        }

        .tour-packages figure {
            margin-bottom: 0;
        }

        .tour-packages figure figcaption {
            text-align: center;
            border: 0.4px solid #00A743;
            background: #FFFFFF;
            border-radius: 25px;
            padding: 10px 20px;
            margin-top: 16px;

        }

        .routs-list li {
            margin-bottom: 24px;
            position: relative;
        }

        .routs-list li a {
            color: var(--color-green)
        }

        .routs-list li::before {
            content: '▶';
            /* Unicode triangle play symbol */
            position: absolute;
            left: -17px;
            top: 0;
            color: #00923F;
            /* match text color */
            font-size: 14px;
            line-height: 1.5;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #444;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .affordable p {
            font-size: 30px;
            padding-right: 100px;
        }

        @media (max-width: 768px) {
            .packages-box {
                margin-bottom: 80px;
            }

            .sec-padding {
                padding: 0;
            }

            .margin-105 {
                margin-top: 72px;
            }

            .facility-section h2.sec-title {
                margin-bottom: 7px;
            }

            .happy-customers h2.sec-title {
                margin-block: 30px;
            }

            p:last-of-type {
                margin-bottom: 0;
            }

            .sec-title {
                font-size: 22px;
            }

            .sec-title.text-center {
                text-align: left !important;
            }

            .padding-Cont {
                padding-inline: 0px;
            }

            .facility-section .abt_Cnt_img {
                margin-right: 0px;
                padding: 0px;
            }

            .bat_Cnt {
                padding-left: 0;
            }

            .support {
                margin-bottom: 20px;
                margin-top: 20px;
            }

            .support,
            .abt_Cnt_img {
                margin-right: 0;

            }

            .facility-section figure img {
                width: 100% !important;
            }

            .social_cnt {
                margin-top: 30px;
            }

            .social-media_sec figure img {
                width: 25px !important;
                height: 25px !important;
            }

            .top-left-radius,
            .bottom-left-radius,
            .top-right-radius,
            .bottom-right-radius {
                border-radius: 0px
            }

            .connect_with_us {
                margin-bottom: 26px;
            }

            .reviews {
                margin-top: 25px;
            }

            .affordable p {
                font-size: 25px;
                padding-right: 0px;

            }
        }
    </style>

    @include('web.components.loader')
    <!-- lodar end -->
    <section class="hero-banner position-relative overflow-hidden margin-105">
        <div class="container px-0 px-lg-2 p h-100">

            <div class="row align-items-center h-100">

                <div class="col-md-4">
                    <div class="row justify-content-center bg-white d-none">
                        <div class="col-md-12">
                            <ul class="nav nav-pills top-nav mb-lg-2 mt-2 mx-3 border rounded-pill position-relative "
                                style="height:50px; background:#b4f1be;">
                                <li class="nav-item flex-grow-1">
                                    <a href="#"
                                        class="nav-link text-center rounded-pill w-100 active d-flex align-items-center justify-content-center"
                                        style="height:50px;">OutStation</a>
                                </li>
                                <li class="nav-item flex-grow-1">
                                    <a href="#"
                                        class="nav-link text-center rounded-pill w-100 active d-flex align-items-center justify-content-center"
                                        style="height:50px;">Tour Package</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="bg-green  text-white text-center p-1 my-1">Book a Cab at Best Price</div> -->
                    <div class="bg-white journey-track-form py-lg-3 mb-0">
                        <ul class="nav nav-pills top-nav mb-lg-2 mt-2 mx-3 border rounded-pill position-relative ">
                            <li class="nav-item w-50">
                                <a href="#"
                                    class="nav-link text-center rounded-pill w-100 active d-flex align-items-center justify-content-center"
                                    style="height:50px;">OutStation</a>
                            </li>
                            <li class="nav-item w-50">
                                <a href="{{ route('tourPackage') }}"
                                    class="nav-link text-center rounded-pill w-100  d-flex align-items-center justify-content-center"
                                    style="height:50px;">Tour Package</a>
                            </li>
                        </ul>
                        <hr class="green-hr-line">
                        <div class="px-3 px-lg-4 pt-lg-2 pt-2 pb-3 mb-0">
                            <ul class="nav nav-pills rounded-pill mb-2" id="pills-tab" role="tablist">
                                <li class="nav-item flex-grow-1" role="presentation">
                                    <button class="nav-link w-100 active" id="pills-outstation-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-outstation" type="button" role="tab"
                                        aria-controls="pills-outstation" aria-selected="true">OutStation</button>
                                </li>
                                <li class="nav-item flex-grow-1 rounded-pill" role="presentation">
                                    <button class="nav-link w-100" id="pills-local-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-local" type="button" role="tab"
                                        aria-controls="pills-local" aria-selected="false">Hourly/Airport</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-outstation" role="tabpanel"
                                    aria-labelledby="pills-outstation-tab" tabindex="0">
                                    <div class="d-flex">
                                        <div class="form-check rounded-pill flex-grow-1 me-2 ps-2">
                                            <input type="radio" class="ms-2 form-check-input mt-0"
                                                name="flexRadioDefault1" id="showDiv" onclick="toggleDiv()" checked />
                                            <label class="ms-lg-3 ms-2 form-check-label" for="showDiv">
                                                One Way
                                            </label>
                                        </div>
                                        <div class="form-check rounded-pill flex-grow-1 ps-2 ms-2">
                                            <input class="ms-2 form-check-input mt-0" type="radio"
                                                name="flexRadioDefault1" id="hideDiv" onclick="toggleDiv()" />
                                            <label class="form-check-label ms-lg-3 ms-2" for="hideDiv">
                                                Round Trip
                                            </label>
                                        </div>
                                    </div>
                                    <div id="oneyWayTrip">
                                        <form id="outStationForm" action="{{ route('searchCab') }}" class="row g-1 mt-1"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="distance" id="distance">
                                            <div class="col-md-12 outStattionPickupCityDiv">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill pickup_cities">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/pickup-location.png"
                                                        alt="Pickup location" height="20" width="20">
                                                    <input type="text" class="form-control ps-1 bg-transparent border-0 "
                                                        id="outStattionPickupCity" placeholder="Enter Pick Up Location">
                                                </div>

                                                <input type="hidden" name="hiddenOutStattionPickupCity[]"
                                                    id="hiddenOutStattionPickupCity">
                                                <select
                                                    class="form-control form-select d-none outStattionPickupCityDropDown"></select>
                                            </div>
                                            <div class="col-md-12  ">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/location-black.png"
                                                        alt="location" height="20" width="20">
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        id="onWayDestination" placeholder="Enter Destination Location">
                                                    {{-- <gmp-place-autocomplete id="onWayDestination"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        componentRestrictions='{"country": ["in"]}'></gmp-place-autocomplete>
                                                    --}}
                                                </div>
                                                <input type="hidden" name="hiddenOutStattionDestiCity"
                                                    id="hiddenOutStattionDestiCity">
                                                <select
                                                    class="form-control form-select d-none outStationOnWayDestCities_dropdown"></select>
                                            </div>

                                            <div class="col-md-12 addMoreOutStationPickUp ">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/plus.png"
                                                        alt="location" height="20" width="20">
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        id="inputEmail4" placeholder="Add More Citys " readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <div class="country-code-dropdown">
                                                        <img id="flag-image"
                                                            src="{{ config('app.asset_url') }}assets/images/icons/ind-flag.png"
                                                            alt="Flag" class="flag-image" />
                                                        <select id="country-code" class="border-0 bg-transparent"
                                                            name="country-code">
                                                            <option value="+1" data-flag="https://flagcdn.com/us.svg">
                                                                +1
                                                            </option>
                                                            <option value="+44" data-flag="https://flagcdn.com/gb.svg">
                                                                +44
                                                            </option>
                                                            <option value="+91" data-flag="https://flagcdn.com/in.svg"
                                                                selected>
                                                                +91</option>
                                                            <option value="+81" data-flag="https://flagcdn.com/jp.svg">
                                                                +81
                                                            </option>
                                                            <option value="+61" data-flag="https://flagcdn.com/au.svg">
                                                                +61
                                                            </option>
                                                            <!-- Add more countries as needed -->
                                                        </select>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 " name="phone"
                                                        id="phone" placeholder="Enter Mobile Number">
                                                    <a href="#"> <img
                                                            src="{{ config('app.asset_url') }}assets/images/icons/arow-right-black.png"
                                                            alt="location" height="20" width="20" class="me-3">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <a type="button"
                                                    class="btn bg-green submit-btn text-white w-100 rounded-pill"
                                                    id="searchCab">Check Fair & Book</a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Round Trip Div -->
                                    <div id="roundTrip">
                                        <form action="{{ route('outStationRoutesearch') }}" class="row g-1 mt-1"
                                            method="POST" id="outStationRouteForm">
                                            @csrf
                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/pickup-location.png"
                                                        alt="Pickup location" height="20" width="20">
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
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
                                            <div class="col-md-12 addMoreRoundTripDestinationCity">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/location-black.png"
                                                        alt="location" height="20" width="20">
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        name="destination[]" id="outStationRoundDestination"
                                                        placeholder="Enter Destination Location">
                                                </div>
                                                <select
                                                    class="form-control form-select d-none outStationRoundDestinationCitiesDropDown"></select>
                                            </div>
                                            <div class="col-md-12 addMoreRoundTripDestinationDiv">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/plus.png"
                                                        alt="location" height="20" width="20">
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        id="inputEmail4" placeholder="Add More Drop Location" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-12 ">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <div class="country-code-dropdown">
                                                        <img id="flag-image"
                                                            src="{{ config('app.asset_url') }}assets/images/icons/ind-flag.png"
                                                            alt="Flag" class="flag-image" />
                                                        <select id="country-code" class="border-0 bg-transparent"
                                                            name="country-code">
                                                            <option value="+1" data-flag="https://flagcdn.com/us.svg">
                                                                +91
                                                            </option>
                                                            <option value="+44" data-flag="https://flagcdn.com/gb.svg">
                                                                +44
                                                            </option>
                                                            <option value="+91" data-flag="https://flagcdn.com/in.svg">
                                                                +1
                                                            </option>
                                                            <option value="+81" data-flag="https://flagcdn.com/jp.svg">
                                                                +81
                                                            </option>
                                                            <option value="+61" data-flag="https://flagcdn.com/au.svg">
                                                                +61
                                                            </option>
                                                            <!-- Add more countries as needed -->
                                                        </select>
                                                    </div>
                                                    <input type="email"
                                                        class="form-control ps-1 bg-transparent border-0 " name="phone"
                                                        id="outStationRoutePhone" placeholder="Enter Mobile Number">
                                                    <a href="#"> <img
                                                            src="{{ config('app.asset_url') }}assets/images/icons/arow-right-black.png"
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
                                <div class="tab-pane fade" id="pills-local" role="tabpanel"
                                    aria-labelledby="pills-local-tab" tabindex="0">
                                    <div class="d-flex">
                                        <div class="form-check rounded-pill flex-grow-1 me-2 ps-2">
                                            <input class="form-check-input ms-2 mt-0" type="radio"
                                                name="flexRadioDefault" id="localDivShow" onclick="localTab()" checked />
                                            <label class="ms-lg-3 ms-2 form-check-label" for="localDivShow">
                                                Local Trip
                                            </label>
                                        </div>
                                        <div class="form-check rounded-pill flex-grow-1 ps-2 ms-2">
                                            <input class="ms-2 form-check-input mt-0" type="radio"
                                                name="flexRadioDefault" id="localDivHide" onclick="localTab()">
                                            <label class="form-check-label ms-lg-3 ms-2" for="localDivHide">
                                                Local Airport
                                            </label>
                                        </div>
                                    </div>
                                    <div id="routTrip">
                                        <form action="{{ route('localRouteSearch') }}" class="row g-1 mt-1"
                                            id="localRouteTrpForm" method="POST">
                                            @csrf
                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/pickup-location.png"
                                                        alt="Pickup location" height="20" width="20">
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        id="localRoundPickupLoc" placeholder="Enter Pick Up Location"
                                                        name="pickUpLocation">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/location-black.png"
                                                        alt="location" height="20" width="20">
                                                    <select
                                                        class="form-select fw-semibold text-dark form-control ps-1 bg-transparent border-0"
                                                        aria-label="Default select example" name="timeschaduleId"
                                                        id="timeschaduleId">
                                                        <option value="" selected disabled>Select Time</option>
                                                        @foreach ($data['time'] as $key => $value)
                                                            <option value="{{ $value->id }}">{{ $value->time }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <div class="country-code-dropdown">
                                                        <img id="flag-image"
                                                            src="{{ config('app.asset_url') }}assets/images/icons/ind-flag.png"
                                                            alt="Flag" class="flag-image" />
                                                        <select id="country-code" class="border-0 bg-transparent"
                                                            name="country-code">
                                                            <option value="+1" data-flag="https://flagcdn.com/us.svg">
                                                                +91
                                                            </option>
                                                            <option value="+44" data-flag="https://flagcdn.com/gb.svg">
                                                                +44
                                                            </option>
                                                            <option value="+91" data-flag="https://flagcdn.com/in.svg">
                                                                +1
                                                            </option>
                                                            <option value="+81" data-flag="https://flagcdn.com/jp.svg">
                                                                +81
                                                            </option>
                                                            <option value="+61" data-flag="https://flagcdn.com/au.svg">
                                                                +61
                                                            </option>
                                                            <!-- Add more countries as needed -->
                                                        </select>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        id="localRouteTrpPhone" placeholder="Enter Mobile Number"
                                                        name="phone">
                                                    <a href="#"> <img
                                                            src="{{ config('app.asset_url') }}assets/images/icons/arow-right-black.png"
                                                            alt="location" height="20" width="20" class="me-3">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="button"
                                                    class="btn bg-green submit-btn text-white  w-100  rounded-pill"
                                                    id="localRouteSearch">Check Fair & Book</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- ============= Airport section -->
                                    <div id="airPort">
                                        <form action="{{ route('airPortSearch') }}" class="row g-1 mt-1"
                                            id="airPortFrom" method="POST">
                                            @csrf
                                            <div class="col-md-12">
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

                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/location-black.png"
                                                        alt="location" height="20" width="20">
                                                    <input type="email"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        name="pickupLoc" id="outstationLocalPickUpLocation"
                                                        placeholder="Select Pickup Airport Local">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <img src="{{ config('app.asset_url') }}assets/images/icons/location-black.png"
                                                        alt="location" height="20" width="20">
                                                    <input type="text"
                                                        class="form-control ps-1 bg-transparent border-0 "
                                                        name="destination" id="localAirportSelectAirport"
                                                        placeholder="Select Drop Airport Local">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                    <div class="country-code-dropdown">
                                                        <img id="flag-image"
                                                            src="{{ config('app.asset_url') }}assets/images/icons/ind-flag.png"
                                                            alt="Flag" class="flag-image" />
                                                        <select id="country-code" class="border-0 bg-transparent"
                                                            name="country-code">
                                                            <option value="+1" data-flag="https://flagcdn.com/us.svg">
                                                                +91
                                                            </option>
                                                            <option value="+44" data-flag="https://flagcdn.com/gb.svg">
                                                                +44
                                                            </option>
                                                            <option value="+91" data-flag="https://flagcdn.com/in.svg">
                                                                +1
                                                            </option>
                                                            <option value="+81" data-flag="https://flagcdn.com/jp.svg">
                                                                +81
                                                            </option>
                                                            <option value="+61" data-flag="https://flagcdn.com/au.svg">
                                                                +61
                                                            </option>
                                                            <!-- Add more countries as needed -->
                                                        </select>
                                                    </div>
                                                    <input type="email"
                                                        class="form-control ps-1 bg-transparent border-0 " name="phone"
                                                        id="airportPhone" placeholder="Enter Mobile Number">
                                                    <a href="#"> <img
                                                            src="{{ config('app.asset_url') }}assets/images/icons/arow-right-black.png"
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

        </div>
        <!--  pakages Listing  -->
        <section class=" position-relative d-none">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6 text-center download-section ">


                        <div class="download-button rounded-pill  py-2">
                            <ul class="nav justify-content-center">
                                <li>
                                    <a href="#">
                                        <img src="{{ config('app.asset_url') }}assets/images/img/playstore.png"
                                            alt="playstore btn" height="100" width="150" class="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ config('app.asset_url') }}assets/images/img/app-store.png"
                                            alt="app store" height="100" width="150" class=" ">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- <p class="text-center mb-2 text-dark text-uppercase mt-2 ">Download the App get ₹ 350 discount </p> -->
                    </div>
                </div>
            </div>
        </section>

    </section>
    <!--  pakages Listing  -->
    <section class=" position-relative d-none">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 text-center  ">


                    <div class="download-button rounded-pill d-none py-2">
                        <ul class="nav justify-content-center">
                            <li>
                                <a href="#">
                                    <img src="{{ config('app.asset_url') }}assets/images/img/playstore.png"
                                        alt="playstore btn" height="100" width="200" class="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ config('app.asset_url') }}assets/images/img/app-store.png"
                                        alt="app store" height="100" width="200" class=" ">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <marquee behavior="smooth" direction="">
                        <p class="text-center mb-2 text-primary  text-uppercase mt-2 fs-6 "><strong>Download the App
                                get</strong> <span class="text-danger">₹ 350 discount</span> </p>
                    </marquee>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ About Cab Yatra ================= -->
    <section class="pt-lg-5 pt-md-4 abt line-green">
        <div class="container">

            <div class="row mb-4 mb-lg-0">
                <div class="col-12 col-md-6">
                    <div class="abt_Cnt_img">
                        <img src="{{ env('ASSET_URL') }}assets/images/img/about-cabyatra.webp" alt="about cab yatra "
                            class="img-fluid">
                        <div class="text-center">
                            <ul class="nav  mt-4 flex-nowrap">
                                <li class="me-2">
                                    <a href="#">
                                        <img src="{{ config('app.asset_url') }}assets/images/img/playstore.png"
                                            alt="playstore btn" class="img-fluid" width="200">
                                    </a>
                                </li>
                                <li class="ms-2">
                                    <a href="#">
                                        <img src="{{ config('app.asset_url') }}assets/images/img/app-store.png"
                                            alt="app store" class="img-fluid" width="200">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="bat_Cnt">
                        <div class="mt-4 mt-lg-0 mb-4">
                            <h2 class="sec-title text-center text-lg-start  text-dark fw-bold">About Cab <span
                                    class="text-green">Yatra</span></h2>
                        </div>
                        <div class="p-3 support rounded-end-pill bg-green text-white d-flex align-items-center ">
                            <figure class="mb-0">
                                <img src="{{ config('app.asset_url') }}assets/images/img/support.webp" alt="support"
                                    width="35" height="35">
                            </figure>
                            <span class="ms-3">24/7 Availability</span>

                        </div>
                        <p>Welcome to CabYatra, your dependable travel partner for every journey—short or long, city-based
                            or
                            outstation. Established with a vision to make travel more convenient, affordable, and reliable,
                            CabYatra is dedicated to offering top-quality taxi services that prioritize your comfort and
                            safety.
                        </p>
                        <p>In a world where mobility is essential, we understand that getting from one place to another
                            should
                            be simple and stress-free. That’s why we’ve built a platform that connects passengers with
                            verified,
                            professional drivers through an easy booking system—ensuring a seamless travel experience every
                            time.</p>
                        <div class=" ">
                            <a href="{{ route('master_function', ['slug' => 'about-us']) }}"
                                class="btn bg-green text-white d-none d-md-inline-block mt-3">Know
                                More</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

    <!-- ================== Popular cab Services Delhi NCR =================== -->
    <section class="sec-padding facility-section pt-0 pb-3 d-none">
        <div class="container">
            <div class="mt-lg-5 mb-4">

            </div>
            <div class="row justify-content-center gy-4">

                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/haridwar-to-char-dham-kedarnath-badrinath-gangotri-yamunotri-yatra-taxi-cab-booking-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Haridwan to Char Dham Yatra Cab Service</h3>

                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/rishikesh-to-char-dham-kedarnath-badrinath-gangotri-yamunotri-yatra-taxi-cab-booking-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Rishikesh to Char Dham Yatra Cab Service</h3>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-agra-taxicab-booking-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi To Agra Cab Service</h3>

                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-dehradun-taxi-cab-booking-service"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi to Dehradun Cab Service</h3>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-haldwani-cab-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi to Haldwani Cab Service</h3>

                        </div>
                    </a>
                </div>

                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-lucknow-cab-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi to Lucknow Cab Service</h3>

                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-rishikesh-taxicab-booking-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi to Rishikesh Cab Service</h3>

                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-nainital-taxi-cab-booking-service"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi to Nanital Cab Service</h3>

                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-jaipur-taxicab-booking-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi to Jaipur Cab Service</h3>

                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-5">
                    <a href="https://cabyatra.com/delhi-to-jim-corbett-ramnagar-cab-services"
                        class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/arrow-right.png"
                                alt="Home pickup icon" height="19 " width="19 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 style="color:#00f; font-size:15px">Delhi to Jim Corbett Cab Service</h3>

                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="btn btn-light  text-white bg-green rounded ">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sec-padding facility-section pt-lg-5 pb-3 line-green">
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="sec-title text-center text-lg-start  text-dark fw-bold">Cabs we <span
                            class="text-green">provide</span></h2>

                    <div class="abt_Cnt_img">
                        <div class="cabs_Card row justify-content-between align-items-center bg-white mb-3">
                            <div class="col-6 col-md-6">
                                <figure class="mb-0">
                                    <img src="{{ env('ASSET_URL') }}assets/images/img/sedan.webp" alt="sedan cab yatra "
                                        width="200" class="img-fluid">
                                    <figcaption class="text-dark text-center mb-3">Sedan A/C</figcaption>
                                </figure>
                            </div>

                            <div class="col-5 col-md-6  border-start ps-lg-5 border-dark">
                                <div class="cab_Card_Cnt ">
                                    <strong>AC Sedan</strong>
                                    <div class="my-2">
                                        <span class="p-2 bg-green text-white">4+1 Seater</span>
                                    </div>
                                    <span>₹9/km</span>
                                </div>
                            </div>
                        </div>
                        <div class="cabs_Card row justify-content-between align-items-center mb-3 bg-white">
                            <div class="col-6 col-md-6">
                                <figure class="mb-0">
                                    <img src="{{ env('ASSET_URL') }}assets/images/img/ertiga.webp" alt="sedan cab yatra "
                                        width="200" class="img-fluid">
                                    <figcaption class="text-dark text-center mb-3">Ertiga A/C</figcaption>
                                </figure>
                            </div>

                            <div class="col-5 col-md-6  border-start ps-lg-5 border-dark">
                                <div class="cab_Card_Cnt ">
                                    <strong>AC Ertiga</strong>
                                    <div class="my-2">
                                        <span class="p-2 bg-green text-white">6+1 Seater</span>
                                    </div>
                                    <span>₹12/km</span>
                                </div>
                            </div>
                        </div>
                        <div class="cabs_Card row justify-content-between align-items-center mb-3 bg-white">
                            <div class="col-6 col-md-6">
                                <figure class="mb-0">
                                    <img src="{{ env('ASSET_URL') }}assets/images/img/innova.webp" alt="sedan cab yatra "
                                        width="200" class="img-fluid">
                                    <figcaption class="text-dark text-center mb-3">Innova A/C</figcaption>
                                </figure>
                            </div>

                            <div class="col-5 col-md-6  border-start ps-lg-5 border-dark">
                                <div class="cab_Card_Cnt ">
                                    <strong>AC Innova</strong>
                                    <div class="my-2">
                                        <span class="p-2 bg-green text-white">6+1 Seater</span>
                                    </div>
                                    <span>₹16/km</span>
                                </div>
                            </div>
                        </div>
                        <div class="cabs_Card row justify-content-between align-items-center bg-white mb-lg-3">
                            <div class="col-6 col-md-6">
                                <figure class="mb-0">
                                    <img src="{{ env('ASSET_URL') }}assets/images/img/tempo-traveler.webp"
                                        alt="sedan cab yatra " width="200" class="img-fluid">
                                    <figcaption class="text-dark text-center mb-3">Traveller A/C</figcaption>
                                </figure>
                            </div>

                            <div class="col-5 col-md-6  border-start ps-lg-5 border-dark">
                                <div class="cab_Card_Cnt ">
                                    <strong>AC Traveller</strong>
                                    <div class="my-2">
                                        <span class="p-2 bg-green text-white">12+1 Seater</span>
                                    </div>
                                    <span>₹22/km</span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-12 col-md-6">

                    <div class="padding-Cont pe-0 happy-customers">
                        <h2 class="sec-title text-center text-lg-start  text-dark fw-bold">Happy <rov class="text-green">
                                Customers</span></h2>

                        <figure>
                            <img src="{{ env('ASSET_URL') }}assets/images/img/new_testmonial_img.avif"
                                alt="cabyatra testimonial " class="img-fluid rounded-3" width="250">
                        </figure>
                        <p class="testi_cnt">
                            Cab Yatra offered a great travel experience with a clean vehicle, punctual service, and a
                            polite, professional driver. The ride was smooth and hassle-free. I’m very satisfied and would
                            definitely recommend Cab Yatra for anyone seeking reliable cab services.
                        </p>
                        <span class="testi_title fw-medium">Mansi Roy</span>
                        <p class="testi_address">Mumbai,MH</p>

                        <div class="reviews">
                            <div class=" rounded-3 bg-green py-3 px-5 text-center text-white mb-3">
                                <p class="mb-1 fw-bold">4.8/5.0</p>
                                <p class="mb-0 fw-medium">cutomer reviews</p>
                            </div>
                            <div class=" rounded-3 bg-green py-3 px-5 text-center text-white mb-3">
                                <p class="mb-1 fw-bold">498k/500k</p>
                                <p class="mb-0 fw-medium">good reviews</p>
                            </div>
                            <div class=" rounded-3 bg-green py-3 px-5 text-center text-white">
                                <p class="mb-1 fw-bold">489k+</p>
                                <p class="mb-0 fw-medium">satisfied customer </p>
                                </di>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
    </section>


    <section class="sec-padding facility-section pt-3 pt-lg-5 pb-3 line-green">
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="sec-title mb-3 text-center text-lg-start  text-dark fw-bold">Social <span
                            class="text-green">Handles</span></h2>

                    <div class="abt_Cnt_img bg-transparent social-media_sec">
                        <div class="text-white connect_with_us bg-green rounded-end-pill p-3 ps-5">
                            connect with us on
                        </div>

                        <div class="mb-3 ">
                            <figure class="d-flex align-items-center">
                                <img src="{{ env('ASSET_URL') }}assets/images/img/instagram_new.png"
                                    alt="sedan cab yatra " width="25" class="img-fluid">
                                <figcaption class="ms-2">Instagram</figcaption>
                            </figure>
                            <div class="social-media bg-white rounded-end-pill py-3 px-3 ps-5">
                                <p class="mb-0">follow us on - <a href="https://www.instagram.com/"
                                        class="text-green">https://www.instagram.com/</a></p>

                            </div>
                        </div>
                        <div class="mb-3 ">
                            <figure class="d-flex align-items-center">
                                <img src="{{ env('ASSET_URL') }}assets/images/img/facebook_new.png"
                                    alt="sedan cab yatra " width="25" class="img-fluid">
                                <figcaption class="ms-2">Facebook</figcaption>
                            </figure>
                            <div class="social-media bg-white rounded-end-pill py-3 px-3 ps-5">
                                <p class="mb-0">follow us on - <a href="https://www.instagram.com/"
                                        class="text-green">https://www.instagram.com/</a></p>

                            </div>
                        </div>
                        <div class="mb-3 ">
                            <figure class="d-flex align-items-center">
                                <img src="{{ env('ASSET_URL') }}assets/images/img/youtube_new.png" alt="sedan cab yatra "
                                    width="25" class="img-fluid">
                                <figcaption class="ms-2">Youtube</figcaption>
                            </figure>
                            <div class="social-media bg-white rounded-end-pill py-3 px-3 ps-5">
                                <p class="mb-0">follow us on - <a href="https://www.instagram.com/"
                                        class="text-green">https://www.instagram.com/</a></p>

                            </div>
                        </div>
                        <div class="mb-3 ">
                            <figure class="d-flex align-items-center">
                                <img src="{{ env('ASSET_URL') }}assets/images/img/twitter_new.png" alt="sedan cab yatra "
                                    width="25" class="img-fluid">
                                <figcaption class="ms-2">Twitter</figcaption>
                            </figure>
                            <div class="social-media bg-white rounded-end-pill py-3 px-3 ps-5">
                                <p class="mb-0">follow us on - <a href="https://www.instagram.com/"
                                        class="text-green">https://www.instagram.com/</a></p>

                            </div>
                        </div>
                        <div class="mb-3 ">
                            <figure class="d-flex align-items-center">
                                <img src="{{ env('ASSET_URL') }}assets/images/img/instagram_new.png"
                                    alt="sedan cab yatra " width="25" class="img-fluid">
                                <figcaption class="ms-2"> Messenger</figcaption>
                            </figure>
                            <div class="social-media bg-white rounded-end-pill py-3 px-3 ps-5">
                                <p class="mb-0">follow us on - <a href="https://www.instagram.com/"
                                        class="text-green">https://www.instagram.com/</a></p>

                            </div>
                        </div>

                        <p class="social_cnt">Cab Yatra gives an activated aliveness on Instagram
                            (@@cabyatra, @@cab.yatra)
                            and Facebook (Cabsyatra, CabYatra), where they post travel guidence service, and special unique
                            offers. These platforms pages help customers to stay updated about city and outstation travel
                            services, proffessional drivers, 24/7 helpline, and with transparent billing. Followcab yatra
                            for asafe and affordable travel experience across India.thankyou</p>


                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="padding-Cont pe-0">
                        <h2 class="sec-title text-center  mt-3 text-lg-start  text-dark fw-bold">Popular<span
                                class="text-green">
                                Cities</span></h2>

                        <div class="abt_Cnt_img popular_cities me-0 ">
                            <div class="cabs_Card py-3 px-2 row justify-content-between align-items-center bg-white mb-3">
                                <div class="col-6 col-md-6">
                                    <figure class="mb-0">
                                        <img src="{{ env('ASSET_URL') }}assets/images/img/indiagate.webp" alt="indiagate"
                                            width="200" height="120" class="img-fluid">
                                    </figure>
                                </div>

                                <div class="col-6 col-md-6  border-start  border-dark">
                                    <div class="cab_Card_Cnt text-center ">
                                        <strong>Taxi Service In DELHI</strong>
                                        <P>"Cabyatra provides reliable, affordable taxi services in Delhi with easy booking
                                            and professional drivers."</P>
                                    </div>
                                </div>
                                <a href="https://cabyatra.com/taxi-service-in-delhi-book-with-cab-yatra"
                                    class="stretched-link"></a>
                            </div>
                            <div class="cabs_Card py-3 px-2 row justify-content-between align-items-center mb-3 bg-white">
                                <div class="col-6 col-md-6">
                                    <figure class="mb-0">
                                        <img src="{{ env('ASSET_URL') }}assets/images/img/haridwar.webp" alt="haridwar "
                                            width="200" height="120" class="img-fluid">
                                    </figure>
                                </div>

                                <div class="col-6 col-md-6  border-start  border-dark">
                                    <div class="cab_Card_Cnt text-center ">
                                        <strong> Taxi Service In HARIDWAR</strong>
                                        <p>"Cabyatra provides reliable, affordable taxi services in Delhi with easy booking
                                            and professional drivers."</p>
                                    </div>
                                </div>
                                <a href="https://cabyatra.com/taxi-service-in-haridwar-book-reliable-taxi-with-cab-yatra"
                                    class="stretched-link"></a>
                            </div>
                            <div class="cabs_Card py-3 px-2 row justify-content-between align-items-center mb-3 bg-white">
                                <div class="col-6 col-md-6">
                                    <figure class="mb-0">
                                        <img src="{{ env('ASSET_URL') }}assets/images/img/tajmahal.webp" alt="tajmahal"
                                            width="200" height="120" class="img-fluid">
                                    </figure>
                                </div>

                                <div class="col-6 col-md-6  border-start  border-dark">
                                    <div class="cab_Card_Cnt text-center ">
                                        <strong> Taxi Service In AGRA</strong>
                                        <p>"Cabyatra provides reliable, affordable taxi services in Delhi with easy booking
                                            and professional drivers."</p>
                                    </div>
                                </div>
                                <a href="https://cabyatra.com/taxi-service-in-agra-best-for-all-local-area-ride"
                                    class="stretched-link"></a>

                            </div>
                            <div class="cabs_Card py-3 px-2 row justify-content-between align-items-center bg-white mb-3">
                                <div class="col-6 col-md-6">
                                    <figure class="mb-0">
                                        <img src="{{ env('ASSET_URL') }}assets/images/img/jaipur-pink-city.webp"
                                            alt="jaipur-pink-city" width="200" height="120" class="img-fluid">
                                    </figure>
                                </div>

                                <div class="col-6 col-md-6  border-start  border-dark">
                                    <div class="cab_Card_Cnt text-center ">
                                        <strong>Taxi Service In jaipur</strong>
                                        <p>"Cabyatra provides reliable, affordable taxi services in Delhi with easy booking
                                            and professional drivers."</p>
                                    </div>
                                </div>
                                <a href="https://cabyatra.com/taxi-service-in-jaipur-book-for-local-rides"
                                    class="stretched-link"></a>

                            </div>
                            <div class="cabs_Card py-3 px-2 row justify-content-between align-items-center bg-white mb-3">
                                <div class="col-6 col-md-6">
                                    <figure class="mb-0">
                                        <img src="{{ env('ASSET_URL') }}assets/images/img/manali-city.webp"
                                            alt="manali_city " width="200" height="120" class="img-fluid">
                                    </figure>
                                </div>

                                <div class="col-6 col-md-6  border-start  border-dark">
                                    <div class="cab_Card_Cnt text-center ">
                                        <strong>Taxi Service In Manali</strong>
                                        <p>"Cabyatra provides reliable, affordable taxi services in Delhi with easy booking
                                            and professional drivers."</p>
                                    </div>
                                </div>
                                <a href="https://cabyatra.com/best-taxi-service-in-manali-book-now"
                                    class="stretched-link"></a>

                            </div>
                            <div class="cabs_Card p-3 row justify-content-between align-items-center bg-white mb-3">
                                <div class="col-6 col-md-6">
                                    <figure class="mb-0">
                                        <img src="{{ env('ASSET_URL') }}assets/images/img/vrindavan.webp" alt="vrindavan"
                                            width="200" height="120" class="img-fluid">
                                    </figure>
                                </div>

                                <div class="col-6 col-md-6  border-start  border-dark">
                                    <div class="cab_Card_Cnt text-center ">
                                        <strong>Taxi Service In vrindavan </strong>
                                        <p>"Cabyatra provides reliable, affordable taxi services in Delhi with easy booking
                                            and professional drivers."</p>
                                    </div>
                                </div>
                                <a href="https://cabyatra.com/taxi-service-in-vrindavan-book-for-local-rides"
                                    class="stretched-link"></a>

                            </div>
                            <div class="col-12">
                                <div class="mt-4">
                                    <a href="{{ route('home') }}"
                                        class="btn btn-light  text-white bg-green rounded-0">Book
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
    </section>
    <hr>
    <!-- ==== Popular Packages ==== -->

    <section class="sec-padding tour-packages py-3">
        <div class="container">
            <div class="mt-lg-5 mb-4">
                <h2 class="sec-title text-dark fw-bold">Famous tour <span class="text-green"> packages</span></h2>

            </div>
            <div class="row justify-content-center g-lg-5 g-3">
                <div class="col-lg-4">
                    <div class="bg-white p-4 top-left-radius">
                        <figure>
                            <img src="{{ env('ASSET_URL') }}assets/images/img/char-dham-yatra.webp" alt=""
                                class="img-fluid w-100">
                            <figcaption>chaar dhaam yatra</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-top-start-pill">
                        <figure>
                            <img src="{{ env('ASSET_URL') }}assets/images/img/agra-city.webp" alt=""
                                class="img-fluid w-100">
                            <figcaption>Agra tour package</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white p-4 top-right-radius">
                        <figure>
                            <img src="{{ env('ASSET_URL') }}assets/images/img/jaipur-pink-city.webp" alt=""
                                class="img-fluid w-100">
                            <figcaption>Jiapur tour package</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white p-4 bottom-left-radius">
                        <figure>
                            <img src="{{ env('ASSET_URL') }}assets/images/img/mathura-dham.webp" alt=""
                                class="img-fluid w-100">
                            <figcaption>Mathura tour package</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-top-start-pill">
                        <figure>
                            <img src="{{ env('ASSET_URL') }}assets/images/img/manali-city.webp" alt=""
                                class="img-fluid w-100">
                            <figcaption>Manali Tour Package</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white p-4 bottom-right-radius">
                        <figure>
                            <img src="{{ env('ASSET_URL') }}assets/images/img/rishikesh-dham.webp" alt=""
                                class="img-fluid w-100">
                            <figcaption>Rishikesh tour package</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="mt-lg-4">
                        <a href="https://cabyatra.com" class="btn btn-light  text-white bg-green">Explore more +</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==== Popular Packages ==== -->

    <section
        class="sec-padding cab-routs py-3 overflow-hidden
                                                            ">
        <div class="container">
            <div class="mt-lg-5 mb-4">
                <h2 class="sec-title text-dark fw-bold">Popular Cab <span class="text-green">Routes</span></h2>

            </div>
            <div class="row justify-content-center gy-3 gy-lg-0 g-lg-5">
                <style>

                </style>
                <div class="col-lg-6">
                    <ul class="routs-list">
                        <li><a href="https://cabyatra.com/delhi-to-agra-one-way-taxi-cab-booking-service">delhi to Agra
                                taxi/cab booking service</a></li>
                        <li><a href="https://cabyatra.com/delhi-to-char-dham-yatra-by-taxi">Delhi to char dhaam yatra
                                taxi/cab service</a></li>
                        <li><a href="https://cabyatra.com/delhi-to-haridwar-quick-pick-up-taxi-cab-booking-service">Delhi
                                to
                                haridwar taxi/cab booking service</a></li>
                        <li><a href="https://cabyatra.com/delhi-to-kachi-dham-taxi-cab-online-booking-service">Delhi to
                                kainchi dham taxi cab booking service</a>
                        </li>
                        <li><a href="https://cabyatra.com/delhi-to-lucknow-taxi-cab-online-booking-service">Delhi to
                                lucknow
                                cab service</a></li>
                        <li><a href="https://cabyatra.com/cab-for-bareilly-from-delhi-airport">Delhi airport to bareilly
                                cab
                                taxi service</a></li>
                        <li><a href="https://cabyatra.com/delhi-to-massoorie-taxi-booking-service">Delhi to mussoorie cab
                                booking service</a></li>
                        <li><a href="https://cabyatra.com/delhi-to-mathura-vrindavan-taxi-service">Delhi to vrindavan
                                taxicab booking service</a></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ config('app.asset_url') }}assets/images/img/slider2.webp"
                                        alt="slider2-img" class="img-fluid ">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ config('app.asset_url') }}assets/images/img/slider3.webp"
                                        alt="slider3-img" class="img-fluid">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{ config('app.asset_url') }}assets/images/img/slider1.webp"
                                        alt="slider1-img" class="img-fluid ">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==== Popular Packages ==== -->

    <section class="sec-padding facility-section py-3">
        <div class="container">
            <div class="mt-lg-5 mb-4">
                <h2 class="sec-title text-dark">Our Services</h2>

            </div>
            <div class="row  gy-4">
                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/star-black.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
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
                            <img src="{{ config('app.asset_url') }}assets/images/icons/professional-driver.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
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
                            <img src="{{ config('app.asset_url') }}assets/images/icons/clean-car.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
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
                            <img src="{{ config('app.asset_url') }}assets/images/icons/billing.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
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
            <div class="mt-lg-5 mb-4">
                <h2 class="sec-title text-dark">Book for outstation</h2>

            </div>
            <div class="row  gy-4">
                <div class="col-12 col-lg-5">
                    <div class="facility-content row justify-content-center flex-nowrap ">
                        <figure class="d-flex col-2 align-items-center justify-content-center">
                            <img src="{{ config('app.asset_url') }}assets/images/icons/star-black.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
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
                            <img src="{{ config('app.asset_url') }}assets/images/icons/star-black.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
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
                            <img src="{{ config('app.asset_url') }}assets/images/icons/star-black.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
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
                            <img src="{{ config('app.asset_url') }}assets/images/icons/star-black.png"
                                alt="Home pickup icon" height="25 " width="25 ">
                        </figure>
                        <div class="facility-text col-10 ps-0">
                            <h3 class="text-green">Book Air Port Cab</h3>
                            <p class="text-dark">
                                Book a cab for Airport to near by drop location at best price.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="btn btn-light  text-white bg-green rounded ">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================ Attractin image listing ====== -->
    <section class="bg-light overflow-hidden py-3">
        <style>
            @media (min-width:1020px) {
                .tirthsthal .attractiion-img figure img {
                    height: 150px;
                    object-fit: cover;
                }
            }
        </style>
        <div class="container tirthsthal">
            <h2 class="sec-title text-dark my-3">Famous Religious Places</h2>

            <div class="row gy-3 gy-lg-0 ">
                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-sm p-3">
                        <figure class="mb-0">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/kedarnath.jpg" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center  text-uppercase">Kedarnath</figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 " data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-sm p-3">
                        <figure class="mb-0">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/badrinath.jpg" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center  text-uppercase">Badrinath</figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-sm p-3">
                        <figure class="mb-0">

                            <img src="{{ env('ASSET_URL') }}assets/images/img/yomunotri.jpg" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center  text-uppercase">Yomunotri</figcaption>

                        </figure>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-sm p-3">
                        <figure class="mb-0">

                            <img src="{{ env('ASSET_URL') }}assets/images/img/gangotri.jpg" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center text-uppercase">Gangotri</figcaption>

                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="overflow-hidden">
        <div class="container">
            <div class="row">
                <h2 class="sec-title mt-3 text-dark">Rate Per Kilometer</h2>
                <div class="col-12 col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6 col-md-6">
                            <figure>
                                <img src="{{ env('ASSET_URL') }}assets/images/img/sedans.jpg" alt=""
                                    class="img-fluid">
                            </figure>

                        </div>
                        <div class="col-4 col-md-6 ">
                            <strong>AC Sedan</strong>
                            <div class="my-2">

                                <span class="p-2 bg-green text-white">4+1 Seater</span>
                            </div>
                            <span>₹9/km</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6 col-md-6">
                            <figure>
                                <img src="{{ env('ASSET_URL') }}assets/images/img/suv.png" alt=""
                                    class="img-fluid">
                            </figure>

                        </div>
                        <div class="col-4 col-md-6">
                            <strong>AC SUV</strong>
                            <div class="my-2">

                                <span class="p-2 bg-green text-white">6+1 Seater</span>
                            </div>
                            <span>₹12/km</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6 col-md-6">
                            <figure>
                                <img src="{{ env('ASSET_URL') }}assets/images/img/innova-crysta.jpg" alt=""
                                    class="img-fluid">
                            </figure>

                        </div>
                        <div class="col-4 col-md-6">
                            <strong>AC Innova</strong>
                            <div class="my-2">

                                <span class="p-2 bg-green text-white">6+1 Seater</span>
                            </div>
                            <span>₹16/km</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-6 col-md-6">
                            <figure>
                                <img src="{{ env('ASSET_URL') }}assets/images/img/tempo-traveller.jpg" alt=""
                                    class="img-fluid">
                            </figure>

                        </div>
                        <div class="col-4 col-md-6">
                            <strong>AC Traveller</strong>
                            <div class="my-2">

                                <span class="p-2 bg-green text-white">12+1 Seater</span>
                            </div>
                            <span>₹22/km</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <hr>
    <!-- ================ Attractin image listing ====== -->
    <section class=" overflow-hidden py-3">
        <div class="container">
            <h2 class="sec-title text-dark my-3">Famous Palaces</h2>

            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-lg p-3">
                        <figure class="mb-0">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/hawamahal.png" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center  text-uppercase">hawamahal</figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 " data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-lg p-3">
                        <figure class="mb-0">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/india-gate.png" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center  text-uppercase">india gate</figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-lg p-3">
                        <figure class="mb-0">

                            <img src="{{ env('ASSET_URL') }}assets/images/img/ram-mandinr.png" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center  text-uppercase">ram mandinr</figcaption>

                        </figure>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="attractiion-img bg-white shadow-lg p-3">
                        <figure class="mb-0">

                            <img src="{{ env('ASSET_URL') }}assets/images/img/tajmahal.png" alt=""
                                class="img-fluid">
                            <figcaption class=" mt-2 text-center  text-uppercase">taj mahal</figcaption>

                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== FAQ Section ======================= -->
    <style>
        .faq .accordion .accordion-button.collapsed {
            background-color: #00a651;
            border-radius: 50px !important;
            margin-bottom: 10PX;
        }

        .faq .accordion .accordion-flush>.accordion-item>.accordion-header .accordion-button {
            background-color: #00a651;
        }

        .faq .accordion .accordion-button:not(.collapsed) {
            background-color: #00a651;
            border-radius: 50px !important;
        }

        .faq .accordion h3 {
            font-size: 14px;
            color: #fff;
            margin-bottom: 0;
        }

        .faq .accordion .accordion-button::after {
            filter: invert(1);
        }

        .key-points {
            list-style-type: disc;
        }
    </style>
    <section class="faq pt-3 pb-2" id="faq">
        <div class="container">
            <h3 class="sec-title text-dark fw-bold my-3">Frequently Asked Question <span class="text-green">(FAQ)</span>
            </h3>

            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-lg-6 ">
                    <div class="accordion accordion-flush" id="accordionFlushExamplefaq">
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <h3> 1. What is Cab Yatra?</h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Cab Yatra is a trusted taxi service provider offering a wide range of travel
                                                solutions including local rides, airport transfers, and outstation trips. We
                                                focus on safety, affordability, and customer satisfaction.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            <h3>2. How do I book a cab with Cab Yatra?</h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Booking a ride with Cab Yatra is simple. Visit our official website <a
                                                    href="https://cabyatra.com"
                                                    class="link-primary">https://cabyatra.com</a> or
                                                call our customer service team. Just enter your pickup and drop-off details,
                                                choose your vehicle type, and confirm your ride.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            <h3>3. Which cities does Cab Yatra operate in?</h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Cab Yatra currently operates in major Indian cities such as Delhi, Gurugram,
                                                Noida, Ghaziabad, Haldwani, Agra, and several others. We’re continuously
                                                expanding to cover more areas.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree1"
                                            aria-expanded="false" aria-controls="flush-collapseThree1">
                                            <h3>4. What types of taxi services does Cab Yatra offer? </h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree1" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>We offer a variety of services including:</p>
                                            <ul class="key-points">
                                                <li>Local city rides</li>
                                                <li>Outstation one-way and round trips</li>
                                                <li>Airport transfers</li>
                                                <li>Hourly rentals</li>
                                                <li>Customized tour packages</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree2"
                                            aria-expanded="false" aria-controls="flush-collapseThree2">
                                            <h3>5. Are Cab Yatra drivers verified? </h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree2" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Yes. All Cab Yatra drivers go through a strict verification process and are
                                                trained to ensure a safe, professional, and courteous experience for our
                                                customers.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="col-12">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree3"
                                            aria-expanded="false" aria-controls="flush-collapseThree3">
                                            <h3> 6. Can I cancel or reschedule a booking with Cab Yatra?</h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree3" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Absolutely. You can cancel or reschedule your booking by contacting our
                                                support
                                                team.
                                                To avoid cancellation charges, please make changes at least 2 hours prior to
                                                your
                                                scheduled pickup time.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree7"
                                            aria-expanded="false" aria-controls="flush-collapseThree7">
                                            <h3>7. What payment options are available with Cab Yatra? </h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree7" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Cab Yatra accepts a variety of payment modes including:</p>
                                            <ul class="key-points">
                                                <li>Cash</li>
                                                <li>UPI</li>
                                                <li>Credit/Debit Cards</li>
                                                <li>Net Banking</li>
                                                <li>Mobile Wallets (where applicable)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree4"
                                            aria-expanded="false" aria-controls="flush-collapseThree4">
                                            <h3> 8. Does Cab Yatra provide both one-way and round-trip services?</h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree4" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Yes, we provide flexible travel options. Choose either a one-way or
                                                round-trip
                                                based
                                                on your travel needs and convenience.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree5"
                                            aria-expanded="false" aria-controls="flush-collapseThree5">
                                            <h3>9. How are fares calculated at Cab Yatra? </h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree5" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>Our fares are calculated based on distance, ride type, cab category, and
                                                applicable
                                                taxes or tolls. Cab Yatra ensures transparent pricing with no hidden
                                                charges.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree6"
                                            aria-expanded="false" aria-controls="flush-collapseThree6">
                                            <h3> 10. How can I contact Cab Yatra for help?</h3>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree6" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExamplefaq">
                                        <div class="accordion-body">
                                            <p>You can reach Cab Yatra through:</p>
                                            <ul class="key-points">
                                                <li>Phone: <a href="callto:+91-9911995523" class="link-primary"></a>
                                                    +91-9911995523
                                                </li>
                                                <li>Email: <a href="mailto:cabyatrabooking@gmail.com"
                                                        class="link-primary">cabyatrabooking@gmail.com</a></li>
                                                <li>Website Chat Support: <a href="https://cabyatra.com"
                                                        class="link-primary">https://cabyatra.com</a></li>

                                            </ul>
                                            <p>Our dedicated support team is available 24/7 to assist you.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="" style="border:1px solid green">
                        <figure>
                            <img src="{{ config('app.asset_url') }}assets/images/img/faqs.webp" alt=""
                                class="img-fluid">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq pt-3 pb-2 affordable">
        <div class="container">
            <h3 class="sec-title text-dark fw-bold my-3">Book Your Cab It's Simple And <span
                    class="text-green">Affordable</span>
            </h3>

            <div class="row align-items-center justify-content-between">

                <div class="col-12 col-lg-6">
                    <p>With No any hidden pricing and 24*7 support ,Cab Yatra a safe and comfortable
                        journey for every passenger.</p>
                    <div>
                        <a href="https://cabyatra.com" class="btn btn-light  text-white bg-green rounded ">Book Now</a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="">
                        <figure>
                            <img src="{{ config('app.asset_url') }}assets/images/img/affordable-cab.webp"
                                alt="" class="img-fluid">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================================== Cabby cab information ========================== -->
    <section class="sec-padding pt-0 pb-0">
        <!-- Modal  -->
        @foreach ($data['package'] as $key => $value)
            <div class="modal fade" id="otherdetails{{ $value->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <div class="modal fade" id="bookmodals" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                                <input class="form-check-input border-dark" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Assured luggage space (either carrier or boot space) for Free
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input class="form-check-input border-dark" type="checkbox" value=""
                                    id="flexCheckChecked">
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

    <script>
        /**
         * Initialize Google Places Autocomplete for city input fields
         * @@param {string} inputId - ID of the input element
         * @@param {string} hiddenFieldSelector - jQuery selector for hidden field to store city name
         * @@param {object} options - Additional options for autocomplete
         */
        // function initCityAutocomplete(inputId, hiddenFieldSelector, options = {}) {
        //     const inputElement = document.getElementById(inputId);
        //     if (!inputElement) {
        //         console.error(`Element with ID ${inputId} not found`);
        //         return null;
        //     }

        //     const defaultOptions = {
        //         // fields: ['name', 'geometry', 'formatted_address'],
        //         fields: ['address_components', 'geometry', 'formatted_address'],
        //         componentRestrictions: {
        //             country: 'in'
        //         },
        //         // strictBounds: true,
        //         // ...options
        //     };

        //     const autocomplete = new google.maps.places.Autocomplete(
        //         inputElement,
        //         defaultOptions
        //     );

        //     const bounds = new google.maps.LatLngBounds(
        //         new google.maps.LatLng(28.4, 77.2), // SW
        //         new google.maps.LatLng(28.8, 77.5) // NE
        //     );
        //     autocomplete.setBounds(bounds);

        //     autocomplete.addListener('place_changed', () => {
        //         const place = autocomplete.getPlace();
        //         console.log(place);
        //         if (!place.geometry) {
        //             console.log("No details available for input: '" + place.formatted_address + "'");
        //             return;
        //         }

        //         if (hiddenFieldSelector) {
        //             $(hiddenFieldSelector).val(place.formatted_address);
        //         }

        //         return {
        //             name: place.formatted_address,
        //             location: place.geometry.location,
        //             lat: place.geometry.location.lat(),
        //             lng: place.geometry.location.lng(),
        //             place: place // Full place object
        //         };
        //     });

        //     return autocomplete;
        // }
        function initCityAutocomplete(inputId, hiddenFieldSelector, options = {}) {
            const inputElement = document.getElementById(inputId);
            if (!inputElement) {
                console.error(`Element with ID ${inputId} not found`);
                return null;
            }

            const autocomplete = new google.maps.places.Autocomplete(inputElement, {
                fields: ['address_components', 'geometry', 'formatted_address', 'place_id'],
                componentRestrictions: {
                    country: 'in'
                }
            });

            const bounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(28.4, 77.2),
                new google.maps.LatLng(28.8, 77.5)
            );
            autocomplete.setBounds(bounds);

            let delayTimer = null;
            let lastPlaceId = null; // ✅ IMPORTANT

            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();

                if (!place.geometry || !place.place_id) return;

                // ❌ Ignore same place selection
                if (place.place_id === lastPlaceId) {
                    return;
                }

                lastPlaceId = place.place_id;

                // Clear previous timer
                clearTimeout(delayTimer);

                delayTimer = setTimeout(() => {
                    if (hiddenFieldSelector) {
                        $(hiddenFieldSelector).val(place.formatted_address);
                    }

                    const result = {
                        name: place.formatted_address,
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng(),
                        placeId: place.place_id
                    };

                    console.log("🔥 Executed after 3 seconds:", result);

                    // 👉 Call API here
                    // hitMatrixApi(result);

                }, 3000); // ⏱ 3 seconds
            });

            return autocomplete;
        }



        // Initialize on page load
        window.onload = function() {
            const pickupAutocomplete = initCityAutocomplete(
                'outStattionPickupCity',
                '#hiddenOutStattionPickupCity'
            );

            const destinationAutocomplete = initCityAutocomplete(
                'onWayDestination',
                '#hiddenOutStattionDestiCity'
            );

            const roundTripPickupAutocomplete = initCityAutocomplete(
                'outStationRoundPickUp',
                'outStationRoundPickUp'
            );

            const roundTripPDestinationAutocomplete = initCityAutocomplete(
                'outStationRoundDestination',
                'outStationRoundDestination'
            );

            const localTripPickUpAutocomplete = initCityAutocomplete(
                'localRoundPickupLoc',
                'localRoundPickupLoc'
            );

            const localAirportPickupAutocomplete = initCityAutocomplete(
                'outstationLocalPickUpLocation',
                'outstationLocalPickUpLocation'
            );

            const localAirportDestinationAutocomplete = initCityAutocomplete(
                'localAirportSelectAirport',
                'localAirportSelectAirport'
            );

        };
    </script>
    <script>
        @if (Session::has('error'))
            Swal.fire({
                icon: "error",
                title: "Not Found",
                text: "Data Not Found!",
            });
        @endif


        $(".localRoundPickupLocCitiesDropDown").on("change", function() {
            var selectedValue = $(this).val();
            var selectedCityName = $(this).find("option:selected").text();
            $("#localRoundPickupLoc").val(selectedValue);
            $("#localRoundPickupLoc").val(selectedCityName);
            $(".localRoundPickupLocCitiesDropDown").addClass("d-none");
        });
        //=========================== local Round trip pick up location ===============//



        //================== validation for searching ============//
        $(document).ready(function() {
            $('.lodar_box').addClass('d-none');

            function validateAndSubmit({
                pickup,
                destination,
                phone,
                airportFlag,
                form,
                phoneLabel = "Phone Number",
                validatePhone = true
            }) {
                const pickupVal = $(pickup).val();
                const destinationVal = destination ? $(destination).val() : null;
                const phoneVal = $(phone).val();
                const airportFlagVal = airportFlag ? $(airportFlag).val() : null;

                if (!pickupVal) {
                    Swal.fire("Missing Field", "Please choose pickup location", "warning");
                } else if (destination && !destinationVal) {
                    Swal.fire("Missing Field", "Please choose destination location", "warning");
                } else if (!phoneVal) {
                    Swal.fire("Missing Field", "Please enter phone number", "warning");
                } else if (validatePhone && phoneVal.length !== 10) {
                    Swal.fire("Invalid Phone", `Please enter 10 digit ${phoneLabel}`, "error");
                } else if (airportFlag && !airportFlagVal) {
                    Swal.fire("Missing Option", "Please select 'To' or 'From' airport", "warning");
                } else {
                    $('.lodar_box').removeClass('d-none');
                    setTimeout(() => {
                        $('.lodar_box').addClass('d-none');
                    }, 2000);
                    $(form).submit();
                }
            }

            $('#searchCab').on("click", function() {
                console.log("click");
                validateAndSubmit({
                    pickup: '#hiddenOutStattionPickupCity',
                    destination: '#hiddenOutStattionDestiCity',
                    phone: '#phone',
                    form: '#outStationForm'
                });
            });

            $('#localRouteSearch').on("click", function() {
                validateAndSubmit({
                    pickup: '#localRoundPickupLoc',
                    destination: '#timeschaduleId',
                    phone: '#localRouteTrpPhone',
                    form: '#localRouteTrpForm',
                    validatePhone: false
                });
            });

            $('.outStationRouteSearchBtn').on("click", function() {
                validateAndSubmit({
                    pickup: '#outStationRoundPickUp',
                    destination: '#outStationRoundDestination',
                    phone: '#outStationRoutePhone',
                    form: '#outStationRouteForm',
                    phoneLabel: "Mobile Number"
                });
            });

            $('#airportSearchBtn').on("click", function() {
                validateAndSubmit({
                    pickup: '#outstationLocalPickUpLocation',
                    destination: '#localAirportSelectAirport',
                    phone: '#airportPhone',
                    airportFlag: '#is_airpotToFrom',
                    form: '#airPortFrom',
                    validatePhone: false
                });
            });

        });
        //================== validation for searching ============//

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

            const url =
                `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyAsQryHkf5N7-bx_ZBMJ-X7yFMa9WTqwt0`;

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

        //======================= Round Trip Cities Drop Down ==================//
        function outStationRoutAdMorePickupLoc(i) {
            console.log("click");
            const inputId = "outStationRoundDestination" + i;
            const inputElement = document.getElementById(inputId);

            if (!inputElement) {
                console.error(`Element with ID ${inputId} not found`);
                return null;
            }

            // Create the autocomplete object restricted to Indian cities
            const autocomplete = new google.maps.places.Autocomplete(inputElement, {
                types: ["(cities)"],
                fields: ["name", "geometry"],
                componentRestrictions: {
                    country: "in"
                }, // India only
            });

            // Listen for when a place is selected
            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    console.log("No Indian city found for input: '" + place.name + "'");
                    // Optional: Clear the input if invalid selection
                    inputElement.value = "";
                    return;
                }

                // Update the input field with the city name
                inputElement.value = place.name;

                // Log the complete place information
                console.log("Selected Indian City:", {
                    name: place.name,
                    location: place.geometry.location,
                    coordinates: {
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng(),
                    },
                    fullPlaceObject: place,
                });
            });

            return autocomplete;
        }
        //======================= Round Trip Cities Drop Down ==================//

        //======================= Round Trip add more fields ==================//
        $(document).ready(function() {
            var i = 2;
            $(".addMoreRoundTripDestinationDiv").on("click", function(e) {
                console.log("click");
                e.preventDefault();
                html =
                    `<div class="col-12 mt-2 addMoreRoundTripDestinationDiv${i}">
                                                                                                                                                                                                                                    <div class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill">
                                                                                                                                                                                                                                        <img src="https://cabyatra.com/public/web/assets/images/icons/location-black.png" alt="location" height="20" width="20">
                                                                                                                                                                                                                                        <input type="email" class="form-control ps-1 bg-transparent border-0 " id="outStationRoundDestination${i}" name="destination[]" onclick="outStationRoutAdMorePickupLoc(${i})" placeholder="Enter Destination Location" onclick="outStationRoutAdMorePickupLoc(${i})">
                                                                                                                                                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" onclick="removeOutStaRoundFld(${i})" class="bi bi-x-square-fill mx-3" viewBox="0 0 16 16">
                                                                                                                                                                                                                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                                                                                                                                                                                                                                        </svg>
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                    <select class="form-control form-select d-none cities_dropdown"></select>
                                                                                                                                                                                                                                </div>`;
                $(".addMoreRoundTripDestinationCity").append(html);
                i++;
            });
        });

        $(document).ready(function() {
            var i = 2;
            $(".addMoreOutStationPickUp").on("click", function(e) {
                console.log("click");
                e.preventDefault();
                html = `<div class="col-12 mt-2 outStattionPickupCityDiv${i}">
                                                     <div class="input-box d-flex align-items-center py-2 ps-3 bg-green-light rounded-pill pickup_cities">
                                                        <img src="https://cabyatra.com/public/web/assets/images/icons/pickup-location.png" alt="Pickup location" height="20" width="20">
                                                            <input type="text" class="form-control ps-1 bg-transparent border-0 " placeholder="Enter More cities" name="hiddenOutStattionPickupCity[]" id="outStattionAddMorePickupCity${i}" onclick="outStationAdMorePickupLoc(${i})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" onclick="removeOutStaOneFld(${i})" class="bi bi-x-square-fill mx-3" viewBox="0 0 16 16">
                                                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                                                        </svg>
                                                            <input type="hidden" id="hiddenAddMoreOutStattionPickupCity${i}">
                                                    </div>
                                                    <select class=" form-control form-select d-none cities_dropdown"></select>
                                                    </div>`;
                $(".outStattionPickupCityDiv").append(html);
                i++;
            });
        });

        function outStationAdMorePickupLoc(i) {
            const inputId = "outStattionAddMorePickupCity" + i;
            const inputElement = document.getElementById(inputId);

            if (!inputElement) {
                console.error(`Element with ID ${inputId} not found`);
                return null;
            }

            // Create the autocomplete object restricted to Indian cities
            const autocomplete = new google.maps.places.Autocomplete(inputElement, {
                types: ["(cities)"],
                fields: ["name", "geometry"],
                componentRestrictions: {
                    country: "in"
                }, // India only
            });

            // Listen for when a place is selected
            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    console.log("No Indian city found for input: '" + place.name + "'");
                    // Optional: Clear the input if invalid selection
                    inputElement.value = "";
                    return;
                }

                // Update the input field with the city name
                inputElement.value = place.name;

                // Log the complete place information
                console.log("Selected Indian City:", {
                    name: place.name,
                    location: place.geometry.location,
                    coordinates: {
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng(),
                    },
                    fullPlaceObject: place,
                });
            });

            return autocomplete;
        }

        function removeOutStaOneFld(i) {
            $(".outStattionPickupCityDiv" + i).remove();
        }

        function removeOutStaRoundFld(i) {
            $(".addMoreRoundTripDestinationDiv" + i).remove();
        }
        //======================= Round Trip add more fields ==================//
    </script>
    <script src="https://unpkg.com/aos@@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            loop: true,
            speed: 600,
            spaceBetween: 10,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 1,
                    spaceBetween: 50,
                },
            },
        });
    </script>
@endsection
@push('scripts')
    {{--
    <script src="{{config('app.asset_url')}}assets/js/addMore1.js"></script> --}}
    <script src="{{ config('app.asset_url') }}assets/js/dropDownCitiesUsingGoogle.js"></script>
    <script src="{{ config('app.asset_url') }}assets/js/distanceCalculator.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@@11/swiper-bundle.min.js"></script>
@endpush
