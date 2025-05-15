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

        .animate-rotate-in {
            animation: rotateIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
        <h2 class="text-2xl font-bold text-center mb-4 bg-gradient-to-r from-green-600 to-emerald-400 bg-clip-text text-transparent">
            Connexion
        </h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 transition-all duration-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 placeholder-gray-300"
                       placeholder="exemple@email.com"
                       required autofocus>
                @error('email')
                    <p class="text-red-500 text-sm mt-1 animate-shake">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-600 transition-all duration-300">Mot de passe</label>
                <input id="password" type="password" name="password"
                       class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-300 placeholder-gray-300"
                       placeholder="••••••••"
                       required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1 animate-shake">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <label class="flex items-center space-x-2 transition-all duration-300 hover:text-green-700 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-emerald-500 focus:ring-emerald-400 transition-all">
                    <span>Se souvenir de moi</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-emerald-500 transition-all duration-300 underline-offset-4 hover:underline">
                    Mot de passe oublié ?
                </a>
            </div>

            <button type="submit"
                    class="w-full bg-gradient-to-br from-green-600 to-emerald-400 text-white py-2 rounded-lg transition-all duration-300 hover:scale-[1.02] hover:shadow-lg hover:shadow-emerald-100 font-semibold">
                Se connecter
            </button>
        </form>

        <p class="text-center text-sm mt-4 text-gray-500">
            Vous n'avez pas de compte ?
            <a href="{{ route('register') }}" class="text-green-600 hover:text-emerald-500 transition-all duration-300 underline-offset-4 hover:underline">
                S'inscrire
            </a>
        </p>
    </div>
</x-guest-layout>