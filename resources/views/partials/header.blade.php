<header class="border-b bg-white px-4 py-3">
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold text-gray-800">
      Noor Al-Haramain
    </h1>
    <div class="flex items-center space-x-4">
      <button class="hover:bg-gray-100 p-2 rounded-full">
        <i data-lucide="bell" class="w-5 h-5 text-gray-600"></i>
      </button>
      
      <!-- Menu utilisateur -->
      <div class="relative">
        <button id="user-menu-button" class="hover:bg-gray-100 p-2 rounded-full">
          <i data-lucide="user" class="w-5 h-5 text-gray-600"></i>
        </button>
        
        <!-- Menu déroulant (caché par défaut) -->
        <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            <i data-lucide="package" class="w-4 h-4 mr-2 inline"></i> Retour aux packs
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <i data-lucide="log-out" class="w-4 h-4 mr-2 inline"></i> Déconnexion
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
  // Gestion du menu déroulant
  document.getElementById('user-menu-button').addEventListener('click', function() {
    const menu = document.getElementById('user-menu');
    menu.classList.toggle('hidden');
  });

  // Fermer le menu quand on clique ailleurs
  document.addEventListener('click', function(event) {
    const menu = document.getElementById('user-menu');
    const button = document.getElementById('user-menu-button');
    
    if (!button.contains(event.target) && !menu.contains(event.target)) {
      menu.classList.add('hidden');
    }
  });
</script>