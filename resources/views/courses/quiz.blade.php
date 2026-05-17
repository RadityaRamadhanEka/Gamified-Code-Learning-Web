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

    <div class="xl:col-span-12 flex flex-col gap-8 max-w-3xl mx-auto w-full pt-8 pb-12">
        
        {{-- Flash from previous attempt --}}
        @if($previousAttempt)
        <div class="bg-primary/10 border border-primary/30 text-primary rounded-xl p-4 flex items-center gap-3">
            <span class="material-symbols-outlined">info</span>
            <span class="font-body-md text-body-md">Attempt sebelumnya: Score {{ $previousAttempt->score }}/{{ $previousAttempt->total_questions }} ({{ $previousAttempt->scorePercentage() }}%). Kamu bisa coba lagi tapi XP hanya diberikan di percobaan pertama.</span>
        </div>
        @endif

        <form method="POST" action="{{ route('quizzes.submit', [$course->slug, $quiz->slug]) }}" id="quiz-form">
            @csrf

            <!-- Progress Header (shared across all questions) -->
            <div class="flex flex-col gap-3 mb-4">
                <div class="flex justify-between items-end">
                    <span id="question-counter" class="font-label-caps text-label-caps text-on-surface-variant">QUESTION 1 OF {{ count($questions) }}</span>
                    @if($quiz->time_limit_seconds)
                    <div class="flex items-center gap-2 text-primary font-code-sm text-code-sm" id="timer-container">
                        <span class="material-symbols-outlined text-[18px]">timer</span>
                        <span id="timer">{{ gmdate('i:s', $quiz->time_limit_seconds) }}</span>
                    </div>
                    @endif
                </div>
                <!-- Progress Bar -->
                <div class="w-full h-2 bg-surface-container-highest rounded-full overflow-hidden border border-white/5">
                    <div id="progress-bar" class="h-full bg-gradient-to-r from-tertiary-fixed-dim to-tertiary-container shadow-[0_0_10px_rgba(255,215,0,0.6)] relative rounded-full transition-all duration-500" style="width: {{ (1 / count($questions)) * 100 }}%">
                        <div class="absolute right-0 top-0 h-full w-4 bg-white/50 blur-sm"></div>
                    </div>
                </div>
            </div>

            @foreach($questions as $index => $question)
            <div class="quiz-question {{ $index > 0 ? 'hidden' : '' }}" data-question="{{ $index }}" data-question-id="{{ $question['id'] }}">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10 quiz-options-grid">
                        @foreach($question['options'] as $option)
                        <label class="relative group cursor-pointer quiz-option-label">
                            <input type="radio" name="answers[{{ $question['id'] }}]" value="{{ $option }}" class="peer sr-only quiz-radio" required>
                            <div class="quiz-option-card p-6 rounded-xl border border-outline-variant bg-surface-container-low hover:bg-surface-container hover:border-primary/50 peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:shadow-[0_0_20px_rgba(0,219,233,0.15)] peer-checked:[&_.radio-ring]:border-primary peer-checked:[&_.radio-dot]:scale-100 transition-all flex items-center gap-4">
                                <div class="radio-ring w-6 h-6 rounded-full border-2 border-outline-variant group-hover:border-primary/50 flex items-center justify-center transition-colors">
                                    <div class="radio-dot w-2.5 h-2.5 rounded-full bg-primary scale-0 transition-transform"></div>
                                </div>
                                <span class="font-body-md text-body-md text-on-surface">{{ $option }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>

                    <!-- Feedback Area (hidden by default, shown after answering) -->
                    <div class="quiz-feedback hidden relative z-10 rounded-xl p-4 flex items-center gap-3 transition-all duration-300">
                        <span class="material-symbols-outlined quiz-feedback-icon text-[24px]"></span>
                        <span class="quiz-feedback-text font-body-md text-body-md font-semibold"></span>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Action Bar -->
            <div class="flex justify-between items-center mt-6">
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

    {{-- Toast Notification Container --}}
    <div id="toast-container" class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === DATA ===
            const answerKey = @json($answerKey);
            const questions = document.querySelectorAll('.quiz-question');
            const btnNext = document.getElementById('btn-next');
            const btnPrev = document.getElementById('btn-prev');
            const btnSubmit = document.getElementById('btn-submit');
            let current = 0;
            const total = questions.length;
            const answered = new Set(); // Track which questions have been answered & checked

            // === TOAST NOTIFICATION ===
            function showToast(message, isCorrect) {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = `pointer-events-auto flex items-center gap-3 px-6 py-4 rounded-xl shadow-2xl border backdrop-blur-xl transition-all duration-500 transform translate-x-[120%] ${
                    isCorrect 
                        ? 'bg-green-500/20 border-green-500/40 text-green-400' 
                        : 'bg-red-500/20 border-red-500/40 text-red-400'
                }`;
                toast.innerHTML = `
                    <span class="material-symbols-outlined text-[28px]">${isCorrect ? 'check_circle' : 'cancel'}</span>
                    <span class="font-bold text-base">${message}</span>
                `;
                container.appendChild(toast);

                // Animate in
                requestAnimationFrame(() => {
                    toast.classList.remove('translate-x-[120%]');
                    toast.classList.add('translate-x-0');
                });

                // Auto remove after 2.5s
                setTimeout(() => {
                    toast.classList.remove('translate-x-0');
                    toast.classList.add('translate-x-[120%]');
                    setTimeout(() => toast.remove(), 500);
                }, 2500);
            }

            // === SHOW QUESTION ===
            function showQuestion(index) {
                questions.forEach((q, i) => {
                    q.classList.toggle('hidden', i !== index);
                });
                btnPrev.classList.toggle('hidden', index === 0);
                btnNext.classList.toggle('hidden', index === total - 1);
                btnSubmit.classList.toggle('hidden', index !== total - 1);

                // Update shared progress header
                const counter = document.getElementById('question-counter');
                if (counter) {
                    counter.textContent = 'QUESTION ' + (index + 1) + ' OF ' + total;
                }
                const progressBar = document.getElementById('progress-bar');
                if (progressBar) {
                    progressBar.style.width = (((index + 1) / total) * 100) + '%';
                }
            }

            // === CHECK IF CURRENT QUESTION IS ANSWERED ===
            function getSelectedAnswer(questionEl) {
                const checked = questionEl.querySelector('input[type="radio"]:checked');
                return checked ? checked.value : null;
            }

            // === SHOW UNANSWERED ERROR ===
            function showAnswerError() {
                const q = questions[current];
                q.querySelector('.quiz-error-msg')?.remove();

                q.querySelectorAll('.quiz-option-card').forEach(el => {
                    el.classList.add('border-error', 'shadow-[0_0_15px_rgba(255,80,80,0.3)]');
                });

                const msg = document.createElement('p');
                msg.className = 'quiz-error-msg text-error font-label-caps text-label-caps flex items-center gap-2 mt-2 animate-pulse';
                msg.innerHTML = '<span class="material-symbols-outlined text-[16px]">warning</span> Pilih salah satu jawaban terlebih dahulu!';
                q.querySelector('.quiz-options-grid').after(msg);

                q.querySelectorAll('input[type="radio"]').forEach(r => {
                    r.addEventListener('change', function() {
                        q.querySelector('.quiz-error-msg')?.remove();
                        q.querySelectorAll('.quiz-option-card').forEach(el => {
                            el.classList.remove('border-error', 'shadow-[0_0_15px_rgba(255,80,80,0.3)]');
                        });
                    }, { once: true });
                });
            }

            // === CHECK ANSWER & SHOW FEEDBACK ===
            function checkAndShowFeedback(questionEl) {
                const questionId = questionEl.dataset.questionId;
                
                // Skip if already checked
                if (answered.has(questionId)) return true;

                const selectedAnswer = getSelectedAnswer(questionEl);
                if (!selectedAnswer) return false;

                const correctAnswer = answerKey[questionId];
                const isCorrect = selectedAnswer === correctAnswer;

                // Mark as answered
                answered.add(questionId);

                // Highlight correct/incorrect options
                const labels = questionEl.querySelectorAll('.quiz-option-label');
                labels.forEach(label => {
                    const radio = label.querySelector('input[type="radio"]');
                    const card = label.querySelector('.quiz-option-card');
                    const value = radio.value;

                    // Disable further changes
                    radio.disabled = true;
                    label.classList.remove('cursor-pointer');
                    label.classList.add('pointer-events-none');

                    if (value === correctAnswer) {
                        // Highlight correct answer in green
                        card.className = 'quiz-option-card p-6 rounded-xl border-2 border-green-500 bg-green-500/15 shadow-[0_0_20px_rgba(34,197,94,0.2)] transition-all flex items-center gap-4';
                        card.querySelector('.radio-ring').className = 'radio-ring w-6 h-6 rounded-full border-2 border-green-500 flex items-center justify-center';
                        card.querySelector('.radio-dot').className = 'radio-dot w-2.5 h-2.5 rounded-full bg-green-500 scale-100';
                    } else if (value === selectedAnswer && !isCorrect) {
                        // Highlight wrong selected answer in red
                        card.className = 'quiz-option-card p-6 rounded-xl border-2 border-red-500 bg-red-500/15 shadow-[0_0_20px_rgba(239,68,68,0.2)] transition-all flex items-center gap-4';
                        card.querySelector('.radio-ring').className = 'radio-ring w-6 h-6 rounded-full border-2 border-red-500 flex items-center justify-center';
                        card.querySelector('.radio-dot').className = 'radio-dot w-2.5 h-2.5 rounded-full bg-red-500 scale-100';
                    } else {
                        // Dim unselected options
                        card.classList.add('opacity-40');
                    }
                });

                // Show inline feedback
                const feedback = questionEl.querySelector('.quiz-feedback');
                const feedbackIcon = questionEl.querySelector('.quiz-feedback-icon');
                const feedbackText = questionEl.querySelector('.quiz-feedback-text');

                feedback.classList.remove('hidden');
                if (isCorrect) {
                    feedback.className = 'quiz-feedback relative z-10 rounded-xl p-4 flex items-center gap-3 bg-green-500/10 border border-green-500/30 text-green-400';
                    feedbackIcon.textContent = 'check_circle';
                    feedbackText.textContent = '🎉 Jawaban Benar! Mantap!';
                } else {
                    feedback.className = 'quiz-feedback relative z-10 rounded-xl p-4 flex items-center gap-3 bg-red-500/10 border border-red-500/30 text-red-400';
                    feedbackIcon.textContent = 'cancel';
                    feedbackText.textContent = '❌ Salah! Jawaban yang benar: ' + correctAnswer;
                }

                // Show toast notification
                showToast(
                    isCorrect ? 'Jawaban Benar! +' + {{ $quiz->xp_per_correct }} + ' XP' : 'Jawaban Salah!',
                    isCorrect
                );

                return true;
            }

            // === NAVIGATION: NEXT ===
            btnNext.addEventListener('click', function() {
                const q = questions[current];
                const selectedAnswer = getSelectedAnswer(q);

                if (!selectedAnswer) {
                    showAnswerError();
                    return;
                }

                // Check answer & show feedback
                checkAndShowFeedback(q);

                // Delay before moving to next question
                setTimeout(() => {
                    if (current < total - 1) {
                        current++;
                        showQuestion(current);
                    }
                }, 1200);
            });

            // === NAVIGATION: PREVIOUS ===
            btnPrev.addEventListener('click', function() {
                if (current > 0) {
                    current--;
                    showQuestion(current);
                }
            });

            // === SUBMIT VALIDATION ===
            btnSubmit?.addEventListener('click', function(e) {
                const q = questions[current];
                const selectedAnswer = getSelectedAnswer(q);

                if (!selectedAnswer) {
                    e.preventDefault();
                    showAnswerError();
                    return;
                }

                // Check last answer & show feedback before submit
                if (!answered.has(q.dataset.questionId)) {
                    e.preventDefault();
                    checkAndShowFeedback(q);
                    
                    // Auto submit after showing feedback
                    setTimeout(() => {
                        // Re-enable all radios before submitting
                        document.querySelectorAll('.quiz-radio').forEach(r => r.disabled = false);
                        document.getElementById('quiz-form').submit();
                    }, 2000);
                } else {
                    // Re-enable all radios before submitting
                    document.querySelectorAll('.quiz-radio').forEach(r => r.disabled = false);
                }
            });

            // === INITIALIZE ===
            showQuestion(0);

            // === TIMER ALGORITHM (5 minutes countdown) ===
            const timerEl = document.getElementById('timer');
            if (timerEl) {
                let timeString = timerEl.textContent.split(':');
                let totalSeconds = parseInt(timeString[0]) * 60 + parseInt(timeString[1]);
                
                if (totalSeconds > 0) {
                    const timerInterval = setInterval(() => {
                        totalSeconds--;
                        
                        let m = Math.floor(totalSeconds / 60);
                        let s = totalSeconds % 60;
                        
                        timerEl.textContent = 
                            String(m).padStart(2, '0') + ':' + 
                            String(s).padStart(2, '0');
                            
                        // Warning visual: kurang dari 1 menit
                        if (totalSeconds < 60) {
                            const container = document.getElementById('timer-container');
                            if (container) {
                                container.classList.remove('text-primary');
                                container.classList.add('text-red-500', 'animate-pulse');
                            }
                        }

                        // Waktu habis -> Auto submit
                        if (totalSeconds <= 0) {
                            clearInterval(timerInterval);
                            showToast('⏰ Waktu Habis! Quiz otomatis di-submit.', false);
                            
                            // Re-enable all radios before submitting
                            document.querySelectorAll('.quiz-radio').forEach(r => r.disabled = false);

                            setTimeout(() => {
                                document.getElementById('quiz-form').submit();
                            }, 1500);
                        }
                    }, 1000);
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
