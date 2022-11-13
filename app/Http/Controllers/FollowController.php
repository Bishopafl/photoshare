<?php

namespace App\Http\Controllers;

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
}
