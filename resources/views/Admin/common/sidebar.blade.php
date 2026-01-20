<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{$active == 'dashboard' ? 'active' : ''}}" href="{{route('dashboard')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Master</li>
        <li
            class="nav-item {{($active == 'cars' || $active == 'package' || $active == 'car_category') ? 'active' : ''}}">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Master</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{($active == 'cars' || $active == 'package' || $active == 'car_category' || $active == 'local_airport_fair') ? 'show' : ''}}"
                id="ui-basic">
                <ul class="nav flex-column sub-menu ">
                    <li class="nav-item"> <a href="{{route('car_list')}}"
                            class="nav-link {{$active == 'cars' ? 'active' : ''}}">Cars</a></li>
                    <li class="nav-item"> <a href="{{route('packages')}}"
                            class="nav-link {{$active == 'package' ? 'active' : ''}}">Packages</a></li>
                    <li class="nav-item"> <a href="{{route('carCategory.index')}}"
                            class="nav-link {{$active == 'car_category' ? 'active' : ''}}">Car Category (Round Trip)</a>
                    </li>
                    <li class="nav-item"> <a href="{{route('onewayAirportFairList')}}"
                            class="nav-link {{$active == 'local_airport_fair' ? 'active' : ''}}">Oneway & Airport
                            Fair</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{(($active == 'local_package') || ($active == 'time_schadule')) ? 'active' : ''}}">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Local</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{(($active == 'local_package') || ($active == 'time_schadule')) ? 'show' : ''}}"
                id="form-elements">
                <ul class="nav flex-column sub-menu ">
                    <li class="nav-item"> <a href="{{route('localpackage.index')}}" class="nav-link">Local Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('time.index')}}">Time</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('timeschadule.index')}}">Time Schadule</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{$active == 'app_banner' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('banner_list')}}">
                <i class=" menu-icon fa fa-file-photo-o"></i>
                <span class="menu-title">App Banners</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'driver' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('driverList')}}">
                <i class=" menu-icon bi bi-person-lines-fill"></i>
                <span class="menu-title">Driver</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'tourPackage' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('tourPackages.index')}}">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Tour Packages</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'cab_booking' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('cabBookingList')}}">
                <i class="menu-icon bi bi-taxi-front"></i>
                <span class="menu-title">Cab Booking</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'tour_package_booking' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('bookingList')}}">
                <i class=" menu-icon bi bi-bus-front"></i>
                <span class="menu-title">Tour Package Booking</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'custom_cities' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('customCities_list')}}">
                <i class="menu-icon fa fa-location-arrow"></i>
                <span class="menu-title">Custom Cities Price</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'search_enquiry' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('search_enquiry.index')}}">
                <i class="menu-icon fa fa-search"></i>
                <span class="menu-title">Search Enquiry</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'footer_linkCategory' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('footerLink-category.index')}}">
                <i class="menu-icon fa fa-arrow-down"></i>
                <span class="menu-title">Footer Links Category</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'footer_link' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('footerLinks.index')}}">
                <i class="menu-icon fa fa-arrow-down"></i>
                <span class="menu-title">Footer Links</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'seo' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('seoData.index')}}">
                <i class="menu-icon fa fa-arrow-up"></i>
                <span class="menu-title">Seo</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'invoice' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('billGenerate.index')}}">
                <i class="menu-icon fa fa-arrow-up"></i>
                <span class="menu-title">Invoice Bill</span>
            </a>
        </li>
        <li class="nav-item {{$active == 'cms_page' ? 'active' : ''}}">
            <a class="nav-link " href="{{route('cms_pages')}}">
                <i class="menu-icon fa fa-file  "></i>
                <span class="menu-title">CMS Pages</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{route('admin_logout')}}">
                <i class="fa fa-sign-out mx-1" style="font-size:22px;"></i>
                <span class="menu-title">Logout</span>
            </a>
        </li>
    </ul>
</nav>