<?php

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contact', function () {
    return FacadesResponse::view('contact');
});

Route::post('/contact', function (HttpRequest $request) {
    dd($request->get('phone_number'));
});

Route::get('/change_password', fn () => FacadesResponse::view('change_password'));

Route::post('/change_password', function (HttpRequest $request) {
    if (auth()->check()) {
        return response("Password CHenged to {$request->get('password')}");
    } else {
        return new response("NOt authenticate", 401);
    }
});
