<x-admin-layout>
    <x-slot name="header">Kelola Kursus</x-slot>

    <div class="col-span-1 xl:col-span-12">
        @if (session('success'))
        <div class="mb-6 glass-panel border border-primary/30 text-primary px-6 py-3 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-sm font-bold text-on-surface">Daftar Kursus ({{ $courses->count() }})</h2>
            <a href="{{ route('admin.courses.create') }}" class="bg-primary text-on-primary font-bold px-6 py-2 rounded-lg flex items-center gap-2 hover:bg-primary/80 transition-colors shadow-[0_0_10px_rgba(0,240,255,0.3)]">
                <span class="material-symbols-outlined">add</span> Tambah Kursus
            </a>
        </div>

        <div class="glass-panel rounded-2xl overflow-hidden">
            @if($courses->isEmpty())
            <div class="p-12 text-center">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">school</span>
                <h3 class="font-bold text-on-surface text-xl mb-2">Belum ada kursus</h3>
                <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 text-primary hover:underline mt-2">
                    Buat kursus pertama <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-highest/50 border-b border-white/10 text-on-surface-variant font-label-caps text-label-caps">
                            <th class="p-4">No</th>
                            <th class="p-4">Judul Kursus</th>
                            <th class="p-4">Modul</th>
                            <th class="p-4">Level Min</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($courses as $course)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="p-4 text-on-surface-variant">{{ $loop->iteration }}</td>
                            <td class="p-4">
                                <div class="font-bold text-primary">{{ $course->title }}</div>
                                <div class="text-xs text-on-surface-variant font-mono">{{ $course->slug }}</div>
                            </td>
                            <td class="p-4 text-on-surface-variant">{{ $course->modules_count }} Modul</td>
                            <td class="p-4 text-on-surface-variant">Level {{ $course->min_level_required }}</td>
                            <td class="p-4">
                                @if($course->is_published)
                                    <span class="bg-primary/10 text-primary text-xs px-3 py-1 rounded-full">Published</span>
                                @else
                                    <span class="bg-white/10 text-on-surface-variant text-xs px-3 py-1 rounded-full">Draft</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex gap-3 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="text-secondary hover:text-secondary-container" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Hapus kursus {{ $course->title }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-error hover:text-error/80" title="Hapus">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
