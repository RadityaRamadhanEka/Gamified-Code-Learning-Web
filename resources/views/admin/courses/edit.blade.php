<x-admin-layout>
    <x-slot name="header">Edit Kursus</x-slot>

    <div class="col-span-1 xl:col-span-8">
        <div class="glass-panel rounded-2xl p-6 md:p-8">
            <h2 class="font-headline-sm font-bold text-on-surface mb-6 border-b border-white/10 pb-4">Edit: {{ $course->title }}</h2>

            @if ($errors->any())
            <div class="mb-6 glass-panel border border-error/30 text-error px-5 py-4 rounded-xl">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-6">
                @csrf @method('PUT')

                <div>
                    <label for="title" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Judul Kursus <span class="text-error">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}" required
                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                </div>

                <div>
                    <label for="description" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">{{ old('description', $course->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="icon" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Icon</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $course->icon) }}"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div>
                        <label for="color_theme" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Tema Warna</label>
                        <select id="color_theme" name="color_theme"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none">
                            <option value="primary" {{ old('color_theme', $course->color_theme) == 'primary' ? 'selected' : '' }}>Primary (Cyan)</option>
                            <option value="secondary" {{ old('color_theme', $course->color_theme) == 'secondary' ? 'selected' : '' }}>Secondary (Pink)</option>
                            <option value="tertiary" {{ old('color_theme', $course->color_theme) == 'tertiary' ? 'selected' : '' }}>Tertiary (Purple)</option>
                        </select>
                    </div>
                    <div>
                        <label for="min_level_required" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Level Minimum</label>
                        <input type="number" id="min_level_required" name="min_level_required" value="{{ old('min_level_required', $course->min_level_required) }}" min="0"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div>
                        <label for="order" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Urutan Tampil</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $course->order) }}" min="0"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $course->is_published) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-white/20 bg-surface-container text-primary focus:ring-primary">
                    <label for="is_published" class="text-on-surface">Published (tampil ke pengguna)</label>
                </div>

                <div class="pt-4 flex items-center justify-end gap-4 border-t border-white/10">
                    <a href="{{ route('admin.courses.index') }}" class="px-6 py-2 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-white/5 transition-all">Batal</a>
                    <button type="submit" class="bg-primary text-on-primary font-bold px-8 py-2 rounded-lg hover:bg-primary/80 transition-all shadow-[0_0_15px_rgba(0,240,255,0.4)]">
                        Update Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
