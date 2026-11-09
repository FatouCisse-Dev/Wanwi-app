<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe - Wañwi</title>

    {{-- <<lien css>> --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    {{-- <<en-tête>> --}}
    <header>
        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="Logo Wañwi">
        <h1>Nouveau mot de passe</h1>
        <p>Code vérifié, choisissez-en un nouveau</p>
    </header>

    <main>
        {{-- <<formulaire>> --}}
        <form method="POST" action="{{ url('/mot-de-passe-oublie/nouveau') }}">
            @csrf

            {{-- <<champ nouveau mot de passe>> --}}
            <label for="mot-de-passe">Nouveau mot de passe</label>
            <div class="champ-mdp">
                <input type="password" id="mot-de-passe" name="password"
                       placeholder="8 caractères minimum">

                {{-- <<bouton voir / masquer : contrôle le champ "mot-de-passe">> --}}
                <button type="button" class="oeil" data-voir="mot-de-passe"
                        aria-label="Afficher le mot de passe">
                    {{-- <<icône œil : mot de passe visible>> --}}
                    <svg class="icone-ouvert" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    {{-- <<icône œil barré : mot de passe masqué>> --}}
                    <svg class="icone-barre" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A10.9 10.9 0 0 1 12 5c7 0 11 7 11 7a19.9 19.9 0 0 1-3.17 4.19"/>
                        <path d="M14.12 14.12A3 3 0 1 1 9.88 9.88"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>

            {{-- <<message d'erreur>> --}}
            @error('password')
                <p class="erreur">{{ $message }}</p>
            @enderror

            {{-- <<champ confirmation>> --}}
            <label for="confirmation">Confirmer le mot de passe</label>
            <div class="champ-mdp">
                <input type="password" id="confirmation" name="password_confirmation"
                       placeholder="Retapez le mot de passe">

                {{-- <<bouton voir / masquer : contrôle le champ "confirmation">> --}}
                <button type="button" class="oeil" data-voir="confirmation"
                        aria-label="Afficher le mot de passe">
                    {{-- <<icône œil : mot de passe visible>> --}}
                    <svg class="icone-ouvert" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    {{-- <<icône œil barré : mot de passe masqué>> --}}
                    <svg class="icone-barre" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A10.9 10.9 0 0 1 12 5c7 0 11 7 11 7a19.9 19.9 0 0 1-3.17 4.19"/>
                        <path d="M14.12 14.12A3 3 0 1 1 9.88 9.88"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>

            {{-- <<bouton enregistrer>> --}}
            <button type="submit">Enregistrer</button>
        </form>
    </main>

    {{-- <<script voir / masquer le mot de passe>> --}}
    <script src="{{ asset('js/mot-de-passe.js') }}"></script>

</body>
</html>