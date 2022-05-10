<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Offices;

class FilterUsersByOffice extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 20;
        $q = null;

        if($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if($request->has('sortBy')) $orderBy = $request->query('sortBy');
        if($request->has('perPage')) $orderBy = $request->query('perPage');
        if($request->has('q')) $orderBy = $request->query('q');

        $users = User::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('/dashboard', compact('users', 'orderBy', 'sortBy', 'q', 'perPage'));

    }

    public function scopeSearch($query, $q){
        if($q == null) return $query;
        return $query
                    ->where('name', 'LIKE', "%{$q}%")
                    ->orwhere('email', 'LIKE', "%{$q}%")
                    ->where('assignedOffice', 'LIKE', "%{$q}%");
    }
}
