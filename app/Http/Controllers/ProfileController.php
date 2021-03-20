<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\addEventRequest;
use App\Http\Requests\addProfileAlbumsRequest;
use App\Http\Requests\addProfileVideoRequest;
// use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\storeRequest;
use App\Profile;
use App\User;
use App\ProfileVideo;
use App\ProfileAlbums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

//use App\Services\HashTagsFind;

class ProfileController extends Controller {
    /**
     * Show user profile
     * @param User $nickname
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(User $nickname) {
        $user = $nickname;
        if($user) {
            $posts = $user->profile()->orderBy('created_at', 'desc')->paginate(15);
            $mainVideo = $user->profileVideo()->orderBy('created_at', 'desc')->limit(1)->get();
            $mainAlbum = $user->profileAlbums()->orderBy('created_at', 'desc')->limit(1)->get();
            $events = $user->events()->orderBy('eventdata')->limit(3)->get();
            $subscribers = Profile::getMySubscribers($user->id); //Кто подписан на пользователя
            $followers = Profile::getMyFollowers($user->id); //На кого подписан пользователь
            $followersPosts = Profile::getMyFollowersPosts($user->id); //Посты на кого подписан пользователь
            return view('profile.profile', compact('user', 'posts', 'mainVideo', 'mainAlbum', 'events',
                'subscribers', 'followers', 'followersPosts'));
        }
        return redirect()->route('musics');
    }

    /**
     * Publish user post
     * @param storeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(storeRequest $request) {
        Profile::addUserPost($request->all());
        return redirect()->back();
    }

    /**
     * Delete user. When user has been deleted, the directory has been deleted too
     * @param app\User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id) {
        $user = User::find($id);
        File::deleteDirectory(public_path('storage/'.Auth::user()->id));
        $user->delete();
        return redirect()->route('musics');
    }

    /**
     * Show post page
     * @param app\User $id
     * @param app\Profile $postId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function post($id, $postId) {
        $user = User::findOrFail($id);
        $post = Profile::findOrFail($postId);
        return view('profile.post', compact('user', 'post'));
    }

    /**
     * Edit user post
     * @param storeRequest $request
     * @param app\User $id
     * @param app\Profile $postId
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function editPost(storeRequest $request, $id, $postId) {
        $user = User::findOrFail($id);
        if(!$user && $user != Auth::user()->id) {
            return abort(404);
        }
        $post = Profile::findOrFail($postId);
        Profile::editUserPost($request->all(), $post);
        return redirect()->back();
    }

    /**
     * Show edit profile template
     * @param app\User $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditProfileInformationPage($id) {
        $user = User::find($id);
        return view('profile.profileEdit', compact('user'));
    }

    /**
     * Edit user information
     * @param Request $request
     * @param app\User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editProfileInformation(Request $request, $id) {
        $user = User::findOrFail($id);
        User::editUserInformation($request->all(), $user);
        return redirect()->back()->with('status', 'Информация обновлена!');
    }

    /**
     * Delete user post
     * @param app\User $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id) {
        $post = Profile::findOrFail($id);
        $post->delete();
        return response()->json([
            'message' => 'deleted...'
        ]);
    }

    /**
     * Show all video
     * @param app\User $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function allVideo($id) {
        $user = User::findOrFail($id);
        $videos = $user->profileVideo()->orderBy('created_at', 'desc')->paginate(6);
        if(!Auth::check() && !$videos->count() || !$videos->count() && Auth::user()->id != $user->id) {
            return abort(404);
        }
        return view('profile.allvideo', compact('user', 'videos'));
    }

    /**
     * Add video in user profile
     * @param addProfileVideoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProfileVideo(addProfileVideoRequest $request) {
        ProfileVideo::newProfileVideo($request->all());
        return redirect()->back();
    }

    /**
     * Delete user video
     * @param app\User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteVideo($id) {
        $videoDelete = ProfileVideo::findOrFail($id);
        $videoDelete->delete();
        return redirect()->route('allVideo', ['id' => $videoDelete->user_id]);
    }

    /**
     * Show all user albums
     * @param app\User $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function allAlbums($id) {
        $user = User::findOrFail($id);
        $albums = $user->profileAlbums()->orderBy('created_at', 'desc')->paginate(6);
        if(!Auth::check() && !$albums->count() || !$albums->count() && Auth::user()->id != $user->id) {
            return abort(404);
        }
        return view('profile.allalbums', compact('user', 'albums'));
    }

    /**
     * Add user album
     * @param addProfileAlbumsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProfileAlbums(addProfileAlbumsRequest $request) {
        ProfileAlbums::newProfileAlbum($request->all());
        return redirect()->back();
    }

    /**
     * Edit user album
     * @param app\User $id
     * @param app\ProfileAlbums $album
     * @param addProfileAlbumsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAlbum($id, $album, addProfileAlbumsRequest $request) {
        $user = User::findOrFail($id);
        if($user->email == Auth::user()->email) {
            $alb = ProfileAlbums::findOrFail($album);
            if($alb) {
                ProfileAlbums::editProfileAlbum($request->all(), $alb);
            }
            return redirect()->back();
        }
    }

    /**
     * Delete user album
     * @param app\User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAlbums($id) {
        $audioDelete = ProfileAlbums::findOrFail($id);
        $audioDelete->delete();
        return redirect()->route('allAlbums', ['id' => $audioDelete->user_id]);
    }

    /**
     * Show user album
     * @param app\User $id
     * @param app\ProfileAlbums $album
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function album($id, $album) {
        $user = User::findOrFail($id);
        $album = ProfileAlbums::findOrFail($album);
        if($album == false || $user->id != $album->user_id) {
            return abort(404);
        }
        return view('profile.album', compact('user', 'album'));
    }

    /**
     * Show all user events
     * @param app\User $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function events($id) {
        $user = User::findOrFail($id);
        $events = $user->events()->orderBy('eventdata')->get();
        if(!Auth::check() && !$events->count() || !$events->count() && Auth::user()->id != $user->id) {
            return abort(404);
        }
        return view('profile.events', compact('user', 'events'));
    }

    /**
     * Show user event
     * @param app\User $id
     * @param app\Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function event($id, $event) {
        $user = User::findOrFail($id);
        $event = Event::find($event);
        if($event == false || $user->id != $event->user_id) {
            return abort(404);
        }
        return view('profile.event', compact('user', 'event'));
    }

    /**
     * Add user event
     * @param addEventRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addEvent(addEventRequest $request) {
        Event::addUserEvent($request->all());
        return redirect()->back();
    }

    /**
     * Edit user event
     * @param addEventRequest $request
     * @param app\User $id
     * @param app\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editEvent(addEventRequest $request, $id, $event) {
        $user = User::findOrFail($id);
        if(Auth::user()->id == $user->id) {
            $event = Event::findOrFail($event);
            Event::editUserEvent($request->all(), $event);
            return redirect()->back();
        } else {
            abort(403);
        }

    }

    /**
     * Delete user event
     * @param app\User $id
     * @param app\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEvent($id, $event) {
        $user = User::findOrFail($id);
        $deleteEvent = Event::findOrFail($event);
        $deleteEvent->delete();
        return redirect()->route('events', ['id' => $user->id]);
    }

    /**
     * Show user video
     * @param app\User $id
     * @param app\ProfileVideo $video
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function video($id, $video) {
        $user = User::findOrFail($id);
        $video = ProfileVideo::findOrFail($video);
        if($video == false || $user->id != $video->user_id) {
            return abort(404);
        }
        return view('profile.video', compact('user', 'video'));
    }

    /**
     * Edit user video
     * @param addProfileVideoRequest $request
     * @param app\User $id
     * @param app\ProfileVideo $video
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateVideo(addProfileVideoRequest $request, $id, $video) {
        $user = User::find($id);
        if(Auth::user()->id == $user->id) {
            $video = ProfileVideo::findOrFail($video);
            ProfileVideo::editUserVideo($request->all(), $video);
            return redirect()->back();
        } else {
            abort(404);
        }
    }

    /**
     * Delete user profile banner
     * @param Request $request
     * @param app\User $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteBanner(Request $request, $id) {
        $user = User::find($id);
        $user->banner = $request->banner;
        $user->update();
        return redirect()->back();
    }

    public function deletePostImage($id, $post) {
        //
    }

    public function deletePostImages($id, $post) {
        //
    }
}
