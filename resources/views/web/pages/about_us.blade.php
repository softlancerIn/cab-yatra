@extends('web.layout.layout')
@section('content')
    <style>
       

        .hero-about{
            height:70vh;
            width: 100%;
            background-size:cover;
            background-image: linear-gradient(90deg,  rgb(0 0 0 / 50%) 0%, rgb(0 0 0 / 50%) 100%), Url('https://cabyatra.com/public/web/assets/images/img/aboutus-cabyatra.avif');
            background-repeat:no-repeat;
            background-position:center;
        }
        .key-points li {
            list-style-type: disc;

            
        } 
        .key-points li span{
            font-weight: 500;
             
            
            
        }         
         @media (max-width: 620px) {
            .margin-105 {
                margin-top: 72px;
            }
            .hero-about{
            height: 30vh;
            margin-top:67px
            }

            }
    </style>
    <section class="hero-about">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-12">
                    <h1 class="text-center text-white">About Cab Yatra</h1>
                </div>
            </div>
        </div>
    </section>
    <main class=" pt-5 pb-3">
        <div class="container">
            <div class="row gy-5">
                <div class="col-12">
                    <!-- {!! $data['setting']->about_us!!} -->
                     <!-- <h1>About Cab Yatra</h1> -->
                     <p>Welcome to CabYatra, your dependable travel partner for every journey—short or long, city-based or outstation. Established with a vision to make travel more convenient, affordable, and reliable, CabYatra is dedicated to offering top-quality taxi services that prioritize your comfort and safety.</p>
                     <p>In a world where mobility is essential, we understand that getting from one place to another should be simple and stress-free. That’s why we’ve built a platform that connects passengers with verified, professional drivers through an easy booking system—ensuring a seamless travel experience every time.</p>
                     <p>Whether you’re heading to the office, catching a flight, planning a family vacation, or attending a special event, CabYatra is here to take the wheel while you sit back and enjoy the ride. We serve multiple cities across India, bringing together local knowledge and professional service to offer a truly personalized travel solution.</p>
                     <p>At CabYatra, we don’t just move people—we move lives, one ride at a time.</p>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <img src="{{ env('ASSET_URL') }}assets/images/img/mission-and-vission.webp" alt="mission and vission " class="img-fluid">
                        </div>
                        <div  class="col-12 col-md-6">
                            <div class="ps-lg-5 mt-3 mt-lg-0">

                                <h2 title="mission and vission">Mission/Vission</h2>
                                <p>At CabYatra, our mission is to redefine the way people travel by offering dependable, budget-friendly, and hassle-free taxi services. We aim to bridge the gap between passengers and professional drivers, ensuring every ride is timely, safe, and enjoyable.</p>
                                <p>Our vision is to become India’s leading taxi service provider by integrating technology, transparency, and trust into every ride we offer. We envision a future where every journey becomes a pleasant memory with CabYatra.</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<section class="">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <div >
                    <h2>Services</h2>

                    <p>We offer a wide range of taxi services designed to cater to all your travel needs:</p>
                    <ul class="key-points">
                        <li><span>	Local City Rides: </span> Get around town with ease and efficiency.</li>
                        <li><span>	Outstation Trips: </span> Travel across cities with comfort and peace of mind.</li>
                        <li><span>	Airport Transfers: </span> On-time pickups and drops, so you never miss a flight.</li>
                        <li><span>	One-Way & Round Trips: </span> Flexible travel options at competitive prices.</li>
                        <li><span>	Corporate Travel Solutions: </span> Professional services tailored for business needs.</li>
                        <li><span>	Customized Tour Packages: </span> Explore popular destinations with curated travel experiences.</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6">
            <img src="{{ env('ASSET_URL') }}assets/images/img/cab-servicess.jpg" alt="cab serviess " title=" cab serivess" class="img-fluid">

            </div>
        </div>
    </div>
</section>

<section class="pt-5">
    <div class="container">
        <div class="row align-items-center flex-column-reverse flex-lg-row">
        <div class="col-12 col-md-6">
        <img src="{{ env('ASSET_URL') }}assets/images/img/why-choose-us.jpg" alt="why choose us " title="why choose us" class="img-fluid">

            </div>
            <div class="col-12 col-md-6">
                <div >
                    <h2> Why Choose Us:</h2>

                    <p> </p>
                    <ul class="key-points">
                        <li><span>	Affordable Pricing:</span> Transparent fares with no hidden charges.</li>
                        <li><span>	24/7 Customer Support: 	</span> We’re here for you anytime, anywhere.</li>
                        <li><span>	Experienced Drivers: 	</span> Courteous, trained, and professional drivers.</li>
                        <li><span>	Easy Booking: 	</span> Book through our website or call us with just a few clicks.</li>
                        <li><span>	Well-Maintained Fleet: 	</span> Clean, sanitized, and regularly serviced vehicles.</li>
                        <li><span>	Punctuality: </span> On-time pickups and drops, guaranteed.</li>
                         
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="py-3">
    <div class="container">
        <div class="row">
        <div class="col-12 mt-3">
            CabYatra is your go-to solution for all your travel needs. Whether you're planning a weekend getaway or need a reliable ride to work, we’re just a booking away. Join thousands of happy customers who trust us every day and experience travel like never before. With CabYatra, "Your journey matters."
            </div>
        </div>
    </div>
</section>
@endsection