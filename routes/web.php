<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('', [App\Http\Controllers\MainPageController::class, 'index'])->name('musics');

//Blog
Route::resource('/blog', App\Http\Controllers\BlogController::class);

Route::get('/contacts', [App\Http\Controllers\SendEmailController::class, 'index']);
Route::post('/contacts/send', [App\Http\Controllers\SendEmailController::class, 'send']);

//Admin
Route::get('/id{id}/home', [App\Http\Controllers\AdminController::class, 'admin'])->name('home');
Route::patch('home/edit/{userId}', [App\Http\Controllers\AdminController::class, 'editAdminForUsers'])->name('editAdminForUsers');
Route::delete('home/delete/{userId}', [App\Http\Controllers\AdminController::class, 'deleteAdminForUsers'])->name('deleteAdminForUsers');

// Profile
Route::get('/{nickname}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

//Публикует пост
Route::post('/{id}/store', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

Route::get('/id{id}/post/{postId}', [App\Http\Controllers\ProfileController::class, 'post'])->name('userPost');
Route::patch('id{id}/{postId}/edit', [App\Http\Controllers\ProfileController::class, 'editPost'])->name('editPost');

//Like post
Route::patch('id{id}/{postId}/like', [App\Http\Controllers\LikePostController::class, 'likePost'])->name('likePost');

//Follow for user
Route::patch('id{my_id}/{follow_user_id}/follow', [App\Http\Controllers\FollowersController::class, 'followUser'])->name('followUser');


//Comment Post
Route::post('/id{id}/post/{postId}/comment', [App\Http\Controllers\CommentController::class, 'sendComment'])->name('sendComment');
Route::delete('/id{id}/post/{postId}/comment/{commentId}/delete', [App\Http\Controllers\CommentController::class, 'deleteComment'])->name('deleteComment');
Route::patch('/id{id}/post/{postId}/comment/{commentId}/edit', [App\Http\Controllers\CommentController::class, 'editComment'])->name('editComment');
//End Comment Post

Route::get('/{id}/edit', [App\Http\Controllers\ProfileController::class, 'showEditProfileInformationPage'])->name('editProfile');
Route::patch('/{id}/edit', [App\Http\Controllers\ProfileController::class, 'editProfileInformation'])->name('editProfileInformation');
Route::delete('delete/{id}', [App\Http\Controllers\ProfileController::class, 'delete'])->name('deletePost');

Route::get('/id{id}/video', [App\Http\Controllers\ProfileController::class, 'allVideo'])->name('allVideo');
Route::get('/id{id}/video/{video}', [App\Http\Controllers\ProfileController::class, 'video'])->name('video');
Route::post('/id{id}/video/create', [App\Http\Controllers\ProfileController::class, 'addProfileVideo'])->name('addProfileVideo');
Route::patch('/id{id}/video/{video}/update', [App\Http\Controllers\ProfileController::class, 'updateVideo'])->name('updateVideo');
Route::delete('/id{id}/video/delete', [App\Http\Controllers\ProfileController::class, 'deleteVideo'])->name('deleteVideo');

Route::get('/id{id}/audio', [App\Http\Controllers\ProfileController::class, 'allAlbums'])->name('allAlbums');
Route::get('/id{id}/audio/{album}', [App\Http\Controllers\ProfileController::class, 'album'])->name('album');
Route::post('/id{id}/audio/create', [App\Http\Controllers\ProfileController::class, 'addProfileAlbums'])->name('addProfileAlbums');;
Route::patch('/id{id}/audio/{album}/update', [App\Http\Controllers\ProfileController::class, 'updateAlbum'])->name('updateAlbum');
Route::delete('/id{id}/audio/delete', [App\Http\Controllers\ProfileController::class, 'deleteAlbums'])->name('deleteAlbums');

Route::get('about', [App\Http\Controllers\MainPageController::class, 'about'])->name('about');
Route::get('rules', [App\Http\Controllers\MainPageController::class, 'rules'])->name('rules');
Route::get('reference', [App\Http\Controllers\MainPageController::class, 'reference'])->name('reference');

Route::get('/id{id}/events', [App\Http\Controllers\ProfileController::class, 'events'])->name('events');
Route::get('/id{id}/events/{event}', [App\Http\Controllers\ProfileController::class, 'event'])->name('event');
Route::post('/id{id}/events/addevent', [App\Http\Controllers\ProfileController::class, 'addEvent'])->name('addEvent');
Route::patch('/id{id}/events/{event}/edit', [App\Http\Controllers\ProfileController::class, 'editEvent'])->name('editEvent');
Route::delete('/id{id}/events/{event}/delete', [App\Http\Controllers\ProfileController::class, 'deleteEvent'])->name('deleteEvent');

Route::delete('/{id}/delete', [App\Http\Controllers\ProfileController::class, 'deleteUser'])->name('deleteUser');
Route::patch('/{id}/deletebanner', [App\Http\Controllers\ProfileController::class, 'deleteBanner'])->name('deleteBanner');

//Short link
Route::get('cc/service', [App\Http\Controllers\ShortLinkController::class, 'index'])->name('shortLinkService');
Route::get('cc/{id}', [App\Http\Controllers\ShortLinkController::class, 'shortLink'])->name('shortLink');
Route::post('generate', [App\Http\Controllers\ShortLinkController::class, 'generateShortLink'])->name('generateShortLink');


























