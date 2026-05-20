<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount(['modules'])->orderBy('order')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'icon'              => 'nullable|string|max:100',
            'color_theme'       => 'nullable|string|max:50',
            'min_level_required'=> 'nullable|integer|min:0',
            'order'             => 'nullable|integer|min:0',
            'is_published'      => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $request->input('order', Course::max('order') + 1);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Course::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil ditambahkan!');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'icon'              => 'nullable|string|max:100',
            'color_theme'       => 'nullable|string|max:50',
            'min_level_required'=> 'nullable|integer|min:0',
            'order'             => 'nullable|integer|min:0',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil diupdate!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}
