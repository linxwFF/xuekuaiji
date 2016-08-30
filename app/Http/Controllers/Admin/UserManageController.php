<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserManageController extends Controller
{
    public function _construst()
    {
        $this->middleware('auth');
    }

    public function userManage()
    {
        return view('admin.accounts_manage');
    }
}
