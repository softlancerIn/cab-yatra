@extends('web.layout.layout')
@section('content')
    <style>
        .hero-about {
            height: 70vh;
            width: 100%;
            background-size: cover;
            background-image: linear-gradient(90deg, rgb(0 0 0 / 50%) 0%, rgb(0 0 0 / 50%) 100%), Url('https://cabyatra.com/public/web/assets/images/img/aboutus-cabyatra.avif');
            background-repeat: no-repeat;
            background-position: center;
        }

        .key-points li {
            list-style-type: disc;

        }

        .key-points li span {
            font-weight: 500;
        }

        .alpha>li {
            list-style-type: lower-alpha;

        }

        @media (max-width: 620px) {
            .margin-105 {
                margin-top: 72px;
            }

            .hero-about {
                height: 30vh;
                margin-top: 67px
            }

        }

        /* body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                margin: 20px;
                background-color: #f4f4f4;
                color: #333;
            } */

        h1 {
            text-align: center;
            color: #333;
        }

        /* .faq-section {
                margin: 20px auto;
                width: 80%;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            } */

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h2 {
            font-size: 1.2em;
            color: #007BFF;
        }

        .faq-item ul {
            margin-top: 10px;
            padding-left: 20px;
        }

        .faq-item ul li {
            margin-bottom: 5px;
        }

        .contact-info {
            margin-top: 20px;
        }
    </style>
    <section class="hero-about">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-12">
                    <h1 class="text-center text-white">Faq</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3">
        <div class="container">
            <div class="row">
                <h1>Frequently Asked Questions (FAQs)</h1>

                <div class="faq-section">

                    <div class="faq-item">
                        <h2>1. What is Cab Yatra?</h2>
                        <p>Cab Yatra is a trusted taxi service provider offering a wide range of travel solutions including
                            local rides, airport transfers, and outstation trips. We focus on safety, affordability, and
                            customer satisfaction.</p>
                    </div>

                    <div class="faq-item">
                        <h2>2. How do I book a cab with Cab Yatra?</h2>
                        <p>Booking a ride with Cab Yatra is simple. Visit our official website <a
                                href="https://cabyatra.com" target="_blank">https://cabyatra.com</a> or call our customer
                            service team. Just enter your pickup and drop-off details, choose your vehicle type, and confirm
                            your ride.</p>
                    </div>

                    <div class="faq-item">
                        <h2>3. Which cities does Cab Yatra operate in?</h2>
                        <p>Cab Yatra currently operates in major Indian cities such as Delhi, Gurugram, Noida, Ghaziabad,
                            Haldwani, Agra, and several others. We’re continuously expanding to cover more areas.</p>
                    </div>

                    <div class="faq-item">
                        <h2>4. What types of taxi services does Cab Yatra offer?</h2>
                        <ul>
                            <li>Local city rides</li>
                            <li>Outstation one-way and round trips</li>
                            <li>Airport transfers</li>
                            <li>Hourly rentals</li>
                            <li>Customized tour packages</li>
                        </ul>
                    </div>

                    <div class="faq-item">
                        <h2>5. Are Cab Yatra drivers verified?</h2>
                        <p>Yes. All Cab Yatra drivers go through a strict verification process and are trained to ensure a
                            safe, professional, and courteous experience for our customers.</p>
                    </div>

                    <div class="faq-item">
                        <h2>6. Can I cancel or reschedule a booking with Cab Yatra?</h2>
                        <p>Absolutely. You can cancel or reschedule your booking by contacting our support team. To avoid
                            cancellation charges, please make changes at least 2 hours prior to your scheduled pickup time.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h2>7. What payment options are available with Cab Yatra?</h2>
                        <ul>
                            <li>Cash</li>
                            <li>UPI</li>
                            <li>Credit/Debit Cards</li>
                            <li>Net Banking</li>
                            <li>Mobile Wallets (where applicable)</li>
                        </ul>
                    </div>

                    <div class="faq-item">
                        <h2>8. Does Cab Yatra provide both one-way and round-trip services?</h2>
                        <p>Yes, we provide flexible travel options. Choose either a one-way or round-trip based on your
                            travel needs and convenience.</p>
                    </div>

                    <div class="faq-item">
                        <h2>9. How are fares calculated at Cab Yatra?</h2>
                        <p>Our fares are calculated based on distance, ride type, cab category, and applicable taxes or
                            tolls. Cab Yatra ensures transparent pricing with no hidden charges.</p>
                    </div>

                    <div class="faq-item">
                        <h2>10. How can I contact Cab Yatra for help?</h2>
                        <div class="contact-info">
                            <p>You can reach Cab Yatra through:</p>
                            <ul>
                                <li>Phone: +91-9911995523</li>
                                <li>Email: <a href="mailto:cabyatrabooking@gmail.com">cabyatrabooking@gmail.com</a></li>
                                <li>Website Chat Support: <a href="https://cabyatra.com"
                                        target="_blank">https://cabyatra.com</a></li>
                            </ul>
                            <p>Our dedicated support team is available 24/7 to assist you.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



@endsection