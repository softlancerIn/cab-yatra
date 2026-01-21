<style>
    a {
        text-decoration: none;
    }

    .accordion-button::after {
        filter: invert(1);
    }

    .float {
        position: fixed;
        width: 45px;
        height: 45px;
        bottom: 40px;
        right: 20px;
        background-color: #00a743;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        animation-name: pulse;
        animation-duration: 1.5s;
        animation-timing-function: ease-out;
        animation-iteration-count: infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 167, 67, 0.9);
        }

        80% {
            box-shadow: 0 0 0 10px rgba(0, 167, 67, 0.87);
        }
    }

    .float.call {
        bottom: 110px;
        background-color: #00a743;
    }

    .footer a.navbar-brand {
        font-size: 35px;
    }

    @media (max-width:767px) {
        .footer {
            padding-top: 0;
        }

        .footer a.navbar-brand {
            font-size: 45px;
        }

    }
</style>
<footer class="footer ">
    <a href="https://api.whatsapp.com/send/?phone=+91 9911995523&amp;text=Hi%20Cab%20Yatra+&amp;type=phone_number&amp;app_absent=0"
        class="float text-white" target="_blank" aria-label="Contact us on WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 448 512" width="20" height="20">
            <path
                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
            </path>
        </svg>
    </a>
    <a href="tel:+91-9911995523" class="call float text-white" aria-label="Call us now">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 512 512" width="20" height="20">
            <path
                d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z">
            </path>
        </svg>
    </a>
    <div class="container">
        <div class="row gy-3 gy-md-0 my-3 justify-content-between flex-column-reverse flex-lg-row">

            <div class="col-12 col-lg-6">
                <p class="text-white">CabYatra.com is an Indian travel platform offering affordable, reliable cab
                    services for outstation trips, Char Dham Yatra, and city rides. It provides 24/7 support,
                    professional drivers, and customizable tour packages. Users can book one-way or round-trip rides
                    across India.</p>
            </div>
            <div class="col-12 col-lg-5">
                <div
                    class="text-center rounded-start-5 d-flex flex-column-reverse flex-column flex-lg-row  align-items-center justify-content-end bg-white p-3">
                    <ul class="nav flex-lg-column">
                        <li class="">
                            <a href="#">
                                <img src="https://cabyatra.com/public/web/assets/images/img/playstore.png"
                                    alt="playstore btn" width="150" class="img-fluid" width="200">
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <img src="https://cabyatra.com/public/web/assets/images/img/app-store.png"
                                    alt="app store" width="150" class="img-fluid" width="200">
                            </a>
                        </li>
                    </ul>
                    <a class="navbar-brand text-black me-0 text-center ms-lg-5 py-0 fw-bold "
                        href="https://cabyatra.com">
                        Cab <span class="text-green ">Yatra</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row gy-3 gy-md-0">
            <hr class="border border-light mb-5 opacity-100">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="mb-0 important-links  ">
                    <h5 class="text-white mb-3">Contact Us</h5>
                    <ul class="ps-0">
                        <!-- <li class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-phone text-white me-1" viewBox="0 0 16 16">
                                <path
                                    d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            </svg>
                            <a href="tel:9911995523" class="text-white">+91 9911995523</a>
                        </li> -->
                        <li class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-phone text-white me-1" viewBox="0 0 16 16">
                                <path
                                    d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            </svg>
                            <a href="tel:9911995523" class="text-white">+91 9911995523</a>
                        </li>
                        <li class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi text-white bi-whatsapp me-1" viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                            </svg>
                            <a href="tel:9911995523" class="text-white"> +91 9911995523</a>
                        </li>
                        <li class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi text-white me-1 bi-envelope-fill" viewBox="0 0 16 16">
                                <path
                                    d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                            </svg>
                            <a href="mailto:cabyatrabooking@gmail.com" class="text-white">cabyatrabooking@gmail.com</a>
                        </li>
                        <!-- <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi me-1 text-white bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                            </svg>
                            <a href="#" class="text-white">Ghaziabad</a>
                        </li> -->
                    </ul>
                </div>
            </div>


            <div class="col-6 col-md-4 col-lg-3">
                <ul class="important-links ps-0">
                    <h5 class="text-white mb-3">Quick Links</h5>
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                    <li class="mb-2"><a href="{{ route('master_function', ['slug' => 'about-us']) }}"
                            class="text-white">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('master_function', ['slug' => 'term-condition']) }}"
                            class="
                            text-white">Terms
                            & Condition</a></li>
                    <li class="mb-2"><a href="{{ route('master_function', ['slug' => 'privacy-policy']) }}"
                            class="
                            text-white">Privacy Policy</a></li>
                    <li class="mb-2"><a href="{{ route('master_function', ['slug' => 'faq']) }}"
                            class="Ttext-white">Faq</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <ul class="important-links ps-0">
                    <h5 class="text-white mb-3">Our Services</h5>
                    <li class="mb-2"><a href="" class="text-white">Car Hire</a></li>
                    <li class="mb-2"><a href="" class="text-white"> Car Rentals</a></li>
                    <li class="mb-2"><a href="" class="text-white">Outstation Cabs</a></li>
                    <li class="mb-2"><a href="" class="text-white">One Way Cabs</a></li>
                    <li class="mb-2"><a href="" class="text-white">Multi Cities Tour Package</a></li>
                    <li class="mb-2"><a href="" class="text-white">Bus Hire</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4 col-lg-3 d-none">
                @php
                    $data['footerLink_category'] = App\Models\FooterLinkCategory::with('footerLnk')
                        ->where('status', '1')
                        ->orderBy('id', 'DESC')
                        ->get();
                @endphp
                @foreach ($data['footerLink_category'] as $lnk)
                    <ul class="important-links ">
                        <h5 class="text-white mb-3">{{ $lnk->name }}</h5>
                        @foreach ($lnk->footerLnk as $sublnk)
                            <li class="mb-2"><a href="{{ route('master_function', ['slug' => $sublnk->slug]) }}"
                                    class="text-green">{{ $sublnk->url_name }}</a></li>
                        @endforeach

                    </ul>
                @endforeach
            </div>
            <div class="col-12">
                <ul class="important-links ps-0">
                    <h5 class="text-white text-center text-md-start mb-3">Social Links</h5>
                    <li class="d-flex align-items-center justify-content-around justify-content-md-start">
                        <a href="mailto:cabyatra6244@gmail.com" class="me-md-2">
                            <img src="{{ env('ASSET_URL') }}assets/images/icons/masages.png" alt=""
                                height="40" width="40">
                        </a>
                        <a href="https://www.facebook.com/share/15gpYtg4uG/" class="me-md-2">
                            <img src="{{ env('ASSET_URL') }}assets/images/icons/fab.png" alt=""
                                height="40" width="40">
                        </a>
                        <a href="https://www.instagram.com/cabyatra/" class="me-md-2">
                            <img src="{{ env('ASSET_URL') }}assets/images/icons/instagram.png" alt=""
                                height="40" width="40">
                        </a>
                        <a href="#" class="me-md-2">
                            <img src="{{ env('ASSET_URL') }}assets/images/icons/tweeter-x.png" alt=""
                                height="40" width="40">
                        </a>

                        <a href="https://youtube.com/@@cab_yatra?si=McK1kKHooacIz6wd"
                            style="border:1px solid #fcc51d" class="rounded me-md-2">
                            <img src="{{ env('ASSET_URL') }}assets/images/icons/youtube.png" alt=""
                                height="40" width="40">
                        </a>


                    </li>
                </ul>
            </div>
            <!-- ========================================================== Destination Link =================================================================== -->
            <div class="col-12 mt-3">
                <hr class="border border-light opacity-100">
                <h2 class=" fs-6 text-center text-white">One way Cab | Car Rental | Airport Taxi | Local Sightseeing |
                    Innova | Tempo Traveller | Pet Friendly Cab | Bus</h2>
                <hr class="border border-light opacity-100">
                <div class="row ">
                    @php
                        $data['footerLink_category'] = App\Models\FooterLinkCategory::with('footerLnk')
                            ->where('status', '1')
                            ->orderBy('id', 'DESC')
                            ->get();
                    @endphp
                    @foreach ($data['footerLink_category'] as $lnk)
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="accordion accordion-flush" id="accordionFlushExample{{ $lnk->id }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button py-1 collapsed" type="button"
                                            style="background-color: black;color:white;" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne{{ $lnk->id }}"
                                            aria-expanded="false"
                                            aria-controls="flush-collapseOne{{ $lnk->id }}">
                                            {{ $lnk->name }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne{{ $lnk->id }}"
                                        class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample{{ $lnk->id }}"
                                        style="background-color: black;">
                                        <div class="accordion-body">
                                            @foreach ($lnk->footerLnk as $sublnk)
                                                <li class="mb-2 d-flex ">
                                                    <svg width="30px" height="30px" viewBox="0 0 32 32"
                                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#00A743"
                                                        stroke="#00A743" stroke-width="0.00032">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="icomoon-ignore"> </g>
                                                            <path
                                                                d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z"
                                                                fill="#00A743"> </path>
                                                        </g>
                                                    </svg>
                                                    <a href="{{ route('master_function', ['slug' => $sublnk->slug]) }}"
                                                        class="text-green">{{ $sublnk->url_name }}</a>
                                                </li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- ======none ====== -->
            </div>
            <div class="col-12 mt-3">
                <p class="mb-0 fs-12 text-center text-white">Copyright ©
                    <span id="yearFooter"> </span>. Taxi services
                    pvt ltd  All right reserved.
                </p>
                <script>
                    document.getElementById("yearFooter").textContent = new Date().getFullYear();
                </script>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });

        document.addEventListener('keydown', function(event) {

        });
    </script>
</footer>
