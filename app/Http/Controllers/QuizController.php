<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\UserQuizAttempt;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class QuizController extends Controller
{
    /**
     * Display quiz with questions.
     * NOTE: correct_answer is NOT sent to the view — server-side validation only.
     */
    public function show(Request $request, Course $course, Quiz $quiz): View
    {
        $user = $request->user();

        // Security: verify course access
        if (!$user->canAccessCourse($course)) {
            abort(403, 'Level kamu belum cukup untuk mengakses kursus ini.');
        }

        // Security: verify quiz belongs to this course
        abort_unless(
            $quiz->module && $quiz->module->course_id === $course->id,
            404
        );

        // Load questions with correct answers for instant feedback
        $questions = $quiz->questions()->orderBy('order')->get()->map(function ($q) {
            return [
                'id' => $q->id,
                'question' => $q->question,
                'options' => $q->options,
                'correct_answer' => $q->correct_answer,
                'order' => $q->order,
            ];
        });

        // Build answer key map for JavaScript instant feedback
        $answerKey = $questions->pluck('correct_answer', 'id');

        $previousAttempt = $user->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->latest()
            ->first();

        return view('courses.quiz', compact('course', 'quiz', 'questions', 'answerKey', 'previousAttempt', 'user'));
    }

    /**
     * Submit quiz answers, validate server-side, award XP.
     */
    public function submit(Request $request, Course $course, Quiz $quiz): RedirectResponse
    {
        $user = $request->user();

        // Security: verify course access
        if (!$user->canAccessCourse($course)) {
            abort(403);
        }

        // Security: verify quiz belongs to this course
        abort_unless(
            $quiz->module && $quiz->module->course_id === $course->id,
            404
        );

        // Validate answers input
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        $answers = $request->input('answers');
        $questions = $quiz->questions()->get();

        $correctCount = 0;
        $totalQuestions = $questions->count();

        // Server-side answer validation — compare against DB
        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            if ($userAnswer !== null && $userAnswer === $question->correct_answer) {
                $correctCount++;
            }
        }

        // Calculate XP earned
        $xpEarned = $correctCount * $quiz->xp_per_correct;

        // Check if this is the first attempt (only award XP on first attempt)
        $isFirstAttempt = !$user->hasAttemptedQuiz($quiz);

        // Record attempt
        UserQuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => $correctCount,
            'total_questions' => $totalQuestions,
            'xp_earned' => $isFirstAttempt ? $xpEarned : 0,
        ]);

        // Award XP only on first attempt (anti-cheat)
        if ($isFirstAttempt && $xpEarned > 0) {
            $user->addXp($xpEarned);
            $user->updateStreak();
        }

        $scorePercent = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : 0;

        return redirect()->route('courses.show', $course->slug)
            ->with('success', "Quiz selesai! Score: {$correctCount}/{$totalQuestions} ({$scorePercent}%)" . ($isFirstAttempt ? " — +{$xpEarned} XP 🎉" : ''));
    }
}
