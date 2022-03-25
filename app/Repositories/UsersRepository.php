<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\User;

class UsersRepository
{
    public function getActiveUsersDetailsByCountryName(string $countryName): array
    {
        $countryId   = Country::select('id')->where('name', $countryName)->first()['id'];
        $activeUsers = User::where('active', 1)->get();
        $users       = [];

        /** @var User $activeUser */
        foreach ($activeUsers as $activeUser) {
            $userDetails = $activeUser->userDetails()->where('country_id', $countryId)->first();
            if (!$activeUser->hasDetails() || !$userDetails) {
                continue;
            }
            $users[] = $activeUser->where('id', $userDetails->getUserId())->first();
        }

        return $users;
    }

}
