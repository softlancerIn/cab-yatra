<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\CommonServices;
use Illuminate\Http\Request;
use App\Traits\SanctumAuthTrait;
use App\Models\Driver;
use App\Models\Transaction;

class TransactionController extends Controller 
{
    use SanctumAuthTrait;

    public function __construct(public CommonServices $commonServices) {}

    public function index()
    {
        $user = $this->sanctumUser();

        $driver = Driver::findOrFail($user->id);
        $transactions = Transaction::where('driver_id', $driver->id)->get();

        return response()->json([
            'status'  => true,
            'message' => 'Transactions fetched successfully',
            'data'    => $transactions
        ]);
    }

    public function show($id)
    {
        $user = $this->sanctumUser();

        $driver = Driver::findOrFail($user->id);
        $transaction = Transaction::where('driver_id', $driver->id)->where('id', $id)->first();

        if (!$transaction) {
            return response()->json([
                'status'  => false,
                'message' => 'Transaction not found',
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Transaction details fetched successfully',
            'data'    => $transaction
        ]);
    }
}