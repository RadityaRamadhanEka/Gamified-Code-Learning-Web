<x-landing-layout>
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 px-gutter max-w-container-max mx-auto flex flex-col items-center text-center">
        <h1 class="font-display-lg text-display-lg text-primary mb-6 max-w-4xl tracking-tighter">Master the Void of Code</h1>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mb-12">Embark on a gamified journey through the coding universe. Learn, compete, and conquer complex algorithms in an immersive dark-glass environment.</p>
        
        <div class="flex flex-wrap gap-6 justify-center mb-16">
            <button class="bg-gradient-to-r from-primary to-secondary text-surface px-8 py-4 rounded-full font-label-caps text-label-caps hover:shadow-[0_0_20px_rgba(0,219,233,0.4)] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
                Mulai Ekspedisi
            </button>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 w-full max-w-4xl p-8 rounded-xl bg-white/[0.03] backdrop-blur-md border border-white/10 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent pointer-events-none"></div>
            
            <x-stat-card value="10k+" label="Learners" color="primary" />
            <x-stat-card value="50+" label="Paths" color="secondary" />
            <x-stat-card value="1M+" label="Lines of Code" color="tertiary" />
            <x-stat-card value="24/7" label="Support" color="primary-fixed" />
        </div>
    </section>

    <!-- Features Bento Grid -->
    <section class="py-24 px-gutter max-w-container-max mx-auto">
        <h2 class="font-headline-lg text-headline-lg text-primary mb-12 text-center">Fitur Ekspedisi</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Gamifikasi -->
            <x-feature-card title="Gamifikasi" icon="star" iconColor="tertiary">
                Dapatkan XP, naikkan level, dan kumpulkan badge saat menyelesaikan tantangan coding.
            </x-feature-card>

            <!-- Code Editor -->
            <x-feature-card title="Code Editor" icon="terminal" iconColor="secondary" class="md:col-span-2">
                <p class="mb-6">Editor kode canggih langsung di browser Anda dengan syntax highlighting dan auto-completion.</p>
                <div class="bg-surface-lowest p-4 rounded-lg font-code-sm text-code-sm border border-white/5">
                    <span class="text-secondary">const</span> <span class="text-primary">masterVoid</span> <span class="text-on-surface">=</span> () <span class="text-secondary">=></span> {<br>
                    &nbsp;&nbsp;<span class="text-primary-container">console</span>.<span class="text-tertiary-container">log</span>(<span class="text-tertiary-fixed">"Hello, Universe!"</span>);<br>
                    };
                </div>
            </x-feature-card>

            <!-- Leaderboard -->
            <x-feature-card title="Leaderboard" icon="emoji_events" iconColor="tertiary">
                Bandingkan skor Anda dengan coders lain di seluruh galaksi.
            </x-feature-card>
        </div>
    </section>
</x-landing-layout>
