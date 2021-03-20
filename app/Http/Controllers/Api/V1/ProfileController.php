<?php

namespace App\Http\Controllers\Api\V1;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getUserAndPosts($user_id) {
        $user = User::find($user_id);
        if($user == false) {
            return response()->json('User not found', 404);
        } else {
            $posts = $user->profile()->get();
            return response()->json([$user, $posts], 200);
        }
    }

    public function getUserAndPost($user_id, $post_id) {
        $user = User::find($user_id);
        if($user == false) {
            return response()->json('User not found', 404);
        } else {
            $post = Profile::find($post_id);
            if($post == false) {
                return response()->json('Post not found', 404);
            } else {
                return response()->json([$user, $post], 200);
            }
        }
    }

//    public function addUserPost($user_id, Request $request) {
//        $user = User::find($user_id);
//        if($user == false) {
//            abort(404);
//        } else {
//            $post = new Profile();
//            $post->title = $request->title;
//            $post->slug = $request->slug;
//            $post->message = $request->message;
//            $post->user_id = $user_id;
//            $post->videoPost = str_replace('watch?v=', 'embed/', $request->videoPost);
//
//            if($request->file('img')) {
//                $path = Storage::putFile('public/' . Auth::user()->id . '/post', $request->file('img')); //Where to put the file
//                $url = Storage::url($path); //url() - Get the URL for the file at the given path.
//                $post->img = $url;
//            }
//
//            $post->save();
//
//            return response()->json($post, 201);
//        }
//    }

//    public function editUserPost($user_id, $post_id, Request $request) {
//        $user = User::find($user_id);
//        if($user == false) {
//            abort(404);
//        } else {
//            $post = Profile::find($post_id);
//            if($post == false) {
//                abort(404);
//            } else {
//                $post->title = $request->title;
//                $post->slug = $request->slug;
//                $post->message = $request->message;
//                $post->user_id = $user_id;
//                $post->videoPost = str_replace('watch?v=', 'embed/', $request->videoPost);
//
//                if($request->file('img')) {
//                    $path = Storage::putFile('public/' . Auth::user()->id . '/post', $request->file('img')); //Where to put the file
//                    $url = Storage::url($path); //url() - Get the URL for the file at the given path.
//                    $post->img = $url;
//                }
//
//                $post->update();
//
//                return response()->json($post, 201);
//            }
//        }
//    }
}
