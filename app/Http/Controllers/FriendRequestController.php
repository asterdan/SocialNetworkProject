<?php

namespace App\Http\Controllers;

use App\Friend;
use App\FriendRequest;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Redirect;

class FriendRequestController extends Controller
{
    //

    public function frienRequestsPage()
    {
        try
        {
            if ($user = Auth::user()) {
                $user_id = auth()->user()->id;
                $friendRequests = DB::select('SELECT users.name,friend_requests.* FROM users JOIN friend_requests  ON users.id = friend_requests.user_id WHERE friend_requests.friend_id =' . $user_id . ' AND friend_requests.accepted  = 0;');
                $user = User::find($user_id);
                $users = User::all();
                $data = [
                    'users' => $users,
                    'friendReq' => $friendRequests,
                    'friends' => $user->friends,
                ];

                return view('profile.friendrequests')->with('data', $data);
            } else {
                return Redirect::to('/login');
            }
        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }

    public function sendFriendRequest(Request $request)
    {
        try
        {
            if ($user = Auth::user()) {
                $toUser = $request->input('user_id');
                $myUser_id = auth()->user()->id;
                $friendRequest = new FriendRequest;
                $friendRequest->accepted = 0;
                $friendRequest->friend_id = $toUser;
                $friendRequest->user_id = $myUser_id;
                $friendRequest->save();

                return response()->json(['message' => 'Friend request sent succesfully!']);
            } else {
                return Redirect::to('/login');
            }

        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }

    public function acceptRequest(Request $request)
    {
        try
        {
            if ($user = Auth::user()) {
                $myUser_id = auth()->user()->id;
                $reqId = $request->input('request_id');
                FriendRequest::where('id', $reqId)->update(['accepted' => 1]);
                $friendName = $request->input('username');
                $friend_id = $request->input('friend_id');

                $friend = new Friend;
                $friend->username = $friendName;
                $friend->friend_id = $friend_id;
                $friend->user_id = $myUser_id;
                $friend->userpagelink = '';

                $friend->save();
                $user = User::find($myUser_id);

                $friend2 = new Friend;
                $friend2->username = $user->name;
                $friend2->friend_id = $myUser_id;
                $friend2->user_id = $friend_id;
                $friend2->userpagelink = '';
                $friend2->save();
                
                return response()->json(['message' => 'Friend request accepted']);
            }

        } catch (Exception $ex) {
            return Redirect::to('/serverError');
        }

    }

    public function denyFriendRequest()
    {
        try
        {
            $reqId = $request->input('request_id');
            FriendRequest::where('id', $reqId)->update(['accepted' => 2]);

            return response()->json(['message' => 'Friend request refused']);
        } 
        catch (Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()]);
        }

    }
}
