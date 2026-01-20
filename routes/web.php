<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use App\Http\Controllers\{
    TourPackageBookingController,
    LocalPackageController,
    CabBookingController,
    TimeSchaduleController,
    CarCategoryController,
    TourPackageController,
    DashBoardController,
    PackageController,
    DriverController,
    CommonControler,
    AuthController,
    CarController,
};


use App\Http\Controllers\Admin\{
    OnewayAndAirportFairController,
    FooterLinksCategoryController,
    CustomCitiesPriceController,
    SearchEnquiryController,
    FooterLinkController,
    AppBannerContolller,
    SeoController,
    TimeController,
    BillController,
};
use App\Http\Controllers\WebController;

Route::controller(WebController::class)->group(function () {
    Route::redirect('/aligarh-to-jaipur-cabtaxi-services', '/aligarh-to-jaipur-cab-taxi-services', 301);
    Route::get('testing', 'testing')->name('testing');
    Route::match(['get', 'post'], '/', 'index')->name('home');
    Route::post('get_cities', 'get_cities')->name('get_cities');
    Route::match(['get', 'post'], 'search-cab', 'searchCab')->name('searchCab');
    Route::match(['get', 'post'], 'tour-packages', 'tourPackage')->name('tourPackage');
    Route::match(['get', 'post'], 'tour-packages-list', 'tourPackageList')->name('tourPackageList');
    Route::match(['get', 'post'], 'tour-packages-details/{slug}', 'tourPackageDetail')->name('tourPackageDetail');
    Route::match(['get', 'post'], 'local-route-trip-cab', 'localRouteSearch')->name('localRouteSearch');


    Route::match(['get', 'post'], 'out-station-route-cab-search', 'outStationRoutesearch')->name('outStationRoutesearch');
    Route::match(['get', 'post'], 'out-station-route-filter-search', 'outStationRouteFilterSearch')->name('outStationRouteFilterSearch');
    Route::match(['get', 'post'], 'cab-booking', 'cabBooking')->name('cabBooking');
    Route::match(['get', 'post'], 'Outstation-local-airport-cab-search', 'airPortSearch')->name('airPortSearch');
    Route::match(['get', 'post'], 'Outstation-local-airport-cab-booking', 'airPorCabBooking')->name('airPorCabBooking');
    Route::match(['get', 'post'], 'outstation-rote-cab-booking', 'outStationRouteBooking')->name('outStationRouteBooking');
    Route::match(['get', 'post'], 'tour-packages-booking', 'tourPackageBooking')->name('tourPackageBooking');
    Route::match(['get', 'post'], 'createRazorpayOrderId', 'createRazorpayOrderId')->name('createRazorpayOrderId');
    Route::match(['get', 'post'], 'delete-account', 'deleteAccount')->name('deleteAccount');
    Route::match(['get', 'post'], '{slug}', 'master_function')->name('master_function');
    Route::match(['get', 'post'], 'get-enquiry', 'getEnquiry')->name('getEnquiry');

    Route::match(['get', 'post'], 'thank-you', 'thankYou')->name('thankYou');
    Route::match(['get', 'post'], 'razorpayWebhook', 'razorpayWebhook')->name('razorpayWebhook');
});








Route::controller(AuthController::class)->group(function () {
    Route::match(['get', 'post'], 'admin/login', 'index')->name('login');
});

