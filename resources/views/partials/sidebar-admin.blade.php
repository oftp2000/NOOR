<aside class="w-64 h-screen bg-gray-800 text-white">
  <div class="p-4 font-bold text-lg border-b border-gray-700">
    Administration
  </div>
  <nav class="mt-4 space-y-2 px-4">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 p-2 hover:bg-gray-700 rounded">
      <i data-lucide="home" class="w-4 h-4"></i> <span>Tableau de bord</span>
    </a>
    <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-2 p-2 hover:bg-gray-700 rounded">
      <i data-lucide="package-search" class="w-4 h-4"></i> <span>Forfaits</span>
    </a>
    <a href="{{ route('admin.reservations.index') }}" class="flex items-center gap-2 p-2 hover:bg-gray-700 rounded">
      <i data-lucide="calendar" class="w-4 h-4"></i> <span>Réservations</span>
    </a>
    <a href="{{ route('admin.clients.index') }}" class="flex items-center gap-2 p-2 hover:bg-gray-700 rounded">
      <i data-lucide="users" class="w-4 h-4"></i> <span>Clients</span>
    </a>
    <a href="#" class="flex items-center gap-2 p-2 hover:bg-gray-700 rounded">
      <i data-lucide="settings" class="w-4 h-4"></i> <span>Paramètres</span>
    </a>
  </nav>
</aside>
