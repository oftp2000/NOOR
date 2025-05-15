@php
$stats = [
    ['title' => 'Réservations totales', 'value' => '156', 'icon' => 'calendar', 'trend' => '+12%', 'trendUp' => true],
    ['title' => 'Forfaits actifs', 'value' => '23', 'icon' => 'package-search', 'trend' => '+4%', 'trendUp' => true],
    ['title' => 'Clients', 'value' => '1,203', 'icon' => 'user-check', 'trend' => '+18%', 'trendUp' => true],
    ['title' => 'En attente', 'value' => '8', 'icon' => 'clock', 'trend' => '-2%', 'trendUp' => false],
];
@endphp

<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
    @foreach ($stats as $stat)
        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ $stat['title'] }}</p>
                    <p class="text-2xl font-bold">{{ $stat['value'] }}</p>
                </div>
                <div class="p-2 rounded-full {{ $stat['trendUp'] ? 'bg-green-100' : 'bg-red-100' }}">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-4 h-4 {{ $stat['trendUp'] ? 'text-green-600' : 'text-red-600' }}"></i>
                </div>
            </div>
            <div class="mt-4 text-sm {{ $stat['trendUp'] ? 'text-green-600' : 'text-red-600' }}">
                {{ $stat['trend'] }} depuis le mois dernier
            </div>
        </div>
    @endforeach
</div>
