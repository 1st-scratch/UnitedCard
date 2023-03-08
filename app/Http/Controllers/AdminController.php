<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $service
    )
    {
        $this->middleware(['auth', 'role:admin']);
        
        $this->service = $service;
    }

    public function index(Request $request) {
        $data = array();

        $data['page_title'] = 'ユーザーリスト';

        return view('admin.user.list', $data);
    }

    public function userListData(Request $request) {
        ## Read value
        $draw = $request->post('draw');
        $start = $request->post("start");
        $rowperpage = $request->post("length"); // Rows display per page

        $columnIndex_arr = $request->post('order');
        $columnName_arr = $request->post('columns');
        $order_arr = $request->post('order');
        $search_arr = $request->post('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = $this->service->getTotalUsers();
        $totalRecordswithFilter = $this->service->getTotalUsersByFilter($searchValue);

        // Fetch records
        $records = $this->service->getUsersByPagenation($start, $rowperpage, $columnName, $columnSortOrder, $searchValue);

        $data_arr = array();

        foreach($records as $record){
            $data_arr[] = array(
                "united_key" => $record->united_key,
                "name" => $record->name,
                "email" => $record->email,
                "link" => route('profile.view.key', ['key' => $record->united_key]),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function profile(Request $request) {
        $data = array();

        $admin_info = $this->service->getAdminInfo();

        $data['page_title'] = 'プロフィール';
        $data['id'] = $admin_info['id'];
        $data['name'] = $admin_info['name'];
        $data['email'] = $admin_info['email'];

        return view('admin.profile', $data);
    }

    public function updateProfile(Request $request) {
        if(empty($request->input('current_password'))) {
            $validated = $request->validate([
                'name' => 'required|max:191',
                'email' => 'required|email|max:191',
            ], [], [
                'name' => '名前',
                'email' => 'Eメール',
            ]);

            $this->service->updateProfileWithoutPassword(
                $request->only(['id', 'name', 'email'])
            );
        } else {
            $validated = $request->validate([
                'name' => 'required|max:191',
                'email' => 'required|email|max:191',
                'current_password' => ['required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('現在のパスワードが正しくありません。'));
                    }
                }],
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ], [], [
                'name' => '名前',
                'email' => 'Eメール',
                'current_password' => '現在のパスワード',
                'new_password' => '新しいパスワード',
                'confirm_password' => '新しいパスワードの確認',
            ]);

            $this->service->updateProfile(
                $request->only(['id', 'name', 'email', 'new_password'])
            );
        }

        return redirect()->back()->with('message', 'プロファイルは正常に更新されました。');
    }

    public function delete(Request $request) {
        $this->service->delete($request->key);

        return response()->json(array('flag' => 'success'));
    }
}
