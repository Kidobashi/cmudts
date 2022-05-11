<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\Offices;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DocumentController extends Controller
{  
    //
    //Show office names
    public function index()
    {
        $docs = DB::table('documents')
        ->join('offices', 'to_office', 'offices.id')
        ->where('documents.sender_name', Auth::user()->email)
        ->distinct()
        ->get()->toArray();
        
        return view ('home', ['docs' => $docs]);
        #return view ('home', compact('docs'));
    }

    public function selectOffice()
    {
        $office = Offices::all();
        //dd(Office::all());
        return view('documents.uploaddoc')->with('officeName', $office);
    }

    //assign office name into user when they register
    public function store(Request $office)
    {
        $sender = Auth::user()->email;

        $office->validate([
            'sender_name' => 'required',
            'recv_name' => 'required',
            'from_office' => 'required',
            'to_office' => 'required',
        ]);

        Documents::create([
            'sender_name' => $sender,
            'recv_name' => request('recv_name'),
            'from_office' => request('from_office'),
            'to_office' => request('to_office'),
            'referenceNo' => request('referenceNo'),
        ]);

        //redirect with success message

        return redirect('uploaddoc')->with('message', 'Successfully Added!');
    }

    public function refNumber()
    {
        $docs = Documents::all();
        return view('documents.uploaddoc')->with('id', $docs);
    }

    public function getRefNumber(Documents $docs)
    {
        Documents::create([
            'reference_no' => $docs->id,
        ]);
    }

    public function edit($id)
    {
        $docs = Documents::find($id);
        $docs = Documents::where('id', '!=', 1)->get();
        $assignedEm =  Documents::find($docs->id)
                                ->where('id', '!=', 1)->get();
                                
        return view('uploaddoc.edit', compact('docs'))->with(compact('assignedEm'));
    }
}
