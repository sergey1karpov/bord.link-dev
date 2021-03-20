<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
	public function __construct()
	{
        $this->middleware('auth');
		$this->middleware('role');
	}

    /**
     * Show admin panel with all users
     */
    public function admin($id)
    {
        $users = User::paginate(50);
        $user = User::find($id);
        return view('home', compact('users', 'user'));
    }

    /**
     * Verification users
     * @param app\User $id
     * @param Illuminate\Http\Request $request
     */
    public function editAdminForUsers(Request $request, $id) {
	    $user = User::findOrFail($id);
        $user->verify = $request->verify;
        $user->update();

        return redirect()->back();
    }

    /**
     * Delete user
     * @param  App\User $id
     */
    public function deleteAdminForUsers($id) {
	    $user = User::find($id);
        File::deleteDirectory(public_path('storage/'.$user->id));
	    $user->delete();
	    return redirect()->back();
    }

}
