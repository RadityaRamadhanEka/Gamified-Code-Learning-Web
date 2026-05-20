<x-admin-layout>
    <x-slot name="header">Tambah Kursus Baru</x-slot>

    <div class="col-span-1 xl:col-span-8">
        <div class="glass-panel rounded-2xl p-6 md:p-8">
            <h2 class="font-headline-sm font-bold text-on-surface mb-6 border-b border-white/10 pb-4">Informasi Kursus</h2>

            @if ($errors->any())
            <div class="mb-6 glass-panel border border-error/30 text-error px-5 py-4 rounded-xl">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Judul Kursus <span class="text-error">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                        placeholder="Contoh: Belajar Next.js dari Nol">
                </div>

                <div>
                    <label for="description" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Deskripsi Kursus</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                        placeholder="Jelaskan apa yang akan dipelajari...">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="icon" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Icon (Material Symbol)</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', 'terminal') }}"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                            placeholder="terminal">
                        <p class="text-xs text-on-surface-variant mt-1">Cek ikon di <a href="https://fonts.google.com/icons" target="_blank" class="text-primary underline">fonts.google.com/icons</a></p>
                    </div>
                    <div>
                        <label for="color_theme" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Tema Warna</label>
                        <select id="color_theme" name="color_theme"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all appearance-none">
                            <option value="primary" {{ old('color_theme') == 'primary' ? 'selected' : '' }}>Primary (Cyan)</option>
                            <option value="secondary" {{ old('color_theme') == 'secondary' ? 'selected' : '' }}>Secondary (Pink)</option>
                            <option value="tertiary" {{ old('color_theme') == 'tertiary' ? 'selected' : '' }}>Tertiary (Purple)</option>
                        </select>
                    </div>
                    <div>
                        <label for="min_level_required" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Level Minimum</label>
                        <input type="number" id="min_level_required" name="min_level_required" value="{{ old('min_level_required', 0) }}" min="0"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div>
                        <label for="order" class="block font-label-lg text-label-lg text-on-surface-variant mb-2">Urutan Tampil</label>
                        <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0"
                            class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-white/20 bg-surface-container text-primary focus:ring-primary">
                    <label for="is_published" class="text-on-surface">Langsung publish (tampilkan ke pengguna)</label>
                </div>

                <div class="pt-4 flex items-center justify-end gap-4 border-t border-white/10">
                    <a href="{{ route('admin.courses.index') }}" class="px-6 py-2 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-white/5 transition-all">Batal</a>
                    <button type="submit" class="bg-primary text-on-primary font-bold px-8 py-2 rounded-lg hover:bg-primary/80 transition-all shadow-[0_0_15px_rgba(0,240,255,0.4)]">
                        Simpan Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-span-1 xl:col-span-4">
        <div class="glass-panel rounded-2xl p-6 border-l-4 border-l-secondary">
            <h3 class="font-bold text-on-surface mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">tips_and_updates</span> Tips
            </h3>
            <ul class="space-y-3 mt-4 text-on-surface-variant text-sm">
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-primary text-[16px] mt-0.5">check_circle</span> Judul kursus akan otomatis diubah menjadi slug URL.</li>
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-primary text-[16px] mt-0.5">check_circle</span> Setelah kursus dibuat, tambahkan Modul dan Materi di dalamnya.</li>
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-primary text-[16px] mt-0.5">check_circle</span> Set "Level Minimum = 0" agar semua pengguna bisa mengakses.</li>
            </ul>
        </div>
    </div>
</x-admin-layout>
