<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Data;

class DataController extends Controller
{
    public function index(){
        $data = Data::all();
        return view ('qrcode', ['data' => $data]);
    }
    public function store(Request $data){

        Data::create([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
        ]);

        return back();
    }
    public function generate ($id)
    {
        $data = Data::findOrFail($id);
        $qrcode = QrCode::size(400)->email($data->email);
        return view('qrcode',compact('qrcode'));
    }
    
    public function qrNumber()
    {
        $data = Data::all();
        return view('qrcode')->with('id', $data);
    }
}