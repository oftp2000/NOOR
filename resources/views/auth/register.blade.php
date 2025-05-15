<x-guest-layout>
    <style>
        @keyframes rotateIn {
            from { transform: rotate(-180deg); opacity: 0; }
            to { transform: rotate(0); opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        .animate-rotate-in {
            animation: rotateIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }

        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
    </style>

    <div class="flex justify-center mb-6 animate-rotate-in">
        <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-600 to-emerald-400 flex items-center justify-center transition-transform duration-300 group-hover:rotate-12">
                <span class="text-white text-xl font-bold">م</span>
            </div>
            <span class="text-2xl font-serif font-bold text-green-700 transition-all duration-300 group-hover:text-emerald-500">Manasik</span>
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md mx-auto hover-lift animate-fade-in-up">
        <h2 class="text-2xl font-bold text-center mb-6 bg-gradient-to-r from-green-600 to-emerald-400 bg-clip-text text-transparent">
            Créer un compte
        </h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600 transition-all duration-300">Nom complet</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                           class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 placeholder-gray-300 input-focus-effect"
                           placeholder="Votre nom complet"
                           required autofocus>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600 transition-all duration-300">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 placeholder-gray-300 input-focus-effect"
                           placeholder="exemple@email.com"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600 transition-all duration-300">Mot de passe</label>
                    <input id="password" name="password" type="password"
                           class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 placeholder-gray-300 input-focus-effect"
                           placeholder="••••••••"
                           required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600 transition-all duration-300">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 placeholder-gray-300 input-focus-effect"
                           placeholder="••••••••"
                           required>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-br from-green-600 to-emerald-400 text-white py-3 rounded-lg transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-emerald-100 font-semibold animate-pulse-slow">
                S'inscrire
            </button>
        </form>

        <p class="text-center text-sm mt-6 text-gray-500">
            Vous avez déjà un compte ?
            <a href="{{ route('login') }}" class="text-green-600 hover:text-emerald-500 transition-all duration-300 underline-offset-4 hover:underline font-medium">
                Se connecter
            </a>
        </p>
    </div>
</x-guest-layout>