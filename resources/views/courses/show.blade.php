<x-app-layout>
    <x-slot name="header">
        <div class="hidden lg:flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps">
            <a href="{{ route('courses.index') }}" class="hover:text-primary transition-colors cursor-pointer">KURSUS</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-bold">{{ strtoupper($course->title) }}</span>
        </div>
    </x-slot>

    <div class="xl:col-span-12 flex flex-col gap-8">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="bg-primary/10 border border-primary/30 text-primary rounded-xl p-4 flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="font-body-md text-body-md">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="bg-error/10 border border-error/30 text-error rounded-xl p-4 flex items-center gap-3">
            <span class="material-symbols-outlined">error</span>
            <span class="font-body-md text-body-md">{{ session('error') }}</span>
        </div>
        @endif

        <!-- Course Hero Header -->
        <section class="relative rounded-xl overflow-hidden border border-outline-variant glass-gradient p-8 md:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/20 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 mb-4">
                        <span class="w-2 h-2 rounded-full bg-primary shadow-[0_0_8px_rgba(0,219,233,0.8)]"></span>
                        <span class="font-code-sm text-code-sm text-primary">Bootcamp Intensive</span>
                    </div>
                    <h1 class="font-headline-lg-mobile text-headline-lg-mobile md:font-headline-lg md:text-headline-lg text-on-surface mb-2">{{ $course->title }}</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl">{{ $course->description }}</p>
                </div>
                <!-- Overall Progress -->
                <div class="w-full md:w-64 bg-surface-container-low border border-white/5 rounded-lg p-4 backdrop-blur-md">
                    <div class="flex justify-between items-end mb-2">
                        <span class="font-label-caps text-label-caps text-on-surface-variant">PROGRESS</span>
                        <span class="font-code-sm text-code-sm text-primary font-bold">{{ $courseProgress }}%</span>
                    </div>
                    <div class="h-2 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-primary to-secondary rounded-full shadow-[0_0_10px_rgba(0,219,233,0.6)] relative" style="width: {{ $courseProgress }}%;">
                            <div class="absolute top-0 right-0 bottom-0 w-4 bg-white/30 blur-[2px]"></div>
                        </div>
                    </div>
                    @php
                        $completedModules = $modules->filter(fn($m) => $m->is_completed)->count();
                    @endphp
                    <div class="mt-3 font-label-caps text-label-caps text-outline text-right">Module {{ $completedModules + 1 > $modules->count() ? $modules->count() : $completedModules + 1 }} of {{ $modules->count() }}</div>
                </div>
            </div>
        </section>

        <!-- Grid Layout: Timeline + Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
            <!-- Left Col: Vertical Timeline (8 cols) -->
            <div class="lg:col-span-8 flex flex-col gap-6 relative">
                <!-- Timeline Guide Line -->
                <div class="absolute left-[23px] top-6 bottom-6 w-[2px] bg-surface-container-high z-0"></div>
                
                @foreach($modules as $module)
                    @php
                        $isCompleted = $module->is_completed;
                        $isActive = !$isCompleted && ($loop->first || $modules[$loop->index - 1]->is_completed);
                        $isLocked = !$isCompleted && !$isActive;
                    @endphp

                    @if($isCompleted)
                    <!-- MODULE {{ $loop->iteration }}: Completed -->
                    <div class="relative z-10 flex gap-6 group">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-12 h-12 rounded-full bg-primary/20 border-2 border-primary flex items-center justify-center text-primary shadow-[0_0_15px_rgba(0,219,233,0.2)]">
                                <span class="material-symbols-outlined fill" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-surface-container-low border border-outline-variant/50 rounded-xl p-6 transition-all opacity-80 hover:opacity-100">
                            <div class="flex justify-between items-center mb-4 border-b border-white/5 pb-4">
                                <div>
                                    <div class="font-label-caps text-label-caps text-primary mb-1">MODULE {{ $loop->iteration }}</div>
                                    <h3 class="font-body-md text-body-md font-bold text-on-surface">{{ $module->title }}</h3>
                                </div>
                                <span class="font-label-caps text-label-caps text-outline px-2 py-1 bg-surface-container rounded">100%</span>
                            </div>
                            <ul class="flex flex-col gap-3">
                                @foreach($module->lessons as $lesson)
                                <li class="flex items-center gap-3 text-on-surface-variant font-body-md text-body-md cursor-pointer hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px] text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    <span>{{ $lesson->title }}</span>
                                </li>
                                @endforeach
                            </ul>
                            @if($module->quiz)
                            <a href="{{ route('courses.quiz', [$course->slug, $module->quiz->slug]) }}" class="block mt-6 pt-4 border-t border-white/5 hover:opacity-80 transition-opacity">
                                <div class="flex items-center gap-3 text-tertiary-fixed-dim">
                                    <div class="w-8 h-8 rounded bg-tertiary-fixed-dim/10 flex items-center justify-center border border-tertiary-fixed-dim/30">
                                        <span class="material-symbols-outlined text-[18px]">emoji_events</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-body-md text-body-md font-bold">{{ $module->quiz->title }}</div>
                                    </div>
                                    @if($module->quiz->best_score !== null)
                                    <span class="font-label-caps text-label-caps bg-surface-container px-2 py-1 rounded">Score: {{ $module->quiz->best_score }}</span>
                                    @endif
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>

                    @elseif($isActive)
                    <!-- MODULE {{ $loop->iteration }}: Active -->
                    <div class="relative z-10 flex gap-6">
                        <div class="flex-shrink-0 mt-1 relative">
                            <div class="w-12 h-12 rounded-full bg-surface border-2 border-primary flex items-center justify-center text-primary shadow-[0_0_20px_rgba(0,219,233,0.5)] z-10 relative">
                                <span class="material-symbols-outlined fill animate-pulse" style="font-variation-settings: 'FILL' 1;">play_circle</span>
                            </div>
                            <div class="absolute inset-0 rounded-full border border-primary/50 animate-[ping_2s_cubic-bezier(0,0,0.2,1)_infinite]"></div>
                        </div>
                        <div class="flex-1 bg-surface-container border border-primary/40 rounded-xl p-6 shadow-[0_0_30px_rgba(0,219,233,0.05)] relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 blur-[40px] pointer-events-none"></div>
                            <div class="flex justify-between items-center mb-4 border-b border-white/10 pb-4 relative z-10">
                                <div>
                                    <div class="font-label-caps text-label-caps text-primary mb-1">MODULE {{ $loop->iteration }}</div>
                                    <h3 class="font-body-md text-body-md font-bold text-on-surface text-lg">{{ $module->title }}</h3>
                                </div>
                                <span class="font-label-caps text-label-caps text-primary px-3 py-1 bg-primary/10 border border-primary/20 rounded-full">IN PROGRESS</span>
                            </div>
                            <ul class="flex flex-col gap-4 relative z-10">
                                @foreach($module->lessons as $lesson)
                                    @if($lesson->is_completed)
                                    <li class="flex items-center gap-3 text-on-surface-variant font-body-md text-body-md opacity-70">
                                        <span class="material-symbols-outlined text-[20px] text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                        <span>{{ $lesson->title }}</span>
                                    </li>
                                    @elseif($lesson->is_accessible)
                                    <li class="flex items-center gap-3 text-primary font-body-md text-body-md bg-surface p-3 rounded-lg border border-primary/20 shadow-inner">
                                        <span class="material-symbols-outlined text-[20px] fill" style="font-variation-settings: 'FILL' 1;">play_circle</span>
                                        <span class="font-bold flex-1">{{ $lesson->title }}</span>
                                        <a href="{{ route('courses.lesson', [$course->slug, $lesson->slug]) }}" class="bg-primary/10 hover:bg-primary/20 text-primary font-label-caps text-label-caps px-3 py-1 rounded transition-colors inline-block text-center">RESUME</a>
                                    </li>
                                    @else
                                    <li class="flex items-center gap-3 text-outline font-body-md text-body-md">
                                        <span class="material-symbols-outlined text-[20px]">lock</span>
                                        <span>{{ $lesson->title }}</span>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                            @if($module->quiz)
                            <div class="mt-6 pt-4 border-t border-white/5 flex items-center gap-3 text-outline relative z-10">
                                <div class="w-8 h-8 rounded bg-surface border border-outline-variant flex items-center justify-center opacity-50">
                                    <span class="material-symbols-outlined text-[18px]">lock</span>
                                </div>
                                <div class="flex-1">
                                    <div class="font-body-md text-body-md">{{ $module->quiz->title }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    @else
                    <!-- MODULE {{ $loop->iteration }}: Locked -->
                    <div class="relative z-10 flex gap-6 opacity-60 grayscale-[50%] hover:grayscale-0 transition-all">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-12 h-12 rounded-full bg-surface-container-high border-2 border-outline-variant flex items-center justify-center text-outline">
                                <span class="material-symbols-outlined">lock</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-surface-container-lowest border border-white/5 rounded-xl p-6">
                            <div class="flex justify-between items-center mb-4 border-b border-white/5 pb-4">
                                <div>
                                    <div class="font-label-caps text-label-caps text-outline mb-1">MODULE {{ $loop->iteration }}</div>
                                    <h3 class="font-body-md text-body-md font-bold text-on-surface">{{ $module->title }}</h3>
                                </div>
                            </div>
                            <ul class="flex flex-col gap-3">
                                @foreach($module->lessons as $lesson)
                                <li class="flex items-center gap-3 text-outline font-body-md text-body-md">
                                    <span class="material-symbols-outlined text-[20px]">lock</span>
                                    <span>{{ $lesson->title }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <!-- Right Col: Sidebar Resources (4 cols) -->
            <aside class="lg:col-span-4 flex flex-col gap-6 lg:sticky lg:top-[100px]">
                <!-- Instructor Card -->
                <div class="bg-surface-container border border-outline-variant/30 rounded-xl p-6 backdrop-blur-xl">
                    <h4 class="font-label-caps text-label-caps text-on-surface-variant mb-4">INSTRUCTOR</h4>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-full border-2 border-secondary overflow-hidden shadow-[0_0_10px_rgba(209,188,255,0.3)] flex items-center justify-center bg-surface-container text-secondary font-bold text-xl">
                            AJ
                        </div>
                        <div>
                            <div class="font-body-md text-body-md font-bold text-on-surface">NgodingAJG Team</div>
                            <div class="font-code-sm text-code-sm text-primary/70">Teaching Staff</div>
                        </div>
                    </div>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm">Tim instruktur NgodingAJG siap membimbingmu menguasai {{ $course->title }}.</p>
                </div>

                <!-- Course Stats -->
                <div class="bg-surface-container-low border border-white/5 rounded-xl p-6 backdrop-blur-xl">
                    <h4 class="font-label-caps text-label-caps text-on-surface-variant mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">analytics</span>
                        COURSE STATS
                    </h4>
                    <div class="flex flex-col gap-3">
                        <div class="flex justify-between items-center p-3 rounded-lg bg-surface-bright/10 border border-white/5">
                            <span class="font-body-md text-body-md text-on-surface-variant">Modules</span>
                            <span class="font-code-sm text-code-sm text-primary font-bold">{{ $modules->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-lg bg-surface-bright/10 border border-white/5">
                            <span class="font-body-md text-body-md text-on-surface-variant">Total Lessons</span>
                            <span class="font-code-sm text-code-sm text-primary font-bold">{{ $course->totalLessonsCount() }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-lg bg-surface-bright/10 border border-white/5">
                            <span class="font-body-md text-body-md text-on-surface-variant">Your Progress</span>
                            <span class="font-code-sm text-code-sm text-primary font-bold">{{ $courseProgress }}%</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
