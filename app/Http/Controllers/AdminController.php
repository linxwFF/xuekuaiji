<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function _construst()
    {
        $this->middleware('auth');
    }

    public function userManger()
    {

        return view('admin.accounts_manage');

    }
}
