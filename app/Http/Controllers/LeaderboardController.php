<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        // Top users by XP
        $topUsers = User::orderByDesc('xp')->take(50)->get();

        // Current user's rank
        $userRank = User::where('xp', '>', $user->xp)->count() + 1;

        return view('leaderboard.index', compact('topUsers', 'userRank', 'user'));
    }
}
