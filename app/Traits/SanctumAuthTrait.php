<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait SanctumAuthTrait
{
    /**
     * Get authenticated sanctum user
     */
    protected function sanctumUser()
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token required!',
            ], 401);
        }

        return $user;
    }
}
