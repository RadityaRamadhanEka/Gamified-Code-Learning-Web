<x-admin-layout>
    <x-slot name="header">Kelola Materi</x-slot>

    <div class="col-span-1 xl:col-span-12">
        @if (session('success'))
        <div class="mb-6 glass-panel border border-primary/30 text-primary px-6 py-3 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-sm font-bold text-on-surface">Daftar Materi ({{ $lessons->count() }})</h2>
            <a href="{{ route('admin.materials.create') }}" class="bg-tertiary text-white font-bold px-6 py-2 rounded-lg flex items-center gap-2 hover:bg-tertiary/80 transition-colors shadow-[0_0_10px_rgba(157,78,255,0.3)]">
                <span class="material-symbols-outlined">add</span> Tambah Materi
            </a>
        </div>

        <div class="glass-panel rounded-2xl overflow-hidden border-t-2 border-tertiary">
            @if($lessons->isEmpty())
            <div class="p-12 text-center">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">library_books</span>
                <h3 class="font-bold text-on-surface text-xl mb-2">Belum ada materi</h3>
                <a href="{{ route('admin.materials.create') }}" class="inline-flex items-center gap-2 text-tertiary hover:underline mt-2">
                    Buat materi pertama <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-highest/50 border-b border-white/10 text-on-surface-variant font-label-caps text-label-caps">
                            <th class="p-4">No</th>
                            <th class="p-4">Judul Materi</th>
                            <th class="p-4">Kursus / Modul</th>
                            <th class="p-4">XP</th>
                            <th class="p-4">Video</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($lessons as $lesson)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="p-4 text-on-surface-variant">{{ $loop->iteration }}</td>
                            <td class="p-4">
                                <div class="font-bold text-tertiary">{{ $lesson->title }}</div>
                                <div class="text-xs text-on-surface-variant font-mono">{{ $lesson->slug }}</div>
                            </td>
                            <td class="p-4 text-on-surface-variant text-sm">
                                <div>{{ $lesson->module?->course?->title ?? '-' }}</div>
                                <div class="text-xs">Modul: {{ $lesson->module?->title ?? '-' }}</div>
                            </td>
                            <td class="p-4 text-on-surface-variant">{{ $lesson->xp_reward }} XP</td>
                            <td class="p-4">
                                @if($lesson->video_url)
                                    <a href="{{ $lesson->video_url }}" target="_blank" class="text-primary hover:underline text-sm flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">play_circle</span> Tonton
                                    </a>
                                @else
                                    <span class="text-on-surface-variant text-xs">-</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex gap-3 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.materials.edit', $lesson) }}" class="text-tertiary hover:text-tertiary-container" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.materials.destroy', $lesson) }}" onsubmit="return confirm('Hapus materi {{ $lesson->title }}?')">
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