Route::middleware(['auth:web_admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('logout', 'logout')->name('admin_logout');
        });

        Route::controller(DashBoardController::class)->group(function () {
            Route::get('dashboard', 'index')->name('dashboard');
            Route::post('importCity', 'importCity')->name('importCity');
        });

        Route::controller(CarController::class)->group(function () {
            Route::get('car-list', 'index')->name('car_list');
            Route::match(['get', 'post'], 'car-create', 'create')->name('car_create');
            Route::get('car-data-edit/{id}', 'edit')->name('car__edit');
        });

        Route::controller(AppBannerContolller::class)->group(function () {
            Route::get('banner-list', 'index')->name('banner_list');
            Route::match(['get', 'post'], 'banner-create', 'create')->name('banner_create');
            Route::post('banner-edit', 'edit')->name('banner_edit');
            Route::post('banner-update', 'update')->name('banner_update');
        });

        Route::controller(DriverController::class)->group(function () {
            Route::get('driver-list', 'index')->name('driverList');
            Route::match(['get', 'post'], 'driver-add', 'create')->name('drivercreate');
            Route::match(['get', 'post'], 'driver-edit/{id}', 'edit')->name('edit');
            Route::match(['get', 'post'], 'status-change/{type}', 'changeStatus')->name('changeStatus');
            Route::match(['get', 'post'], 'driver-update', 'update')->name('driverupdate');
            Route::match(['get', 'post'], 'driver-orders/{driver_id}', 'driverOrders')->name('driverOrders');
        });


        Route::controller(PackageController::class)->group(function () {
            Route::get('packages-list', 'index')->name('packages');
            Route::match(['get', 'post'], 'package-create', 'create')->name('package_create');
            Route::get('package-edit/{id}', 'edit')->name('package_edit');

            Route::get('assign-car-to-package/{packageId}', 'assignCar')->name('assign_carTo_package');
            Route::post('assign-car-to-package-add', 'addAssignCar')->name('add_assign_carTo_package');
        });

        Route::controller(TourPackageBookingController::class)->group(function () {
            Route::get('booking-list', 'index')->name('bookingList');
            Route::match(['get', 'post'], 'tour-package-detail/{id}', 'tourPkgDetail')->name('tourPkgDetail');
            Route::get('car-edit/{id}', 'edit')->name('car_edit');
        });


        Route::controller(CabBookingController::class)->group(function () {
            Route::get('cab-booking-list', 'index')->name('cabBookingList');
            Route::match(['get', 'post'], 'cab-booking-detail/{id}', 'cabBooingDetail')->name('cabBooingDetail');
            Route::get('car-edit/{id}', 'edit')->name('car_edit');
            Route::post('assign-cab-booking', 'assign_cabBooking')->name('assign_cab_booking');
        });

        Route::controller(OnewayAndAirportFairController::class)->group(function () {
            Route::match(['get', 'post'], 'one-way-airport-fair', 'index')->name('onewayAirportFairList');
            Route::match(['get', 'post'], 'one-way-airport-fair/{id}', 'createEdit')->name('onewayAirportFairCreate');
        });

        Route::controller(CustomCitiesPriceController::class)->group(function () {
            Route::get('custom-cities-list', 'index')->name('customCities_list');
            Route::match(['get', 'post'], 'custom-cities-create', 'create')->name('customCities_create');
            Route::match(['get', 'post'], 'custom-cities-edit/{id}', 'edit')->name('customCities_edit');
            Route::post('assign-cabBooking', 'assign_cabBooking')->name('assign_cabBooking');


            Route::get('custom-cities-car-price-list/{id}', 'customCarCategoryPriceList')->name('customCarCategoryPriceList');
            Route::match(['get', 'post'], 'custom-cities-car-price-create/{id}', 'customCarCategoryPricecreate')->name('customCarCategoryPricecreate');
            Route::match(['get', 'post'], 'custom-cities-car-price-edit/{id}/{customCitiesCarPriceId}', 'customCarCategoryPriceEdit')->name('customCarCategoryPriceEdit');
        });

        Route::resource('localpackage', LocalPackageController::class);
        Route::resource('timeschadule', TimeSchaduleController::class);
        Route::resource('carCategory', CarCategoryController::class);
        Route::resource('tourPackages', TourPackageController::class);
        Route::resource('time', TimeController::class);
        Route::resource('footerLink-category', FooterLinksCategoryController::class);
        Route::resource('footerLinks', FooterLinkController::class);
        Route::resource('seoData', SeoController::class);
        Route::resource('search_enquiry', SearchEnquiryController::class);
        Route::resource('billGenerate', BillController::class);

        Route::controller(BillController::class)->group(function () {
            Route::match(['get', 'post'], 'download/{id}', 'download')->name('BillDownload');
        });

        Route::controller(CommonControler::class)->group(function () {
            Route::get('global-delete/{model}/{id}', 'globalDelete')->name('globalDelete');
            Route::match(['get', 'post'], 'status-update/{table}/{id}', 'statusUpate')->name('statusUpate');
            Route::match(['get', 'post'], 'cms-pages', 'cmsPage')->name('cms_pages');
        });
    });
});
