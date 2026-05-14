<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        // Get the active course (first course with progress, or first available)
        $activeCourse = Course::published()->ordered()->first();
        $courseProgress = $activeCourse ? $user->courseProgress($activeCourse) : 0;

        // Load modules for active course with user's progress
        $modules = $activeCourse
            ? $activeCourse->modules()->with('lessons')->get()
            : collect();

        // XP needed for next level
        $currentLevelXp = ($user->level - 1) * 500;
        $nextLevelXp = $user->level * 500;
        $xpProgress = $nextLevelXp > 0
            ? round((($user->xp - $currentLevelXp) / 500) * 100)
            : 0;

        // Mini leaderboard (top 5)
        $topUsers = User::orderByDesc('xp')->take(5)->get();
        $userRank = User::where('xp', '>', $user->xp)->count() + 1;

        return view('dashboard', compact(
            'user',
            'activeCourse',
            'courseProgress',
            'modules',
            'xpProgress',
            'topUsers',
            'userRank',
        ));
    }
}
