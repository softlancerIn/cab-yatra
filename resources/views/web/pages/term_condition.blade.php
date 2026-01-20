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
                   <h1 class="text-center text-white">Terms & Conditions</h1>
               </div>
           </div>
       </div>
   </section>
<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center ">Terms and Conditions</h2>
                <p>Welcome to Cab Yatra (accessible at https://cabyatra.com/). By accessing or using our website and services, you agree to comply with and be bound by the following terms and conditions. If you do not agree with these terms, please do not use our platform.</p>
                <h3>Definitions</h3>
                <ul class="key-points">
                    <li>“Cab Yatra”, “We”, “Us”, or “Our” refers to the website and its operators.</li>
                    <li>“User”, “You”, or “Your” refers to the customer or visitor using our website or booking services.</li>
                    <li>“Driver” or “Service Provider” refers to third-party cab operators or individuals offering transportation services via Cab Yatra.</li>

                </ul>
                <h3>Services Provided</h3>
                <p>Cab Yatra is an online cab booking platform that connects users with taxi and travel service providers for local, outstation, and airport transfers. We facilitate the booking process but do not operate the taxis directly.</p>
                <h3>User Responsibilities</h3>
                <p>By using Cab Yatra, you agree to:</p>
                <ul class="key-points">
                    <li>Provide accurate, current, and complete information during the booking process.</li>
                    <li>Use the platform lawfully and refrain from any activity that disrupts or damages the website.</li>
                    <li>Make full payment for the services booked through our platform.</li>
                    <li>Maintain appropriate behavior with drivers and service providers.</li>
                </ul>
                <h3>Booking and Payment</h3>
                <ul class="key-points">
                    <li>All bookings are subject to availability and confirmation.</li>
                    <li>Full or partial advance payment may be required at the time of booking.</li>
                    <li>Payment can be made via online payment gateways, UPI, wallets, or cash (where applicable).</li>
                    <li>Booking details, including fare, pickup/drop points, vehicle type, and timings, will be shared via email/SMS/WhatsApp upon confirmation.</li>
                </ul>
                <h3>Cancellation and Refund Policy</h3>
                <ul class="key-points">
                    <li> Cancellation terms vary depending on the cab service selected and will be disclosed at the time of booking.
                    </li>
                <li class="fw-bold">In most cases:</li>
                    <ul class="key-points">
                        <li>
                       Full refund if cancellation is made 24 hours prior to the scheduled pickup time.

                        </li>
                        <li>Half refund if cancellation is made 6 hours prior to the scheduled pickup time.</li>
                        <li>0(Null) refund if cancellation is made 2 hours prior to the scheduled pickup time.</li>

                        <li>Partial refund or no refund for cancellations made within 24 hours of the trip.</li>
                        <li>Refunds (if applicable) will be processed within 7–10 working days.</li>
                    </ul>
                </ul>
                <h3>Pricing and Charges</h3>
                <ul class="key-points">
                    <li>Prices displayed are approximate and may vary based on real-time traffic, tolls, route changes, waiting time, night charges, and peak hour surcharges.</li>
                    <li>Additional charges (such as tolls, parking fees, interstate taxes) are generally not included and must be paid by the user unless otherwise specified.</li>
                </ul>
                <h3>User Conduct and Prohibited Activities</h3>
                <p>You agree not to:</p>
                <ul class="key-points">
                    <li>Misuse or tamper with the website or its features.</li>
                    <li>Impersonate another person or entity.</li>
                    <li>Use the platform for illegal or unauthorized purposes.</li>
                    <li>Harass, threaten, or behave inappropriately toward drivers or customer support.</li>
                </ul>
                <h3>Limitation of Liability</h3>
                <ul class="key-points">
                    <li>Cab Yatra acts only as a facilitator and does not guarantee the quality, safety, or legality of the services provided by third-party drivers.</li>
                    <li>We are not liable for delays, accidents, breakdowns, or any other unforeseen events during your trip.</li>
                    <li>Any disputes arising during the ride should be resolved directly with the driver or service provider.</li>

                </ul>
                <h3>Intellectual Property</h3>
                <p>All content on the website, including text, graphics, logos, and images, is the property of Cab Yatra or its content suppliers and protected by intellectual property laws. Unauthorized use is strictly prohibited.</p>
                <h3>Third-Party Links</h3>
                <p>Cab Yatra may contain links to third-party websites. We do not control or endorse the content of these external sites and are not responsible for any damages or losses caused by them.</p>
                <h3>Modifications to Terms</h3>
                <p>We reserve the right to modify these Terms and Conditions at any time. Users will be notified of changes via the website or email. Continued use of the platform constitutes acceptance of the updated terms.</p>
                <h3>Privacy Policy</h3>
                <P>Your use of our platform is also governed by our Privacy Policy, which outlines how we collect, use, and protect your personal data.</P>
                <h3>Governing Law</h3>
                <P>These Terms and Conditions are governed by the laws of India. Any disputes arising from or related to these terms shall be subject to the exclusive jurisdiction of the courts in [Your City, e.g., Delhi].</P>
                <h3>Contact Information</h3>
                <p>If you have any questions regarding these Terms and Conditions, please contact us at:</p>
                <address>
                    <p class="mb-1">
                    Email: cabyatrabooking@gmail.com
                    </p>
                    <p class="mb-1">Contact : <a href="callto:91 9911995523">91 9911995523</a></p>
                    <p class="mb-1">Website: <a href="https://cabyatra.com/" class="link-primary">cabyatra.com</a></p>
                </address>
            </div>
        </div>
    </div>
</section>


@endsection
