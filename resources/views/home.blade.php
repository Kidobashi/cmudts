@extends('layouts.navigation')
@section('content')
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" href={{url('home')}}>{{ __('Dashboard') }}</div>

                    {{ __('Welcome ' ) }}    {{ auth()->user()->name }} {{ __('!' ) }}
                </div>
            </div>
        </div>
    </div>
</div>
<!--Display Created Documents-->
<div class="card-body" style="width:80%; position: absolute; left: 130px; padding:15px; background: #E8E8E8;">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <th>Reference Number</th>
            <th>Receiver</th>
            <th>Destination Office</th>
            <th>Date Created</th>
            <th>Info</th>
        </thead>
        <tbody>
            @foreach ($docs as $doc)
                <tr>
                    <td>
                        {{ $doc->referenceNo }}
                    </td>
                    <td>
                        {{ $doc->recv_name }}
                    </td>
                    <td>
                        {{ $doc->officeName }}
                    </td>
                    <td>
                        {{ $doc->created_at }}
                    </td>
                    <td>
                        <a href="{{ url('qrinfo', $doc->referenceNo)}}">Show Info</a>
                    </td>
                </tr>
            @endforeach
            <tr></tr>
        </tbody>
    </table>
</div>

@endsection
