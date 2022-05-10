<?php

    $servername = "localhost";
    $username = "root";
    $password = "mortarmax";
    $dbname = "cmudts";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $result = mysqli_query($conn, "SELECT MAX(id) FROM documents");
    $row = mysqli_fetch_array($result);

    $lastID = strval($row[0]+1);
    $number = sprintf('%04d', $lastID);
    $stringVal = strval($number);
    $year = strval(strftime("%Y"));
    $refNo = "$year$stringVal";
?>
@extends('layouts.navigation')
@section('content')
<html>
    <head>
    <!-- Scripts -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" href={{url('home')}}>{{ __('Add Document') }}</div>
                    <form method="POST" action="uploaddoc/{{$refNo}}">
                        @csrf
                        <!-- Name -->
                            <div>
                                <x-label for="referenceNo" :value="__('Reference No.:')" />
                                <input id="referenceNo" class="block mt-1 w-full" type="type " name="referenceNo" :value="old('referenceNo')" value="{{ $refNo }}" readonly/>
                            </div>
                            
                            <div>
                                <x-label for="from_office" :value="__('From Office')" />
                                    <select id="from_office" name="from_office" class="block mt-1 w-full">
                                        <option value="old(from_office)" selected disabled>Select Office
                                            @foreach ($officeName as $row)
                                            <option value="{{ $row->id }}">{{ $row->officeName }}</option>
                                        </option>
                                        @endforeach
                                    </select>
                                        @error('from_office')
                                        <div id="errMsg" class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                                            <i class="bi-exclamation-octagon-fill"></i>
                                            <strong class="mx-2">Error!</strong>Source Office field is missing
                                        </div>
                                        @enderror
                                </div>
                                
                    
                            <div>
                                <x-label for="to_office" :value="__('To Office')" />
                                    <select id = "to_office" name="to_office" class="block mt-1 w-full">
                                        <option value="old(to_office)" selected disabled>Select Office
                                            @foreach ($officeName as $row)
                                           <option value="{{ $row->id }}">{{ $row->officeName }}</option>
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('to_office')
                                        <div id="errMsg" class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                                            <i class="bi-exclamation-octagon-fill"></i>
                                            <strong class="mx-2">Error!</strong>Destination Office field is missing
                                        </div>
                                        @enderror
                            </div>
                
                            <div>
                                <x-label for="sender_name" :value="__('Sender')" />
                                <input id="sender_name" class="block mt-1 w-full" type="text" name="sender_name" :value="old('sender_name')" value="{{ auth()->user()->email }}" readonly/>
                                @error('sender_name')
                                <div id="errMsg" class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                                    <i class="bi-exclamation-octagon-fill"></i>
                                    <strong class="mx-2">Error!</strong>Sender field is missing
                                </div>
                                @enderror
                            </div>
                
                            <div>
                                <x-label for="recv_name" :value="__('Receiver')" />
                                <x-input id="recv_name" class="block mt-1 w-full" type="text" name="recv_name" :value="old('recv_name')"/>
                                @error('recv_name')
                                <div id="errMsg" class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                                    <i class="bi-exclamation-octagon-fill"></i>
                                    <strong class="mx-2">Error!</strong>Receiver field is missing
                                </div>
                                @enderror
                            </div>
                
                            <div id="placeHolder" width="300px" height="300px">
                
                            </div>
                            
                
                            <input id="genBtn" type="submit" value="Submit" onclick=alertMsg()>
                
                            @if(session('message'))
                                <div class="alert alert-success">{{session('message')}}</div>
                            @endif
                                
                            </div>
                    </form>
                        {{ __('Add Document Page!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/qrcode.js')}} "></script>
    <script>

        var typeNumber = 4;
        var errorCorrectionLevel = 'L';
        var qr = qrcode(typeNumber, errorCorrectionLevel);
        var data = document.getElementById('referenceNo').value;
        qr.addData(data);
        qr.make();
        document.getElementById('placeHolder').innerHTML = qr.createImgTag();

    </script>
</html>
@endsection