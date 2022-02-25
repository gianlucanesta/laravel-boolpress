<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        
        // dd($user);
        // dd($user->userInfo);
        // dd($user->userInfo->phone);


        $data = [
            'user' => $user,
            'userInfo' => $user->userInfo

        ];


        return view('admin.home', $data);
    }
}
