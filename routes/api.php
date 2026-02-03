<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    LiveCabBookingDataController,
    DriverRatingReviewController,
    AuthController,
    HomeController,
};

use App\Http\Controllers\Api\User\{
    FooterLinkController,
    UserAuthController,
    UserHomeController,
};

use App\Http\Controllers\Api\V2\{
    HomeController as NewHomeController,
    BookingChatRequestController,
    SubDriverController,
    BookingController,
    AlertController,
    ProfileController,
};

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/', function () {
    return "Hello";
});

Route::prefix('driver')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::match(['get', 'post'], '/', function () {
            return "hello";
        });
        Route::match(['get', 'post'], 'send-otp', 'sendOtp')->name('sendOtp');
        Route::match(['get', 'post'], 'registration', 'registration')->name('registration');
        Route::match(['get', 'post'], 'login', 'login')->name('login');
        Route::match(['get', 'post'], 'testing', 'testing')->name('testing');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::match(['get', 'post'], 'home', 'index')->name('home');
            // Route::match(['get', 'post'], 'booking_details', 'booking_details')->name('booking_details');
            Route::match(['get', 'post'], 'update_booking_status', 'updateBookingStatus')->name('update_booking_status');
            Route::match(['get', 'post'], 'crete_razorpay_oder_id', 'createRazorPayOrderId')->name('crete_razorpay_oder_id');
            Route::match(['get', 'post'], 'my_booking', 'myBooking')->name('my_booking');
            Route::match(['get', 'post'], 'get-car-category', 'getCarCategory')->name('get_car_category');
            // Route::match(['get', 'post'], 'add_booking', 'addBooking')->name('add_booking');
            Route::match(['get', 'post'], 'update_booking/{id}', 'upadteBooking')->name('update_booking');

            Route::match(['get', 'post'], 'deleteDriverBooking', 'deleteDriverBooking')->name('deleteDriverBooking');
            Route::match(['get', 'post'], 'get_booking', 'getBooking')->name('get_booking');

            //====================== Ride Start and end routes =======================================>
            Route::match(['get', 'post'], 'sendStartRideOtp', 'sendStartRideOtp')->name('sendStartRideOtp');
            Route::match(['get', 'post'], 'verifyStartRideOtp', 'verifyStartRideOtp')->name('verifyStartRideOtp');
            Route::match(['get', 'post'], 'rideEnd', 'rideEnd')->name('rideEnd');
            //====================== Ride Start and end routes =======================================>

            Route::match(['get', 'post'], 'cancel_booking', 'deleteBooking')->name('delete_booking');
            Route::match(['get', 'post'], 'completeBooking', 'completeBooking')->name('completeBooking');
            Route::match(['get', 'post'], 'cancelBooking', 'cancelBooking')->name('cancelBooking');
            // Route::match(['get', 'post'], 'profile', 'profile')->name('profile');

            Route::match(['get', 'post'], 'driverPaymentMethod', 'driverPaymentMethod')->name('driverPaymentMethod');
            Route::match(['get', 'post'], 'bookingRatignReview', 'bookingRatignReview')->name('bookingRatignReview');
            Route::match(['get', 'post'], 'wallet', 'wallet')->name('wallet');
            Route::match(['get', 'post'], 'editComission', 'editComission')->name('editComission');
            Route::match(['get', 'post'], 'updateComission', 'updateComission')->name('updateComission');
            Route::match(['get', 'post'], 'ratin_driverReviewList', 'driverRatingReviewList')->name('driverRatingReviewList');

            Route::match(['get', 'post'], 'getLocalTime', 'getLocalTime');
            Route::match(['get', 'post'], 'checkBankInfo', 'checkBankInfo')->name('checkBankInfo');


            Route::match(['get', 'post'], 'checkBankInfo', 'checkBankInfo')->name('checkBankInfo');
        });

        Route::controller(DriverRatingReviewController::class)->group(function () {
            Route::match(['get', 'post'], 'getDriverDataForRatingReview/{driverId}', 'getDriverDataForRatingReview')->name('getDriverDataForRatingReview');
        });
    });
    Route::controller(HomeController::class)->group(function () {
        Route::match(['get', 'post'], 'cmsPages', 'cmsPages')->name('cmsPages');
    });
    Route::controller(LiveCabBookingDataController::class)->group(function () {
        Route::match(['get', 'post'], 'get-live-booking-data', 'getLiveBooking')->name('getLiveBooking');
    });
});

Route::prefix('users')->group(function () {
    Route::controller(UserAuthController::class)->group(function () {
        Route::match(['get', 'post'], '/', function () {
            return "hello";
        });
        Route::match(['get', 'post'], 'send-otp', 'sendOtp')->name('sendOtp');
        Route::match(['get', 'post'], 'registration', 'registration')->name('registration');
        Route::match(['get', 'post'], 'login', 'login')->name('login');
        Route::match(['get', 'post'], 'testing', 'testing')->name('testing');
    });

    Route::middleware(['auth:sanctum', 'token.ability:user'])->group(function () {
        Route::controller(UserHomeController::class)->group(function () {
            Route::match(['get', 'post'], 'complete-registration', 'completeRegistration')->name('completeRegistration');
            Route::match(['get', 'post'], 'home', 'home')->name('home');
            Route::match(['get', 'post'], 'cab-list', 'cabList');
            Route::match(['get', 'post'], 'cab-details', 'cabDetails');
            Route::match(['get', 'post'], 'cab-booking', 'cabBooking');






            Route::match(['get', 'post'], 'booking_details', 'booking_details')->name('booking_details');
            Route::match(['get', 'post'], 'update_booking_status', 'updateBookingStatus')->name('update_booking_status');
            Route::match(['get', 'post'], 'crete_razorpay_oder_id', 'createRazorPayOrderId')->name('crete_razorpay_oder_id');
            Route::match(['get', 'post'], 'my_booking', 'myBooking')->name('my_booking');
            Route::match(['get', 'post'], 'get-car-category', 'getCarCategory')->name('get_car_category');
            Route::match(['get', 'post'], 'add_booking', 'addBooking')->name('add_booking');
            Route::match(['get', 'post'], 'get_booking', 'getBooking')->name('get_booking');

            Route::match(['get', 'post'], 'sendStartRideOtp', 'sendStartRideOtp')->name('sendStartRideOtp');
            Route::match(['get', 'post'], 'verifyStartRideOtp', 'verifyStartRideOtp')->name('verifyStartRideOtp');

            Route::match(['get', 'post'], 'delete_booking', 'deleteBooking')->name('delete_booking');
            Route::match(['get', 'post'], 'completeBooking', 'completeBooking')->name('completeBooking');
            Route::match(['get', 'post'], 'cancelBooking', 'cancelBooking')->name('cancelBooking');
            Route::match(['get', 'post'], 'profile', 'profile')->name('profile');


            Route::match(['get', 'post'], 'driverPaymentMethod', 'driverPaymentMethod')->name('driverPaymentMethod');
            Route::match(['get', 'post'], 'bookingRatignReview', 'bookingRatignReview')->name('bookingRatignReview');
            Route::match(['get', 'post'], 'wallet', 'wallet')->name('wallet');
            Route::match(['get', 'post'], 'cmsPages', 'cmsPages')->name('cmsPages');
        });
    });

    // Route::controller(LiveCabBookingDataController::class)->group(function () {
    //     Route::match(['get', 'post'], 'get-live-booking-data', 'getLiveBooking')->name('getLiveBooking');
    // });
});

require __DIR__ . '/api-v2.php';
