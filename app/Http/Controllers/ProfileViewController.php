<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use JeroenDesloovere\VCard\VCard;
use Symfony\Component\HttpFoundation\Response;

class ProfileViewController extends Controller
{
    /**
     * @var UserService
     */
    protected $user_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $user_service
    ) {
        $this->user_service = $user_service;
    }

    public function viewProfileByID(Request $request) {
        $user_info = $this->user_service->getUserByID($request->id);

        $data = array();

        $data['login_status'] = false;

        if(Auth::check() && Auth::id() == $request->id)
            $data['login_status'] = true;
        else
            return redirect()->route('profile.get');

        $data['user_id'] = $request->id;
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
                            'base_url' => $item['base_url'],
                            'value' => $item->pivot->value,
                        );
                    }
                }
            }
        }

        return view('profile.view', $data);
    }
    
    public function viewProfileByUnitedKey(Request $request) {
        if(!$this->user_service->checkUserByUnitedKey($request->key))
            return redirect()->route('register', ['key' => $request->key]);

        $user_info = $this->user_service->getUserByUnitedKey($request->key);

        $data = array();

        $data['user_id'] = $user_info['id'];
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
                            'base_url' => $item['base_url'],
                            'value' => $item->pivot->value,
                        );
                    }
                }
            }
        }

        return view('profile.view', $data);
    }

    public function downloadProfile(Request $request) {
        $user_id = $request->user_id;

        $user_info = $this->user_service->getUserByID($user_id);

        // define vcard
        $vcard = new VCard();

        // define variables
        $lastname = '';
        $firstname_buf = $user_info['name'];
        $firstname = quoted_printable_encode($firstname_buf);

        /*$arr = explode(" ", $firstname);
        $arr_e = [];
        foreach ($arr as $item) {
            if ($item!=" ") {
                array_push($arr_e, $item);
            }
        }
        if (count($arr_e)>0) {
            $lastname = $arr_e[0]; 
            if (count($arr_e)>1) {$firstname = $arr_e[1];}
            if (count($arr_e)>2) {$additional = $arr_e[2];}
        } else {
            $firstname = "";$lastname = "";$additional = "";
        }*/


        //$firstname = explode('@', $user_info['email'])[0];
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        // $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);
        $vcard->addName_me($lastname, $firstname, $additional, $prefix, $suffix);
        // $vcard->addEmail($user_info['email']);
        $vcard->addURL(route('profile.view.key', ['key' => $user_info['united_key']]));

        // add work data

        if(!empty($user_info['profile'])) {
            // if(!empty($user_info['profile']['photo_path'])) {
            //     $vcard->addPhoto(asset("storage") . '/' . $user_info['profile']['photo_path']);
            // }

            if(!empty($user_info['profile']['sns_flag'])) {
                if(!empty($user_info['soicals'])) {
                    foreach($user_info['soicals'] as $item) {
                        
                        if(strtolower($item['name']) == 'phone') {
                            $vcard->addPhoneNumber($item->pivot->value, 'WORK');
                        }

                        if(strtolower($item['name']) == 'email') {
                            $vcard->addEmail($item->pivot->value);
                        }
                    }
                }
        
            }
        }

        // $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
        // $vcard->addLabel('street, worktown, workpostcode Belgium');

        // return vcard as a string
        //return $vcard->getOutput();

        // return vcard as a download
        // return $vcard->download();
        $content = $vcard->getOutput();

        // $browser = $this->getUserAgent();
        // $isIOS7 = (strpos($browser, 'iphone') || strpos($browser, 'ipod') || strpos($browser, 'ipad')) && $this->shouldAttachmentBeCal();

        // $extension = $isIOS7 ? 'ics' : 'vcf';
        $extension = 'vcf';

        $arr = explode(";;", $content);
        if (count($arr)==2) {
            $arr1 = explode("ENCODING=QUOTED-PRINTABLE", $arr[0]);
            if (count($arr1)==2) {
                /*$arr2 = explode(" ", $arr1[1]);                
                $arr1[1] = implode("", $arr2);*/

                $arr2 = preg_split("/\\r\\n|\\r|\\n/", $arr1[1]);
                if (count($arr2)==2) {
                    $arr2[1] = ltrim($arr2[1], " ");
                }
                $arr1[1] = implode("", $arr2);

                $arr[0] = implode("ENCODING=QUOTED-PRINTABLE", $arr1);
                $content = implode(";;", $arr);
            }
        }

        $response = new Response();
        $response->setContent($content);
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/x-vcard');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$user_info['united_key'].'.'.$extension.'"');
        $response->headers->set('Content-Length', mb_strlen($content, 'utf-8'));

        return $response;
    }

    public function getUserAgent()
    {
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
        } else {
            $browser = 'unknown';
        }

        return $browser;
    }

    public function shouldAttachmentBeCal()
    {
        $browser = $this->getUserAgent();

        $matches = [];
        preg_match('/os (\d+)_(\d+)\s+/', $browser, $matches);
        $version = isset($matches[1]) ? ((int)$matches[1]) : 999;

        return ($version < 8);
    }
}