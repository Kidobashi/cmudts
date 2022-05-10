<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentIdentifierController extends Controller
{
    public function docSender()
    {
        $scod = DB::table('documents')
        ->join('offices', 'to_office', 'offices.id')
        ->get();
        #echo "<pre>";
        #print_r($scod);
        //dd(Office::all());
        #return view ('home', compact('docs', 'scod'));
        return view ('home', ['scod' => $scod]);
    }
}

