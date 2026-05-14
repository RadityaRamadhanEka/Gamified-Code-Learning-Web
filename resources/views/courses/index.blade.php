<x-app-layout>
    <x-slot name="header">
        Kursus
    </x-slot>

    <div class="xl:col-span-12 space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
            <div>
                <h1 class="font-display-lg text-display-lg md:text-display-lg text-primary mb-2 tracking-tighter">Pathfinder</h1>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">Pilih jalur teknologimu dan kuasai keahlian baru di alam semesta NgodingAJG.</p>
            </div>
        </div>

        <!-- Bento Grid Layout for Courses -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                @if($course->is_locked)
                <!-- Course Card: Locked -->
                <div class="relative glass-panel bg-surface-container-lowest/50 rounded-xl p-6 flex flex-col h-full grayscale-[0.8] opacity-70 pointer-events-none">
                    <div class="absolute inset-0 bg-surface/40 backdrop-blur-[2px] rounded-xl z-10 flex items-center justify-center">
                        <div class="flex flex-col items-center gap-3">
                            <span class="material-symbols-outlined text-[48px] text-on-surface-variant" style="font-variation-settings: 'FILL' 1;">lock</span>
                            <span class="font-label-caps text-label-caps text-on-surface bg-surface-container px-4 py-2 rounded-full border border-white/10">Reach Level {{ $course->min_level_required }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 rounded-lg bg-surface flex items-center justify-center border border-white/5 shadow-inner">
                            <span class="material-symbols-outlined text-[40px] text-tertiary-container" style="font-variation-settings: 'FILL' 1;">{{ $course->icon }}</span>
                        </div>
                    </div>
                    <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-2">{{ $course->title }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-8 flex-1">{{ $course->description }}</p>
                    <div class="mt-auto">
                        <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden mb-4 border border-white/5"></div>
                        <div class="flex items-center gap-2 text-on-surface-variant font-code-sm text-code-sm">
                            <span class="material-symbols-outlined text-[16px]">menu_book</span>
                            <span>{{ $course->total_lessons }} Lessons</span>
                        </div>
                    </div>
                </div>
                @elseif($course->progress > 0)
                <!-- Course Card: In Progress -->
                <a href="{{ route('courses.show', $course->slug) }}" class="block relative group glass-panel bg-surface-container/40 rounded-xl p-6 shadow-[0_0_20px_rgba(0,219,233,0.1)] hover:shadow-[0_0_30px_rgba(0,219,233,0.2)] transition-all duration-300 flex flex-col h-full overflow-hidden border border-primary/30">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary-container to-secondary-container"></div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 rounded-lg bg-surface flex items-center justify-center border border-white/10 shadow-inner">
                            <span class="material-symbols-outlined text-[40px] text-primary" style="font-variation-settings: 'FILL' 1;">{{ $course->icon }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary font-label-caps text-label-caps text-[10px]">In Progress</span>
                    </div>
                    <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-2 group-hover:text-primary transition-colors">{{ $course->title }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-8 flex-1">{{ $course->description }}</p>
                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-2 font-label-caps text-label-caps">
                            <span class="text-on-surface-variant">Progress</span>
                            <span class="text-primary font-bold">{{ $course->progress }}%</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden mb-4 border border-white/5">
                            <div class="h-full bg-gradient-to-r from-primary to-primary-container shadow-[0_0_10px_rgba(0,240,255,0.8)] rounded-full relative" style="width: {{ $course->progress }}%">
                                <div class="absolute right-0 top-0 h-full w-4 bg-white/50 blur-sm"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant font-code-sm text-code-sm">
                            <span class="material-symbols-outlined text-[16px]">menu_book</span>
                            <span>{{ $course->completed_lessons }} / {{ $course->total_lessons }} Lessons</span>
                        </div>
                    </div>
                </a>
                @else
                <!-- Course Card: Available -->
                <a href="{{ route('courses.show', $course->slug) }}" class="block relative group glass-panel bg-surface-container/30 rounded-xl p-6 hover:border-white/30 transition-all duration-300 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 rounded-lg bg-surface flex items-center justify-center border border-white/5 shadow-inner">
                            <span class="material-symbols-outlined text-[40px] text-secondary" style="font-variation-settings: 'FILL' 1;">{{ $course->icon }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-surface-variant border border-white/10 text-on-surface font-label-caps text-label-caps text-[10px]">Available</span>
                    </div>
                    <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-2 group-hover:text-secondary transition-colors">{{ $course->title }}</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-8 flex-1">{{ $course->description }}</p>
                    <div class="mt-auto">
                        <div class="flex justify-between items-end mb-2 font-label-caps text-label-caps opacity-50">
                            <span class="text-on-surface-variant">Progress</span>
                            <span class="text-on-surface">0%</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden mb-4 border border-white/5">
                            <div class="h-full bg-white/10 w-[0%]"></div>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant font-code-sm text-code-sm">
                            <span class="material-symbols-outlined text-[16px]">menu_book</span>
                            <span>0 / {{ $course->total_lessons }} Lessons</span>
                        </div>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
