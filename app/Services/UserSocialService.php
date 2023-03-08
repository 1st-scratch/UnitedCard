<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\UserSocial;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserSocialService
{
    public function updateSnsByUserID($user_id, $data) {
        UserSocial::where('user_id', $user_id)->delete();

        $records = array();

        foreach($data as $key => $val) {
            $records[] = array(
                'user_id' => $user_id,
                'social_id' => $key,
                'value' => $val['value'],
                'disp_order' => $val['disp_order'],
            );
        }

        if(!empty($records)) UserSocial::insert($records);

        return User::with(['soicals', 'profile'])
          ->where('id', $user_id)
          ->firstOrFail();
    }
}
