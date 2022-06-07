<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FilterUsersByOffice;
use App\Http\Controllers\UserOfficeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/uploaddoc', function () {
    return view('dashboard');
})->middleware(['auth'])->name('uploaddoc');

require __DIR__.'/auth.php';

Route::get('/auth.register', 'App\Http\Controllers\UserOfficeController@index');
Route::post('/auth.register', 'App\Http\Controllers\UserOfficeController@store');

//Route::post('/posts', 'App\Http\Controllers\UserOfficeController@index');


Route::post('/uploaddoc', 'App\Http\Controllers\DocumentController@store');
// Route::get('/uploaddoc/edit/{id}', 'App\Http\Controllers\DocumentController@refNumber');
Route::get('uploaddoc', 'App\Http\Controllers\DocumentController@getRefNumber')->name('refNo');
Route::get('uploaddoc', 'App\Http\Controllers\DocumentController@selectOffice');
#Route::post('/uploaddoc', 'App\Http\Controllers\DocumentIdentifierController@docSender');
#Route::put('/uploaddoc', 'App\Http\Controllers\DocumentIdentifierController@docSender');
#Route::get('/uploaddoc', 'App\Http\Controllers\DocumentIdentifierController@getDocSender');

Route::get('qrcode', 'App\Http\Controllers\QrController@generateQrCode');

#Route::get('/uploaddoc', 'App\Http\Controllers\DocumentController@getRefNumber');

Route::get('/qrcode', [DataController::class, 'index']);
Route::post('/qrcode', [DataController::class, 'store'])->name('store');
Route::get('qrcode/{id}', [DataController::class, 'generate'])->name('generate');
#Route::get('/auth.register', [RegisterController::class, 'index']);
Route::post('/auth.register', [RegisteredUserController::class, 'store']);

#Route::post('/dashboard', [FilterUsersByOffice::class, 'index']);
Route::post('dashboard', [FilterUsersByOffice::class, 'scopeSearch']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
#Route::get('/home', [App\Http\Controllers\DocumentController::class, 'selectOffices']);
#Route::get('/home', [App\Http\Controllers\DocumentController::class, 'selectOffices']);
Route::get('/home', [App\Http\Controllers\DocumentIdentifierController::class, 'docSender']);
Route::get('/home', [App\Http\Controllers\DocumentController::class, 'index']);

Route::get('show', 'App\Http\Controllers\UserProfileController@show');

Route::get('/qrinfo/{referenceNo}', [App\Http\Controllers\QrInfoController::class, 'selectRefNo']);
//Auth::routes();
