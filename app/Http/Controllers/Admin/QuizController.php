<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('module.course')->latest()->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::with('modules')->orderBy('order')->get();
        return view('admin.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id'          => 'required|exists:modules,id',
            'title'              => 'required|string|max:255',
            'xp_per_correct'     => 'nullable|integer|min:0',
            'time_limit_seconds' => 'nullable|integer|min:0',
            'questions'          => 'required|array|min:1',
            'questions.*.question'       => 'required|string',
            'questions.*.options'        => 'required|array|min:2',
            'questions.*.correct_answer' => 'required|string',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Quiz::where('module_id', $validated['module_id'])->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $quiz = Quiz::create([
            'module_id'          => $validated['module_id'],
            'title'              => $validated['title'],
            'slug'               => $slug,
            'xp_per_correct'     => $validated['xp_per_correct'] ?? 25,
            'time_limit_seconds' => $validated['time_limit_seconds'] ?? null,
        ]);

        foreach ($validated['questions'] as $index => $q) {
            QuizQuestion::create([
                'quiz_id'        => $quiz->id,
                'question'       => $q['question'],
                'options'        => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'order'          => $index + 1,
            ]);
        }

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Kuis berhasil ditambahkan!');
    }

    public function edit(Quiz $quiz)
    {
        $quiz->load('questions');
        $courses = Course::with('modules')->orderBy('order')->get();
        return view('admin.quizzes.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'module_id'          => 'required|exists:modules,id',
            'title'              => 'required|string|max:255',
            'xp_per_correct'     => 'nullable|integer|min:0',
            'time_limit_seconds' => 'nullable|integer|min:0',
            'questions'          => 'required|array|min:1',
            'questions.*.question'       => 'required|string',
            'questions.*.options'        => 'required|array|min:2',
            'questions.*.correct_answer' => 'required|string',
        ]);

        $quiz->update([
            'module_id'          => $validated['module_id'],
            'title'              => $validated['title'],
            'xp_per_correct'     => $validated['xp_per_correct'] ?? 25,
            'time_limit_seconds' => $validated['time_limit_seconds'] ?? null,
        ]);

        // Delete old questions
        $quiz->questions()->delete();

        // Recreate new questions
        foreach ($validated['questions'] as $index => $q) {
            QuizQuestion::create([
                'quiz_id'        => $quiz->id,
                'question'       => $q['question'],
                'options'        => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'order'          => $index + 1,
            ]);
        }

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Kuis berhasil diupdate!');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Kuis berhasil dihapus.');
    }
}
