@extends('web.layout.layout')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <marquee behavior="scroll" direction="left" scrollamount="5" class="mt-3 text-dark">
                        Welcome to our website! Enjoy your stay!
                    </marquee>
                </div>
            </div>
        </div>
    </section>
    <section class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
                <div class="col-12 d-flex justify-content-center">
                    <div class="thankyou-wrapper text-center">
                        <img src="https://cabyatra.com/public/admin/assets/images/372103860_CHECK_MARK_400px.gif"
                            alt="thanks" width="200" />
                        <h1>Thank You</h1>
                        <p>Your Booking has been confirmed successfully! </p>
                        <a href="{{route('home')}}" class="btn btn-primary">Back to home</a>

                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection