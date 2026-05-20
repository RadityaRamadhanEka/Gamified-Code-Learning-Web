<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('module.course')->orderBy('order')->get();
        return view('admin.materials.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::with('modules')->orderBy('order')->get();
        return view('admin.materials.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title'     => 'required|string|max:255',
            'content'   => 'nullable|string',
            'video_url' => 'nullable|url|max:500',
            'xp_reward' => 'nullable|integer|min:0',
            'order'     => 'nullable|integer|min:0',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Lesson::where('module_id', $validated['module_id'])->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $validated['slug'] = $slug;
        $validated['xp_reward'] = $validated['xp_reward'] ?? 50;
        $validated['order'] = $validated['order'] ?? (Lesson::where('module_id', $validated['module_id'])->max('order') + 1);

        Lesson::create($validated);

        return redirect()->route('admin.materials.index')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::with('modules')->orderBy('order')->get();
        return view('admin.materials.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title'     => 'required|string|max:255',
            'content'   => 'nullable|string',
            'video_url' => 'nullable|url|max:500',
            'xp_reward' => 'nullable|integer|min:0',
            'order'     => 'nullable|integer|min:0',
        ]);

        $validated['xp_reward'] = $validated['xp_reward'] ?? 50;

        $lesson->update($validated);

        return redirect()->route('admin.materials.index')
            ->with('success', 'Materi berhasil diupdate!');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.materials.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
