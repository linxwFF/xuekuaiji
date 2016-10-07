<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use Response;
use Input;
use App\Models\User;

class UserManageController extends Controller
{
    protected $userPepo;

    public function __construct(UserRepository $userPepo)
    {
        $this->userPepo = $userPepo;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.accounts_manage.index');
    }

    public function table()
    {
        $fields = [
            'id',
            'name',
            'username',
            'email',
            'created_at'
        ];

        $data = $this->userPepo->table($fields);

        // //请求次数
        // $draw = request('draw', 1);
        //
        // $result = [
        //     'draw' => $draw,
        //     'recordsTotal' => 10,
        //     'recordsFiltered' => 10,
        //     'data' => $data,
        // ];

        return Response::json($data);
    }

    public function edit($id)
    {
        $result = User::find($id);
        return view('admin.accounts_manage.update')->with('data', ['data' => $result]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $result = $this->userPepo->update_one($input['form']);
        return Response::json($result['data'], $result['status']);
    }

    public function destroy($id)
    {
        $result = $this->userPepo->destroy_one($id);
        return Response::json($result['data'], $result['status']);
    }

    public function destroy_many()
    {
        $input = Input::all();
        $result = $this->userPepo->destroy_many($input);
        return Response::json($result['data'], $result['status']);
    }
}
