<x-admin-layout>
    <x-slot name="header">Edit Kuis</x-slot>

    <div class="col-span-1 xl:col-span-12">
        @if ($errors->any())
        <div class="mb-6 glass-panel border border-error/30 text-error px-5 py-4 rounded-xl">
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST" id="quiz-form">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
                <!-- Left: Quiz Info -->
                <div class="xl:col-span-4">
                    <div class="glass-panel rounded-2xl p-6 border-t-2 border-secondary sticky top-24">
                        <h3 class="font-bold text-on-surface mb-4 border-b border-white/10 pb-3">Info Kuis</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-on-surface-variant mb-1">Kursus <span class="text-error">*</span></label>
                                <select id="course_select" class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-secondary transition-all appearance-none">
                                    <option value="">Pilih Kursus...</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $quiz->module->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-on-surface-variant mb-1">Modul <span class="text-error">*</span></label>
                                <select id="module_select" name="module_id" required class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-secondary transition-all appearance-none">
                                    <!-- Populated by JS -->
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-on-surface-variant mb-1">Judul Kuis <span class="text-error">*</span></label>
                                <input type="text" name="title" value="{{ old('title', $quiz->title) }}" required
                                    class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all">
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm text-on-surface-variant mb-1">XP/Jawaban</label>
                                    <input type="number" name="xp_per_correct" value="{{ old('xp_per_correct', $quiz->xp_per_correct) }}" min="0"
                                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-secondary transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm text-on-surface-variant mb-1">Waktu (detik)</label>
                                    <input type="number" name="time_limit_seconds" value="{{ old('time_limit_seconds', $quiz->time_limit_seconds) }}" min="0" placeholder="Opsional"
                                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-secondary transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-white/10 flex gap-3">
                            <a href="{{ route('admin.quizzes.index') }}" class="flex-1 text-center px-4 py-2 rounded-lg text-on-surface-variant hover:bg-white/5 transition-all">Batal</a>
                            <button type="submit" class="flex-1 bg-secondary text-white font-bold px-4 py-2 rounded-lg hover:bg-secondary/80 transition-all shadow-[0_0_10px_rgba(255,42,133,0.3)]">
                                Update Kuis
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right: Questions -->
                <div class="xl:col-span-8 space-y-4" id="questions-container">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-on-surface">Daftar Pertanyaan</h3>
                        <button type="button" onclick="addQuestion()" class="flex items-center gap-2 text-secondary hover:text-secondary/80 transition-colors font-bold">
                            <span class="material-symbols-outlined">add_circle</span> Tambah Pertanyaan
                        </button>
                    </div>

                    @foreach($quiz->questions as $index => $question)
                    <div class="question-block glass-panel rounded-2xl p-6 border border-white/5" id="question-{{ $index }}">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-bold text-secondary">Pertanyaan <span class="question-number">{{ $index + 1 }}</span></h4>
                            <button type="button" onclick="removeQuestion({{ $index }})" class="text-error/50 hover:text-error transition-colors">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <textarea name="questions[{{ $index }}][question]" rows="2" required placeholder="Tuliskan soal di sini..."
                                class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-secondary transition-all">{{ $question->question }}</textarea>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach(['A','B','C','D'] as $optIdx => $opt)
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="questions[{{ $index }}][correct_answer]" value="{{ $opt }}" {{ $question->correct_answer == $opt ? 'checked' : '' }} required class="text-secondary focus:ring-secondary">
                                    <input type="text" name="questions[{{ $index }}][options][]" placeholder="Opsi {{ $opt }}" value="{{ $question->options[$optIdx] ?? '' }}" required
                                        class="flex-1 bg-surface-container border border-white/10 rounded-lg px-3 py-2 text-on-surface focus:outline-none focus:border-secondary transition-all text-sm">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        const coursesData = @json($courses->map(fn($c) => ['id' => $c->id, 'modules' => $c->modules->map(fn($m) => ['id' => $m->id, 'title' => $m->title])])->keyBy('id'));
        const currentModuleId = {{ $quiz->module_id }};
        const currentCourseId = {{ $quiz->module->course_id }};

        function populateModules(courseId, selectedModuleId = null) {
            const moduleSelect = document.getElementById('module_select');
            moduleSelect.innerHTML = '<option value="">Pilih Modul...</option>';
            if (courseId && coursesData[courseId]) {
                coursesData[courseId].modules.forEach(m => {
                    const selected = m.id == selectedModuleId ? 'selected' : '';
                    moduleSelect.innerHTML += `<option value="${m.id}" ${selected}>${m.title}</option>`;
                });
            }
        }

        // Init on load
        populateModules(currentCourseId, currentModuleId);

        document.getElementById('course_select').addEventListener('change', function() {
            populateModules(this.value);
        });

        let questionCount = {{ $quiz->questions->count() }};
        let globalIndex = {{ $quiz->questions->count() }}; // To ensure unique DOM ids

        function addQuestion() {
            const idx = globalIndex++;
            questionCount++;
            const container = document.getElementById('questions-container');
            const block = document.createElement('div');
            block.className = 'question-block glass-panel rounded-2xl p-6 border border-white/5';
            block.id = `question-${idx}`;
            block.innerHTML = `
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-bold text-secondary">Pertanyaan <span class="question-number">${questionCount}</span></h4>
                    <button type="button" onclick="removeQuestion(${idx})" class="text-error/50 hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                </div>
                <div class="space-y-4">
                    <textarea name="questions[${idx}][question]" rows="2" required placeholder="Tuliskan soal di sini..."
                        class="w-full bg-surface-container border border-white/10 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-secondary transition-all"></textarea>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        ${['A','B','C','D'].map(opt => `
                        <div class="flex items-center gap-2">
                            <input type="radio" name="questions[${idx}][correct_answer]" value="${opt}" required class="text-secondary focus:ring-secondary">
                            <input type="text" name="questions[${idx}][options][]" placeholder="Opsi ${opt}" required
                                class="flex-1 bg-surface-container border border-white/10 rounded-lg px-3 py-2 text-on-surface focus:outline-none focus:border-secondary transition-all text-sm">
                        </div>`).join('')}
                    </div>
                </div>`;
            container.appendChild(block);
            updateQuestionNumbers();
        }

        function removeQuestion(idx) {
            const block = document.getElementById(`question-${idx}`);
            if (document.querySelectorAll('.question-block').length > 1) {
                block.remove();
                questionCount--;
                updateQuestionNumbers();
            } else {
                alert('Kuis harus memiliki minimal 1 pertanyaan.');
            }
        }

        function updateQuestionNumbers() {
            const blocks = document.querySelectorAll('.question-block .question-number');
            blocks.forEach((el, index) => {
                el.innerText = index + 1;
            });
        }
    </script>
    @endpush
</x-admin-layout>
