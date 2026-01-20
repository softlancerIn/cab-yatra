<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Services\CommonServices;

use App\Models\{
    DriverCarDetails,
    CabAirportFair,
    TourPackages,
    TimeSchadule,
    CarCategory,
    Cars,
    Driver,
    User,
};

use DB;

class UserHomeController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}
    public function completeRegistration(Request $request)
    {
        $user = $request->user();

        if (!$request->isMethod('POST')) {
            $data = [
                'status' => true,
                'message' => 'This method not supported!',
            ];
            return response()->json($data, 200);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'lat' => 'required',
            'long' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed!',
                'error' => $validator->errors(),
            ], 422);
        }

        $add = User::where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Added Successfully!'
        ], 200);
    }

    public function home(Request $request)
    {
        $data = [];
        $data['tourPackages'] = TourPackages::where('status', '1')->get(['id', 'name', 'image']);

        $data = [
            'status' => true,
            'message' => 'Home Data Send Successfully!',
            'data' => $data,
        ];

        return response()->json($data, 200);
    }

    public function cabList(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'type' => 'required|in:oneway,round_trip,local_trip,airport',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Failed!',
                    'error' => $validator->errors(),
                ], 422);
            }

            $carList = $this->getCarListByType($request->type);

            if (empty($carList)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid trip type or no available cars found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Car list fetched successfully.',
                'data' => $carList,
            ], 200);
        }
    }

    public function cabDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:oneway,round_trip,local_trip,airport',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed!',
                'error' => $validator->errors(),
            ], 422);
        }

        $carList = $this->getCarDetailByType($request->type, $request->id);
        if (empty($carList)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid trip type or no available cars found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Car Details fetched successfully.',
            'data' => $carList,
        ], 200);
    }

    public function cabBooking(Request $request)
    {
        if (!$request->isMethod('POST')) {
            return response()->json([
                'status' => true,
                'message' => 'Method not supported!',
            ], 200);
        }

        $validator = Validator::make($request->all(), [
            'subType' => 'required|in:oneway,round_trip,local_trip,airport',
            'carCategorId' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'payment_mode' => 'required|in:0,1',
            'total_fair' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed!',
                'error' => $validator->errors(),
            ], 422);
        }

        switch ($request->subType) {
            case 'oneway':
                $type = '1';
                $subType = '1';
                $is_airport = '2';
                $orderId = '#ORD_OSOWCB' . rand(10000, 99999); //OSRTCB :out station one way  cab booking
                break;
            case 'round_trip':
                $type = '1';
                $subType = '0';
                $is_airport = '2';
                $orderId = '#ORD_OSRTCB' . rand(10000, 99999); //OSRTCB :out station route trip  cab booking
                break;
            case 'local_trip':
                $type = '0';
                $subType = '0';
                $is_airport = '2';
                $orderId = '#ORD_LRTCB' . rand(10000, 99999); // LRTCB: local route trip cab booking
                break;
            case 'airport':
                $type = '0';
                $subType = '2';
                $is_airport = '1'; // check here is airport type  
                $orderId = '#ORD_OSLACB' . rand(10000, 99999); //OSRTCB :out local airport cab booking
                break;
            default:
                $type = '1';
                $subType = '1';
                $is_airport = '2';
                $orderId = '#ORD_' . rand(10000, 99999);
                break;
        }

        $total_fair = $request->total_fair;
        $online_payment = '';
        $offline_payment = '';
        if ($request->payment_mode == '0') {
            //
        }

        $add = '';
    }

    private function getCarListByType($type)
    {
        switch ($type) {
            case 'oneway':
                $carList = CabAirportFair::with(['cabCategory' => function ($query) {
                    $query->select('id', 'name');
                }])->where('type', '1')->orderBy('id', 'DESC')->get();

                return $this->loadCarImagesForAirportAndOneway($carList);

            case 'round_trip':
                return CarCategory::with(['car' => function ($query) {
                    $query->select('id', 'image', 'category');
                }])
                    ->where('status', '1')
                    ->orderBy('id', 'DESC')
                    ->get();

            case 'local_trip':
                $carList =  TimeSchadule::with([
                    'timeData' => function ($query2) {
                        $query2->select('id', 'time');
                    },
                    'carCategory' => function ($query3) {
                        $query3->select('id', 'name');
                    }
                ])->where('status', '1')->orderBy('id', 'DESC')->get();

                return $this->loadCarImagesForLocalTrip($carList);

            case 'airport':
                $carList = CabAirportFair::with(['cabCategory' => function ($query) {
                    $query->select('id', 'name');
                }])->where('type', '0')->orderBy('id', 'DESC')->get();

                return $this->loadCarImagesForAirportAndOneway($carList);

            default:
                return [];
        }
    }

    private function loadCarImagesForAirportAndOneway($carList)
    {
        $carCategoryIds = $carList->pluck('cabCategory.id')->toArray();
        $cars = Cars::whereIn('category', $carCategoryIds)->get()->keyBy('category');

        // Add the car image to the respective carData
        foreach ($carList as $carData) {
            $car = $cars->get($carData->cabCategory->id);
            $carData->car_image = $car ? $car->image : null;
        }

        return $carList;
    }

    private function loadCarImagesForLocalTrip($carList)
    {
        $carCategoryIds = $carList->pluck('carCategory.id')->toArray();
        $cars = Cars::whereIn('category', $carCategoryIds)->get()->keyBy('category');

        foreach ($carList as $carData) {
            $car = $cars->get($carData->carCategory->id);
            $carData->car_image = $car ? $car->image : null;
        }

        return $carList;
    }

    private function getCarDetailByType($type, $id)
    {
        switch ($type) {
            case 'oneway':
                $carList = CabAirportFair::with(['cabCategory' => function ($query) {
                    $query->select('id', 'name');
                }])->where(['type' => '1', 'id' => $id])->orderBy('id', 'DESC')->get();

                return $this->loadCarImagesForAirportAndOneway($carList);

            case 'round_trip':
                return CarCategory::with(['car' => function ($query) {
                    $query->select('id', 'image', 'category');
                }])
                    ->where(['status' => '1', 'id' => $id])
                    ->orderBy('id', 'DESC')
                    ->get();

            case 'local_trip':
                $carList =  TimeSchadule::with([
                    'timeData' => function ($query2) {
                        $query2->select('id', 'time');
                    },
                    'carCategory' => function ($query3) {
                        $query3->select('id', 'name');
                    }
                ])->where(['status' => '1', 'id' => $id])->orderBy('id', 'DESC')->get();

                return $this->loadCarImagesForLocalTrip($carList);

            case 'airport':
                $carList = CabAirportFair::with(['cabCategory' => function ($query) {
                    $query->select('id', 'name');
                }])->where(['type' => '0', 'id' => $id])->orderBy('id', 'DESC')->get();

                return $this->loadCarImagesForAirportAndOneway($carList);

            default:
                return [];
        }
    }
}
