<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserLessonProgress;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LessonController extends Controller
{
    /**
     * Display lesson content.
     * Gate: check prerequisite (previous lesson must be completed).
     */
    public function show(Request $request, Course $course, Lesson $lesson): View
    {
        $user = $request->user();

        // Security: verify course access
        if (!$user->canAccessCourse($course)) {
            abort(403, 'Level kamu belum cukup untuk mengakses kursus ini.');
        }

        // Security: verify lesson belongs to this course
        abort_unless(
            $lesson->module && $lesson->module->course_id === $course->id,
            404
        );

        // Security: check prerequisite
        if (!$lesson->isAccessibleBy($user)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Selesaikan materi sebelumnya terlebih dahulu.');
        }

        $isCompleted = $user->hasCompletedLesson($lesson);

        // Get next lesson for navigation
        $nextLesson = Lesson::where('module_id', $lesson->module_id)
            ->where('order', '>', $lesson->order)
            ->orderBy('order')
            ->first();

        // If no next lesson in this module, get first lesson of next module
        if (!$nextLesson) {
            $nextModule = $lesson->module->course->modules()
                ->where('order', '>', $lesson->module->order)
                ->orderBy('order')
                ->first();
            if ($nextModule) {
                $nextLesson = $nextModule->lessons()->orderBy('order')->first();
            }
        }

        return view('courses.lesson', compact('course', 'lesson', 'isCompleted', 'nextLesson', 'user'));
    }

    /**
     * Mark lesson as complete and award XP.
     * Idempotent: if already completed, no duplicate XP.
     */
    public function complete(Request $request, Course $course, Lesson $lesson): RedirectResponse
    {
        $user = $request->user();

        // Security: verify course access
        if (!$user->canAccessCourse($course)) {
            abort(403);
        }

        // Security: verify lesson belongs to this course
        abort_unless(
            $lesson->module && $lesson->module->course_id === $course->id,
            404
        );

        // Security: check prerequisite
        if (!$lesson->isAccessibleBy($user)) {
            return back()->with('error', 'Selesaikan materi sebelumnya terlebih dahulu.');
        }

        // Idempotent check: don't award XP twice
        if ($user->hasCompletedLesson($lesson)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('info', 'Materi ini sudah pernah diselesaikan.');
        }

        // Create progress record
        UserLessonProgress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'xp_earned' => $lesson->xp_reward,
        ]);

        // Award XP (server-side only — anti-cheat)
        $user->addXp($lesson->xp_reward);

        // Update streak
        $user->updateStreak();

        return redirect()->route('courses.show', $course->slug)
            ->with('success', "Materi selesai! +{$lesson->xp_reward} XP 🎉");
    }
}
