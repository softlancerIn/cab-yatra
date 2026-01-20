@extends('web.layout.layout')
@section('content')
    <style>
        @media (max-width: 620px) {

            .margin-105 {
                margin-top: 72px;
            }
        }
    </style>
    <section class="tour-hero-banner margin-105 position-relative py-3 py-lg-0"
        style="background: linear-gradient(rgb(0 0 0 / 78%), rgb(0 0 0 / 93%)),url('{{ env('ASSET_URL') }}assets/images/img/tour-packages.png') no-repeat center right;">
        <div class="container">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-8">
                    <div class="row justify-content-center h-100 align-items-center">
                        <div class="col-md-8">
                            <ul class="nav nav-pills top-nav border rounded-pill" style="height:50px; background:#b4f1be;">
                                <li class="nav-item flex-grow-1">
                                    <a href="{{route('home')}}"
                                        class="nav-link text-center d-flex align-items-center justify-content-center rounded-pill w-100 "
                                        style="height:50px;">OutStation</a>
                                </li>
                                <li class="nav-item flex-grow-1 rounded-pill">
                                    <a href="{{route('tourPackage')}}"
                                        class="nav-link text-center rounded-pill w-100 active d-flex align-items-center justify-content-center"
                                        style="height:50px;">Tour
                                        Packages</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <section class="hero-banner packages-details position-relative"
        style="background: url('{{$data['packageDetail']->image}}') no-repeat center; background-size: cover;">
    </section>
    <section class="py-3 package-details-descriptions">
        <div class="container">
            <div class="mt-3 mb-5">
                <h2 class="sec-title text-center text-green">{{$data['packageDetail']->name}}</h2>
            </div>
            <div class="row  ">
                <div class="col-12">
                    {!! $data['packageDetail']->tour_details!!}
                </div>
                <div class="col-12 text-center">
                    <!-- Button trigger modal -->
                    <a href="#" type="button" class="text-decoration-underline showmore text-green my-4"
                        data-bs-toggle="modal" data-bs-target="#package-list-details">
                        Show More
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="#00A743">
                            <path
                                d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                        </svg>
                    </a>

                </div>

            </div>
        </div>
    </section>
    <section class=" pb-3  popular-packages">
        <div class="container">
            <div class="row popular-packages">
                <div class="col-12 ">

                    <ul class="nav nav-pills flex-nowrap overflow-x-scroll package-list-details-nav mb-3 rounded-1 border  "
                        id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link position-relative rounded-1 active text-nowrap" id="tab1-tab"
                                data-bs-toggle="pill" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1"
                                aria-selected="true">Included in Packages</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link position-relative rounded-1 text-nowrap" id="tab2-tab"
                                data-bs-toggle="pill" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2"
                                aria-selected="false" tabindex="-1">Excluded in
                                Packages</button>
                        </li>

                    </ul>
                </div>
                <div class="col-12 ">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab"
                            tabindex="0">
                            {!! $data['packageDetail']->include_detail!!}
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab" tabindex="0">
                            {!! $data['packageDetail']->excluded_detail!!}
                        </div>
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab" tabindex="0">
                            {!! $data['packageDetail']->term_condition!!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12">
                    <form class="row g-3 mt-3 fill-pic-info">

                        <div class="col-12 col-lg-6">
                            <!-- ================ Add on Services ============= -->
                            <h5 class="fs-16 fw-bold mb-3">Add on Services</h5>
                            <div class="form-check d-flex mb-2 align-items-lg-center">
                                <input class="form-check-input border-dark" type="checkbox" value="" id="assuredLuggage">
                                <label class="form-check-label ms-3" for="assuredLuggage">
                                    Assured luggage space (either carrier or boot space) for Free
                                </label>
                            </div>
                            <div class="form-check mb-2  d-flex align-items-lg-center">
                                <input class="form-check-input border-dark" type="checkbox" value="" id="petAllowed">
                                <label class="form-check-label ms-3" for="petAllowed">
                                    Pet Allowed for Rs. 300
                                </label>
                            </div>

                            <h5 class="fs-16 fw-bold my-4">Payment Mode</h5>
                            <div class="form-check mb-2 d-flex align-items-lg-center">
                                <input class="form-check-input border-dark" type="radio" name="payment_mode"
                                    id="flexRadioDefault1" value="10">
                                <label class="form-check-label ms-3" for="flexRadioDefault1">
                                    Pay 10% minimum amount of your booking. </label>
                            </div>
                            <div class="form-check mb-2 d-flex align-items-lg-center">
                                <input class="form-check-input border-dark" type="radio" name="payment_mode"
                                    id="flexRadioDefault2" value="100">
                                <label class="form-check-label ms-3" for="flexRadioDefault2">
                                    Pay 100% amount of your booking. </label>
                            </div>
                            {{-- <div class="form-check mb-2 d-flex align-items-lg-center">
                                <input class="form-check-input border-dark" type="radio" name="payment_mode"
                                    id="flexRadioDefault2" checked value="pay_later">
                                <label class="form-check-label ms-3" for="flexRadioDefault2">
                                    Pay later amount of your booking.
                                </label>
                            </div> --}}
                            <div class="row mt-3 gy-3">
                                <div class="col-12">
                                    <h5 class="fs-16 fw-bold my-1">Personal Information</h5>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" class="form-control fw-semibold" id="name" placeholder="Enter Name">
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="text" class="form-control fw-semibold" id="mobile_no"
                                        placeholder="Enter Mobile Number">
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="email" class="form-control fw-semibold" id="email"
                                        placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="accordion mt-3" id="accordionExample">

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
                                                    <input type="text" class="form-control fw-semibold" id="billingName"
                                                        placeholder="Enter Name">
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <input type="text" class="form-control fw-semibold"
                                                        id="billingGstNumber" placeholder="Enter GST Number">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- <div class="row mt-3 gy-3">
                                <div class="col-12">
                                    <div class="form-check mb-3 d-flex align-items-center">
                                        <input class="form-check-input border-dark" type="checkbox" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label ms-3 fw-bold text-dark" for="flexRadioDefault2">
                                            Billing Information
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">

                                </div>
                                <div class="col-12 col-md-6">

                                </div>
                            </div> -->
                        </div>
                        <div class="col-1 text-center d-none d-lg-block">
                            <div class="vr h-100"></div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class=" ">
                                <h5 class="fs-16 fw-bold my-4 text-gray">Travel Details</h5>

                                <div class="row  ">
                                    <div class="col-6  ">
                                        <strong class="mb-2 d-block">
                                            <img src=" https://cabyatra.com/public//web/assets/images/icons/car-icon.png"
                                                alt="car icon" height="20" width="20">
                                            Selected Car
                                        </strong>
                                        <input type="hidden" id="carCategoryId" value="{{$data['carCategoryId']}}">
                                        <p class="ms-4 text-gray">{{$data['cars']}} or Similar cars</p>
                                    </div>
                                    <div class="col-6  ">
                                        <strong class="mb-2 d-block">
                                            <img src=" https://cabyatra.com/public//web/assets/images/icons/pickup-location.png"
                                                alt="Pickup location" height="20" width="20">
                                            Pick Up Location
                                        </strong>
                                        <input type="hidden" id="pickUpLocation" value="{{$data['pickUpLoac']}}">
                                        <p class="ms-4 text-gray">{{$data['pickUpLoac']}}</p>
                                    </div>
                                    <div class="col-6">
                                        <strong class="mb-2 d-block">
                                            <img src=" {{ env('ASSET_URL') }}assets/images/icons/date-icon.png"
                                                alt="date iocn" height="20" width="20">

                                            Start Date
                                        </strong>
                                        <input type="hidden" id="travelDate" value="{{$data['date']}}">
                                        <p class="ms-4 text-gray">{{$data['date']}}</p>

                                    </div>
                                    <div class="col-6  ">
                                        <strong class="mb-2 d-block">
                                            <img src=" https://cabyatra.com/public//web/assets/images/icons/pickup-location.png"
                                                alt="Pickup location" height="20" width="20">
                                            Drop Up Location
                                        </strong>
                                        <input type="hidden" id="" value=" ">
                                        <p class="ms-4 text-gray"> </p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="accordion" id="accordionExample">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button bg-transparent collapsed p-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                        aria-controls="collapseOne">
                                        <h5 class="fs-14 mb-0 fw-bold">Have Coupon ?</h5>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse  "
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row coupon">
                                            <div class="col-12">
                                            <input type="text" class="form-control fw-semibold" id="formGroupExampleInput"
                                            placeholder="Enter Coupon Code" id="coupon">
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


                        </div> -->
                            <!-- <div class="row ">
                                <div class="col-12">`
                                    <h5 class="fs-16 mb-3 fw-bold">Have Coupon ?</h5>

                                </div>
                                <div class="col-6 col-md-4">
                                    <label for="formGroupExampleInput" class="form-label fw-semibold fs-5">Apply
                                        Coupon</label>
                                </div>
                                <div class="col-6 col-md-6">

                                </div>
                            </div> -->
                            <div class="col-12 text-center ">
                                <input type="hidden" id="defaultFair" value="{{$data['packageDetail']->price}}">
                                <button type="button" class="btn bg-green w-50 text-white rounded-pill" id="payBtn">Pay
                                    ₹<span id="packageFair">
                                        {{$data['packageDetail']->price}}</span></button>
                            </div>
                            <span class="text-center d-block">5% GST Charges Included This Fair<span>₹ 50</span></span>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= Modal of pick location and date & time ===================== -->
    <!-- Button trigger modal -->

    <input type="hidden" id="tour_id" value="{{$data['tour_id']}}">
    <!-- Modal -->
    <div class="modal fade" id="package-list-details" tabindex="-1" aria-labelledby="package-list-detailsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! $data['packageDetail']->tour_details!!}
                </div>
            </div>
        </div>

    </div>
    </section>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Your Booking Confirmed!</h3>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#petAllowed').on("click", function () {
                var defaultFair = $('#defaultFair').val();
                if ($('#petAllowed').is(":checked")) {
                    var addPetCost = parseInt(defaultFair) + parseInt(300);
                    console.log(addPetCost);
                    $('#packageFair').html(addPetCost);
                } else {
                    $('#packageFair').html(defaultFair);
                }
            });

            $('#payBtn').on("click", function () {
                var isPet = $('#petAllowed').is(":checked") ? '1' : '0';
                var assuredLuggage = $('#assuredLuggage').is(":checked") ? '1' : '0';

                var payment_mode = $('input[name="payment_mode"]:checked').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var mobile = $('#mobile_no').val();
                var gstName = $('#billingName').val();
                var gstNo = $('#billingGstNumber').val();
                var carCategoryId = $('#carCategoryId').val();
                var pickUpLocation = $('#pickUpLocation').val();
                var travelDate = $('#travelDate').val();
                var coupon = $('#coupon').val();
                var totalFair = $('#packageFair').html();
                var tour_id = $('#tour_id').val();

                if (name && email && mobile && carCategoryId && pickUpLocation && travelDate && payment_mode) {
                    console.log(name, email, mobile, gstName, carCategoryId, pickUpLocation, travelDate, payment_mode, gstNo);
                    if (payment_mode != '1') {
                        var totalFair = (totalFair * 10) / 100;
                    }

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
                        success: function (res) {
                            var options = {
                                "key": "rzp_test_2APbUBB8GPokeh",
                                "currency": "INR",
                                "name": name,
                                "email": email,
                                "phone": mobile,
                                "image": "https://cabyatra.com/public/admin/assets/images/admin_logo.png",
                                "order_id": res.order_no,
                                "handler": function (response) {
                                    console.log(response);
                                    // $('#razorpay_paymentId').val(response.razorpay_payment_id);
                                    var data = {
                                        'name': name,
                                        'email': email,
                                        'mobile': mobile,
                                        'gstName': gstName,
                                        'gstNo': gstNo,
                                        'add_onService': {
                                            'isPet': isPet,
                                            'assuredLuggage': assuredLuggage,
                                        },
                                        'carCategoryId': carCategoryId,
                                        'pickUpLocation': pickUpLocation,
                                        'travelDate': travelDate,
                                        'coupon': coupon,
                                        'payment_mode': payment_mode,
                                        'totalFair': totalFair,
                                        'tour_id': tour_id,
                                        'razorpay_paymentId': response.razorpay_payment_id,
                                    }
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        url: "{{route('tourPackageBooking')}}",
                                        method: "POST",
                                        data: data,
                                        success: function (res) {
                                            console.log(res);
                                            if (res.status == true) {
                                                $("#staticBackdrop").modal('show');
                                                setTimeout(function () {
                                                    window.location.href = "https://cabyatra.com/";
                                                }, 2000);
                                            }
                                        }
                                    });
                                },
                                "modal": {
                                    "ondismiss": function () {
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
                    Swal.fire({
                        title: "Invalid Request?",
                        text: "Please fill all required filled!",
                        icon: "error"
                    });
                }


            });
        });
    </script>
@endsection