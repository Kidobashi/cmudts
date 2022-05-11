<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QrInfoController extends Controller
{
    public function index(){
        return Documents::all();
    }

    public function selectRefNo($referenceNo){
        $data = DB::table('documents')
        ->join('offices', 'from_office', 'offices.id')
        ->where('referenceNo','LIKE', "%{$referenceNo}%")
        ->get(); 
        
        //dd($docs);
        //dd($data);
        return view('partial.qr')->with('data', $data);  
    }
}

