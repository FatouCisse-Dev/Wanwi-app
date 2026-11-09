<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - Wañwi</title>

    {{-- <<lien css>> --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    {{-- <<en-tête>> --}}
    <header>
        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="Logo Wañwi">
        <h1>Mot de passe oublié</h1>
        <p>Nous vous envoyons un code de vérification</p>
    </header>

    <main>
        {{-- <<explication>> --}}
        <p class="aide-texte">Saisissez votre numéro de téléphone pour recevoir un code par SMS, ou votre adresse email pour le recevoir par email.</p>

        {{-- <<formulaire>> --}}
        <form method="POST" action="{{ url('/mot-de-passe-oublie') }}">
            @csrf

            {{-- <<champ email ou téléphone>> --}}
            <label for="identifiant">Email ou téléphone</label>
            <input type="text" id="identifiant" name="identifiant"
                   value="{{ old('identifiant') }}"
                   placeholder="771234567 ou nom@exemple.com">

            {{-- <<message d'erreur>> --}}
            @error('identifiant')
                <p class="erreur">{{ $message }}</p>
            @enderror

            {{-- <<bouton envoyer>> --}}
            <button type="submit">Envoyer le code</button>
        </form>

        {{-- <<retour à la connexion>> --}}
        <a href="{{ url('/login') }}" class="lien-retour">← Retour à la connexion</a>
    </main>

</body>
</html>