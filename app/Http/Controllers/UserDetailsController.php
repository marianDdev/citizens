<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    /**
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    public function edit(Request $request, int $id): JsonResponse
    {
        //if there is no userDetails record with this id, a ModelNotFoundException will be thrown
        $userDetails = UserDetails::findOrFail($id);
        $userDetails->update($request->all());

        return response()->json(
            [
                'id'     => $id,
                'status' => 'updated',
            ]
        );
    }
}
