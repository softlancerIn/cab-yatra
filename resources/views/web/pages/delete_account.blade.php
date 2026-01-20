@extends('web.layout.layout')
@section('content')

    <section class="container mt-4">
        <h1 class="text-center">Delete Account</h1>
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-4">
                <form action="">
                    @csrf
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Enter Mobile Number</label>
                        <input type="mobile" class="form-control" id="mobile" name="mobile" required>
                    </div>
                    <button type="submit" class="btn btn-danger text-center">Delete Account</button>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5>Account Deletion Warning</h5>
            </div>
            <div class="card-body">
                <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                <p>Please ensure you have backed up any important data before proceeding.</p>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5>Contact Support</h5>
            </div>
            <div class="card-body">
                <p>If you have any questions or need assistance, please contact our support team.</p>
                <p>Email:
                    <a href="mailto:cabyatra@gmail.com">cabyatra@gmail.com</a>
                </p>
                <p>Phone:
                    <a href="tel:+919876543210">+91 98765 43210</a>
                </p>
                <p>We are here to help you!</p>
            </div>
        </div>
        {{-- <div class="card mt-3">
            <div class="card-header">
                <h5>Feedback</h5>
            </div>
            <div class="card-body">
                <p>We value your feedback. If you have any suggestions or comments, please let us know.</p>
                <form action="{{ route('feedback.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Your Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
            </div>
        </div> --}}

    </section>
@endsection