@extends('web.layout.layout')
@section('content')
<style>
    .current_location:hover {
        transform: scale(1.3);
    }

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
                                    class="nav-link text-center rounded-pill text-dark w-100 d-flex align-items-center justify-content-center"
                                    style="height:50px;">OutStation</a>
                            </li>
                            <li class="nav-item flex-grow-1 rounded-pill">
                                <a href="{{route('tourPackage')}}"
                                    class="nav-link text-center rounded-pill w-100 active d-flex align-items-center justify-content-center"
                                    style="height:50px;">Tour Packages</a>
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
        <div class="row mb-4 justify-content-center ">
            <div class="col-md-8">
                <form class="d-flex rounded-pill tour-package-search  " role="search">
                    <input class="form-control bg-transparent border-0 me-2" type="search"
                        placeholder="Search Tour Packages" aria-label="Search">
                    <button class="btn btn-outline-success border-0 me-2" type="submit">
                        <img src="{{ env('ASSET_URL') }}assets/images/icons/search-icon.png" alt="Pickup location"
                            height="20" width="20">
                    </button>
                </form>
            </div>
        </div>
        <div class="row gx-lg-5 gy-5">
            @foreach($data['tourPackage'] as $key => $value)
                <div class="col-12 col-md-4" onclick="getPackageId({{$value->id}})">
                    <div class="tour-packege-price position-relative rounded-4 overflow-hidden" data-bs-toggle="modal"
                        data-bs-target="#searchCabeModal">
                        <img src="{{$value->image}}" alt="rishikesh" class="img-fluid rounded-4 ">
                        <div
                            class="tour-title-and-price d-flex position-absolute bottom-0 align-items-center justify-content-between px-3">
                            <span class="text-white">{{$value->name}}</span>
                            <span class="text-white">Rs. {{$value->price}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ========================= Modal of pick location and date & time ===================== -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="searchCabeModal" tabindex="-1" aria-labelledby="searchCabeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('tourPackageDetail', ['slug' => 'ertyuio'])}}" method="POST" id="tourform">
                        @csrf

                        <input type="hidden" name="tour_id" id="tour_id">

                        <div class="container">
                            <div class="row gy-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center  ps-3 bg-green-light rounded-pill">
                                        <select class="form-select  bg-transparent border-0 fs-14"
                                            aria-label="Default select example" name="carCategory_id" required>
                                            <option selected disabled value="">Select Car</option>
                                            @foreach($data['CarCategory'] as $key => $cName)
                                                <option value="{{$cName->id}}">{{$cName->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center  ps-3 bg-green-light rounded-pill">
                                        <img src="{{ env('ASSET_URL') }}assets/images/icons/location-black.png"
                                            alt="location" height="18" width="18">
                                        <input type="text" class="form-control ps-1 bg-transparent border-0 fs-14"
                                            placeholder="Enter Pickup Location" name="location" id="pickup_location">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-geo-fill mx-2 current_location"
                                            style="cursor: pointer;" viewBox="0 0 16 16" onclick="getLocation()">
                                            <path fill-rule="evenodd"
                                                d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="d-block d-md-none">Select Date</label>
                                    <div class="bg-green-light rounded-pill position-relative ">
                                        <input type="date" id="boking-date"
                                            class="form-control bg-transparent border-0 text-green fs-14 " name="date">
                                        <label for="boking-date" class="calendar-icon d-block d-md-none"
                                            style="right:9px; top:12px;">📅</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <a type="button" class="btn btn-primary rounded-pill w-50 bg-green border-0" id="findPackage">Find
                        Package Cab</a>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    $(document).ready(function () {
        $('#findPackage').on("click", function () {
            $('#tourform').submit();
        });
    });

    function getPackageId(id) {
        $('#tour_id').val(id);
    }

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
        const apiKey = 'AIzaSyDhTJHj8fT_dHJMkH0ndpW0guo4EQzXhHY';
        const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${apiKey}`;

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'OK') {
                    const address = getAddress(data.results[0].formatted_address);
                    console.log(data);
                    $('#pickup_location').val(address);
                    $('#pickup_location').val(data.results[0].formatted_address);
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
</script>
@endsection