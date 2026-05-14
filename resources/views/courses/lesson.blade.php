<x-app-layout>
    <x-slot name="header">
        <div class="hidden lg:flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps">
            <a href="{{ route('courses.index') }}" class="hover:text-primary transition-colors cursor-pointer">KURSUS</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a href="{{ route('courses.show', $course->slug) }}" class="hover:text-primary transition-colors cursor-pointer">{{ strtoupper($course->title) }}</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-bold uppercase">{{ $lesson->title }}</span>
        </div>
    </x-slot>

    <div class="xl:col-span-12 flex flex-col gap-8 max-w-4xl mx-auto w-full">
        <!-- Video Player Placeholder -->
        @if($lesson->video_url)
        <div class="w-full aspect-video bg-surface-container-highest rounded-xl overflow-hidden relative border border-white/10 shadow-2xl flex items-center justify-center group">
            <div class="absolute inset-0 bg-gradient-to-t from-background/80 to-transparent z-10 pointer-events-none"></div>
            <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" alt="Code Thumbnail" class="absolute inset-0 w-full h-full object-cover opacity-50 grayscale group-hover:grayscale-0 transition-all duration-500">
            <button class="relative z-20 w-20 h-20 rounded-full bg-primary/20 border border-primary text-primary flex items-center justify-center backdrop-blur-md hover:bg-primary hover:text-on-primary hover:scale-110 transition-all duration-300 shadow-[0_0_30px_rgba(0,219,233,0.3)]">
                <span class="material-symbols-outlined text-[40px] fill" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
            </button>
        </div>
        @endif

        <!-- Lesson Content -->
        <div class="glass-panel p-8 md:p-12 rounded-xl flex flex-col gap-6 text-on-surface">
            <h1 class="font-headline-lg text-headline-lg text-primary font-bold">{{ $lesson->title }}</h1>
            
            <div class="prose prose-invert prose-p:font-body-md prose-p:text-body-md prose-p:text-on-surface-variant max-w-none prose-headings:font-headline-lg prose-headings:text-on-surface prose-pre:bg-surface-container-lowest prose-pre:border prose-pre:border-white/10 prose-pre:text-on-surface prose-code:font-code-sm">
                {!! $lesson->content !!}
            </div>
        </div>

        <!-- Action Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center bg-surface-container-low p-6 rounded-xl border border-white/5 gap-4 shadow-xl relative z-10 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent pointer-events-none"></div>
            <a href="{{ route('courses.show', $course->slug) }}" class="text-on-surface-variant hover:text-primary font-label-caps text-label-caps transition-colors flex items-center gap-2 relative z-10">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Silabus
            </a>
            
            @if($isCompleted)
            <span class="w-full sm:w-auto px-8 py-4 bg-surface-container-high text-on-surface-variant font-label-caps text-label-caps font-bold rounded-lg flex items-center justify-center gap-2 relative z-10 opacity-60">
                <span class="material-symbols-outlined">check_circle</span>
                Sudah Diselesaikan
            </span>
            @else
            <form method="POST" action="{{ route('lessons.complete', [$course->slug, $lesson->slug]) }}" class="relative z-10 w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary to-secondary text-on-primary font-label-caps text-label-caps font-bold rounded-lg shadow-[0_0_20px_rgba(0,219,233,0.3)] hover:shadow-[0_0_30px_rgba(0,219,233,0.5)] transition-all flex items-center justify-center gap-2 group hover:-translate-y-0.5">
                    <span class="material-symbols-outlined">check_circle</span>
                    Mark Complete (+{{ $lesson->xp_reward }} XP) & Next
                </button>
            </form>
            @endif
        </div>
    </div>
</x-app-layout>
