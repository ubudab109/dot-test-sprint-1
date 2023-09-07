<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $headers = [
        'key' => config('app.raja_ongkir_key'),
    ];
    $client = new Client([
        'base_uri' => 'https://api.rajaongkir.com/starter/',
        'headers'  => $headers
    ]);
    $request = $client->get('province');
    $result = $request->getBody();
    $data = json_decode($result, 1);
    return $data['rajaongkir'];
});
