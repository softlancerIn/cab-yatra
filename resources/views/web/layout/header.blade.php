<style>
    header .navbar {
        height: auto
    }

    #navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 99;
        background-color: #000;
    }

    #navbar.sticky {
        animation: stickyMenu 0.75s ease-in-out;
        background: #000;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        z-index: 120;

    }


    @keyframes stickyMenu {
        0% {
            margin-top: -120px;
            opacity: 0;
        }

        50% {
            margin-top: -64px;
            opacity: 0;
        }

        100% {
            margin-top: 0px;
            opacity: 1;
        }
    }

    @media (max-width: 620px) {
        header .navbar {
            height: 67px;
            position: relative;
        }

        header .navbar.sticky::after {
            display: none;
        }
    }
</style>
<header>

    <nav class="navbar navbar-expand-lg   d-block d-md-none " id="navbar">
        <div class="container justify-content-center">
            <a class="navbar-brand text-white me-0 text-center py-0 fw-bold  " href="{{route('home')}}"
                style="font-size:35px">
                Cab <span class="text-green ">Yatra</span>
            </a>

            <ul class="navbar-nav ms-auto flex-row  mb-lg-0">
                <li class="nav-item mb-0 me-2">
                    <a class="nav-link text-dark fs-14 bg-green p-2 rounded-circle " href="tel:+91 9911995523">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff"
                            class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                        </svg>

                    </a>
                </li>
                <li class="nav-item mb-0 me-2 ">
                    <a class="nav-link text-dark fs-14 bg-green p-2 rounded-circle "
                        href="https://api.whatsapp.com/send/?phone=+91 9911995523&text=Hello%20I%20Want%20Cab+&type=phone_number&app_absent=0">

                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff"
                            class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path
                                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fs-14 bg-green p-2 rounded-circle"
                        href="mailto:cabyatrabooking@gmail.com">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff"
                            class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                        </svg>

                    </a>
                </li>

            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg bg-black d-none d-md-block">
        <div class="container justify-content-center">
            <a class="navbar-brand text-white me-0 text-center py-0 fw-bold " href="{{route('home')}}"
                style="font-size:35px">
                Cab <span class="text-green ">Yatra</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto d-none d-lg-flex mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="tel:">
                            <img src="{{ env('ASSET_URL') }}/assets/images/icons/phone.png" alt="phone" height="25"
                                width="25" class="img-fluid">
                            +91 9911995523
                        </a>
                    </li>
                    <li class="nav-item  d-none">
                        <a class="nav-link text-white"
                            href="https://api.whatsapp.com/send/?phone=9911995523&text=Hi%20Tekniko%20Global+&type=phone_number&app_absent=0">
                            <img src="{{ env('ASSET_URL') }}assets/images/icons/whatsapp.png" alt="phone" height="25"
                                width="25" class="img-fluid">

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="mailto:">
                            <img src="{{ env('ASSET_URL') }}/assets/images/icons/mail.png" alt="mail" height="25"
                                width="25" class="img-fluid">
                            cabyatrabooking@gmail.com
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
</header>
<script>
    let nav = document.querySelector("#navbar");
    window.onscroll = function () {
        if (document.documentElement.scrollTop > 20) {
            nav.classList.add("sticky");
        } else {
            nav.classList.remove("sticky");
        }
    }

</script>