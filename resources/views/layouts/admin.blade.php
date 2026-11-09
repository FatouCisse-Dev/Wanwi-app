<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre') - Wañwi</title>

    {{-- <<lien css>> --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    {{-- <<en-tête>> --}}
    <header class="entete">
        <div class="entete-gauche">
            <div class="avatar">W</div>
            <div>
                <h1>@yield('titre')</h1>
                <p>@yield('sous-titre')</p>
            </div>
        </div>

        <div class="entete-droite">
            <span class="badge-admin">ADMIN</span>
            {{-- <<bouton déconnexion>> --}}
            <button type="button" class="deconnexion" id="btn-deconnexion">Déconnexion</button>
        </div>
    </header>

    {{-- <<menu de navigation en bas>> --}}
    <nav class="menu-bas">
        <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') || request()->is('carte') || request()->is('chiffre-affaires') ? 'actif' : '' }}">
            <span class="menu-icone">▦</span><span>Bord</span>
        </a>
        <a href="{{ url('/commandes') }}" class="{{ request()->is('commandes*') ? 'actif' : '' }}">
            <span class="menu-icone">📦</span><span>Commandes</span>
        </a>
        <a href="{{ url('/livreurs') }}" class="{{ request()->is('livreurs*') || request()->is('tricycles*') || request()->is('stock*') ? 'actif' : '' }}">
            <span class="menu-icone">🛺</span><span>Livreurs</span>
        </a>
        <a href="{{ url('/produits') }}" class="{{ request()->is('produits*') ? 'actif' : '' }}">
            <span class="menu-icone">🛒</span><span>Produits</span>
        </a>
    </nav>

    {{-- <<contenu de la page>> --}}
    <main class="contenu">
        @yield('contenu')
    </main>
    
    {{-- <<fenêtre de confirmation de déconnexion>> --}}
    <dialog id="fenetre-deconnexion" class="fenetre">
        <h2>⚠️ Se déconnecter ?</h2>
        <p>Vous devrez vous reconnecter pour accéder à l'espace administrateur.</p>

        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <div class="boutons-fenetre">
                <button type="button" id="annuler-deconnexion" class="fenetre-annuler">Annuler</button>
                <button type="submit" class="fenetre-confirmer">Se déconnecter</button>
            </div>
        </form>
    </dialog>

    {{-- <<script de la fenêtre>> --}}
    <script>
        const fenetre = document.getElementById('fenetre-deconnexion');

        document.getElementById('btn-deconnexion')
            .addEventListener('click', () => fenetre.showModal());

        document.getElementById('annuler-deconnexion')
            .addEventListener('click', () => fenetre.close());
    </script>

    {{-- <<script de recherche en direct>> --}}
    <script src="{{ asset('js/recherche.js') }}"></script>
</body>
</html>