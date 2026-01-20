<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cabyatra.com/public/web/assets/css/style.css" />
</head>

<body>
    <section>
        <div class="container">
            <div class="row p-0">
                <div class="card text-center border-0 p-0">
                    <div class="card-body p-0">
                        <h5 class="card-title">Your Ride is Confirmed!</h5>

                        <img src="https://cdn-icons-png.flaticon.com/512/7804/7804371.png" alt="" class="img-fluid" />

                        <h3 class="mb-5">Sit Back & Enjoy the Journey</h3>

                        <table class="table table-secondary border-5 border-bottom border-light">
                            <tbody>
                                @php
                                    $trip_SubType = '';
                                    $tax = '';
                                    if ($data['type'] == '0' && $data['subType'] == '3' && $data['is_airpotToFrom'] == '') {
                                        $trip_SubType = 'Local';
                                        $tax = 'Toll, state tax, parking extra';
                                    } elseif ($data['type'] == '1' && $data['subType'] == '0' && $data['is_airpotToFrom'] == '') {
                                        $trip_SubType = 'Round Trip';
                                        $tax = 'Toll, state tax, parking extra';
                                    } elseif ($data['type'] == '1' && $data['subType'] == '1' && $data['is_airpotToFrom'] == '') {
                                        $trip_SubType = 'One Way';
                                        $tax = 'Toll, state tax include and parking extra';
                                    } else {
                                        $trip_SubType = 'Airport';
                                        $tax = 'Toll, state tax include and parking extra.';
                                    }
                                @endphp

                                <tr>
                                    <th class="text-start p-3">Pick Up Location:</th>
                                    @if(is_array($data['pickUpLoc']))
                                        <td class="text-start p-3">
                                            @foreach ($data['pickUpLoc'] as $item1)
                                                <span>{{$item1}},</span>
                                            @endforeach
                                        </td>
                                    @else
                                        <td class="text-start">{{$data['pickUpLoc']}}</td>
                                    @endif
                                </tr>

                                @if($trip_SubType != 'Local')
                                    <tr>
                                        <th class="text-start p-3">Drop Location:</th>
                                        @if(is_array($data['destinationLoc']))
                                            <td class="text-start p-3">
                                                @foreach ($data['destinationLoc'] as $item1)
                                                    <span>{{$item1}},</span>
                                                @endforeach
                                            </td>
                                        @elseif(is_array(json_decode($data['destinationLoc'])))
                                            <td class="text-start p-3">
                                                @foreach (json_decode($data['destinationLoc']) as $item1)
                                                    <span>{{$item1}},</span>
                                                @endforeach
                                            </td>
                                        @else
                                            <td class="text-start">{{$data['destinationLoc']}}</td>
                                        @endif
                                    </tr>
                                @endif
                                <tr>
                                    <th class="text-start p-3">Pick Up Timing</th>
                                    <td class="text-start p-3">
                                        {{$data['pickUp_time'] ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start p-3">Include K/m</th>
                                    <td class="text-start p-3">
                                        {{$data['include_km'] ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start p-3">Extra Per K/m</th>
                                    <td class="text-start p-3">
                                        {{$data['extra_fair_perKm'] ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start p-3">Paid Amount</th>
                                    <td class="text-start p-3">
                                        {{number_format($data['online_payment'], 2, '.', ',')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start p-3">Running Bailance</th>
                                    <td class="text-start p-3">
                                        {{number_format($data['offline_payment'], 2, '.', ',')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start p-3">Trip Type</th>
                                    <td class="text-start p-3">{{$data['type'] == '1' ? 'Out Station' : 'Local'}}</td>
                                </tr>
                                <tr>
                                    <th class="text-start p-3">Trip SubType</th>
                                    <td class="text-start p-3">{{$trip_SubType}}</td>
                                </tr>
                                <tr>
                                    <th class="text-start p-3">Other Details</th>
                                    <td class="text-start p-3">{{$tax}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-start px-2">
                        <strong>Note:</strong> You will get cab and driver information 2
                        hours before starting the journey via Whatsapp or Message.
                    </p>

                    <!-- <a class="navbar-brand text-dark me-0   py-0 fw-bold  " href="https://cabyatra.com" style="font-size:35px">
            Cab<span class="text-green ">Yatra.com</span>
          </a> -->
                    <div class="card-footer py-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <div>
                                <img src="https://cdn-icons-png.freepik.com/512/7678/7678795.png"
                                    class="img-fluid rounded-top" alt="" height="40" width="40" />
                            </div>
                            <p class="mb-0 ms-3">
                                <a href="tel:+91 9911995523">9911995523</a>
                            </p>
                        </div>
                    </div>
                    <div class="py-5" style="background-color: #efefef">
                        <strong>Follow Us On</strong>
                        <div class="d-flex align-items-center justify-content-around mt-4">
                            <div class="p-3 border border-dark rounded-circle">
                                <a href="#"><svg fill="#4caf50" height="40px" width="40px" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 308 308" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g id="XMLID_468_">
                                                <path id="XMLID_469_"
                                                    d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156 c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687 c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887 c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153 c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348 c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802 c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922 c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0 c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458 C233.168,179.508,230.845,178.393,227.904,176.981z">
                                                </path>
                                                <path id="XMLID_470_"
                                                    d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716 c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396 c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188 l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677 c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867 C276.546,215.678,222.799,268.994,156.734,268.994z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div class="p-3 border border-dark rounded-circle">
                                <a href=""><svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        height="40px" width="40px">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <rect x="2" y="2" width="28" height="28" rx="6"
                                                fill="url(#paint0_radial_87_7153)"></rect>
                                            <rect x="2" y="2" width="28" height="28" rx="6"
                                                fill="url(#paint1_radial_87_7153)"></rect>
                                            <rect x="2" y="2" width="28" height="28" rx="6"
                                                fill="url(#paint2_radial_87_7153)"></rect>
                                            <path
                                                d="M23 10.5C23 11.3284 22.3284 12 21.5 12C20.6716 12 20 11.3284 20 10.5C20 9.67157 20.6716 9 21.5 9C22.3284 9 23 9.67157 23 10.5Z"
                                                fill="white"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M16 21C18.7614 21 21 18.7614 21 16C21 13.2386 18.7614 11 16 11C13.2386 11 11 13.2386 11 16C11 18.7614 13.2386 21 16 21ZM16 19C17.6569 19 19 17.6569 19 16C19 14.3431 17.6569 13 16 13C14.3431 13 13 14.3431 13 16C13 17.6569 14.3431 19 16 19Z"
                                                fill="white"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6 15.6C6 12.2397 6 10.5595 6.65396 9.27606C7.2292 8.14708 8.14708 7.2292 9.27606 6.65396C10.5595 6 12.2397 6 15.6 6H16.4C19.7603 6 21.4405 6 22.7239 6.65396C23.8529 7.2292 24.7708 8.14708 25.346 9.27606C26 10.5595 26 12.2397 26 15.6V16.4C26 19.7603 26 21.4405 25.346 22.7239C24.7708 23.8529 23.8529 24.7708 22.7239 25.346C21.4405 26 19.7603 26 16.4 26H15.6C12.2397 26 10.5595 26 9.27606 25.346C8.14708 24.7708 7.2292 23.8529 6.65396 22.7239C6 21.4405 6 19.7603 6 16.4V15.6ZM15.6 8H16.4C18.1132 8 19.2777 8.00156 20.1779 8.0751C21.0548 8.14674 21.5032 8.27659 21.816 8.43597C22.5686 8.81947 23.1805 9.43139 23.564 10.184C23.7234 10.4968 23.8533 10.9452 23.9249 11.8221C23.9984 12.7223 24 13.8868 24 15.6V16.4C24 18.1132 23.9984 19.2777 23.9249 20.1779C23.8533 21.0548 23.7234 21.5032 23.564 21.816C23.1805 22.5686 22.5686 23.1805 21.816 23.564C21.5032 23.7234 21.0548 23.8533 20.1779 23.9249C19.2777 23.9984 18.1132 24 16.4 24H15.6C13.8868 24 12.7223 23.9984 11.8221 23.9249C10.9452 23.8533 10.4968 23.7234 10.184 23.564C9.43139 23.1805 8.81947 22.5686 8.43597 21.816C8.27659 21.5032 8.14674 21.0548 8.0751 20.1779C8.00156 19.2777 8 18.1132 8 16.4V15.6C8 13.8868 8.00156 12.7223 8.0751 11.8221C8.14674 10.9452 8.27659 10.4968 8.43597 10.184C8.81947 9.43139 9.43139 8.81947 10.184 8.43597C10.4968 8.27659 10.9452 8.14674 11.8221 8.0751C12.7223 8.00156 13.8868 8 15.6 8Z"
                                                fill="white"></path>
                                            <defs>
                                                <radialGradient id="paint0_radial_87_7153" cx="0" cy="0" r="1"
                                                    gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(12 23) rotate(-55.3758) scale(25.5196)">
                                                    <stop stop-color="#B13589"></stop>
                                                    <stop offset="0.79309" stop-color="#C62F94"></stop>
                                                    <stop offset="1" stop-color="#8A3AC8"></stop>
                                                </radialGradient>
                                                <radialGradient id="paint1_radial_87_7153" cx="0" cy="0" r="1"
                                                    gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(11 31) rotate(-65.1363) scale(22.5942)">
                                                    <stop stop-color="#E0E8B7"></stop>
                                                    <stop offset="0.444662" stop-color="#FB8A2E"></stop>
                                                    <stop offset="0.71474" stop-color="#E2425C"></stop>
                                                    <stop offset="1" stop-color="#E2425C" stop-opacity="0"></stop>
                                                </radialGradient>
                                                <radialGradient id="paint2_radial_87_7153" cx="0" cy="0" r="1"
                                                    gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(0.500002 3) rotate(-8.1301) scale(38.8909 8.31836)">
                                                    <stop offset="0.156701" stop-color="#406ADC"></stop>
                                                    <stop offset="0.467799" stop-color="#6A45BE"></stop>
                                                    <stop offset="1" stop-color="#6A45BE" stop-opacity="0"></stop>
                                                </radialGradient>
                                            </defs>
                                        </g>
                                    </svg></a>
                            </div>
                            <div class="p-3 border border-dark rounded-circle">
                                <a href=""><svg fill="#1877f2" height="40px" width="40px" viewBox="0 0 512 512"
                                        id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M480,257.35c0-123.7-100.3-224-224-224s-224,100.3-224,224c0,111.8,81.9,204.47,189,221.29V322.12H164.11V257.35H221V208c0-56.13,33.45-87.16,84.61-87.16,24.51,0,50.15,4.38,50.15,4.38v55.13H327.5c-27.81,0-36.51,17.26-36.51,35v42h62.12l-9.92,64.77H291V478.66C398.1,461.85,480,369.18,480,257.35Z"
                                                fill-rule="evenodd"></path>
                                        </g>
                                    </svg></a>
                            </div>
                            <div class="p-3 border border-dark rounded-circle">
                                <a href=""><svg viewBox="0 0 24 24" height="40px" width="40px" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M8 8H16M8 12H13M7 16V21L12 16H20V4H4V16H7Z" stroke="#000000"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </g>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>