<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\UserProfile;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserProfileService
{
    public function updateFlagByUserID($user_id, $data) {
        $profile_info = UserProfile::where('user_id', $user_id)->first();

        if(!$profile_info) {
            $item = new UserProfile();

            $item->user_id = $user_id;
            $item->{$data['type']} = $data['status'];

            $item->save();
        } else {
            $profile_info->{$data['type']} = $data['status'];
            $profile_info->save();
        }

        return User::with(['soicals', 'profile'])
          ->where('id', $user_id)
          ->firstOrFail();
    }

    public function updatePropertyByUserID($user_id, $data) {
        $profile_info = UserProfile::where('user_id', $user_id)->first();

        if(!$profile_info) {
            $item = new UserProfile();

            $item->user_id = $user_id;

            foreach($data as $key => $value) {
                if($key == 'name') continue;
                
                $item->{$key} = $value;
            }

            $item->save();
        } else {
            foreach($data as $key => $value) {
                if($key == 'name') {
                    $user = User::where('id', $user_id)->first();
                    $user->name = $value;

                    $user->save();
                } else {
                    $profile_info->{$key} = $value;
                }
            }

            $profile_info->save();
        }

        return User::with(['soicals', 'profile'])
          ->where('id', $user_id)
          ->firstOrFail();
    }
}
