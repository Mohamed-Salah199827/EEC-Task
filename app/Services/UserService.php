<?php

namespace App\Services;

use App\Models\Detail;
use App\Models\User;

class UserService
{
    public function saveUserDetails(User $user)
    {
        $middleInitial = $user->middle_name ? strtoupper(substr($user->middle_name, 0, 1)) . '.' : '';

        $gender = 'N/A';
        if (!empty($user->prefixname)) {
            $gender = str_contains(strtolower($user->prefixname), 'mr') ? 'male' : 'female';
        }

        $avatar = $user->avatar ?? 'default-avatar.png';

        $details = [
            'full_name' => "{$user->first_name} {$middleInitial} {$user->last_name}",
            'middle_initial' => $middleInitial,
            'email' => $user->email,
            'phone' => $user->phone ?? 'N/A',
            'birthdate' => $user->birthdate ?? 'N/A',
            'gender' => $gender, 
            'avatar' => $avatar
        ];

        foreach ($details as $key => $value) {
            Detail::updateOrCreate(
                ['user_id' => $user->id, 'key' => $key],
                ['value' => $value, 'type' => 'user_info']
            );
        }
    }



}
