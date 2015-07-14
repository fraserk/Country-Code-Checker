<?php
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $result ='';
    return View('welcome',compact('result'));

});

Route::post('/check', function (Request $Request){

    $api_key = getenv('api_key');
    $api_secret = getenv('api_secret');
    $country = $Request->input('countries');
    $number= $Request->input('number');

    $client = new GuzzleHttp\Client();
    $res = $client->get('https://api.nexmo.com/number/format/json?api_key='.$api_key.'&api_secret='.$api_secret.'&country='.$country.'&number='.$number);
    $result = json_decode($res->getBody());
    return view('welcome',compact('result'));
});
//Route::get('auth/twitter', 'Auth\AuthController@redirectToProvider');
//Route::get('auth/twitter/callback', 'Auth\AuthController@handleProviderCallback');
