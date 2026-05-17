<x-app-layout>
    <x-slot name="header">
        <div class="hidden lg:flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps">
            <a href="{{ route('courses.index') }}" class="hover:text-primary transition-colors cursor-pointer">KURSUS</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a href="{{ route('courses.show', $course->slug) }}" class="hover:text-primary transition-colors cursor-pointer">{{ strtoupper($course->title) }}</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-tertiary-container font-bold uppercase">{{ $quiz->title }}</span>
        </div>
    </x-slot>

    <div class="xl:col-span-12 flex flex-col gap-8 max-w-3xl mx-auto w-full pt-8">
        
        {{-- Flash from previous attempt --}}
        @if($previousAttempt)
        <div class="bg-primary/10 border border-primary/30 text-primary rounded-xl p-4 flex items-center gap-3">
            <span class="material-symbols-outlined">info</span>
            <span class="font-body-md text-body-md">Attempt sebelumnya: Score {{ $previousAttempt->score }}/{{ $previousAttempt->total_questions }} ({{ $previousAttempt->scorePercentage() }}%). Kamu bisa coba lagi tapi XP hanya diberikan di percobaan pertama.</span>
        </div>
        @endif

        <form method="POST" action="{{ route('quizzes.submit', [$course->slug, $quiz->slug]) }}" id="quiz-form">
            @csrf

            @foreach($questions as $index => $question)
            <div class="quiz-question {{ $index > 0 ? 'hidden' : '' }}" data-question="{{ $index }}">
                <!-- Progress Header -->
                <div class="flex flex-col gap-3 mb-4">
                    <div class="flex justify-between items-end">
                        <span class="font-label-caps text-label-caps text-on-surface-variant">QUESTION {{ $index + 1 }} OF {{ count($questions) }}</span>
                        @if($quiz->time_limit_seconds)
                        <div class="flex items-center gap-2 text-primary font-code-sm text-code-sm">
                            <span class="material-symbols-outlined text-[18px]">timer</span>
                            <span id="timer">{{ gmdate('i:s', $quiz->time_limit_seconds) }}</span>
                        </div>
                        @endif
                    </div>
                    <!-- Progress Bar -->
                    <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden border border-white/5">
                        <div class="h-full bg-gradient-to-r from-tertiary-fixed-dim to-tertiary-container shadow-[0_0_10px_rgba(255,215,0,0.6)] relative rounded-full transition-all duration-500" style="width: {{ (($index + 1) / count($questions)) * 100 }}%">
                            <div class="absolute right-0 top-0 h-full w-4 bg-white/50 blur-sm"></div>
                        </div>
                    </div>
                </div>

                <!-- Question Container -->
                <div class="glass-panel p-8 md:p-10 rounded-2xl flex flex-col gap-8 relative overflow-hidden">
                    <div class="absolute -top-32 -right-32 w-64 h-64 bg-tertiary-container/10 rounded-full blur-[80px] pointer-events-none"></div>

                    <div class="flex items-start gap-4 relative z-10">
                        <div class="w-10 h-10 shrink-0 rounded-full bg-surface-container-highest border border-white/10 flex items-center justify-center font-display-lg text-lg text-tertiary-container font-bold">{{ $index + 1 }}</div>
                        <h2 class="font-headline-lg text-2xl md:text-3xl text-on-surface leading-tight">
                            {{ $question['question'] }}
                        </h2>
                    </div>

                    <!-- Options Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10">
                        @foreach($question['options'] as $option)
                        <label class="relative group cursor-pointer">
                            <input type="radio" name="answers[{{ $question['id'] }}]" value="{{ $option }}" class="peer sr-only" required>
                            <div class="p-6 rounded-xl border border-outline-variant bg-surface-container-low hover:bg-surface-container hover:border-primary/50 peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:shadow-[0_0_20px_rgba(0,219,233,0.15)] peer-checked:[&_.radio-ring]:border-primary peer-checked:[&_.radio-dot]:scale-100 transition-all flex items-center gap-4">
                                <div class="radio-ring w-6 h-6 rounded-full border-2 border-outline-variant group-hover:border-primary/50 flex items-center justify-center transition-colors">
                                    <div class="radio-dot w-2.5 h-2.5 rounded-full bg-primary scale-0 transition-transform"></div>
                                </div>
                                <span class="font-body-md text-body-md text-on-surface">{{ $option }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Action Bar -->
            <div class="flex justify-between items-center mt-4">
                <a href="{{ route('courses.show', $course->slug) }}" class="text-on-surface-variant hover:text-error transition-colors font-label-caps text-label-caps flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                    Keluar Kuis
                </a>
                
                <div class="flex gap-3">
                    <button type="button" id="btn-prev" class="hidden px-6 py-4 bg-surface-container border border-outline-variant text-on-surface font-label-caps text-label-caps rounded-lg transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Previous
                    </button>
                    <button type="button" id="btn-next" class="px-8 py-4 bg-surface-container-high border border-outline-variant hover:border-primary hover:bg-primary/10 text-on-surface hover:text-primary font-label-caps text-label-caps font-bold rounded-lg transition-all flex items-center gap-2 group shadow-lg">
                        Next
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                    <button type="submit" id="btn-submit" class="hidden px-8 py-4 bg-gradient-to-r from-primary to-secondary text-on-primary font-label-caps text-label-caps font-bold rounded-lg shadow-[0_0_20px_rgba(0,219,233,0.3)] hover:shadow-[0_0_30px_rgba(0,219,233,0.5)] transition-all flex items-center gap-2 group">
                        Submit Quiz
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">check</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questions = document.querySelectorAll('.quiz-question');
            const btnNext = document.getElementById('btn-next');
            const btnPrev = document.getElementById('btn-prev');
            const btnSubmit = document.getElementById('btn-submit');
            let current = 0;
            const total = questions.length;

            function showQuestion(index) {
                questions.forEach((q, i) => {
                    q.classList.toggle('hidden', i !== index);
                    // Reset error state when showing
                    if (i === index) {
                        q.querySelector('.quiz-error-msg')?.remove();
                        q.querySelectorAll('label > div').forEach(el => {
                            el.classList.remove('border-error', 'shadow-[0_0_15px_rgba(255,80,80,0.3)]');
                        });
                    }
                });
                btnPrev.classList.toggle('hidden', index === 0);
                btnNext.classList.toggle('hidden', index === total - 1);
                btnSubmit.classList.toggle('hidden', index !== total - 1);
            }

            function isCurrentAnswered() {
                const q = questions[current];
                const radios = q.querySelectorAll('input[type="radio"]');
                return Array.from(radios).some(r => r.checked);
            }

            function showAnswerError() {
                const q = questions[current];
                // Remove existing error
                q.querySelector('.quiz-error-msg')?.remove();

                // Highlight options
                q.querySelectorAll('label > div').forEach(el => {
                    el.classList.add('border-error', 'shadow-[0_0_15px_rgba(255,80,80,0.3)]');
                });

                // Show error message
                const msg = document.createElement('p');
                msg.className = 'quiz-error-msg text-error font-label-caps text-label-caps flex items-center gap-2 mt-2 animate-pulse';
                msg.innerHTML = '<span class="material-symbols-outlined text-[16px]">warning</span> Pilih salah satu jawaban terlebih dahulu!';
                q.querySelector('.grid').after(msg);

                // Auto-clear highlight on any selection
                q.querySelectorAll('input[type="radio"]').forEach(r => {
                    r.addEventListener('change', function() {
                        q.querySelector('.quiz-error-msg')?.remove();
                        q.querySelectorAll('label > div').forEach(el => {
                            el.classList.remove('border-error', 'shadow-[0_0_15px_rgba(255,80,80,0.3)]');
                        });
                    }, { once: true });
                });
            }

            btnNext.addEventListener('click', function() {
                if (!isCurrentAnswered()) {
                    showAnswerError();
                    return;
                }
                if (current < total - 1) {
                    current++;
                    showQuestion(current);
                }
            });

            btnPrev.addEventListener('click', function() {
                if (current > 0) {
                    current--;
                    showQuestion(current);
                }
            });

            // Validate all answered before submit
            btnSubmit?.addEventListener('click', function(e) {
                if (!isCurrentAnswered()) {
                    e.preventDefault();
                    showAnswerError();
                }
            });

            showQuestion(0);
        });
    </script>
    @endpush
</x-app-layout>
