<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\UserProfileService;
use App\Services\SocialService;
use App\Services\UserSocialService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * @var UserProfileService
     */
    protected $profile_service;

    /**
     * @var SocialService
     */
    protected $social_service;
    
    /**
     * @var UserSocialService
     */
    protected $user_social_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $service,
        UserProfileService $profile_service,
        SocialService $social_service,
        UserSocialService $user_social_service
    )
    {
        $this->middleware(['auth']);

        $this->service = $service;
        $this->profile_service = $profile_service;
        $this->social_service = $social_service;
        $this->user_social_service = $user_social_service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get(Request $request)
    {
        $user_id = $request->user()->id;
        
        $user_info = $this->service->getUserByID($user_id);
        $socials_datas = $this->processSnsData($this->social_service->getAllSnsData());

        $data = array();

        $data['socials_datas'] = $socials_datas;
        $data['user_id'] = $user_id;
        $data['name'] = $user_info['name'];

        $data['title'] = '';
        $data['photo_path'] = '';
        $data['cover_path'] = '';

        $data['intro_flag'] = 0;
        $data['job_flag'] = 0;
        $data['edu_flag'] = 0;
        $data['address_flag'] = 0;
        $data['skill_flag'] = 0;
        $data['sns_flag'] = 0;

        $data['intro'] = '';
        $data['company'] = '';
        $data['director'] = '';
        $data['edu'] = '';
        $data['major'] = '';
        $data['address'] = '';
        $data['skill_flag'] = '';
        $data['skill'] = '';
        $data['sns_flag'] = '';

        $data['sns_arr'] = array();

        if(!empty($user_info['profile'])) {
            $data['title'] = $user_info['profile']['title'];
            $data['photo_path'] = $user_info['profile']['photo_path'];
            $data['cover_path'] = $user_info['profile']['cover_path'];
            $data['intro_flag'] = $user_info['profile']['intro_flag'];
            $data['job_flag'] = $user_info['profile']['job_flag'];
            $data['edu_flag'] = $user_info['profile']['edu_flag'];
            $data['address_flag'] = $user_info['profile']['address_flag'];
            $data['skill_flag'] = $user_info['profile']['skill_flag'];
            $data['sns_flag'] = $user_info['profile']['sns_flag'];

            if(!empty($data['intro_flag'])) {
                $data['intro'] = $user_info['profile']['intro'];
            }

            if(!empty($data['job_flag'])) {
                $data['company'] = $user_info['profile']['company'];
                $data['director'] = $user_info['profile']['director'];
            }

            if(!empty($data['edu_flag'])) {
                $data['edu'] = $user_info['profile']['edu'];
                $data['major'] = $user_info['profile']['major'];
            }

            if(!empty($data['address_flag'])) {
                $data['address'] = $user_info['profile']['address'];
            }

            if(!empty($data['skill_flag'])) {
                $data['skill'] = $user_info['profile']['skill'];
            }

            if(!empty($data['sns_flag'])) {
                if(!empty($user_info['soicals'])) {
                    foreach($user_info['soicals'] as $item) {
                        
                        $data['sns_arr'][] = array(
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'icon_path' => $item['icon_path'],
                            'value' => $item->pivot->value,
                        );
                    }
                }
            }
        }

        return view('profile.update', $data);
    }

    public function processSnsData($data) {
        $result = array();
        $placeholder_arr = array(
            'instagram' => 'ユーザーネームを入力してください。',
            'facebook' => 'ユーザーネームを入力してください。',
            'twitter' => 'ユーザーネームを入力してください。',
            'youtube' => 'ユーザーネームを入力してください。',
            'phone' => '電話番号を入力してください。',
            'email' => 'メールアドレスを入力してください。',
            'line' => 'WebブラウザURL共有可能 / IDによる共有不可',
            'linkedin' => 'ユーザーネームを入力してください。',
            'tiktok' => 'ユーザーネームを入力してください。',
            'clubhouse' => 'ユーザーネームを入力してください。',
            'stand.fm' => 'ユーザーネームを入力してください。',
            'snapchat' => 'ユーザーネームを入力してください。',
            'wechat' => 'ユーザーネームを入力してください。',
            'website' => 'WebサイトURLを入力してください。',
            '名刺管理アプリ' => 'WebサイトURLを入力してください。',
        );

        foreach($data as $item) {
            $tmp = array();

            $tmp['id'] = $item->id;
            $tmp['name'] = $item->name;
            $tmp['icon_path'] = $item->icon_path;
            $tmp['base_url'] = $item->base_url;
            $tmp['placeholder'] = $placeholder_arr[strtolower($item->name)];

            $result[] = $tmp;
        }

        return $result;
    }

    public function updateFlag(Request $request) {
        $user_id = $request->user()->id;

        $data = $request->validate([
            'type' => 'required',
            'status' => 'required'
        ]);

        $user = $this->profile_service->updateFlagByUserID($user_id, $data);
        
        return json_encode(array('flag' => 'success', 'user_info' => $user));
    }

    public function updateProperty(Request $request) {
        $user_id = $request->user()->id;
        $data = $request->attrs;
        
        $user = $this->profile_service->updatePropertyByUserID($user_id, $data);
        
        return json_encode(array('flag' => 'success', 'user_info' => $user));
    }

    public function updateSnsProperty(Request $request) {
        $user_id = $request->user()->id;
        $data = $request->attrs;

        $user = $this->user_social_service->updateSnsByUserID($user_id, $data);

        return json_encode(array('flag' => 'success', 'user_info' => $user));
    }

    public function updateImage(Request $request) {
        $image = $request->file('file');
        $imgFlName = $image->getClientOriginalName();
        
        $path_arr = Common::getSavePath();
        $abs_path = $path_arr['abs_path'];
        $rel_path = $path_arr['rel_path'] . '/' . $imgFlName;
        
        $image->move($abs_path, $imgFlName);
        
        return response()->json(['success' => $rel_path]);
    }

    /*public function updateImage(Request $request) {
        $image = $request->file('file');
        $imgFlName = $image->getClientOriginalName();
        
        // $path_arr = Common::getSavePath();
        // $abs_path = $path_arr['abs_path'];
        // $rel_path = $path_arr['rel_path'] . '/' . $imgFlName;
        
        $image->move("images", $imgFlName);
        
        return response()->json(['success' => $rel_path]);
    }*/
}
