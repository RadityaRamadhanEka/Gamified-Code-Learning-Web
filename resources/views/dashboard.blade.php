<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Left Column (Content) -->
    <div class="xl:col-span-8 space-y-8">
        
        <!-- Welcome Banner -->
        <section class="glass-panel rounded-2xl p-8 relative overflow-hidden flex flex-col md:flex-row items-center gap-8 border-l-4 border-l-primary">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent z-0 pointer-events-none"></div>
            <!-- XP Ring SVG -->
            <div class="relative w-32 h-32 flex-shrink-0 z-10">
                @php
                    $circumference = 2 * M_PI * 45; // ~282.7
                    $offset = $circumference - ($circumference * $xpProgress / 100);
                @endphp
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" fill="transparent" r="45" stroke="#1c1b1c" stroke-width="8"></circle>
                    <circle class="drop-shadow-[0_0_8px_rgba(0,240,255,0.5)]" cx="50" cy="50" fill="transparent" r="45" stroke="url(#neon-gradient)" stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}" stroke-width="8"></circle>
                    <defs>
                        <linearGradient id="neon-gradient" x1="0%" x2="100%" y1="0%" y2="0%">
                            <stop offset="0%" stop-color="#00f0ff"></stop>
                            <stop offset="100%" stop-color="#7000ff"></stop>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">Level</span>
                    <span class="font-headline-lg text-headline-lg font-black text-primary drop-shadow-[0_0_10px_rgba(0,240,255,0.3)]">{{ $user->level }}</span>
                </div>
            </div>
            
            <div class="z-10 flex-1">
                <h2 class="font-display-lg text-display-lg md:text-headline-lg font-bold mb-2">Welcome back, {{ explode(' ', $user->name)[0] }}.</h2>
                <p class="text-on-surface-variant font-code-sm text-code-sm mb-4">You are {{ $xpProgress }}% of the way to Level {{ $user->level + 1 }}. Keep pushing the boundaries of the void.</p>
                @if($activeCourse)
                <a href="{{ route('courses.show', $activeCourse->slug) }}" class="bg-primary/10 border border-primary text-primary hover:bg-primary hover:text-on-primary font-label-caps text-label-caps px-6 py-2 rounded-full transition-all duration-300 inline-block">
                    Continue Masterclass
                </a>
                @endif
            </div>
        </section>

        <!-- Stat Cards Row (Bento Grid) -->
        <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="glass-panel rounded-xl p-4 flex flex-col">
                <span class="material-symbols-outlined text-primary mb-2">bolt</span>
                <span class="font-code-sm text-code-sm text-on-surface-variant">Total XP</span>
                <span class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-on-surface">{{ number_format($user->xp) }}</span>
            </div>
            <div class="glass-panel rounded-xl p-4 flex flex-col">
                <span class="material-symbols-outlined text-secondary mb-2">school</span>
                <span class="font-code-sm text-code-sm text-on-surface-variant">Lessons Completed</span>
                <span class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-on-surface">{{ $user->completedLessonsCount() }}</span>
            </div>
            <div class="glass-panel rounded-xl p-4 flex flex-col">
                <span class="material-symbols-outlined text-tertiary-container mb-2">local_fire_department</span>
                <span class="font-code-sm text-code-sm text-on-surface-variant">Current Streak</span>
                <span class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-on-surface">{{ $user->current_streak }} Days</span>
            </div>
            <div class="glass-panel rounded-xl p-4 flex flex-col glow-active border-primary/50">
                <span class="material-symbols-outlined text-primary mb-2">military_tech</span>
                <span class="font-code-sm text-code-sm text-on-surface-variant">Global Rank</span>
                <span class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary">#{{ $userRank }}</span>
            </div>
        </section>

        <!-- Jalur Belajar (Learning Path) -->
        @if($activeCourse && $modules->count() > 0)
        <section class="glass-panel rounded-2xl p-8">
            <h3 class="font-headline-lg-mobile text-headline-lg-mobile font-bold mb-8">Jalur Belajar: {{ $activeCourse->title }}</h3>
            <div class="relative">
                <!-- Vertical Path Line -->
                <div class="absolute left-6 top-0 bottom-0 w-1 bg-surface-container-highest rounded-full"></div>
                @php
                    $completedModules = $modules->filter(fn($m) => $m->isCompletedBy($user))->count();
                    $progressHeight = $modules->count() > 0 ? ($completedModules / $modules->count()) * 100 : 0;
                @endphp
                <div class="absolute left-6 top-0 w-1 bg-gradient-to-b from-primary to-secondary-container rounded-full drop-shadow-[0_0_8px_rgba(0,240,255,0.4)]" style="height: {{ $progressHeight }}%"></div>
                
                <div class="space-y-8 relative z-10">
                    @foreach($modules as $module)
                        @php
                            $isCompleted = $module->isCompletedBy($user);
                            $isActive = !$isCompleted && ($loop->first || $modules[$loop->index - 1]->isCompletedBy($user));
                            $isLocked = !$isCompleted && !$isActive;
                        @endphp

                        @if($isCompleted)
                        <!-- Completed Node -->
                        <div class="flex gap-6 items-start opacity-70">
                            <div class="w-12 h-12 rounded-full bg-surface-container border border-primary/30 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined text-primary text-sm">check</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-on-surface mb-1">Module {{ $loop->iteration }}: {{ $module->title }}</h4>
                                <p class="font-code-sm text-code-sm text-on-surface-variant">Completed</p>
                            </div>
                        </div>
                        @elseif($isActive)
                        <!-- Active Node -->
                        <div class="flex gap-6 items-start">
                            <div class="w-12 h-12 rounded-full bg-surface-container border-2 border-primary flex items-center justify-center flex-shrink-0 mt-1 glow-active">
                                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                            </div>
                            <div class="flex-1 glass-panel bg-surface-container/50 p-4 rounded-xl border border-primary/20">
                                <h4 class="font-bold text-primary mb-2">Module {{ $loop->iteration }}: {{ $module->title }}</h4>
                                <div class="w-full bg-surface-container-highest rounded-full h-2 mb-2">
                                    <div class="bg-gradient-to-r from-primary to-primary-container h-2 rounded-full drop-shadow-[0_0_5px_rgba(0,240,255,0.5)]" style="width: {{ $module->progressFor($user) }}%"></div>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="font-code-sm text-code-sm text-on-surface-variant">{{ $module->progressFor($user) }}% Complete</span>
                                    @php $firstIncompleteLesson = $module->lessons->first(fn($l) => !$user->hasCompletedLesson($l)); @endphp
                                    @if($firstIncompleteLesson)
                                    <a href="{{ route('courses.lesson', [$activeCourse->slug, $firstIncompleteLesson->slug]) }}" class="font-label-caps text-label-caps text-primary hover:text-primary-fixed transition-colors">Resume</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Locked Node -->
                        <div class="flex gap-6 items-start opacity-50 grayscale">
                            <div class="w-12 h-12 rounded-full bg-surface-container border border-white/10 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined text-on-surface-variant">lock</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-on-surface mb-1">Module {{ $loop->iteration }}: {{ $module->title }}</h4>
                                <p class="font-code-sm text-code-sm text-on-surface-variant">Requires Module {{ $loop->iteration - 1 }} Completion</p>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </div>

    <!-- Right Column (Sticky Side) -->
    <aside class="xl:col-span-4 space-y-6">
        <div class="sticky top-24 space-y-6">
            
            <!-- Streak Tracker -->
            <div class="glass-panel rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-on-surface">Weekly Streak</h3>
                    <span class="material-symbols-outlined text-tertiary-container" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                </div>
                <div class="flex justify-between gap-2">
                    @php
                        $days = ['M','T','W','T','F','S','S'];
                        $today = now()->dayOfWeekIso; // 1=Mon, 7=Sun
                    @endphp
                    @foreach($days as $i => $day)
                        @php $dayNum = $i + 1; @endphp
                        <div class="flex flex-col items-center gap-2 {{ $dayNum > $today ? 'opacity-30' : '' }}">
                            <span class="font-label-caps text-label-caps text-on-surface-variant text-[10px] {{ $dayNum == $today ? 'text-primary' : '' }}">{{ $day }}</span>
                            @if($dayNum < $today && $dayNum >= $today - $user->current_streak + 1 && $user->current_streak > 0)
                                <div class="w-8 h-8 rounded-full bg-tertiary-container/20 border border-tertiary-container flex items-center justify-center"><span class="material-symbols-outlined text-tertiary-container text-xs" style="font-variation-settings: 'FILL' 1;">check</span></div>
                            @elseif($dayNum == $today)
                                <div class="w-8 h-8 rounded-full bg-primary/20 border-2 border-primary flex items-center justify-center glow-active"><div class="w-2 h-2 rounded-full bg-primary"></div></div>
                            @else
                                <div class="w-8 h-8 rounded-full bg-surface-container-highest border border-white/10"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Badge Showcase -->
            <div class="glass-panel rounded-xl p-6">
                <h3 class="font-bold text-on-surface mb-4">Top Badges</h3>
                <div class="flex justify-around gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full bg-surface-container border border-tertiary-container flex items-center justify-center drop-shadow-[0_0_10px_rgba(255,215,0,0.2)] mb-2">
                            <span class="material-symbols-outlined text-tertiary-container text-3xl" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                        </div>
                        <span class="font-label-caps text-label-caps text-center text-[10px]">Fast<br>Learner</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full bg-surface-container border border-tertiary-container flex items-center justify-center drop-shadow-[0_0_10px_rgba(255,215,0,0.2)] mb-2">
                            <span class="material-symbols-outlined text-tertiary-container text-3xl" style="font-variation-settings: 'FILL' 1;">bug_report</span>
                        </div>
                        <span class="font-label-caps text-label-caps text-center text-[10px]">Bug<br>Squasher</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full bg-surface-container border border-tertiary-container flex items-center justify-center drop-shadow-[0_0_10px_rgba(255,215,0,0.2)] mb-2">
                            <span class="material-symbols-outlined text-tertiary-container text-3xl" style="font-variation-settings: 'FILL' 1;">code_blocks</span>
                        </div>
                        <span class="font-label-caps text-label-caps text-center text-[10px]">Clean<br>Code</span>
                    </div>
                </div>
            </div>
            
            <!-- Mini Leaderboard -->
            <div class="glass-panel rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-on-surface">League Standings</h3>
                    <a class="font-label-caps text-label-caps text-primary hover:underline" href="{{ route('leaderboard.index') }}">View All</a>
                </div>
                <ul class="space-y-3">
                    @foreach($topUsers->take(3) as $rank => $topUser)
                    <li class="flex items-center justify-between p-2 rounded-lg {{ $topUser->id === $user->id ? 'bg-primary/10 border border-primary/30 relative' : 'hover:bg-white/5 transition-colors cursor-pointer' }}">
                        @if($topUser->id === $user->id)
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary rounded-l-lg"></div>
                        @endif
                        <div class="flex items-center gap-3 {{ $topUser->id === $user->id ? 'pl-2' : '' }}">
                            <span class="font-code-sm text-code-sm {{ $topUser->id === $user->id ? 'text-primary' : 'text-on-surface-variant' }} w-4">{{ $rank + 1 }}</span>
                            <div class="w-8 h-8 rounded-full {{ $topUser->id === $user->id ? 'border border-primary' : 'bg-surface-container border border-white/10' }} overflow-hidden flex items-center justify-center text-xs font-bold {{ $topUser->id === $user->id ? 'text-primary' : 'text-on-surface-variant' }}">
                                {{ strtoupper(substr($topUser->name, 0, 2)) }}
                            </div>
                            <span class="font-code-sm text-code-sm {{ $topUser->id === $user->id ? 'font-bold text-primary' : '' }}">{{ $topUser->name }}{{ $topUser->id === $user->id ? ' (You)' : '' }}</span>
                        </div>
                        <span class="font-code-sm text-code-sm {{ $topUser->id === $user->id ? 'text-primary font-bold' : 'text-on-surface-variant' }}">{{ number_format($topUser->xp) }} XP</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Daily Quote -->
            <div class="glass-panel rounded-xl p-6 border-l-2 border-secondary">
                <p class="font-code-sm text-code-sm text-on-surface italic opacity-80">"First, solve the problem. Then, write the code."</p>
                <p class="font-label-caps text-label-caps text-on-surface-variant mt-2 text-right">- John Johnson</p>
            </div>
        </div>
    </aside>
</x-app-layout>
