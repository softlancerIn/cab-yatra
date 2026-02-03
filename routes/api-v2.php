<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V2\{
    HomeController as NewHomeController,
    BookingChatRequestController,
    SubDriverController,
    BookingController,
    AlertController,
    ProfileController,
    VehicleController,
    PaymentMethodController,
    TransactionController
};

Route::prefix('driver')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('V2')->group(function () {
            Route::controller(NewHomeController::class)->group(function () {
                Route::match(['get', 'post'], 'home', 'home')->name('home');

                Route::prefix('home/filter')->group(function () {
                    Route::get('', 'getFilters')->name('home.filter');
                    Route::post('', 'filter')->name('home.filter');
                });
            });

            Route::controller(AlertController::class)->group(function () {
                Route::get('alerts', 'index')->name('alerts.index');
                Route::post('alerts', 'store')->name('alerts.store');
            });

            Route::controller(BookingChatRequestController::class)->group(function () {
                Route::get('booking-chat-requests', 'index')->name('booking-chat-requests.index');
                Route::post('booking-chat-requests', 'store')->name('booking-chat-requests.store');
                Route::get('booking-chat-requests/{id}', 'show')->name('booking-chat-requests.show');
                Route::put('booking-chat-requests/{id}', 'update')->name('booking-chat-requests.update');
                Route::delete('booking-chat-requests/{id}', 'destroy')->name('booking-chat-requests.destroy');
                Route::get('booking-chat-requests/booking/{bookingId}', 'getByBooking')->name('booking-chat-requests.getByBooking');
            });

            Route::controller(BookingController::class)->group(function () {
                // Route::get('sub-drivers', 'index')->name('sub-drivers.index');
                Route::post('booking', 'store')->name('booking.store');
                Route::get('booking/{id}', 'show')->name('booking.show');
                Route::put('updateAssign-method/{id}', 'updateAssignMethod')->name('booking.updateAssignMethod');
                Route::put('booking/{id}', 'update')->name('booking.update');
                // Route::get('sub-drivers/{id}', 'show')->name('sub-drivers.show');
                // Route::put('sub-drivers/{id}', 'update')->name('sub-drivers.update');
                // Route::delete('sub-drivers/{id}', 'destroy')->name('sub-drivers.destroy');
                // Route::get('sub-drivers/driver/{driverId}', 'getByDriver')->name('sub-drivers.getByDriver');
                Route::get('get-car-category', 'getCarCategory')->name('get_car_category');
            });


            Route::prefix('profile')->group(function () {
                Route::controller(ProfileController::class)->group(function () {
                    Route::match(['get', 'post'], '/', 'profile')->name('profile');

                    Route::get('reviews', 'reviews')->name('profile.reviews');
                });

                Route::controller(VehicleController::class)->group(function () {
                    Route::get('vehicles', 'index')->name('vehicles.index');
                    Route::post('vehicles', 'store')->name('vehicles.store');
                    Route::get('vehicles/{id}', 'show')->name('vehicles.show');
                    Route::put('vehicles/{id}', 'update')->name('vehicles.update');
                    Route::delete('vehicles/{id}', 'destroy')->name('vehicles.destroy');
                    Route::get('vehicles/driver/{driverId}', 'getByDriver')->name('vehicles.getByDriver');
                });

                Route::controller(SubDriverController::class)->group(function () {
                    Route::get('sub-drivers', 'index')->name('sub-drivers.index');
                    Route::post('sub-drivers', 'store')->name('sub-drivers.store');
                    Route::get('sub-drivers/{id}', 'show')->name('sub-drivers.show');
                    Route::put('sub-drivers/{id}', 'update')->name('sub-drivers.update');
                    Route::delete('sub-drivers/{id}', 'destroy')->name('sub-drivers.destroy');
                    Route::get('sub-drivers/driver/{driverId}', 'getByDriver')->name('sub-drivers.getByDriver');
                });

                Route::controller(PaymentMethodController::class)->group(function () {
                    Route::get('payment-methods', 'index')->name('payment-methods.index');
                    Route::post('payment-methods', 'store')->name('payment-methods.store');
                    Route::get('payment-methods/{id}', 'show')->name('payment-methods.show');
                    Route::put('payment-methods/{id}', 'update')->name('payment-methods.update');
                    Route::delete('payment-methods/{id}', 'destroy')->name('payment-methods.destroy');
                });

                Route::controller(TransactionController::class)->group(function () {
                    Route::get('transactions', 'index')->name('transactions.index');
                    Route::get('transactions/{id}', 'show')->name('transactions.show');
                });
            });
        });
    });
});