<?php

use Illuminate\Http\Request;
use App\User;

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

//Route::get('{id}', function ($id) {
//    return response()->json(User::find($id),200);
//});

Route::get('profile/{user_id}', 'Api\V1\ProfileController@getUserAndPosts');
Route::get('profile/{user_id}/{post_id}', 'Api\V1\ProfileController@getUserAndPost');
//Route::post('profile/{user_id}', 'Api\V1\ProfileController@addUserPost');
//Route::put('profile/{user_id}/edit/{post_id}', 'Api\V1\ProfileController@editUserPost');
