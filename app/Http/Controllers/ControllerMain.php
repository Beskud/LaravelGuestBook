<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class ControllerMain extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function setComment(Request $request)
    {
    
        if (!empty($request->input('text_comment'))) {
            if (preg_match('/^[\p{L}\d\s,.\(\)!\";:\[\]{}\#$@%&]{1,60}$/ui', $request->input('text_comment'))) {
                $text_comment = $request->input('text_comment');

                $created = $request->input('created');
                $comment_id = null;
                if (!empty($request->input('comment_id'))) {
                    $comment_id = $request->input('comment_id');
                }

                $response = Comment::create([
                    'user_id' =>  session()->get('user_data')['id'],
                    'text_comment' => $text_comment,
                    'comment_id' => $comment_id,
                ]);
                $response['user']['avatar_id'] = session()->get('user_data')['avatar_id'];
                $response['user']['username'] = session()->get('user_data')['username'];
                $response['status'] = 'success';
                return response()->json($response); 
            } else {
                $response['status'] = 'bad';
                return response()->json($response);
            }
        } else {
            $response['status'] = 'bad';
            return response()->json($response);
        }
    }

    public function getComment()
    {
    
        // $comments = Comment::
        //     join('users', 'users.id', '=', 'comments.user_id')
        //     ->select('comments.*', 'users.username', 'avatar_id')
        //     ->get();       
            $comments = Comment::with('user')->get();
             return response()->json($comments);
    }

    public function remove(Request $request)
    {
       
        if (session()->get('user_data')['is_admin']) {
           
            Comment::where('id', $request->input('comment_id'))->delete();
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function changeUserAvatar(Request $request)
    {
        if (!empty($request->input('avatar_id'))) {
            
            User::where('id', session()->get('user_data')['id'])->
            update(['avatar_id' => $request->input('avatar_id')]);

            $user_data = session()->get('user_data');
            $user_data['avatar_id'] = $request->input('avatar_id');

            session(['user_data' =>  $user_data]);

            return $request->input('avatar_id');
        }
    }    
}

