<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use App\Models\Follower;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    use Notify, Upload;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }

    public function follow(Request $request, $userId = null){
      $ifExists = Follower::whereUser_id($userId)->whereFollowing_id($this->user->id)->latest()->first();
      if (!$ifExists){
          Follower::create([
              'user_id' => $userId,
              'following_id' => $this->user->id,
              'created_at' => Carbon::now(),
          ]);
          session()->flash('success', __('Follow'));
          return back();
      }
    }

    public function unFollow(Request $request, $userId = null)
    {
        Follower::whereUser_id($userId)->whereFollowing_id($this->user->id)->delete();
        session()->flash('success', __('UnFollow'));
        return back();
    }

}
