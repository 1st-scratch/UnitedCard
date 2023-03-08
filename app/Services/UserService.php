<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserSocial;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    public function getUserByID($id) {
        return User::with(['soicals' => function($query) {
                $query->orderBy('pivot_disp_order', 'asc');
            }, 'profile'])
          ->where('id', $id)
          ->firstOrFail();
    }

    public function getUserByUnitedKey($key) {
        return User::with(['soicals' => function($query) {
                $query->orderBy('pivot_disp_order', 'asc');
            }, 'profile'])
          ->where('united_key', $key)
          ->firstOrFail();
    }

    public function checkUserByUnitedKey($key) {
        return User::where('united_key', $key)->exists();
    }

    public function getTotalUsers() {
        return User::where('role', User::ROLES['user'])->count();
    }

    public function getTotalUsersByFilter($searchValue) {
        $query = User::where('role', User::ROLES['user']);

        if(!empty(trim($searchValue))) {
            $query->where(function($query) use ($searchValue) {
                            $query->where('united_key', 'like', '%' .$searchValue . '%')
                                    ->orWhere('name', 'like', '%' .$searchValue . '%')
                                    ->orWhere('email', 'like', '%' .$searchValue . '%');
                        });
        }

        return $query->count();
    }

    public function getUsersByPagenation($start, $rowperpage, $columnName, $columnSortOrder, $searchValue) {
        $query = User::where('role', User::ROLES['user'])
                    ->orderBy($columnName,$columnSortOrder);

        if(!empty(trim($searchValue)))
            $query->where(function($query) use ($searchValue) {
                $query->where('united_key', 'like', '%' .$searchValue . '%')
                        ->orWhere('name', 'like', '%' .$searchValue . '%')
                        ->orWhere('email', 'like', '%' .$searchValue . '%');
            });
        
        return $query->skip($start)->take($rowperpage)->get();            
    }

    public function getAdminInfo() {
        return User::where('role', User::ROLES['admin'])->first();
    }

    public function updateProfileWithoutPassword($data) {
        $user = User::where('id', $data['id'])->first();

        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->save();
    }

    public function updateProfile($data) {
        $user = User::where('id', $data['id'])->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['new_password']);

        $user->save();
    }

    public function delete($key) {
        $user = User::where('united_key', $key)->first();

        UserProfile::where('user_id', $user->id)->delete();
        UserSocial::where('user_id', $user->id)->delete();

        $user->delete();

        return true;
    }
}
