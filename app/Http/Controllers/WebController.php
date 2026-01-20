<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\CustomCitiesPrice;
use Illuminate\Http\Request;
use App\Models\{
    CustomCitiesCarPrice,
    TourPackageBooking,
    CabAirportFair,
    SearchEnquiry,
    TimeSchadule,
    CarCategory,
    TourPackages,
    FooterLink,
    cabBooking,
    Packages,
    Settings,
    Time,
    City,
    Cars,
};

use DB;
use GuzzleHttp\Client;
use Carbon\Carbon;

use App\Mail\{
    UserConfirmBooking
};
use Mail;
use Illuminate\Support\Facades\Log;

class WebController extends Controller
{
    protected $client;
    protected $apiKey;
    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
    }
    public function index()
    {
        $data = [];
        $data['footerLink'] = FooterLink::where('status', '1')->orderBy('id', 'DESC')->get();
        $data['package'] = Packages::where('status', '1')->orderBy('id', 'DESC')->get();
        $data['time'] = Time::where('status', '1')->orderBy('id', 'DESC')->get();
        $data['timeSchadule'] = TimeSchadule::where('status', '1')->orderBy('id', 'DESC')->get();
        return view('web.index', compact('data'));
    }

    public function get_cities(Request $request)
    {
        $cities = City::where('name', 'LIKE', "{$request->value}%")->get(['id', 'name']);
        return response()->json(['status' => true, 'data' => $cities]);
    }

    public function searchCab(Request $request)
    {
        $data = [];
        if ($request->isMethod('GET')) {
            return view('web.pages.cabList', compact('data'));
        } else {
            try {
                $validated = $request->validate([
                    'hiddenOutStattionPickupCity' => 'required',
                    'hiddenOutStattionDestiCity' => 'required',
                ]);

                $filteredPickupData = array_filter($request->hiddenOutStattionPickupCity, function ($value) {
                    return !is_null($value); // Only include values that are not null
                });
                $request->hiddenOutStattionPickupCity = $filteredPickupData;


                if (is_array($request->hiddenOutStattionPickupCity) && sizeof($request->hiddenOutStattionPickupCity) > 1) {
                    $distance = $this->calculateMultipleDistances(array_merge([$request->hiddenOutStattionDestiCity], $request->hiddenOutStattionPickupCity));

                    if (empty($distance['totalDistance'])) {
                        return redirect()->back()->with('error', 'No Route Found!');
                    }
                    $data['pickup'] = $request->hiddenOutStattionPickupCity;
                    $data['tripDetails'] = $distance['tripDetails'];
                    $data['destination'] = $request->hiddenOutStattionDestiCity;
                    $data['totalKm'] = $distance['totalDistance'];
                    $data['distanceKm'] = $distance['totalDistance'];
                } else {
                    if (is_array($request->hiddenOutStattionPickupCity)) {
                        $distance = $this->calculateDistance($request->hiddenOutStattionPickupCity[0], $request->hiddenOutStattionDestiCity);
                    } else {
                        $distance = $this->calculateDistance($request->hiddenOutStattionPickupCity, $request->hiddenOutStattionDestiCity);
                    }

                    if ($distance['status'] == false) {
                        return redirect()->back()->with('error', 'No Route Found!');
                    }

                    $data['pickup'] = $request->hiddenOutStattionPickupCity;
                    $data['destination'] = $request->hiddenOutStattionDestiCity;
                    $data['totalKm'] = $distance['distanceValue'];
                    $data['distanceKm'] = $distance['distance'];
                }


                $carCategories = CabAirportFair::where('type', '1')->distinct()->pluck('car_category')->toArray();
                $carCategoriesData = CabAirportFair::distinct()->get();

                $data['CarCategory'] = CarCategory::with(['car' => function ($query) {
                    $query->where('status', '1');
                }, 'oneWayAirport'])
                    ->whereIn('id', $carCategories)
                    ->where('status', '1')
                    ->has('car')
                    ->get(['id', 'name', 'per_km_cost', 'extra_fair_perKm', 'extra_fair_perHour', 'extra_fair_perHour', 'driver_charge', 'night_charge', 'other_details', 'toll', 'tax', 'parking', 'off']);

                $pickupCity = explode(',', $data['pickup'][0])[0];
                $destinationCity = explode(',', $data['destination'])[0];
                $pickupCity = $this->getCityFromAddress($pickupCity);
                $destinationCity = $this->getCityFromAddress($destinationCity);

                $customPrice = CustomCitiesPrice::where('pickup_loc', 'LIKE', '%' . $pickupCity . '%')
                    ->where('destination_loc', 'LIKE', '%' . $destinationCity . '%')
                    ->first();
                foreach ($data['CarCategory'] as $category) {
                    $category->carData = $category->car->first(['id', 'name', 'image', 'min_charge']);
                    $onewayData = DB::table('cab_airport_fairs')->where(['type' => '1', 'car_category' => $category->id])->first();

                    $category->oneWayAirport = (object) [];
                    $category->oneWayAirport->is_fixed_price = 0;
                    $checkCustomCityPrice = '';
                    if ($customPrice) {
                        $checkCustomCityPrice = CustomCitiesCarPrice::where(['custom_citiesId' => $customPrice->id, 'car_categoryId' => $category->id])->first();
                    }
                    if ($checkCustomCityPrice) {
                        $category->oneWayAirport->is_fixed_price = $checkCustomCityPrice->fixed_fair;
                        $data['totalKm'] = $checkCustomCityPrice->total_km;
                        $data['distanceKm'] = $checkCustomCityPrice->total_km;
                        $category->oneWayAirport->off = '0';
                        $onewayData->off = '0';
                    } else {
                        if ($customPrice && ($category->id == $customPrice->car_categoryId)) {
                            $category->oneWayAirport->is_fixed_price = $customPrice->fair;
                            $category->oneWayAirport->off = $customPrice->fair;
                        }
                    }
                    if ($onewayData) {
                        foreach ($onewayData as $key => $value) {
                            $category->oneWayAirport->$key = $value;
                        }
                    }
                }

                $data['carCategoriesData'] = $carCategoriesData;
                $destnation = $data['destination'];

                $this->getEnquiry($data['pickup'], [$destnation], $request->phone);

                if (is_array($request->hiddenOutStattionPickupCity)) {
                    return view('web.pages.ouststationOneWayCabList', compact('data'));
                } else {
                    return view('web.pages.ouststationOneWayCabList', compact('data'));
                }
            } catch (\Throwable $th) {
                dd($th->getMessage());
                return redirect()->back()->with('Somehting went wrong' . $th->getMessage());
            }
        }
    }

    public function tourPackage(Request $request)
    {
        $data['CarCategory'] = CarCategory::where('status', '1')->get();
        $data['tourPackage'] = TourPackages::where('status', '1')->orderBy('id', 'DESC')->get();
        return view('web.pages.tour_package', compact('data'));
    }

    public function tourPackageList(Request $request)
    {
        return view('web.pages.tourPackageList');
    }

    public function tourPackageDetail(Request $request)
    {
        $car = Cars::where('category', $request->carCategory_id)->take(3)->get();
        if (sizeof($car) > 1) {
            $data['cars'] = ($car[0]->name ?? '') . ',' . isset($car[1]) ? $car[1]->name : '';
        } else {
            $data['cars'] = ($car[0]->name ?? '');
        }
        $data['pickUpLoac'] = $request->location;
        $data['date'] = $request->date;
        $data['carCategoryId'] = $request->carCategory_id;
        $data['tour_id'] = $request->tour_id;
        $data['packageDetail'] = TourPackages::where('id', $request->tour_id)->first();
        return view('web.pages.tourPackageDetail', compact('data'));
    }

    public function tourPackageBooking(Request $request)
    {
        $orderId = '#ORD_TPKG' . rand(10000, 99999);
        if ($request->payment_mode == 'pay_later') {
            $payment_mode = '2';
        } elseif ($request->payment_mode == '100') {
            $payment_mode = '1';
        } else {
            $partial_amt = ($request->totalFair * 10) / 100;
            $payment_mode = '0';
        }
        $add = TourPackageBooking::create([
            'orderId' => $orderId,
            'tour_pkgId' => $request->tour_id,
            'name' => $request->name ?? '',
            'mobile' => $request->mobile ?? '',
            'email' => $request->email ?? '',
            'pickUpLoc' => $request->pickUpLocation ?? '',
            'pickUp_date' => $request->travelDate ?? '',
            'coupon_id' => $request->coupon_id ?? NULL,
            'biling_name' => $request->gstName ?? '',
            'biling_gstNo' => $request->gstNo ?? NULL,
            'add_onService' => json_encode($request->add_onService) ?? '',
            'payment_mode' => $payment_mode  ?? '',
            'total_faire' => $request->totalFair ?? '',
            'payment_infoId' => '',
        ]);

        if ($add) {
            return response()->json(['status' => true, 'message' => 'Data Addedd Successfully!']);
        }
    }

    public function localRouteSearch(Request $request)
    {
        $data = [];
        try {
            $validated = $request->validate([
                'timeschaduleId' => 'required',
            ]);
            $timeschaduleId = DB::table('time_schadule')
                ->where('time_id', $request->timeschaduleId)
                ->first();


            $timeRecords = DB::table('time_schadule')
                ->where(['time_id' => $request->timeschaduleId])
                ->pluck('car_category')
                ->toArray();

            if (sizeof($timeRecords) < 1) {
                return redirect()->back()->with('error', 'Data Not Found!');
            }

            if ($timeRecords) {
                $data['CarCategory'] = CarCategory::with('car')->whereIn('id', $timeRecords)->where('status', '1')->orderBy('per_km_cost', 'ASC')->get();
                foreach ($data['CarCategory'] as $key => $value) {
                    $timeschaduleData = TimeSchadule::where(['time_id' => $request->timeschaduleId, 'car_category' => $value->id])->first();
                    $time_data = DB::table('times')->where('id', $timeschaduleData->time_id)->first();

                    $timeschaduleData->time_id = $time_data->time;
                    $value->timeschaduleData = $timeschaduleData;
                }
            } else {
                $data['CarCategory'] = []; // Or handle the null case as needed
            }

            $data['pickup'] = $request->pickUpLocation;
            $data['destination'] = $timeschaduleId->time ?? '--';
            $data['timeschaduleId'] = $timeschaduleId;

            $pickupCity = $data['pickup'];
            $destination = [];
            $this->getEnquiry([$pickupCity], $destination, $request->phone);
            return view('web.pages.localRouteSearch', compact('data'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function cabBooking(Request $request)
    {
        try {
            $validated = $request->validate([
                'carCategorId' => 'required',
                'phone' => 'required',
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'payment_mode' => 'required',
                'total_fair' => 'required',
            ]);

            $orderId = '#ORD_' . rand(10000, 99999);
            if ($request->type == 'outstation') {
                $jsonPickupLoc = $request->pickupLoc;
                $type = '1';
                $subType = '';
                $validated = $request->validate([
                    'pickupLoc' => 'required',
                    'destination' => 'required',
                ]);

                if ($request->subType == 'route') {
                    $orderId = '#ORD_OSRTCB' . rand(10000, 99999); //OSRTCB :out station route trip  cab booking
                    $subType = '0';
                } else {
                    $orderId = '#ORD_OSOWCB' . rand(10000, 99999); //OSRTCB :out station one way  cab booking
                    $subType = '1';
                }
            } else {
                $pickuoLoc = $request->pickupLoc;
                $jsonPickupLoc = json_encode([$pickuoLoc]);
                $type = '0';
                if ($request->subType == 'route') {
                    $orderId = '#ORD_LRTCB' . rand(10000, 99999); // LRTCB: local route trip cab booking
                    $subType = '3';
                    $validated = $request->validate([
                        'timeScahduleId' => 'required',
                    ]);
                } else {
                    $subType = '2';
                    $validated = $request->validate([
                        'destination' => 'required',
                    ]);
                }
            }

            if ($request->has('timeScahduleId')) {
                $timeScahduleData = TimeSchadule::where('time', 'like', '%' . $request->timeScahduleId)->first();
            }

            $total_fair = $request->total_fair;

            if (!empty($request->add_on_services) && count($request->add_on_services) == '2') {
                $total_fair = ($total_fair + 300);
            }

            $gst = ($total_fair * 5) / 100;
            $total_fair = ($total_fair + $gst);
            $online_payment = $total_fair;
            $offline_payment = '0';
            if ($request->payment_mode != '1') {
                $online_payment = ($total_fair * 15) / 100;
                $offline_payment = ($total_fair - $online_payment);
            }

            $destination = $request->destination;
            $jsonDestination = json_encode($destination);

            $car_categoryData = $this->getCarCategoryData($request->carCategorId);

            $add = cabBooking::create([
                'orderId' => $orderId,
                'type' => $type,
                'subType' => $subType,
                'carCategory_id' => $request->carCategorId,
                'name' => $request->name,
                'mobile' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'timeSchadule_id' => isset($timeScahduleData) ? $timeScahduleData->id : '',
                'pickupLoc' => $request->pickupLoc,
                'destinationLoc' => $jsonDestination ?? '',
                'pickUp_date' => $request->travelDate ?? '',
                'pickUp_time' => $request->travelTime ?? '',
                'destination_date' => $request->destination_date ?? '',
                'destination_time' => $request->destination_time ?? '',
                'fuel_type' => $request->fuel_type ?? '2',
                'coupon_id' => $request->coupon_id ?? '',
                'biling_name' => $request->biling_name ?? '',
                'biling_gstNo' => $request->biling_gstNo ?? '',
                'add_onService' => json_encode($request->add_on_services) ?? '',
                'payment_mode' => $request->payment_mode,
                'total_faire' => $total_fair,
                'payment_infoId' => $request->razorpay_no ?? '',
                'online_payment' => $online_payment ?? '',
                'offline_payment' => $offline_payment ?? '',
                'include_km' => $request->included_km ?? '',
                'extra_fair_perKm' => $request->extra_fair_perKm ?? '',
            ]);

            $mailData = $request->email;
            $data = [
                'orderId' => $orderId,
                'type' => $type,
                'subType' => $subType,
                'is_airpotToFrom' => '',
                'pickUpLoc' => $request->pickupLoc,
                'destinationLoc' => $request->destination,
                'pickUp_time' => $request->travelTime,
                'include_km' => $request->included_km,
                'extra_fair_perKm' => $request->extra_fair_perKm,
                'online_payment' => $online_payment,
                'offline_payment' => $offline_payment,
            ];

            $this->updateRazorpayPaymentStatus($request->razorpay_no, $request->total_fair);

            Mail::to($mailData)->send(new UserConfirmBooking($data));
            Mail::to('cabyatrabooking@gmail.com')->send(new UserConfirmBooking($data));

            return redirect()->route('thankYou')->with('success', 'Booking Successfully!');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('home')->with('error', 'Something went wrong!');
        }
    }

    public function testing()
    {
        // $data = $this->updateRazorpayPaymentStatus('pay_R8lXzuK97CIKHK', 100);
        // dd($data);
    }
    public function outStationRoutesearch(Request $request)
    {
        $validated = $request->validate([
            'pickUpLoc' => 'required',
            'destination' => 'required',
        ]);

        if ($request->has('filter_request')) {
            $request->destination = json_decode($request->destination);
        }
        if ((sizeof($request->destination) < 2)) {
            $destination = $request->destination;
            $destination[1] = $request->pickUpLoc;
            $request->merge(['destination' => $destination]);
        } else {
            $size = count($request->destination);
            $destination = $request->destination;
            $destination[$size] = $request->pickUpLoc;
            $request->merge(['destination' => $destination]);
        }

        $filteredDestinationData = array_filter($request->destination, function ($value) {
            return !is_null($value); // Only include values that are not null
        });
        $request->destination = $filteredDestinationData;


        if (is_array($request->destination) && (sizeof($request->destination) > 1)) {
            $distance = $this->calculateMultipleDistances(array_merge([$request->pickUpLoc], $request->destination));
            if (empty($distance['totalDistance'])) {
                return redirect()->back()->with('error', 'No Route Found!');
            }

            if (($distance['totalDistance'] < 250)) {
                $distance['totalDistance'] = 250;
            }

            $data['pickup'] = $request->pickUpLoc;
            $data['tripDetails'] = $distance['tripDetails'];
            $data['destination'] = $request->destination;
            $data['totalKm'] = $distance['totalDistance'];
            $data['distanceKm'] = $distance['totalDistance'];
            $data['distanceData'] = $distance;
        } else {
            if (is_array($request->destination)) {
                $distance = $this->calculateDistance($request->pickUpLoc, $request->destination[0]);
            } else {
                $distance = $this->calculateDistance($request->pickUpLoc, $request->destination);
            }

            if (isset($distance) && $distance['status'] == false) {
                return redirect()->back()->with('error', 'No Route Found!');
            }

            $data['pickup'] = $request->pickUpLoc;
            $data['tripDetails'] = '';
            $data['destination'] = $request->destination;
            $data['totalKm'] = $distance['distance'];
            $data['distanceKm'] = $distance['distance'];
            $data['distanceData'] = $distance;
        }

        $data['CarCategory'] = CarCategory::with(['car' => function ($query) {
            $query->where('status', '1');
        }])
            ->where('status', '1')
            ->has('car')
            ->get();


        foreach ($data['CarCategory'] as $category) {
            $category->carData = $category->car->first(['id', 'name', 'image', 'min_charge']);
        }

        if ($request->has('filter_request')) {
            $start = Carbon::createFromFormat('Y-m-d', $request->filteredStartDate);
            $end = Carbon::createFromFormat('Y-m-d', $request->filteredEndDate);

            $days_difference = $start->diffInDays($end) + 1;

            $filterDayPrice = ($days_difference * 250);
            if ($filterDayPrice > $data['distanceKm']) {
                $data['totalKm'] = $filterDayPrice;
                $data['distanceKm'] = $filterDayPrice;
            }

            $carbonTime = Carbon::createFromFormat('H:i', $request->filteredStartTime);
            $time_in_12_hour_format = $carbonTime->format('g:i A');
            $data['filteredStartDate'] = $request->filteredStartDate;
            $data['filteredEndDate'] = $request->filteredEndDate;
            $data['filteredStartTime'] = $time_in_12_hour_format;
            $data['days_difference'] = intval($days_difference);
            $data['distanceData'] = $distance;
        }

        $pickupCity = $data['pickup'];
        $this->getEnquiry([$pickupCity], $data['destination'], $request->phone);
        return view('web.pages.outStationRouteSearchList', compact('data'));
    }

    // public function roundTripModalPriceUpdate(Request $request)
    // {
    //     // dd($request->all());
    //     $response = [];
    //     $start = Carbon::createFromFormat('Y-m-d', $request->start_travel_Date);
    //     $end = Carbon::createFromFormat('Y-m-d', $request->end_travel_Date);

    //     $days_difference = $start->diffInDays($end) + 1;

    //     $filterDayDistance = ($days_difference * 250);
    //     if ($filterDayDistance > $request->included_km) {
    //         $data['totalKm'] = $filterDayPrice;
    //         $data['distanceKm'] = $filterDayPrice;
    //     }
    // }

    public function outStationRouteFilterSearch(Request $request)
    {
        $validated = $request->validate([
            'pickUpLoc' => 'required',
            'destination' => 'required',
        ]);

        if ($request->has('datFIlterdDistance')) {
        }


        if ((sizeof($request->destination) < 2)) {
            $destination = $request->destination;
            $destination[1] = $request->pickUpLoc;
            $request->merge(['destination' => $destination]);
        }

        if (is_array($request->destination) && (sizeof($request->destination) > 1)) {
            $distance = $this->calculateMultipleDistances(array_merge([$request->pickUpLoc], $request->destination));
            if (empty($distance['totalDistance'])) {
                return redirect()->back()->with('error', 'No Route Found!');
            }


            if ($distance['totalDistance'] < 250) {
                $distance['totalDistance'] = 250;
            }

            $data['pickup'] = $request->pickUpLoc;
            $data['tripDetails'] = $distance['tripDetails'];
            $data['destination'] = $request->destination;
            $data['totalKm'] = $distance['totalDistance'];
            $data['distanceKm'] = $distance['totalDistance'];
        } else {
            if (is_array($request->destination)) {
                $distance = $this->calculateDistance($request->pickUpLoc, $request->destination[0]);
            } else {
                $distance = $this->calculateDistance($request->pickUpLoc, $request->destination);
            }

            if (isset($distance) && $distance['status'] == false) {
                return redirect()->back()->with('error', 'No Route Found!');
            }

            $data['pickup'] = $request->pickUpLoc;
            $data['tripDetails'] = '';
            $data['destination'] = $request->destination;
            $data['totalKm'] = $distance['distance'];
            $data['distanceKm'] = $distance['distance'];
        }

        $data['CarCategory'] = CarCategory::with(['car' => function ($query) {
            $query->where('status', '1');
        }])
            ->where('status', '1')
            ->has('car')
            ->get();


        foreach ($data['CarCategory'] as $category) {
            $category->carData = $category->car->first(['id', 'name', 'image', 'min_charge']);
        }
        return view('web.pages.outStationRouteSearchList', compact('data'));
    }

    public function outStationRouteBooking(Request $request)
    {
        try {
            try {
                $validated = $request->validate([
                    'pickupLoc' => 'required',
                    'destination' => 'required',
                    'carCategorId' => 'required',
                    'bookingDate' => 'required',
                    'bookingTime' => 'required',
                    'phone' => 'required',
                    'name' => 'required',
                    'email' => 'required',
                    'address' => 'required',
                    'payment_mode' => 'required',
                    'total_fair' => 'required',
                ]);
            } catch (\Throwable $e) {
                dd($e->errors());
            }

            $orderId = '#ORD_OSRTCB' . rand(10000, 99999); //OSRTCB :out station route trip  cab booking
            $type = '1';
            $subType = '0';

            if ($request->has('timeScahduleId')) {
                $timeScahduleData = TimeSchadule::where('time', 'like', '%' . $request->timeScahduleId)->first();
            }

            $total_fair = $request->total_fair;
            $online_payment = $total_fair;
            $offline_payment = 0;

            if ($request->payment_mode != '1') {
                $online_payment = ($total_fair * 15) / 100;
                $offline_payment = ($total_fair - $online_payment);
            }

            $pickupCity = $request->pickupLoc;
            $jsonPickup = json_encode([$pickupCity]);

            $add = cabBooking::create([
                'orderId' => $orderId,
                'type' => $type,
                'subType' => $subType,
                'carCategory_id' => $request->carCategorId,
                'name' => $request->name,
                'mobile' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'timeSchadule_id' => isset($timeScahduleData) ? $timeScahduleData->id : '',
                'pickupLoc' => $jsonPickup,
                'destinationLoc' => $request->destination ?? '',
                'pickUp_date' => $request->bookingDate ?? '',
                'pickUp_time' => $request->bookingTime ?? '',
                'destination_date' => $request->endBookingDate ?? '',
                'destination_time' => $request->destination_time ?? '',
                'fuel_type' => $request->fuel_type ?? '2',
                'coupon_id' => $request->coupon_id ?? '',
                'biling_name' => $request->biling_name ?? '',
                'biling_gstNo' => $request->biling_gstNo ?? '',
                'add_onService' => json_encode($request->add_on_services) ?? '',
                'payment_mode' => $request->payment_mode,
                'total_faire' => $request->total_fair,
                'payment_infoId' => $request->razorpay_paymentId ?? '',
                'online_payment' => $online_payment ?? '',
                'offline_payment' => $offline_payment ?? '',
                'include_km' => $request->included_km ?? '',
                'extra_fair_perKm' => $request->extra_fair_perKm ?? '',
            ]);

            $mailData = $request->email;
            $data = [
                'orderId' => $orderId,
                'type' => $type,
                'subType' => $subType,
                'is_airpotToFrom' => '',
                'pickUpLoc' => $request->pickupLoc,
                'destinationLoc' => $request->destination,
                'pickUp_time' => $request->bookingTime,
                'include_km' => $request->included_km,
                'extra_fair_perKm' => $request->extra_fair_perKm,
                'online_payment' => $online_payment,
                'offline_payment' => $offline_payment,
            ];

            $this->updateRazorpayPaymentStatus($request->razorpay_paymentId, $request->total_fair);

            Mail::to($mailData)->send(new UserConfirmBooking($data));
            Mail::to('cabyatrabooking@gmail.com')->send(new UserConfirmBooking($data));
            return redirect()->route('thankYou')->with('success', 'Booking Successfully!');
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('home')->with('error', 'Something went wrong!');
        }
    }

    public function airPortSearch(Request $request)
    {
        $validated = $request->validate([
            'is_airpotToFrom' => 'required',
            'pickupLoc' => 'required',
            'destination' => 'required',
            'phone' => 'required',
        ]);

        $distance = $this->calculateDistance($request->pickupLoc, $request->destination);
        if ($distance['status'] == false) {
            return redirect()->back()->with('error', 'No Route Found!');
        }

        $data['is_airpotToFrom'] = $request->is_airpotToFrom;
        $data['pickup'] = $request->pickupLoc;
        $data['destination'] = $request->destination;
        $data['totalKm'] = $distance['distanceValue'];
        $data['distanceKm'] = $distance['distance'];

        $data['CarCategory'] = CarCategory::with(['car' => function ($query) {
            $query->where('status', '1');
        }])
            ->where('status', '1')
            ->has('car')
            ->get(['id', 'name', 'per_km_cost']);

        foreach ($data['CarCategory'] as $category) {
            $category->carData = $category->car->first(['id', 'name', 'image', 'min_charge']);
            $airportData = CabAirportFair::where(['car_category' => $category->id, 'type' => '0'])->first();
            $category->airportData = $airportData ?? '';
        }

        $pickupCity = $data['pickup'];
        $destinationCity = $data['destination'];
        $this->getEnquiry([$pickupCity], [$destinationCity], $request->phone);
        return view('web.pages.airPortSearchCabList', compact('data'));
    }

    public function airPorCabBooking(Request $request)
    {
        try {
            $validated = $request->validate([
                'pickupLoc' => 'required',
                'destination' => 'required',
                'carCategorId' => 'required',
                'travelDate' => 'required',
                'travelTime' => 'required',
                'phone' => 'required',
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'payment_mode' => 'required',
                'total_fair' => 'required',
            ]);


            $orderId = '#ORD_OSLACB' . rand(10000, 99999); //OSRTCB :out local airport cab booking
            $type = '1';
            $subType = '2';
            $is_airpotToFrom = $request->is_airpotToFrom;

            if ($request->has('timeScahduleId')) {
                $timeScahduleData = TimeSchadule::where('time', 'like', '%' . $request->timeScahduleId)->first();
            }

            $total_fair = $request->total_fair;

            if (!empty($request->add_on_services) && array_key_exists("1", $request->add_on_services)) {
                $total_fair = $total_fair + 300;
            }

            if ($request->fuel_type == '0') {
                $total_fair = $total_fair + 1000;
            }

            $gst_amt = ($total_fair * 5) / 100;
            $total_fair = ($total_fair + $gst_amt);

            if ($request->payment_mode == '0') {
                $online_amt = ($total_fair * 15) / 100;
                $offline_amt = $total_fair - $online_amt;
            } else {
                $online_amt = $total_fair;
                $offline_amt = 0;
            }

            $pickupCity = $request->pickupLoc;
            $destinationCity = $request->destination;
            $jsonPickup = json_encode([$pickupCity]);
            $jsonDestination = json_encode($destinationCity);
            $add = cabBooking::create([
                'orderId' => $orderId,
                'type' => $type,
                'subType' => $subType,
                'carCategory_id' => $request->carCategorId,
                'is_airpotToFrom' => $is_airpotToFrom,
                'name' => $request->name,
                'mobile' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'timeSchadule_id' => '',
                'pickupLoc' => $jsonPickup,
                'destinationLoc' => $jsonDestination ?? '',
                'pickUp_date' => $request->travelDate ?? '',
                'pickUp_time' => $request->travelTime ?? '',
                'destination_date' => $request->destination_date ?? '',
                'destination_time' => $request->destination_time ?? '',
                'fuel_type' => $request->fuel_type,
                'coupon_id' => $request->coupon_id ?? '',
                'biling_name' => $request->biling_name,
                'biling_gstNo' => $request->biling_gstNo,
                'add_onService' => json_encode($request->add_on_services),
                'online_payment' => $online_amt,
                'offline_payment' => $offline_amt,
                'payment_mode' => $request->payment_mode,
                'total_faire' => $total_fair,
                'payment_infoId' => $request->payment_infoId ?? '',
                'include_km' => $request->included_km ?? '',
                'extra_fair_perKm' => $request->extra_fair_perKm ?? '',
            ]);

            $mailData = $request->email;
            $data = [
                'orderId' => $orderId,
                'type' => $type,
                'subType' => $subType,
                'is_airpotToFrom' => $request->is_airpotToFrom,
                'pickUpLoc' => $request->pickupLoc,
                'destinationLoc' => $request->destination,
                'pickUp_time' => $request->travelTime,
                'include_km' => $request->included_km,
                'extra_fair_perKm' => $request->extra_fair_perKm,
                'online_payment' => $online_amt,
                'offline_payment' => $offline_amt,
            ];

            $this->updateRazorpayPaymentStatus($request->payment_infoId, $request->total_fair);

            Mail::to($mailData)->send(new UserConfirmBooking($data));
            Mail::to('cabyatrabooking@gmail.com')->send(new UserConfirmBooking($data));

            return redirect()->route('thankYou')->with('success', 'Booking Successfully!');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_function(Request $request, $slug)
    {
        $data = [];
        $data['setting'] = Settings::first();
        if ($slug == 'term-condition') {
            return view('web.pages.term_condition', compact('data'));
        }
        if ($slug == 'privacy-policy') {
            return view('web.pages.privacy_policy', compact('data'));
        }
        if ($slug == 'about-us') {
            return view('web.pages.about_us', compact('data'));
        }

        if ($slug == 'faq') {
            return view('web.pages.faq', compact('data'));
        }
        if ($slug == 'thank-you') {
            return view('web.pages.thank_you', compact('data'));
        }




        $data['footerLink'] = FooterLink::where('status', '1')->orderBy('id', 'DESC')->get();
        $data['footerLinkData'] = FooterLink::where(['status' => '1'])->where('slug', 'like', '%' . $slug . '%')->orderBy('id', 'DESC')->first();

        if ($data['footerLinkData'] == null) {
            return redirect()->route('home')->with('error', 'No Data Found!');
        }
        $data['package'] = Packages::where('status', '1')->orderBy('id', 'DESC')->get();
        $data['time'] = Time::where('status', '1')->orderBy('id', 'DESC')->get();
        $data['timeSchadule'] = TimeSchadule::where('status', '1')->orderBy('id', 'DESC')->get();
        return view('web.master_index', compact('data'));
    }

    public function getEnquiry($pickUp_loc, $destination_loc, $phone)
    {
        try {
            $add = SearchEnquiry::create([
                'pickUp_loc' => json_encode($pickUp_loc),
                'destination_loc' => json_encode($destination_loc),
                'phone' => $phone ?? '',
            ]);

            if ($add) {
                return response()->json(['status' => true, 'message' => 'Enquiry submitted successfully!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!' . $th->getMessage()]);
        }
    }

    public function thankYou(Request $request)
    {
        return view('web.pages.thank_you', compact('data'));
    }


    public function calculateDistance($originCity, $destinationCity)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY'); // Make sure to store your API key in the .env file
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'query' => [
                'origins' => $originCity,
                'destinations' => $destinationCity,
                'mode' => 'driving',
                'units' => 'metric',
                'key' => $apiKey,
            ]
        ]);
        $data = json_decode($response->getBody(), true);

        if ($data['status'] == 'OK') {
            $origin = $data['origin_addresses'][0];
            $destination = $data['destination_addresses'][0];
            if ($data['rows'][0]['elements'][0]['status'] === 'ZERO_RESULTS') {
                return [
                    'status' => false,
                    'origin' => '',
                    'destination' => '',
                    'distance' => '',
                    'duration' => '',
                    'distanceValue' => '',
                ];
            } elseif ($data['rows'][0]['elements'][0]['status'] === 'NOT_FOUND') {
                return [
                    'status' => false,
                    'origin' => '',
                    'destination' => '',
                    'distance' => '',
                    'duration' => '',
                    'distanceValue' => '',
                ];
            } else {
                $distance = $data['rows'][0]['elements'][0]['distance']['text'];
                $duration = $data['rows'][0]['elements'][0]['duration']['text'];

                $distanceValue = $data['rows'][0]['elements'][0]['distance']['value'];
                return [
                    'status' => true,
                    'origin' => $origin,
                    'destination' => $destination,
                    'distance' => $distance,
                    'duration' => $duration,
                    'distanceValue' => $distanceValue / 1000,
                ];
            }
        } else {
            return response()->json(['error' => 'Error fetching data from Distance Matrix: ' . $data['status']]);
        }
    }
    public function calculateMultipleDistances($cities)
    {
        // dd($cities);
        $apiKey = env('GOOGLE_MAPS_API_KEY'); // Ensure the API key is set in your .env file
        $client = new Client();
        $results = [];
        $totalDistance = 0;
        for ($i = 0; $i < count($cities) - 1; $i++) {
            $originCity = $cities[$i];
            $destinationCity = $cities[$i + 1];

            $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'query' => [
                    'origins' => $originCity,
                    'destinations' => $destinationCity,
                    'mode' => 'driving',
                    'units' => 'metric',
                    'key' => $apiKey,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['status'] === 'OK') {
                $origin = $data['origin_addresses'][0];
                $destination = $data['destination_addresses'][0];

                if ($data['rows'][0]['elements'][0]['status'] === 'ZERO_RESULTS') {
                    $results[] = [
                        'status' => false,
                        'origin' => $originCity,
                        'destination' => $destinationCity,
                        'distance' => '',
                        'duration' => '',
                        'distanceValue' => '',
                    ];
                } else {
                    $distance = $data['rows'][0]['elements'][0]['distance']['text'];
                    $duration = $data['rows'][0]['elements'][0]['duration']['text'];
                    $distanceValue = $data['rows'][0]['elements'][0]['distance']['value'] / 1000; // Convert meters to kilometers

                    $totalDistance += $distanceValue; // Accumulate total distance

                    $results[] = [
                        'status' => true,
                        'origin' => $origin,
                        'destination' => $destination,
                        'distance' => $distance,
                        'duration' => $duration,
                        'distanceValue' => $distanceValue,
                    ];
                }
            } else {
                $results[] = [
                    'status' => false,
                    'origin' => $originCity,
                    'destination' => $destinationCity,
                    'error' => 'Error fetching data from Distance Matrix: ' . $data['status'],
                ];
            }
        }

        return [
            'tripDetails' => $results,
            'totalDistance' => $totalDistance,
        ];
    }

    public function getCarCategoryData($id)
    {
        $carCategory = CarCategory::where(['id' => $id, 'status' => '1'])->orderBy('id', 'DESC')->first();
        return $carCategory;
    }
    public function createRazorpayOrderId(Request $request)
    {
        $amount = $request->amount;
        // $amount = 0.01;
        $ch = curl_init();
        $fields = array();
        $fields["amount"] = $amount * 100;
        $fields["currency"] = "INR";
        $fields["payment_capture"] = 1;
        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "rzp_live_0eAwBezccR23jF:GSSv5Xd7z5LLU0ahIkPcAAyT");
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);

        // dd($data);
        if (empty($data) or (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
            $data = FALSE;
        } else {
            return json_decode($data, TRUE);
        }
    }

    public function updateRazorpayPaymentStatus($paymentID, $amount)
    {
        // Log the start of the process
        Log::info('Starting Razorpay capture process', [
            'payment_id' => $paymentID,
            'amount' => $amount
        ]);

        try {
            // Make the API request
            $response = Http::withBasicAuth('rzp_live_0eAwBezccR23jF', 'GSSv5Xd7z5LLU0ahIkPcAAyT')
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post("https://api.razorpay.com/v1/payments/{$paymentID}/capture", [
                    'amount' => $amount,
                    'currency' => 'INR',
                ]);

            // Log the response status and body
            Log::info('Razorpay capture response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            // Return JSON-decoded response
            return $response->json();
        } catch (\Exception $e) {
            // Log exception details
            Log::error('Exception during Razorpay capture', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'error' => true,
                'message' => 'Exception occurred during capture.',
                'details' => $e->getMessage()
            ];
        }
    }

    // public function getCityFromAddress($address)
    // {
    //     try {
    //         $response = $this->client->get('https://maps.googleapis.com/maps/api/geocode/json', [
    //             'query' => [
    //                 'address' => $address,
    //                 'key' => env('GOOGLE_MAPS_API_KEY'),
    //                 'result_type' => 'locality|administrative_area_level_1',
    //             ]
    //         ]);

    //         $data = json_decode($response->getBody(), true);
    //         // dump($data);
    //         if ($data['status'] !== 'OK') {
    //             Log::error('Google Maps API error', ['response' => $data]);
    //             return null;
    //         }

    //         // Extract city from results
    //         foreach ($data['results'] as $result) {
    //             foreach ($result['address_components'] as $component) {
    //                 if (in_array('locality', $component['types'])) {
    //                     return $component['long_name'];
    //                 }
    //                 if (in_array('administrative_area_level_1', $component['types'])) {
    //                     return $component['long_name'];
    //                 }
    //             }
    //         }

    //         return null;
    //     } catch (\Exception $e) {
    //         Log::error('Location service error', ['error' => $e->getMessage()]);
    //         return null;
    //     }
    // }

    public function getCityFromAddress($address)
    {
        try {
            $response = $this->client->get('https://maps.googleapis.com/maps/api/geocode/json', [
                'query' => [
                    'address' => $address,
                    'key' => env('GOOGLE_MAPS_API_KEY'),
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if ($data['status'] !== 'OK') {
                Log::error('Google Maps API error', ['response' => $data]);
                return null;
            }

            $city = null;
            $fallback = null;
            $state = null;

            foreach ($data['results'] as $result) {
                if ($address == 'Delhi') {
                    $fallback = 'Delhi';
                }
                foreach ($result['address_components'] as $component) {

                    if (in_array('sublocality_level_1', $component['types']) && !$fallback) {
                        $fallback = $component['long_name'];
                    }
                    if (in_array('locality', $component['types'])) {
                        return $component['long_name'];
                    }

                    if (in_array('administrative_area_level_2', $component['types']) && !$fallback) {
                        $fallback = $component['long_name'];
                    }

                    if (in_array('administrative_area_level_1', $component['types'])) {
                        $state = $component['long_name'];
                    }
                }
            }

            // dd($fallback);
            return $fallback ?? $state ?? null;
        } catch (\Exception $e) {
            Log::error('Location service error', ['error' => $e->getMessage()]);
            return null;
        }
    }



    public function checkCustomCity($pickup, $destination)
    {
        $pickupCity = $this->getCityFromAddress($pickup);
        $destinationCity = $this->getCityFromAddress($destination);

        if (!$pickupCity || !$destinationCity) {
            return false;
        }
        $customCity = CustomCitiesPrice::where(['pickup_loc' => $pickupCity, 'destination_loc' => $destinationCity])->first();
        if ($customCity) {
            return $customCity;
        }

        return false;
    }

    public function termCondition()
    {
        $data['setting'] = Settings::first();
        return view('web.pages.term_condition', compact('data'));
    }
    public function privacyPolicy()
    {
        $data['setting'] = Settings::first();
        return view('web.pages.privacy_policy', compact('data'));
    }
    public function aboutUs()
    {
        $data['setting'] = Settings::first();
        return view('web.pages.about_us', compact('data'));
    }

    public function deleteAccount(Request $request)
    {
        $data = [];
        return view('web.pages.delete_account', compact('data'));
    }


    public function razorpayWebhook(Request $request)
    {
        $payload = file_get_contents('php://input');
        $signature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'] ?? '';
        $secret = env('RAZORPAY_WEBHOOK_SECRET');
        $expectedSignature = hash_hmac('sha256', $payload, $secret);

        if (!hash_equals($expectedSignature, $signature)) {
            Log::warning('Invalid Razorpay Webhook Signature');
            return response()->json(['status' => 'invalid signature'], 400);
        }

        $event = json_decode($payload, true);
        Log::info('Razorpay Webhook Event:', $event);

        // Example: Handle payment captured event
        if (isset($event['event']) && $event['event'] === 'payment.captured') {
            $paymentId = $event['payload']['payment']['entity']['id'] ?? null;
            $amount = $event['payload']['payment']['entity']['amount'] ?? null;

            // TODO: Update your payment/booking status in DB using $paymentId and $amount
            // Example:
            $booking = cabBooking::where('payment_infoId', $paymentId)->first();
            if ($booking) {
                $booking->status = 'paid';
                $booking->save();
                Log::info('Booking marked as paid for paymentId: ' . $paymentId);
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}
