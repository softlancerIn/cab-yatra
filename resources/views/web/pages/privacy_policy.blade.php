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
       .alpha > li {
        list-style-type: lower-alpha;

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
                   <h1 class="text-center text-white">Privacy Policy</h1>
               </div>
           </div>
       </div>
   </section>

    <section class="py-3">        
         <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">Privacy Policy</h2>
                    <p>At Cab Yatra, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, disclose, and safeguard your data when you use our website, mobile application, and taxi services.</p>
                    <p>By accessing or using Cab Yatra’s services, you agree to the terms of this Privacy Policy.</p>
                    <h3>1. Information We Collect</h3>
                    <p>We collect the following types of information to provide and improve our services:</p>
                    <ul class="alpha">
                        <li> Personal Information:</li>
                        <ul class="key-points">
                            <li>Full name</li>
                            <li>Contact number</li>
                            <li>Email address</li>
                            <li>Pickup and drop-off addresses</li>
                            <li>Payment details (processed securely via third-party gateways)</li>
                        </ul>
                        <li> Location Data:</li>
                        <p>We collect real-time location data from your device to provide accurate taxi service and route navigation.</p>
                        <li> Usage Data:</li>
                        <p>This includes information such as:</p>
                        <ul class="key-points">
                            <li>IP address</li>
                            <li>Browser type</li>
                            <li>Access times</li>
                            <li>Pages viewed</li>
                            <li>Device type and OS</li>
                        </ul>
                    </ul>
                    <h3>2. How We Use Your Information</h3>
                    <p>We use the information we collect to:</p>
                    <ul class="key-points">
                        <li>Facilitate bookings and offer our taxi services</li>
                        <li>Improve customer service and user experience</li>
                        <li>Send booking confirmations and updates</li>
                        <li>Process payments securely</li>
                        <li>Communicate offers, promotions, and service updates</li>
                        <li>Ensure rider safety and operational efficiency</li>
                        <li>Comply with legal obligations</li>
                    </ul>
                    <h3>3. Sharing of Information</h3>
                    <p>We do not sell, rent, or trade your personal data. However, we may share information with:</p>
                    <ul class="key-points">
                        <li>	Drivers and service partners to fulfill your ride request</li>
                    <li>Payment processors to complete transactions</li>
                    <li>Law enforcement or regulatory bodies when required by law</li>
                    <li>Third-party service providers who assist with technology, marketing, or analytics (under strict confidentiality)</li>
                </ul>
                <h3>4. Data Security</h3>
                <p>We implement industry-standard measures to protect your data:</p>
                <ul class="key-points">
                    <li>SSL encryption for data transmission</li>
                    <li>Secure payment gateways</li>
                    <li>Restricted data access to authorized personnel only However, no method of online transmission or storage is 100% secure. While we strive to protect your data, we cannot guarantee absolute security.</li>
                </ul>
                <h3>5. Your Choices</h3>
                <p>You can:</p>
                <ul class="key-points">
                    <li>Review and update your account information at any time</li>
                    <li>Opt-out of marketing emails or SMS notifications</li>
                    <li>Request deletion of your data by contacting us</li>
                </ul>
                <h3>6. Cookies and Tracking Technologies</h3>
                <p>Our website may use cookies and similar technologies to:</p>
                <ul class="key-points">
                    <li>Remember user preferences</li>
                    <li>Analyze website traffic</li>
                    <li>Enhance user experience</li>
                </ul>
                <p>You can disable cookies via your browser settings, but some features may not work as intended.</p>
<h3>7. Third-Party Links</h3>
<p>Our platform may contain links to external websites. We are not responsible for the privacy practices or content of these third-party sites. We encourage you to read their privacy policies before sharing any information.</p>
<h3>8. Children’s Privacy</h3>
<p>Cab Yatra services are not intended for use by children under the age of 13. We do not knowingly collect data from minors. If we learn that a child has submitted personal information, we will delete it immediately.</p>
<h3>9. Changes to This Privacy Policy</h3>
<p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. Any changes will be posted on this page with an updated effective date.</p>
<h3>10. Contact Us</h3>
<p>If you have any questions or concerns regarding this Privacy Policy or how we handle your data, feel free to contact us:</p>
<address>
    <h3>Cab Yatra</h3>
    <p class="mb-1">Email: cabyatrabooking@gmail.com</p>
    <p class="mb-1">Phone: +91-9911995523</p>
    <p class="mb-1">Website: https://cabyatra.com</p>
</address>
                </div>
            </div>
         </div>
    </section>



@endsection