<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    /**
     * Comment on a user's post
     * @param Illuminate\Http\Request $request
     */
    public function sendComment(Request $request) {
        $comment = new Comments();
        $comment->user_id = Auth::user()->id;
        $comment->user_name = Auth::user()->nickname;
        $comment->profile_id = $request->postId;
        $comment->user_avatar = Auth::user()->avatar;
        $comment->comment = $request->comment;
        $comment->save();

        $a = Profile::find($request->postId);
        $a->commentCount++;
        $a->update();

        return redirect()->back();
    }

    /**
     * Delete comment
     * @param app\User $id
     * @param app\Profile $postId
     * @param app\Comment $commentId
     */
    public function deleteComment($id, $postId, $commentId) {
        $user = User::find($id);
        if($user) {
            $post = Profile::find($postId);
            if($post) {
                $comment = Comments::find($commentId);
                if($comment) {
                    $comment->delete();

                    $a = Profile::find($postId);
                    $a->commentCount--;
                    $a->update();

                    return response()->json([
                        'message' => 'deleted...'
                    ]);
                }
            }
        }

        return abort(404);
    }

    /**
     * Edit comment
     * @param app\User $id
     * @param app\Profile $postId
     * @param app\Comment $commentId
     * @param Illuminate\Http\Request $request
     */
    public function editComment($id, $postId, $commentId, Request $request) {
        $user = User::find($id);
        if($user) {
            $post = Profile::find($postId);
            if($post) {
                $comment = Comments::find($commentId);
                if($comment) {
                    $comment->comment = $request->commentEdited;
                    $comment->update();
                    return redirect()->back();
//                    return response()->json([
//                        'message' => 'edited...'
//                    ]);
                }
            }
        }
    }

}
