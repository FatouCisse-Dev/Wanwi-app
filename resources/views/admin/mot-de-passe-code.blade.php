<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisir le code - Wañwi</title>

    {{-- <<lien css>> --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    {{-- <<en-tête>> --}}
    <header>
        <img class="logo-img" src="{{ asset('images/logo.png') }}" alt="Logo Wañwi">
        <h1>Saisissez le code</h1>
        <p>Vérification en 6 chiffres</p>
    </header>

    <main>
        {{-- <<message de succès (code renvoyé)>> --}}
        @if (session('succes'))
            <p class="succes">{{ session('succes') }}</p>
        @endif

        {{-- <<explication selon le canal>> --}}
        <p class="aide-texte">
            Si un compte correspond à <strong>{{ $destination }}</strong>,
            un code à 6 chiffres vient d'être envoyé
            {{ $canal === 'sms' ? 'par SMS' : 'par email' }}.
            Il est valable quelques minutes.
        </p>

        {{-- <<formulaire du code>> --}}
        <form method="POST" action="{{ url('/mot-de-passe-oublie/code') }}">
            @csrf

            <label for="code">Code de vérification</label>
            <input type="text" id="code" name="code" class="champ-code"
                   inputmode="numeric" maxlength="6" autocomplete="one-time-code"
                   placeholder="······">

            {{-- <<message d'erreur du code>> --}}
            @error('code')
                <p class="erreur">{{ $message }}</p>
            @enderror

            <button type="submit">Vérifier</button>
        </form>

        {{-- <<renvoyer le code>> --}}
        <form method="POST" action="{{ url('/mot-de-passe-oublie/renvoyer') }}">
            @csrf
            <button type="submit" class="lien-renvoi">Renvoyer le code</button>
        </form>

        {{-- <<changer d'identifiant>> --}}
        <a href="{{ url('/mot-de-passe-oublie') }}" class="lien-retour">← Changer d'identifiant</a>
    </main>

</body>
</html>