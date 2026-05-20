<x-admin-layout>
    <x-slot name="header">Kelola Kuis</x-slot>

    <div class="col-span-1 xl:col-span-12">
        @if (session('success'))
        <div class="mb-6 glass-panel border border-primary/30 text-primary px-6 py-3 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-sm font-bold text-on-surface">Daftar Kuis ({{ $quizzes->count() }})</h2>
            <a href="{{ route('admin.quizzes.create') }}" class="bg-secondary text-white font-bold px-6 py-2 rounded-lg flex items-center gap-2 hover:bg-secondary/80 transition-colors shadow-[0_0_10px_rgba(255,42,133,0.3)]">
                <span class="material-symbols-outlined">add</span> Tambah Kuis
            </a>
        </div>

        <div class="glass-panel rounded-2xl overflow-hidden border-t-2 border-secondary">
            @if($quizzes->isEmpty())
            <div class="p-12 text-center">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">quiz</span>
                <h3 class="font-bold text-on-surface text-xl mb-2">Belum ada kuis</h3>
                <a href="{{ route('admin.quizzes.create') }}" class="inline-flex items-center gap-2 text-secondary hover:underline mt-2">
                    Buat kuis pertama <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-highest/50 border-b border-white/10 text-on-surface-variant font-label-caps text-label-caps">
                            <th class="p-4">No</th>
                            <th class="p-4">Judul Kuis</th>
                            <th class="p-4">Kursus / Modul</th>
                            <th class="p-4">Pertanyaan</th>
                            <th class="p-4">XP/Jawaban</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($quizzes as $quiz)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="p-4 text-on-surface-variant">{{ $loop->iteration }}</td>
                            <td class="p-4">
                                <div class="font-bold text-secondary">{{ $quiz->title }}</div>
                                <div class="text-xs text-on-surface-variant font-mono">{{ $quiz->slug }}</div>
                            </td>
                            <td class="p-4 text-on-surface-variant">
                                <div>{{ $quiz->module?->course?->title ?? '-' }}</div>
                                <div class="text-xs">Modul: {{ $quiz->module?->title ?? '-' }}</div>
                            </td>
                            <td class="p-4 text-on-surface-variant">{{ $quiz->questions->count() }} soal</td>
                            <td class="p-4 text-on-surface-variant">{{ $quiz->xp_per_correct }} XP</td>
                            <td class="p-4">
                                <div class="flex gap-3 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-secondary hover:text-secondary-container" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.quizzes.destroy', $quiz) }}" onsubmit="return confirm('Hapus kuis {{ $quiz->title }}?')">
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
