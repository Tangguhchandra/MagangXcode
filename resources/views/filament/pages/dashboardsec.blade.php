<x-filament::page>
    <div
    class="relative w-full min-h-screen bg-cover bg-center px-4 py-0 rounded-3xl overflow-hidden">
        <!-- Overlay gelap -->
        <div class="absolute inset-0 bg-black/40 z-0"></div>

        <!-- Selamat Datang -->
        <div class="relative z-10 pt-8 pb-4 text-center text-white text-3xl font-bold drop-shadow-lg">
            
        </div>

        <!-- Grid konten -->
        <div class="relative z-10 px-4 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @php
                    $cards = [
                        ['icon' => '👥', 'label' => 'Total Pendaftar', 'value' => $total, 'color' => 'text-purple-700'],
                        ['icon' => '✅', 'label' => 'Diterima', 'value' => $diterima, 'color' => 'text-green-700'],
                        ['icon' => '⏳', 'label' => 'Pending', 'value' => $pending, 'color' => 'text-yellow-700'],
                        ['icon' => '❌', 'label' => 'Ditolak', 'value' => $ditolak, 'color' => 'text-red-700'],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl flex flex-col items-center justify-center min-h-[180px] text-center">
                        <div class="{{ $card['color'] }} text-4xl mb-3">{{ $card['icon'] }}</div>
                        <div class="text-base text-gray-600 dark:text-gray-300 mb-1">{{ $card['label'] }}</div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $card['value'] }}</div>
                    </div>
                @endforeach

                <!-- Tingkat Diterima -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl min-h-[180px] flex flex-col justify-center">
                    <div class="flex flex-col items-center text-center mb-3">
                        <div class="text-blue-700 text-4xl mb-2">📈</div>
                        <div class="text-base text-gray-600 dark:text-gray-300">Tingkat Diterima</div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $persentase }}%</div>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 h-4 rounded-full">
                        <div class="bg-green-500 h-4 rounded-full transition-all duration-500" style="width: {{ $persentase }}%"></div>
                    </div>
                </div>

                <!-- Pendaftar Terbaru -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl min-h-[180px]">
                    <div class="text-2xl text-gray-700 dark:text-white mb-1 text-center">🕒</div>
                    <div class="text-base text-gray-600 dark:text-gray-300 mb-2 text-center">Pendaftar Terbaru</div>
                    <ul class="text-sm text-gray-800 dark:text-gray-100 space-y-1">
                        @forelse ($recent as $p)
                            <li>• {{ $p->nama }} - {{ $p->divisi }} -
                                <span class="italic text-gray-500 dark:text-gray-400">{{ ucfirst($p->status) }}</span>
                            </li>
                        @empty
                            <li class="text-gray-400 dark:text-gray-500">Belum ada pendaftar</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
