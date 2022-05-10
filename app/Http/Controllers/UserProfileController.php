<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    //
    public function show()
    {
        $user = DB::table('users')
        ->join('offices', 'users.id', "=" ,'offices.id')
        ->select('offices.officeName')
        ->get();

        return "$user"; 
    }
}
