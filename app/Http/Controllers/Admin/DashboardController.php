<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_courses'  => Course::count(),
            'total_quizzes'  => Quiz::count(),
            'total_lessons'  => Lesson::count(),
            'total_users'    => User::where('is_admin', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
