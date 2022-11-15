<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function followUnfollow(Request $requst) {
        $followerId = User::find(auth()->user()->id);
        $followingId = User::find($requst->userId);
        $followerId->following()->toggle($followingId);
        return redirect()->back();
    }

    /**
     * get followers where follower_id is 
     * equal to logged in user and return 
     * it to the view
     */
    public function profile() {
        $followings = Follower::where('follower_id', auth()->user()->id)->get();
        foreach ($followings as $following) {
            $userId = $following->userfollow->id;
            $follows = (new User)->amIfollowing($userId);
        }
        return view('profile', compact('userId', 'follows', 'followings'));
    }
}
