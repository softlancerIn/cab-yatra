<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    CustomCitiesCarPrice,
    CustomCitiesPrice,
    DriverCarDetails,
    CabAirportFair,
    LocalPackages,
    TimeSchadule,
    TourPackages,
    SearchEnquiry,
    CarCategory,
    cabBooking,
    FooterLink,
    AppBanner,
    Settings,
    Driver,
    Time,
    Bill,
    Cars,
    Seo,
};

class CommonControler extends Controller
{
    public function globalDelete(Request $request, $model, $id)
    {
        switch ($model) {
            case 'car':
                $data = Cars::where('id', $id)->first();
                $data->delete();
                break;

            case 'localPackage':
                $data = LocalPackages::where('id', $id)->first();
                $data->delete();
                break;

            case 'carCategory':
                $data = CarCategory::where('id', $id)->first();
                $data->delete();
                break;

            case 'timeschadule':
                $data = TimeSchadule::where('id', $id)->first();
                $data->delete();
                break;

            case 'driver':
                $driver_data = Driver::where('id', $id)->first();
                $driver_detail = DriverCarDetails::where('driver_id', $driver_data->id)->first();

                $driver_data->delete();
                $driver_detail->delete();
                break;
            case 'app_banner':
                $app_banner = AppBanner::where('id', $id)->first();
                $app_banner->delete();
                break;
            case 'tourPackages':
                $tourPackage = TourPackages::where('id', $id)->first();
                $tourPackage->delete();
                break;
            case 'custom_cities_price':

                $checkCarPrice = CustomCitiesCarPrice::where('custom_citiesId', $id)->first();
                if ($checkCarPrice) {
                    return redirect()->back()->with('error', 'Please delete car price first!');
                }

                $customCities = CustomCitiesPrice::where('id', $id)->first();
                $customCities->delete();
                break;
            case 'time':
                $time = Time::where('id', $id)->first();
                $time->delete();
                break;

            case 'onewayAirportFair':
                $cabAirportFair = CabAirportFair::where('id', $id)->first();
                $cabAirportFair->delete();
                break;
            case 'footerLinks':
                $footer_link = FooterLink::where('id', $id)->first();
                $footer_link->delete();
                break;
            case 'seo':
                $seo = Seo::where('id', $id)->first();
                $seo->delete();
                break;
            case 'custom_carPrice':
                $customCarPrice = CustomCitiesCarPrice::where('id', $id)->first();
                $customCarPrice->delete();
                break;
            case 'billGenerate':
                $bill = Bill::where('id', $id)->first();
                $bill->delete();
                break;
            default:
                # code...
                break;
        }

        return redirect()->back()->with('success', 'Data Deleted Successfully!');
    }

    public function statusUpate(Request $request, $type, $id)
    {
        $status = '0';
        switch ($type) {
            case 'loaclPackage':
                $data = LocalPackages::where('id', $id)->first();
                if ($data->status == '0') {
                    $status = '1';
                }

                $update = LocalPackages::where('id', $id)->update([
                    'status' => $status,
                ]);
                break;

            case 'TimeSchadule':
                $data = TimeSchadule::where('id', $id)->first();
                if ($data->status == '0') {
                    $status = '1';
                }

                $update = TimeSchadule::where('id', $id)->update([
                    'status' => $status,
                ]);

            case 'cabBooking':
                $update = cabBooking::where('id', $id)->update([
                    'status' => $status,
                ]);

            case 'time':
                $data = Time::where('id', $id)->first();
                if ($data->status == '0') {
                    $status = '1';
                }
                $update = Time::where('id', $id)->update([
                    'status' => $status,
                ]);

            case 'carCategory':
                $data = CarCategory::where('id', $id)->first();
                if ($data->status == '0') {
                    $status = '1';
                }
                $update = CarCategory::where('id', $id)->update([
                    'status' => $status,
                ]);

            case 'seo':
                $data = Seo::where('id', $id)->first();
                if ($data->status == '0') {
                    $status = '1';
                }
                $update = Seo::where('id', $id)->update([
                    'status' => $status,
                ]);
            case 'search_enquiry':
                $data = SearchEnquiry::where('id', $id)->first();
                if ($data->is_read == '0') {
                    $status = '1';
                }
                $update = SearchEnquiry::where('id', $id)->update([
                    'is_read' => $status,
                ]);
                return response()->json(['status' => 'true', 'message' => 'Status Updated Successfully!']);
            default:
                # code...
                break;
        }

        return redirect()->back()->with('success', 'Status Updated Successfully!');
    }

    public function cmsPage(Request $request)
    {
        $data = [];
        if ($request->isMethod('GET')) {
            $data['settings'] = Settings::first();
            return view('Admin.cms_pages.index', compact('data'));
        } else {

            $validated = $request->validate([
                'mobile' => 'required',
                'email' => 'required',
                'address' => 'required',
                'about_us' => 'required',
                'term_condition' => 'required',
                'privacy_policy' => 'required',
            ]);

            $check = Settings::first();
            if ($check) {
                $add_update = Settings::where('id', '1')->update([
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'address' => $request->address,
                    'about_us' => $request->about_us,
                    'term_condition' => $request->term_condition,
                    'privacy_policy' => $request->privacy_policy,
                    'sla_agreements' => $request->sla_agreements,
                    'refund_policy' => $request->refund_policy,
                    'penalty' => $request->penalty,
                ]);
            } else {
                $add_update = Settings::create([
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'address' => $request->address,
                    'about_us' => $request->about_us,
                    'term_condition' => $request->term_condition,
                    'privacy_policy' => $request->privacy_policy,
                    'sla_agreements' => $request->sla_agreements,
                    'refund_policy' => $request->refund_policy,
                    'penalty' => $request->penalty,
                ]);
            }


            return redirect()->back()->with('sucess', 'Data Addedd Successfully!');
        }
    }
}
