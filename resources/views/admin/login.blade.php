<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Wañwi</title>

    {{-- <<lien css>> --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    {{-- <<en-tête>> --}}
    <header>
        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="Logo Wañwi">
        <h1>Wañwi</h1>
        <p>Un seul compte, trois espaces</p>
    </header>

    <main>

        {{-- <<message de succès>> --}}
        @if (session('succes'))
            <p class="succes">{{ session('succes') }}</p>
        @endif
        {{-- <<formulaire>> --}}
        <form method="POST" action="{{ url('/login') }}">
            @csrf

            {{-- <<champ identifiant>> --}}
            <label for="identifiant">Identifiant</label>
            <input type="text" id="identifiant" name="identifiant"
                   value="{{ old('identifiant') }}"
                   placeholder="Téléphone, email ou identifiant" required>

            {{-- <<message d'erreur identifiant>> --}}
            @error('identifiant')
                <p class="erreur">{{ $message }}</p>
            @enderror

            {{-- <<champ mot de passe>> --}}
            <label for="mot-de-passe">Mot de passe</label>
            {{-- <<champ mot de passe avec bouton voir>> --}}
            <div class="champ-mdp">
                <input type="password" id="mot-de-passe" name="password"
                       placeholder="Mot de passe">

                {{-- <<bouton voir / masquer>> --}}
                <button type="button" class="oeil" data-voir="mot-de-passe"
                        aria-label="Afficher le mot de passe">

                    {{-- <<icône œil : mot de passe masqué>> --}}
                    <svg class="icone-ouvert" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>

                    {{-- <<icône œil barré : mot de passe visible>> --}}
                    <svg class="icone-barre" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A10.9 10.9 0 0 1 12 5c7 0 11 7 11 7a19.9 19.9 0 0 1-3.17 4.19"/>
                        <path d="M14.12 14.12A3 3 0 1 1 9.88 9.88"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>

            {{-- <<message d'erreur mot de passe>> --}}
            @error('password')
                <p class="erreur">{{ $message }}</p>
            @enderror

            {{-- <<lien mot de passe oublié>> --}}
            <a href="{{ url('/mot-de-passe-oublie') }}" class="lien-oublie">Mot de passe oublié ?</a>

            {{-- <<bouton connexion>> --}}
            <button type="submit">Se connecter</button>
        </form>
    </main>
    {{-- <<script voir / masquer le mot de passe>> --}}
    <script src="{{ asset('js/mot-de-passe.js') }}"></script>
</body>
</html>