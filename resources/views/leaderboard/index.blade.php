<x-app-layout>
    <x-slot name="header">
        Leaderboard
    </x-slot>

    <div class="xl:col-span-12 flex flex-col gap-12 w-full z-10">
        <!-- Header & Tabs -->
        <div class="flex flex-col items-center gap-6 text-center">
            <h1 class="font-display-lg text-display-lg text-on-surface font-black tracking-tight drop-shadow-md">The <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-fixed to-secondary-fixed">Void</span> Ranks</h1>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl">Top coders navigating the cosmic logic. Prove your skills, earn XP, and dominate the leaderboard.</p>
        </div>

        @php
            $top3 = $topUsers->take(3);
            $restUsers = $topUsers->skip(3);
        @endphp

        <!-- Podium Section -->
        @if($top3->count() >= 3)
        <div class="flex justify-center items-end gap-2 sm:gap-6 h-[380px] mt-8">
            <!-- 2nd Place (Silver) -->
            <div class="flex flex-col items-center w-28 sm:w-40 relative group">
                <div class="absolute -top-24 z-10 flex flex-col items-center gap-2">
                    <div class="text-on-surface-variant font-bold text-lg drop-shadow-md">2nd</div>
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-4 border-on-surface-variant shadow-[0_0_20px_rgba(185,202,203,0.3)] bg-surface-container flex items-center justify-center text-2xl font-bold text-on-surface-variant">
                        {{ strtoupper(substr($top3[1]->name, 0, 2)) }}
                    </div>
                    <div class="bg-surface/80 backdrop-blur-md px-3 py-1 rounded-lg border border-on-surface-variant/30 text-center">
                        <div class="font-label-caps text-[10px] text-on-surface truncate w-full">{{ $top3[1]->name }}</div>
                        <div class="text-primary-fixed-dim text-[10px] font-bold">{{ number_format($top3[1]->xp) }} XP</div>
                    </div>
                </div>
                <div class="w-full h-48 bg-gradient-to-t from-surface-container-lowest to-surface-container border-t-4 border-on-surface-variant rounded-t-xl relative overflow-hidden flex justify-center pt-6">
                    <span class="material-symbols-outlined text-4xl text-on-surface-variant/50" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                </div>
            </div>

            <!-- 1st Place (Gold) -->
            <div class="flex flex-col items-center w-32 sm:w-48 relative z-10 scale-105 group">
                <div class="absolute -top-32 z-10 flex flex-col items-center gap-2">
                    <span class="material-symbols-outlined text-tertiary-container text-4xl drop-shadow-[0_0_10px_rgba(255,215,0,0.8)]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full border-4 border-tertiary-container shadow-[0_0_30px_rgba(255,215,0,0.5)] bg-surface-container flex items-center justify-center text-3xl font-bold text-tertiary-container ring-2 ring-primary-container ring-offset-4 ring-offset-background">
                        {{ strtoupper(substr($top3[0]->name, 0, 2)) }}
                    </div>
                    <div class="bg-surface/90 backdrop-blur-xl px-4 py-1.5 rounded-lg border border-tertiary-container/50 text-center shadow-[0_4px_20px_rgba(0,0,0,0.5)]">
                        <div class="font-label-caps text-xs text-tertiary-container font-bold truncate w-full">{{ $top3[0]->name }}</div>
                        <div class="text-primary text-[11px] font-bold">{{ number_format($top3[0]->xp) }} XP</div>
                    </div>
                </div>
                <div class="w-full h-64 bg-gradient-to-t from-surface-container-lowest via-surface-container to-surface-container-high border-t-4 border-tertiary-container rounded-t-xl shadow-[0_-10px_40px_rgba(255,215,0,0.15)] relative overflow-hidden flex justify-center pt-8">
                    <div class="absolute top-0 w-full h-1 bg-tertiary-container shadow-[0_0_15px_rgba(255,215,0,1)]"></div>
                </div>
            </div>

            <!-- 3rd Place (Bronze) -->
            <div class="flex flex-col items-center w-28 sm:w-40 relative group">
                <div class="absolute -top-24 z-10 flex flex-col items-center gap-2">
                    <div class="text-on-tertiary-container font-bold text-lg drop-shadow-md">3rd</div>
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-4 border-[#cd7f32] shadow-[0_0_20px_rgba(205,127,50,0.3)] bg-surface-container flex items-center justify-center text-2xl font-bold text-[#cd7f32]">
                        {{ strtoupper(substr($top3[2]->name, 0, 2)) }}
                    </div>
                    <div class="bg-surface/80 backdrop-blur-md px-3 py-1 rounded-lg border border-[#cd7f32]/30 text-center">
                        <div class="font-label-caps text-[10px] text-on-surface truncate w-full">{{ $top3[2]->name }}</div>
                        <div class="text-primary-fixed-dim text-[10px] font-bold">{{ number_format($top3[2]->xp) }} XP</div>
                    </div>
                </div>
                <div class="w-full h-40 bg-gradient-to-t from-surface-container-lowest to-surface-container border-t-4 border-[#cd7f32] rounded-t-xl relative overflow-hidden flex justify-center pt-6">
                    <span class="material-symbols-outlined text-4xl text-[#cd7f32]/50" style="font-variation-settings: 'FILL' 1;">military_tech</span>
                </div>
            </div>
        </div>
        @endif

        <!-- Leaderboard Table -->
        <div class="w-full bg-surface-container/30 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.5)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/5 bg-surface-container-highest/50 font-label-caps text-label-caps text-on-surface-variant">
                            <th class="py-4 px-6 font-semibold w-16 text-center">Rank</th>
                            <th class="py-4 px-6 font-semibold">Coder</th>
                            <th class="py-4 px-6 font-semibold hidden md:table-cell">Level</th>
                            <th class="py-4 px-6 font-semibold text-right">Total XP</th>
                        </tr>
                    </thead>
                    <tbody class="font-body-md text-sm divide-y divide-white/5">
                        @foreach($topUsers as $index => $topUser)
                        <tr class="{{ $topUser->id === $user->id ? 'bg-primary/5 border-l-4 border-l-primary relative shadow-[0_0_20px_rgba(0,219,233,0.1)_inset]' : '' }} hover:bg-surface-bright/20 transition-colors group">
                            <td class="py-4 px-6 text-center {{ $topUser->id === $user->id ? 'text-primary' : 'text-on-surface-variant' }} font-bold">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full {{ $topUser->id === $user->id ? 'bg-surface border border-primary shadow-[0_0_10px_rgba(0,219,233,0.3)]' : 'bg-surface-container-high border border-white/10' }} flex items-center justify-center overflow-hidden text-xs font-bold {{ $topUser->id === $user->id ? 'text-primary' : 'text-on-surface-variant' }}">
                                        {{ strtoupper(substr($topUser->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="{{ $topUser->id === $user->id ? 'font-bold text-primary' : 'font-medium text-on-surface group-hover:text-primary transition-colors' }}">{{ $topUser->name }}{{ $topUser->id === $user->id ? ' (You)' : '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-on-surface-variant hidden md:table-cell">
                                <span class="px-2 py-1 rounded {{ $topUser->id === $user->id ? 'bg-primary/10 border border-primary/20 text-primary' : 'bg-white/5 border border-white/10 text-on-surface-variant' }} text-[10px] font-label-caps">Lvl {{ $topUser->level }}</span>
                            </td>
                            <td class="py-4 px-6 text-right font-code-sm {{ $topUser->id === $user->id ? 'font-bold text-primary' : 'text-primary-fixed-dim' }}">{{ number_format($topUser->xp) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
