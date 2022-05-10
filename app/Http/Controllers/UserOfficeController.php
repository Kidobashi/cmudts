<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use App\Models\User;
use Illuminate\Http\Request;

class UserOfficeController extends Controller
{
    //
    //Show office names
    public function index()
    {
        $office = Offices::all();
        //dd(Offices::all());
        return view('auth.register')->with('officeName', $office);
    }
    
    //assign office name into user when they register
    public function store(Request $office)
    {
        User::create([
            'assignedOffice' => request('assignedOffice')
        ]);

    }
   
}
