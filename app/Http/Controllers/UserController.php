<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * @param UsersRepository $usersRepository
     *
     * @return JsonResponse
     */
    public function getActiveAustrians(UsersRepository $usersRepository): JsonResponse
    {
        return response()->json($usersRepository->getActiveUsersDetailsByCountryName('Austria'));
    }

    /**
     * @param int $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function delete(int $id): JsonResponse|RedirectResponse
    {
        $user = User::findOrFail($id);
        if (!$user->hasDetails()) {
            $user->delete();
            return response()->json(
                [
                    'id'      => $id,
                    'status'  => 'deleted',
                    'message' => 'User has been deleted.',
                ]
            );
        }
        return response()->json(
            [
                'id'      => $id,
                'status'  => 'not deleted',
                'message' => 'This user has details.',
            ]
        );
    }
}
