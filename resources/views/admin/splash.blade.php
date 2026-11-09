<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wañwi</title>

    {{-- <<lien css>> --}}
    <link rel="stylesheet" href="{{ asset('css/splash.css') }}">

    {{-- <<si JavaScript est désactivé : redirection directe>> --}}
    <noscript>
        <meta http-equiv="refresh" content="2;url={{ url('/login') }}">
    </noscript>
</head>
<body>

    {{-- <<cercles décoratifs>> --}}
    <div class="cercle cercle-haut"></div>
    <div class="cercle cercle-bas"></div>

    {{-- <<contenu centré>> --}}
    <main class="splash">
        <div class="logo-tuile">W</div>
        <h1>Wañwi</h1>
        <p>Produits frais, livrés vite</p>

        {{-- <<barre de progression>> --}}
        <div class="progression">
            <div class="progression-remplie"></div>
        </div>
    </main>

    {{-- <<redirection vers la connexion après 2,2 secondes>> --}}
    <script>
        setTimeout(() => window.location.replace('{{ url('/login') }}'), 2200);
    </script>

</body>
</html>