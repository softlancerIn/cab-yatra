<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\CommonServices;
use Illuminate\Http\Request;
use App\Traits\SanctumAuthTrait;
use App\Models\Driver;
use App\Http\Requests\V2\StorePaymentMethodRequest;
use App\Http\Requests\V2\UpdatePaymentMethodRequest;

class PaymentMethodController extends Controller
{
    use SanctumAuthTrait;

    public function __construct(public CommonServices $commonServices) {}

    public function index()
    {
        $user = $this->sanctumUser();

        $driver = Driver::findOrFail($user->id);
        $paymentMethods = $driver->paymentMethods;

        return response()->json([
            'status'  => true,
            'message' => 'Payment methods fetched successfully',
            'data'    => $paymentMethods
        ]);

    }

    public function store(StorePaymentMethodRequest $request)
    {
        $user = $this->sanctumUser();

        $qrImagePath = null;
        if ($request->hasFile('qr_image')) {
            $qrImagePath = $request->file('qr_image')->store('qr_images', 'public');
        }

         $paymentMethod = PaymentMethod::create([
            'driver_id' => $user->id,
            'type' => $request->type,
            'bank_name' => $request->type == 1 ? $request->bank_name : null,
            'account_number' => $request->type == 1 ? $request->account_number : null,
            'ifsc_code' => $request->type == 1 ? $request->ifsc_code : null,
            'account_holderName' => $request->type == 1 ? $request->account_holderName : null,
            'upi_id' => $request->type == 0 ? $request->upi_id : null,
            'payment_number' => $request->type == 0 ? $request->payment_number : null,
            'qr_image' => $request->type == 0 ? $qrImagePath : null,
            'status' => 1,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment method added successfully',
            'data' => $paymentMethod
        ]);
    }

    public function show($id)
    {
        $user = $this->sanctumUser();

        $paymentMethod = PaymentMethod::where('driver_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'status' => true,
            'data' => $paymentMethod
        ]);
    }

    public function update(UpdatePaymentMethodRequest $request, $id)
    {
        $user = $this->sanctumUser();

        $paymentMethod = PaymentMethod::where('driver_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        if ($request->type == 0 && $request->hasFile('qr_image')) {
            if ($paymentMethod->qr_image) {
                Storage::disk('public')->delete($paymentMethod->qr_image);
            }

            $qrImagePath = $request->file('qr_image')->store('qr_images', 'public');
        } else {
            $qrImagePath = $paymentMethod->qr_image;
        }

        $paymentMethod->update([
            'type' => $request->type,
            'bank_name' => $request->type == 1 ? $request->bank_name : null,
            'account_number' => $request->type == 1 ? $request->account_number : null,
            'ifsc_code' => $request->type == 1 ? $request->ifsc_code : null,
            'account_holderName' => $request->type == 1 ? $request->account_holderName : null,
            'upi_id' => $request->type == 0 ? $request->upi_id : null,
            'payment_number' => $request->type == 0 ? $request->payment_number : null,
            'qr_image' => $request->type == 0 ? $qrImagePath : null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment method updated successfully',
            'data' => $paymentMethod->fresh()
        ]);
    }


    public function destroy($id)
    {
        $user = $this->sanctumUser();

        $paymentMethod = PaymentMethod::where('driver_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        if ($paymentMethod->qr_image) {
            Storage::disk('public')->delete($paymentMethod->qr_image);
        }

        $paymentMethod->delete();

        return response()->json([
            'status' => true,
            'message' => 'Payment method deleted successfully'
        ]);
    }
}