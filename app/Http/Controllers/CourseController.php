<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display listing of courses with user progress & lock status.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $courses = Course::published()->ordered()->get();

        // Attach progress & access info to each course
        $courses->each(function ($course) use ($user) {
            $course->progress = $user->courseProgress($course);
            $course->is_locked = !$user->canAccessCourse($course);
            $course->completed_lessons = $user->lessonProgress()
                ->whereHas('lesson.module', fn($q) => $q->where('course_id', $course->id))
                ->count();
            $course->total_lessons = $course->totalLessonsCount();
        });

        return view('courses.index', compact('courses', 'user'));
    }

    /**
     * Display single course with modules, lessons, and progress.
     * Gate: abort 403 if user level is insufficient.
     */
    public function show(Request $request, Course $course): View
    {
        $user = $request->user();

        // Security gate: check level requirement
        if (!$user->canAccessCourse($course)) {
            abort(403, 'Level kamu belum cukup untuk mengakses kursus ini. Dibutuhkan Level ' . $course->min_level_required);
        }

        // Load modules with lessons and quizzes
        $modules = $course->modules()->with(['lessons', 'quiz.questions'])->get();

        // Attach per-module progress data
        $modules->each(function ($module) use ($user) {
            $module->progress = $module->progressFor($user);
            $module->is_completed = $module->isCompletedBy($user);

            // Mark each lesson's completion status
            $module->lessons->each(function ($lesson) use ($user) {
                $lesson->is_completed = $user->hasCompletedLesson($lesson);
                $lesson->is_accessible = $lesson->isAccessibleBy($user);
            });

            // Mark quiz status
            if ($module->quiz) {
                $module->quiz->is_attempted = $user->hasAttemptedQuiz($module->quiz);
                $module->quiz->best_score = $user->bestQuizScore($module->quiz);
            }
        });

        // Determine current active module
        $activeModule = $modules->first(fn($m) => !$m->is_completed) ?? $modules->last();

        $courseProgress = $user->courseProgress($course);

        return view('courses.show', compact('course', 'modules', 'activeModule', 'courseProgress', 'user'));
    }
}
