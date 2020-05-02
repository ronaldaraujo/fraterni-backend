<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("institutions", "Api\\InstitutionController@index")->name("institutions.index");
Route::get("institutions/{id}/show/", "Api\\InstitutionController@show")->name("institutions.show");

Route::get("profile", "Api\\DonorController@index")->name("donor.index");

Route::post("auth/sign-up", "Api\\AuthController@signUp")->name("auth.sign_up");
Route::post("auth/sign-in", "Api\\AuthController@signIn")->name("auth.sign_in");

Route::post("payment", "Api\\PaymentController@index")->name("payment.index");
