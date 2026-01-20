@extends('web.layout.layout')
@section('content')
    <style>
        @media (max-width: 620px) {

            .margin-105 {
                margin-top: 72px;
            }
        }
    </style>
    <section class="tour-hero-banner margin-105 position-relative py-3"
        style="background: linear-gradient(rgb(0 0 0 / 78%), rgb(0 0 0 / 93%)),url('{{ env('ASSET_URL') }}assets/images/img/tour-packages.png') no-repeat center right;">
        <div class="container">

            <div class="row justify-content-center align-items-center h-100">

                <div class="col-md-8">
                    <div class="row justify-content-center h-100 align-items-center">
                        <div class="col-md-8">
                            <ul class="nav nav-pills top-nav border rounded-pill">
                                <li class="nav-item flex-grow-1">
                                    <a href="https://cabyatra.com"
                                        class="nav-link text-center rounded-pill w-100 ">OutStation</a>
                                </li>
                                <li class="nav-item flex-grow-1 rounded-pill">
                                    <a href="{{route('tourPackage')}}"
                                        class="nav-link text-center rounded-pill w-100 active">Tour Packages</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <section class="sec-padding">
        <div class="container">
            <div class="row mb-4 ">
                <div class="col-8 col-lg-3">
                    <h4 class="  fs-13"><span class="px-3 py-1 border border-ligth rounded-pill">Delhi</span>
                        <img src="{{ env('ASSET_URL') }}assets/images/icons/large-arrow.png" width="40" height=""
                            alt="large-arrow" class="mx-lg-2">
                        <span class="border px-3 py-1 border-ligth rounded-pill">Manali</span>
                    </h4>

                </div>
            </div>
            <div class="row packages g-lg-5">
                <div class="col-md-4 col-lg-3 dd">
                    <div class="packages-box p-3 mx-auto position-relative">

                        <div class="car-img position-absolute start-50 translate-middle">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/car1.png" alt="car1" class="" width="200">
                        </div>
                        <div class="packages-text mt-5">
                            <h3 class="text-center">Dzire, Etios or Similar</h3>
                            <h4 class="text-center"><span>Noida</span><img
                                    src="{{ env('ASSET_URL') }}assets/images/icons/large-arrow.png" width="75" height=""
                                    alt="large-arrow" class="mx-2"> <span>Rishikesh</span></h4>
                            <h5 class="mt-3  primary-text text-center">Sedan (AC)</h5>
                            <h6 class="price text-green text-center mt-3"><span>₹ 5,555</span> <span
                                    class="text-decoration-line-through text-secondary ms-2 fs-12">₹ 8,555</span></h6>
                        </div>
                        <div class="package-details">
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Included Km</span>
                                <span class="text-green">557km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Extra fare/Km</span>
                                <span class="text-green">₹ 9.5/Km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Driver Charges</span>
                                <span class="text-green">Included</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Night Charges</span>
                                <span class="text-green">Included</span></p>
                        </div>
                        <p class="text-center mt-3"><a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                                data-bs-target="#otherdetails">Other Details</a></p>
                        <div class="text-center">
                            <button class="btn bg-black text-white w-75 rounded-pill " data-bs-toggle="modal"
                                data-bs-target="#bookmodals">Book Now</button>

                        </div>
                        <div class="social-media-icon mt-3">
                            <ul class="nav justify-content-around">
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/whatsapp.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/insta.png" alt="whatsapp icon"
                                            height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/message.png" alt="whatsapp icon"
                                            class=" " height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/facebook.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/call.png" alt="whatsapp icon"
                                            height="18" width="18">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 dd">
                    <div class="packages-box p-3  mx-auto position-relative">

                        <div class="car-img position-absolute start-50 translate-middle">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/car1.png" alt="car1" class="" width="200">
                        </div>
                        <div class="packages-text mt-5">
                            <h3 class="text-center">Dzire, Etios or Similar</h3>
                            <h4 class="text-center"><span>Noida</span><img
                                    src="{{ env('ASSET_URL') }}assets/images/icons/large-arrow.png" width="75" height=""
                                    alt="large-arrow" class="mx-2"> <span>Rishikesh</span></h4>
                            <h5 class="mt-3  primary-text text-center">Sedan (AC)</h5>
                            <h6 class="price text-green text-center mt-3"><span>₹ 5,555</span> <span
                                    class="text-decoration-line-through text-secondary ms-2 fs-12">₹ 8,555</span></h6>

                        </div>
                        <div class="package-details">
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Included Km</span>
                                <span class="text-green">557km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Extra fare/Km</span>
                                <span class="text-green">₹ 9.5/Km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Driver Charges</span>
                                <span class="text-green">Included</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Night Charges</span>
                                <span class="text-green">Included</span></p>
                        </div>
                        <p class="text-center mt-3"><a href="#" class="text-decoration-underline">Other Details</a></p>
                        <div class="text-center">
                            <button class="btn bg-black text-white w-75 rounded-pill ">Book Now</button>

                        </div>

                        <div class="social-media-icon mt-3">
                            <ul class="nav justify-content-around">
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/whatsapp.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/insta.png" alt="whatsapp icon"
                                            height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/message.png" alt="whatsapp icon"
                                            class=" " height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/facebook.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/call.png" alt="whatsapp icon"
                                            height="18" width="18">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 dd">
                    <div class="packages-box p-3  mx-auto position-relative">

                        <div class="car-img position-absolute start-50 translate-middle">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/car1.png" alt="car1" class="" width="200">
                        </div>
                        <div class="packages-text mt-5">
                            <h3 class="text-center">Dzire, Etios or Similar</h3>
                            <h4 class="text-center"><span>Noida</span><img
                                    src="{{ env('ASSET_URL') }}assets/images/icons/large-arrow.png" width="75" height=""
                                    alt="large-arrow" class="mx-2"> <span>Rishikesh</span></h4>
                            <h5 class="mt-3  primary-text text-center">Sedan (AC)</h5>
                            <h6 class="price text-green text-center mt-3"><span>₹ 5,555</span> <span
                                    class="text-decoration-line-through text-secondary ms-2 fs-12">₹ 8,555</span></h6>
                        </div>
                        <div class="package-details">
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Included Km</span>
                                <span class="text-green">557km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Extra fare/Km</span>
                                <span class="text-green">₹ 9.5/Km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Driver Charges</span>
                                <span class="text-green">Included</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Night Charges</span>
                                <span class="text-green">Included</span></p>
                        </div>
                        <p class="text-center mt-3"><a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                                data-bs-target="#otherdetails">Other Details</a></p>
                        <div class="text-center">
                            <button class="btn bg-black text-white w-75 rounded-pill " data-bs-toggle="modal"
                                data-bs-target="#bookmodals">Book Now</button>

                        </div>
                        <div class="social-media-icon mt-3">
                            <ul class="nav justify-content-around">
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/whatsapp.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/insta.png" alt="whatsapp icon"
                                            height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/message.png" alt="whatsapp icon"
                                            class=" " height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/facebook.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/call.png" alt="whatsapp icon"
                                            height="18" width="18">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 dd">
                    <div class="packages-box mb-0 p-3  mx-auto position-relative">
                        <div class="car-img position-absolute start-50 translate-middle">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/car1.png" alt="car1" class="" width="200">
                        </div>
                        <div class="packages-text mt-5">
                            <h3 class="text-center">Dzire, Etios or Similar</h3>
                            <h4 class="text-center"><span>Noida</span><img
                                    src="{{ env('ASSET_URL') }}assets/images/icons/large-arrow.png" width="75" height=""
                                    alt="large-arrow" class="mx-2"> <span>Rishikesh</span></h4>
                            <h5 class="mt-3  primary-text text-center">Sedan (AC)</h5>
                            <h6 class="price text-green text-center mt-3"><span>₹ 5,555</span> <span
                                    class="text-decoration-line-through text-secondary ms-2 fs-12">₹ 8,555</span></h6>
                        </div>
                        <div class="package-details">
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Included Km</span>
                                <span class="text-green">557km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Extra fare/Km</span>
                                <span class="text-green">₹ 9.5/Km</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Driver Charges</span>
                                <span class="text-green">Included</span></p>
                            <p class="d-flex justify-content-between align-items-center mb-0 "><span>Night Charges</span>
                                <span class="text-green">Included</span></p>
                        </div>
                        <p class="text-center mt-3"><a href="#" class="text-decoration-underline">Other Details</a></p>
                        <div class="text-center">
                            <button class="btn bg-black text-white w-75 rounded-pill ">Book Now</button>

                        </div>

                        <div class="social-media-icon mt-3">
                            <ul class="nav justify-content-around">
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/whatsapp.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/insta.png" alt="whatsapp icon"
                                            height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/message.png" alt="whatsapp icon"
                                            class=" " height="20" width="20">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/facebook.png"
                                            alt="whatsapp icon" height="20" width="20">
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/call.png" alt="whatsapp icon"
                                            height="18" width="18">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= Modal of pick location and date & time ===================== -->

    </section>



@endsection