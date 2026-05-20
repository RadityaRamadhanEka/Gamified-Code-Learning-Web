<x-admin-layout>
    <x-slot name="header">Tambah Materi Baru</x-slot>

    <div class="col-span-1 xl:col-span-8">
        <div class="glass-panel rounded-2xl p-6 md:p-8 border-t-2 border-tertiary">
            <h2 class="font-headline-sm font-bold text-on-surface mb-6 border-b border-white/10 pb-4">Isi Materi / Lesson</h2>

            @if ($errors->any())
            <div class="mb-6 glass-panel border border-error/30 text-error px-5 py-4 rounded-xl">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.materials.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="course_select" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Kursus <span class="text-error">*</span></label>
                        <select id="course_select" class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-tertiary focus:ring-1 focus:ring-tertiary transition-all appearance-none">
                            <option value="">Pilih Kursus...</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="module_id" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Modul <span class="text-error">*</span></label>
                        <select id="module_id" name="module_id" required class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-tertiary focus:ring-1 focus:ring-tertiary transition-all appearance-none">
                            <option value="">Pilih Kursus dulu...</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="title" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Judul Materi <span class="text-error">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-tertiary focus:ring-1 focus:ring-tertiary transition-all"
                        placeholder="Contoh: Pengenalan Sintaks Dasar Python">
                </div>

                <div>
                    <label for="content" class="block font-label-lg text-label-lg text-on-surface-variant mb-2 flex justify-between items-end">
                        Konten Materi
                        <span class="text-xs font-normal opacity-70">Mendukung Markdown</span>
                    </label>
                    <textarea id="content" name="content" rows="12"
                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-tertiary focus:ring-1 focus:ring-tertiary transition-all font-mono text-sm"
                        placeholder="# Judul Materi&#10;&#10;Tuliskan isi materi di sini...">{{ old('content') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="video_url" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">URL Video (Opsional)</label>
                        <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-tertiary focus:ring-1 focus:ring-tertiary transition-all"
                            placeholder="https://youtube.com/watch?v=...">
                    </div>
                    <div>
                        <label for="xp_reward" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">XP Reward</label>
                        <input type="number" id="xp_reward" name="xp_reward" value="{{ old('xp_reward', 50) }}" min="0"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-tertiary focus:ring-1 focus:ring-tertiary transition-all">
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-4 border-t border-white/10">
                    <a href="{{ route('admin.materials.index') }}" class="px-6 py-2 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-white/5 transition-all">Batal</a>
                    <button type="submit" class="bg-tertiary text-white font-bold px-8 py-2 rounded-lg hover:bg-tertiary/80 transition-all shadow-[0_0_15px_rgba(157,78,255,0.4)]">
                        Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-span-1 xl:col-span-4">
        <div class="glass-panel rounded-2xl p-6 border-l-4 border-l-tertiary">
            <h3 class="font-bold text-on-surface mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary">tips_and_updates</span> Tips Materi
            </h3>
            <ul class="space-y-3 mt-4 text-on-surface-variant text-sm">
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-tertiary text-[16px] mt-0.5">check_circle</span> Pilih Kursus dulu, baru pilih Modul yang tersedia.</li>
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-tertiary text-[16px] mt-0.5">check_circle</span> Konten mendukung format Markdown (# Heading, **bold**, dll).</li>
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-tertiary text-[16px] mt-0.5">check_circle</span> URL Video harus dimulai dengan https://</li>
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-tertiary text-[16px] mt-0.5">check_circle</span> XP Reward default 50 XP per materi selesai.</li>
            </ul>
        </div>
    </div>

    @push('scripts')
    <script>
        const coursesData = @json($courses->map(fn($c) => ['id' => $c->id, 'modules' => $c->modules->map(fn($m) => ['id' => $m->id, 'title' => $m->title])])->keyBy('id'));

        document.getElementById('course_select').addEventListener('change', function() {
            const courseId = this.value;
            const moduleSelect = document.getElementById('module_id');
            moduleSelect.innerHTML = '<option value="">Pilih Modul...</option>';
            if (courseId && coursesData[courseId]) {
                coursesData[courseId].modules.forEach(m => {
                    moduleSelect.innerHTML += `<option value="${m.id}">${m.title}</option>`;
                });
            }
        });
    </script>
    @endpush
</x-admin-layout>
