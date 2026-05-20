<x-admin-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <div class="col-span-1 xl:col-span-12">
        @if (session('success'))
        <div class="mb-6 glass-panel border border-primary/30 text-primary px-6 py-3 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="mb-6 glass-panel border border-error/30 text-error px-6 py-3 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
        @endif

        <div class="glass-panel rounded-2xl p-6 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-error/20 rounded-full blur-[80px]"></div>
            <div class="relative z-10">
                <h3 class="font-headline-sm text-headline-sm font-bold text-error mb-2">Selamat Datang, Admin!</h3>
                <p class="text-on-surface-variant max-w-2xl">
                    Pusat kendali NgodingAJG. Kelola kursus, materi, dan kuis dari sini.
                </p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="col-span-1 xl:col-span-3">
        <a href="{{ route('admin.courses.index') }}" class="block glass-panel rounded-2xl p-6 border-t-4 border-t-primary transition-all duration-300 hover:-translate-y-1 hover:glow-active">
            <div class="flex justify-between items-start mb-4">
                <h3 class="font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Total Kursus</h3>
                <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg">school</span>
            </div>
            <div class="text-display-sm font-bold text-on-surface">{{ $stats['total_courses'] }}</div>
        </a>
    </div>

    <div class="col-span-1 xl:col-span-3">
        <a href="{{ route('admin.quizzes.index') }}" class="block glass-panel rounded-2xl p-6 border-t-4 border-t-secondary transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(255,42,133,0.3)]">
            <div class="flex justify-between items-start mb-4">
                <h3 class="font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Total Kuis</h3>
                <span class="material-symbols-outlined text-secondary bg-secondary/10 p-2 rounded-lg">quiz</span>
            </div>
            <div class="text-display-sm font-bold text-on-surface">{{ $stats['total_quizzes'] }}</div>
        </a>
    </div>

    <div class="col-span-1 xl:col-span-3">
        <a href="{{ route('admin.materials.index') }}" class="block glass-panel rounded-2xl p-6 border-t-4 border-t-tertiary transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(157,78,255,0.3)]">
            <div class="flex justify-between items-start mb-4">
                <h3 class="font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Total Materi</h3>
                <span class="material-symbols-outlined text-tertiary bg-tertiary/10 p-2 rounded-lg">library_books</span>
            </div>
            <div class="text-display-sm font-bold text-on-surface">{{ $stats['total_lessons'] }}</div>
        </a>
    </div>

    <div class="col-span-1 xl:col-span-3">
        <div class="glass-panel rounded-2xl p-6 border-t-4 border-t-error transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_15px_rgba(255,84,73,0.3)]">
            <div class="flex justify-between items-start mb-4">
                <h3 class="font-label-lg text-label-lg text-on-surface-variant uppercase tracking-wider">Total Pengguna</h3>
                <span class="material-symbols-outlined text-error bg-error/10 p-2 rounded-lg">group</span>
            </div>
            <div class="text-display-sm font-bold text-on-surface">{{ number_format($stats['total_users']) }}</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-span-1 xl:col-span-12">
        <h3 class="font-bold text-on-surface mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.courses.create') }}" class="glass-panel rounded-xl p-5 flex items-center gap-4 hover:border-primary border border-transparent transition-all group">
                <span class="material-symbols-outlined text-primary bg-primary/10 p-3 rounded-lg group-hover:bg-primary group-hover:text-on-primary transition-all">add_circle</span>
                <div>
                    <div class="font-bold text-on-surface">Tambah Kursus Baru</div>
                    <div class="text-sm text-on-surface-variant">Buat kursus pembelajaran baru</div>
                </div>
            </a>
            <a href="{{ route('admin.quizzes.create') }}" class="glass-panel rounded-xl p-5 flex items-center gap-4 hover:border-secondary border border-transparent transition-all group">
                <span class="material-symbols-outlined text-secondary bg-secondary/10 p-3 rounded-lg group-hover:bg-secondary group-hover:text-white transition-all">add_circle</span>
                <div>
                    <div class="font-bold text-on-surface">Tambah Kuis Baru</div>
                    <div class="text-sm text-on-surface-variant">Buat kuis dengan pertanyaan</div>
                </div>
            </a>
            <a href="{{ route('admin.materials.create') }}" class="glass-panel rounded-xl p-5 flex items-center gap-4 hover:border-tertiary border border-transparent transition-all group">
                <span class="material-symbols-outlined text-tertiary bg-tertiary/10 p-3 rounded-lg group-hover:bg-tertiary group-hover:text-white transition-all">add_circle</span>
                <div>
                    <div class="font-bold text-on-surface">Tambah Materi Baru</div>
                    <div class="text-sm text-on-surface-variant">Tambahkan lesson ke modul</div>
                </div>
            </a>
        </div>
    </div>
</x-admin-layout>
