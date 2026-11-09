<?php

use Illuminate\Support\Facades\Route;

// <<données fictives partagées : tricycles>>
$tricycles = [
    ['id' => 1, 'plaque' => 'AA-234-DK', 'livreur' => 'Moussa D.',   'zone' => 'Sacré-Cœur',  'statut' => 'Actif',          'classe' => 'actif'],
    ['id' => 2, 'plaque' => 'BB-119-XY', 'livreur' => 'Ibrahima F.', 'zone' => 'Almadies',    'statut' => 'Actif',          'classe' => 'actif'],
    ['id' => 3, 'plaque' => 'CC-882-TR', 'livreur' => 'Fatou N.',    'zone' => 'Mamelles',    'statut' => 'Actif',          'classe' => 'actif'],
    ['id' => 4, 'plaque' => 'DD-451-KL', 'livreur' => 'Cheikh S.',   'zone' => 'Pikine',      'statut' => 'En maintenance', 'classe' => 'maintenance'],
    ['id' => 5, 'plaque' => 'EE-762-PQ', 'livreur' => 'Aïssatou D.', 'zone' => 'Maristes',    'statut' => 'Inactif',        'classe' => 'inactif'],
    ['id' => 6, 'plaque' => 'FF-305-MN', 'livreur' => null,          'zone' => 'Keur Massar', 'statut' => 'Inactif',        'classe' => 'inactif'],
];

// <<données fictives partagées : livreurs>>
$livreurs = [
    ['id' => 1, 'code' => 'LIV-001', 'nom' => 'Moussa D.',   'statut' => 'En ligne',   'classe' => 'en-ligne',   'vehicule' => '🛺 Tricycle', 'activite' => 'Livraison #1047', 'note' => '4.9', 'livraisons' => 128, 'taux' => '98%', 'telephone' => '77 123 45 67', 'zone' => 'Sacré-Cœur',  'membre_depuis' => '12/03/2024',
        'historique' => [['Livraison #1047', 'Il y a 8 min'], ['Livraison #1045', 'Il y a 1 h'], ['Livraison #1042', 'Il y a 3 h'], ['Pause déjeuner', 'Il y a 4 h']]],
    ['id' => 2, 'code' => 'LIV-002', 'nom' => 'Ibrahima F.', 'statut' => 'En ligne',   'classe' => 'en-ligne',   'vehicule' => '🛺 Tricycle', 'activite' => 'Livraison #1043', 'note' => '4.7', 'livraisons' => 96,  'taux' => '95%', 'telephone' => '77 234 56 78', 'zone' => 'Almadies',    'membre_depuis' => '05/06/2024',
        'historique' => [['Livraison #1043', 'Il y a 20 min'], ['Livraison #1039', 'Il y a 2 h'], ['Livraison #1036', 'Il y a 5 h']]],
    ['id' => 3, 'code' => 'LIV-003', 'nom' => 'Fatou N.',    'statut' => 'Occupé',     'classe' => 'occupe',     'vehicule' => '🛺 Tricycle', 'activite' => 'Disponible',      'note' => '4.8', 'livraisons' => 74,  'taux' => '97%', 'telephone' => '77 345 67 89', 'zone' => 'Mamelles',    'membre_depuis' => '18/09/2024',
        'historique' => [['Livraison #1041', 'Il y a 1 h'], ['Livraison #1038', 'Il y a 3 h']]],
    ['id' => 4, 'code' => 'LIV-004', 'nom' => 'Cheikh S.',   'statut' => 'Occupé',     'classe' => 'occupe',     'vehicule' => '🛺 Tricycle', 'activite' => 'En pause',        'note' => '4.6', 'livraisons' => 61,  'taux' => '93%', 'telephone' => '77 456 78 90', 'zone' => 'Pikine',      'membre_depuis' => '02/11/2024',
        'historique' => [['Pause déjeuner', 'Il y a 30 min'], ['Livraison #1040', 'Il y a 2 h']]],
    ['id' => 5, 'code' => 'LIV-005', 'nom' => 'Aïssatou D.', 'statut' => 'Hors ligne', 'classe' => 'hors-ligne', 'vehicule' => '🛺 Tricycle', 'activite' => 'Hors service',    'note' => '4.9', 'livraisons' => 89,  'taux' => '99%', 'telephone' => '77 567 89 01', 'zone' => 'Maristes',    'membre_depuis' => '21/01/2025',
        'historique' => [['Fin de service', 'Hier, 18:30'], ['Livraison #1030', 'Hier, 17:50']]],
    ['id' => 6, 'code' => 'LIV-006', 'nom' => 'Malick N.',   'statut' => 'Suspendu',   'classe' => 'suspendu',   'vehicule' => '🛺 Tricycle', 'activite' => 'Compte suspendu', 'note' => '4.5', 'livraisons' => 52,  'taux' => '90%', 'telephone' => '77 678 90 12', 'zone' => 'Keur Massar', 'membre_depuis' => '14/02/2025',
        'historique' => [['Compte suspendu', 'Il y a 3 jours']]],
];

// <<positions fictives sur la carte : id du livreur => [haut %, gauche %]>>
$positions = [
    1 => [12, 8],
    2 => [38, 32],
    3 => [60, 52],
    4 => [25, 70],
];

// <<points de la carte : livreurs actifs (en ligne ou occupés) avec une position>>
$pointsCarte = collect($livreurs)
    ->filter(fn ($l) => isset($positions[$l['id']]) && in_array($l['classe'], ['en-ligne', 'occupe']))
    ->map(fn ($l) => [
        'id'       => $l['id'],
        'nom'      => $l['nom'],
        'statut'   => $l['statut'],
        'classe'   => $l['classe'],
        'activite' => $l['activite'],
        'icone'    => '🛺',
        'haut'     => $positions[$l['id']][0],
        'gauche'   => $positions[$l['id']][1],
    ])
    ->values()
    ->all();

// <<données fictives partagées : produits>>
$produits = [
    ['id' => 1, 'icone' => '🍊', 'nom' => 'Oranges',   'categorie' => 'Fruits',   'quantite' => 55, 'unite' => 'kg', 'prix' => 750,  'niveau' => 90, 'alerte' => null],
    ['id' => 2, 'icone' => '🥬', 'nom' => 'Salade',    'categorie' => 'Légumes',  'quantite' => 18, 'unite' => 'pc', 'prix' => 500,  'niveau' => 30, 'alerte' => null],
    ['id' => 3, 'icone' => '🍅', 'nom' => 'Tomates',   'categorie' => 'Légumes',  'quantite' => 60, 'unite' => 'kg', 'prix' => 700,  'niveau' => 95, 'alerte' => null],
    ['id' => 4, 'icone' => '🧅', 'nom' => 'Oignons',   'categorie' => 'Légumes',  'quantite' => 45, 'unite' => 'kg', 'prix' => 450,  'niveau' => 75, 'alerte' => null],
    ['id' => 5, 'icone' => '🐟', 'nom' => 'Thiof',     'categorie' => 'Poissons', 'quantite' => 12, 'unite' => 'kg', 'prix' => 3500, 'niveau' => 20, 'alerte' => 'Bas'],
    ['id' => 6, 'icone' => '🦐', 'nom' => 'Crevettes', 'categorie' => 'Poissons', 'quantite' => 4,  'unite' => 'kg', 'prix' => 6000, 'niveau' => 8,  'alerte' => 'Critique'],
];

// <<données fictives partagées : commandes>>
$commandes = [
    ['id' => 1, 'numero' => '#1042', 'statut' => 'Livrée', 'classe' => 'livree', 'client' => 'Awa S.', 'telephone' => '77 111 22 33', 'livreur' => 'Moussa D.', 'zone' => 'Sacré-Cœur 3', 'adresse' => 'Villa 24, Sacré-Cœur 3', 'paiement' => 'Orange Money', 'montant' => '6 100 F', 'heure' => '09:41',
        'articles' => [
            ['nom' => 'Tomates', 'quantite' => 3, 'unite' => 'kg', 'prix' => 700],
            ['nom' => 'Oranges', 'quantite' => 2, 'unite' => 'kg', 'prix' => 750],
            ['nom' => 'Salade',  'quantite' => 5, 'unite' => 'pc', 'prix' => 500],
        ],
        'historique' => [['Commande reçue', '09:12'], ['Acceptée par Moussa D.', '09:15'], ['En route', '09:22'], ['Livrée', '09:41']]],

    ['id' => 2, 'numero' => '#1043', 'statut' => 'En cours', 'classe' => 'en-cours', 'client' => 'Cheikh T.', 'telephone' => '77 222 33 44', 'livreur' => 'Ibrahima F.', 'zone' => 'Point E', 'adresse' => 'Rue 10, Point E', 'paiement' => 'Wave', 'montant' => '4 300 F', 'heure' => '10:02',
        'articles' => [
            ['nom' => 'Oignons', 'quantite' => 2, 'unite' => 'kg', 'prix' => 450],
            ['nom' => 'Tomates', 'quantite' => 2, 'unite' => 'kg', 'prix' => 700],
            ['nom' => 'Salade',  'quantite' => 4, 'unite' => 'pc', 'prix' => 500],
        ],
        'historique' => [['Commande reçue', '09:55'], ['Acceptée par Ibrahima F.', '09:58'], ['En route', '10:02']]],

    ['id' => 3, 'numero' => '#1044', 'statut' => 'En attente', 'classe' => 'en-attente', 'client' => 'Fatou B.', 'telephone' => '77 333 44 55', 'livreur' => '—', 'zone' => 'Médina', 'adresse' => 'Rue 6 x Blaise Diagne, Médina', 'paiement' => 'Paiement à la livraison', 'montant' => '8 900 F', 'heure' => '10:15',
        'articles' => [
            ['nom' => 'Thiof',   'quantite' => 2, 'unite' => 'kg', 'prix' => 3500],
            ['nom' => 'Tomates', 'quantite' => 2, 'unite' => 'kg', 'prix' => 700],
            ['nom' => 'Salade',  'quantite' => 1, 'unite' => 'pc', 'prix' => 500],
        ],
        'historique' => [['Commande reçue', '10:15']]],

    ['id' => 4, 'numero' => '#1045', 'statut' => 'Livrée', 'classe' => 'livree', 'client' => 'Omar D.', 'telephone' => '77 444 55 66', 'livreur' => 'Fatou N.', 'zone' => 'Almadies', 'adresse' => 'Route des Almadies, Résidence Les Palmiers', 'paiement' => 'Carte bancaire', 'montant' => '5 200 F', 'heure' => '10:40',
        'articles' => [
            ['nom' => 'Oranges', 'quantite' => 2, 'unite' => 'kg', 'prix' => 750],
            ['nom' => 'Tomates', 'quantite' => 4, 'unite' => 'kg', 'prix' => 700],
            ['nom' => 'Oignons', 'quantite' => 2, 'unite' => 'kg', 'prix' => 450],
        ],
        'historique' => [['Commande reçue', '10:05'], ['Acceptée par Fatou N.', '10:08'], ['En route', '10:20'], ['Livrée', '10:40']]],

    ['id' => 5, 'numero' => '#1046', 'statut' => 'Annulée', 'classe' => 'annulee', 'client' => 'Mariama K.', 'telephone' => '77 555 66 77', 'livreur' => '—', 'zone' => 'Pikine', 'adresse' => 'Pikine Icotaf, Villa 12', 'paiement' => 'Wave', 'montant' => '3 500 F', 'heure' => '11:05',
        'articles' => [
            ['nom' => 'Salade',  'quantite' => 4, 'unite' => 'pc', 'prix' => 500],
            ['nom' => 'Oranges', 'quantite' => 2, 'unite' => 'kg', 'prix' => 750],
        ],
        'historique' => [['Commande reçue', '11:05'], ['Annulée', '11:12']]],
];

// <<libellés du statut de remplissage : clé => [texte, classe CSS]>>
$etiquettesStock = [
    'confirme' => ['Confirmé', 'actif'],
    'attente'  => ['En attente de confirmation', 'maintenance'],
    'vide'     => ['Non rempli', 'inactif'],
];

// <<données fictives partagées : stock du jour, par id de tricycle>>
// initial = rempli le matin, appli = vendu via l'application, rue = vendu dans la rue
$stocks = [
    1 => ['statut' => 'confirme', 'lignes' => [
        ['produit_id' => 3, 'initial' => 30, 'appli' => 9, 'rue' => 6],
        ['produit_id' => 4, 'initial' => 25, 'appli' => 5, 'rue' => 4],
        ['produit_id' => 2, 'initial' => 20, 'appli' => 6, 'rue' => 3],
        ['produit_id' => 1, 'initial' => 20, 'appli' => 4, 'rue' => 5],
    ]],
    2 => ['statut' => 'confirme', 'lignes' => [
        ['produit_id' => 3, 'initial' => 25, 'appli' => 7, 'rue' => 5],
        ['produit_id' => 1, 'initial' => 15, 'appli' => 3, 'rue' => 2],
        ['produit_id' => 5, 'initial' => 10, 'appli' => 4, 'rue' => 1],
    ]],
    3 => ['statut' => 'attente', 'lignes' => [
        ['produit_id' => 4, 'initial' => 30, 'appli' => 0, 'rue' => 0],
        ['produit_id' => 2, 'initial' => 24, 'appli' => 0, 'rue' => 0],
        ['produit_id' => 3, 'initial' => 20, 'appli' => 0, 'rue' => 0],
    ]],
];

// <<écran de démarrage>>
Route::get('/', function () {

    // <<à intégrer: si l'utilisateur est déjà connecté, rediriger vers /dashboard>>

    return view('admin.splash');
});

// <<afficher la page de login>>
Route::get('/login', function () {
    return view('admin.login');
});

/*envoi du formulaire de login*/
Route::post('/login', function (\Illuminate\Http\Request $request) {

    // <<validation des champs>>
    $request->validate([
        'identifiant' => 'required',
        'password'    => 'required|min:8',
    ], [
        // messages d'erreur
        'identifiant.required' => 'Saisissez votre identifiant.',
        'password.required'    => 'Saisissez votre mot de passe.',
        'password.min'         => 'Le mot de passe doit contenir au moins 8 caractères.',
    ]);

    // Direction dashboard
    return redirect('/dashboard');
});

// <<afficher le dashboard>>
Route::get('/dashboard', function () use ($pointsCarte) {

    // <<données fictives : statistiques>>
    $stats = [
        ['icone' => '🧾', 'valeur' => '126',     'libelle' => 'Commandes',          'variation' => '+12%',   'positif' => true,  'lien' => '/commandes'],
        ['icone' => '📈', 'valeur' => '632 k F', 'libelle' => "Chiffre d'affaires", 'variation' => '+8%',    'positif' => true,  'lien' => '/chiffre-affaires'],
        ['icone' => '🛺', 'valeur' => '23/31',   'libelle' => 'Livreurs actifs',    'variation' => '+77%',   'positif' => true,  'lien' => '/livreurs?statut=en-ligne'],
        ['icone' => '⏱️', 'valeur' => '26 min',  'libelle' => 'Temps moyen',        'variation' => '-3 min', 'positif' => false, 'lien' => '/commandes?statut=livree'],
    ];

    // <<données fictives : commandes récentes>>
    $commandes = [
        ['id' => 1, 'numero' => '#1042', 'statut' => 'Livrée',      'classe' => 'livree',      'icone' => '✓',  'client' => 'Awa S.',    'livreur' => 'Moussa D.',   'montant' => '6 100 F', 'heure' => '09:41'],
        ['id' => 2, 'numero' => '#1043', 'statut' => 'En cours',    'classe' => 'en-cours',    'icone' => '🛺', 'client' => 'Cheikh T.', 'livreur' => 'Ibrahima F.', 'montant' => '4 300 F', 'heure' => '10:02'],
        ['id' => 3, 'numero' => '#1044', 'statut' => 'En attente',  'classe' => 'en-attente',  'icone' => '⏳', 'client' => 'Fatou B.',  'livreur' => '—',           'montant' => '8 900 F', 'heure' => '10:55'],
    ];


    // <<envoi des données à la vue>>
    return view('admin.dashboard', [
        'stats'     => $stats,
        'commandes' => $commandes,
        'livreurs'  => $pointsCarte,
    ]);
});

// <<afficher la page livreurs>>
Route::get('/livreurs', function (\Illuminate\Http\Request $request) use ($livreurs) {

    // <<compteurs : calculés sur la liste complète>>
    $compteurs = [
        'en-ligne'   => collect($livreurs)->where('classe', 'en-ligne')->count(),
        'occupe'     => collect($livreurs)->where('classe', 'occupe')->count(),
        'hors-ligne' => collect($livreurs)->where('classe', 'hors-ligne')->count(),
        'suspendu'   => collect($livreurs)->where('classe', 'suspendu')->count(),
    ];

    // <<lecture des paramètres de l'adresse>>
    $statut = (string) $request->query('statut');
    $q      = trim((string) $request->query('q'));

    // <<application des filtres>>
    $resultat = collect($livreurs);

    if ($statut !== '') {
        $resultat = $resultat->where('classe', $statut);
    }

    if ($q !== '') {
        $resultat = $resultat->filter(function ($l) use ($q) {
            return stripos(
                \Illuminate\Support\Str::ascii($l['nom']),
                \Illuminate\Support\Str::ascii($q)
            ) !== false;
        });
    }

    // <<boutons de filtre : adresse => libellé>>
    $filtres = [
        ''           => 'Tous',
        'en-ligne'   => 'En ligne',
        'occupe'     => 'Occupés',
        'hors-ligne' => 'Hors ligne',
        'suspendu'   => 'Suspendus',
    ];

    return view('admin.livreurs', [
        'livreurs'  => $resultat->values()->all(),
        'compteurs' => $compteurs,
        'filtres'   => $filtres,
        'statut'    => $statut,
        'q'         => $q,
    ]);
});

// <<afficher le formulaire d'ajout d'un livreur>>
Route::get('/livreurs/creer', function () {

    // <<zones de livraison>>
    $zones = ['Sacré-Cœur', 'Almadies', 'Mamelles', 'Maristes', 'Pikine', 'Keur Massar'];

    return view('admin.livreur-creer', ['zones' => $zones]);
});

// <<envoi du formulaire d'ajout d'un livreur>>
Route::post('/livreurs', function (\Illuminate\Http\Request $request) {

    // <<validation des champs>>
    $request->validate([
        'nom'       => 'required|min:3',
        'telephone' => ['required', 'regex:/^7[05678][0-9]{7}$/'],
        'zone'      => 'required',
    ], [
        // <<messages d'erreur en français>>
        'nom.required'       => 'Saisissez le nom complet.',
        'nom.min'            => 'Le nom doit contenir au moins 3 caractères.',
        'telephone.required' => 'Saisissez le numéro de téléphone.',
        'telephone.regex'    => 'Numéro invalide : 9 chiffres, sans espaces (ex. 771234567).',
        'zone.required'      => 'Choisissez une zone d\'activité.',
    ]);

    // <<à intégrer appel API de création du livreur>>

    // <<retour à la liste avec message de succès>>
    return redirect('/livreurs')->with('succes', 'Livreur ajouté avec succès.');
});

// <<afficher la page tricycles>>
Route::get('/tricycles', function () use ($tricycles) {

    // <<compteurs>>
    $compteurs = [
        'actif'       => collect($tricycles)->where('classe', 'actif')->count(),
        'maintenance' => collect($tricycles)->where('classe', 'maintenance')->count(),
        'inactif'     => collect($tricycles)->where('classe', 'inactif')->count(),
        'sans-livreur' => collect($tricycles)->whereNull('livreur')->count(),
    ];

    // <<envoi des données à la vue>>
    return view('admin.tricycles', [
        'tricycles' => $tricycles,
        'compteurs' => $compteurs,
    ]);
});

// <<afficher le formulaire d'ajout d'un tricycle>>
Route::get('/tricycles/creer', function () use ($tricycles) {

    // <<zones de livraison>>
    $zones = ['Sacré-Cœur', 'Almadies', 'Mamelles', 'Maristes', 'Pikine', 'Keur Massar'];

    // <<tous les livreurs : données fictives>>
    $tousLesLivreurs = ['Moussa D.', 'Ibrahima F.', 'Fatou N.', 'Cheikh S.', 'Aïssatou D.', 'Malick N.'];

    // <<livreurs qui ont déjà un tricycle>>
    $livreursAvecTricycle = collect($tricycles)->pluck('livreur')->filter()->all();

    // <<livreurs disponibles : sans tricycle>>
    $livreurs = collect($tousLesLivreurs)->diff($livreursAvecTricycle)->values()->all();

    return view('admin.tricycle-creer', [
        'zones'    => $zones,
        'livreurs' => $livreurs,
    ]);
});

// <<envoi du formulaire d'ajout d'un tricycle>>
Route::post('/tricycles', function (\Illuminate\Http\Request $request) {

    // <<validation des champs>>
    $request->validate([
        'plaque'  => ['required', 'regex:/^[A-Z]{2}-[0-9]{3}-[A-Z]{2}$/'],
        'zone'    => 'required',
        'livreur' => 'required',
    ], [
        // <<messages d'erreur en français>>
        'plaque.required'  => 'Saisissez la plaque d\'immatriculation.',
        'plaque.regex'     => 'Format invalide : 2 lettres, 3 chiffres, 2 lettres en majuscules (ex. AA-234-DK).',
        'zone.required'    => 'Choisissez une zone d\'activité.',
        'livreur.required' => 'Choisissez le livreur rattaché.',
    ]);

    // <<à intégrer  appel API de création du tricycle>>

    // <<retour à la liste avec message de succès>>
    return redirect('/tricycles')->with('succes', 'Tricycle ajouté avec succès.');
});

// <<afficher la page commandes>>
Route::get('/commandes', function (\Illuminate\Http\Request $request) use ($commandes) {

    // <<lecture des paramètres de l'adresse>>
    $statut = (string) $request->query('statut');
    $q      = trim((string) $request->query('q'));

    // <<application des filtres>>
    $resultat = collect($commandes);

    if ($statut !== '') {
        $resultat = $resultat->where('classe', $statut);
    }

    if ($q !== '') {
        $resultat = $resultat->filter(function ($c) use ($q) {
            return stripos($c['numero'] . ' ' . $c['client'] . ' ' . $c['livreur'], $q) !== false;
        });
    }

    // <<boutons de filtre : adresse => libellé>>
    $filtres = [
        ''           => 'Toutes',
        'en-attente' => 'En attente',
        'en-cours'   => 'En cours',
        'livree'     => 'Livrée',
        'annulee'    => 'Annulée',
    ];

    return view('admin.commandes', [
        'commandes' => $resultat->values()->all(),
        'filtres'   => $filtres,
        'statut'    => $statut,
        'q'         => $q,
    ]);
});

// <<afficher la page produits>>
Route::get('/produits', function (\Illuminate\Http\Request $request) use ($produits) {


    // <<totaux : calculés sur toute la liste>>
    $totaux = [
        'total'     => count($produits),
        'stock-bas' => collect($produits)->whereNotNull('alerte')->count(),
        'valeur'    => collect($produits)->sum(fn ($p) => $p['quantite'] * $p['prix']),
    ];

    // <<recherche>>
    $q = trim((string) $request->query('q'));

    $liste = collect($produits)
        ->when($q !== '', fn ($c) => $c->filter(
            fn ($p) => stripos($p['nom'] . ' ' . $p['categorie'], $q) !== false
        ))
        ->values()
        ->all();

    return view('admin.produits', [
        'produits' => $liste,
        'totaux'   => $totaux,
        'q'        => $q,
    ]);
});

// <<déconnexion>>
Route::post('/logout', function (\Illuminate\Http\Request $request) {

    // <<à intégrer : appel API de déconnexion (invalider le token)>>

    // <<fermeture de la session web>>
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // <<retour à la page de connexion>>
    return redirect('/login');
});

// <<afficher la fiche d'un livreur>>
Route::get('/livreurs/{id}', function ($id) use ($livreurs, $tricycles) {

    // <<recherche du livreur par son numéro>>
    $livreur = collect($livreurs)->firstWhere('id', (int) $id);

    // <<si le livreur n'existe pas : page 404>>
    abort_if(! $livreur, 404);

    // <<tricycle rattaché à ce livreur>>
    $tricycle = collect($tricycles)->firstWhere('livreur', $livreur['nom']);

    return view('admin.livreur-detail', [
        'livreur'  => $livreur,
        'tricycle' => $tricycle,
    ]);
})->whereNumber('id');

// <<désactivation d'un livreur>>
Route::post('/livreurs/{id}/desactiver', function ($id) use ($livreurs) {

    $livreur = collect($livreurs)->firstWhere('id', (int) $id);
    abort_if(! $livreur, 404);

    // <<à intégrer: appel API de désactivation du livreur>>

    // <<retour à la liste avec message de succès>>
    return redirect('/livreurs')->with('succes', $livreur['nom'] . ' a été désactivé.');
})->whereNumber('id');

// <<afficher le formulaire de modification d'un livreur>>
Route::get('/livreurs/{id}/modifier', function ($id) use ($livreurs) {

    $livreur = collect($livreurs)->firstWhere('id', (int) $id);
    abort_if(! $livreur, 404);

    // <<le téléphone est affiché sans espaces, comme le format attendu>>
    $livreur['telephone'] = str_replace(' ', '', $livreur['telephone']);

    // <<zones de livraison>>
    $zones = ['Sacré-Cœur', 'Almadies', 'Mamelles', 'Maristes', 'Pikine', 'Keur Massar'];

    return view('admin.livreur-modifier', [
        'livreur' => $livreur,
        'zones'   => $zones,
    ]);
})->whereNumber('id');

// <<envoi du formulaire de modification d'un livreur>>
Route::put('/livreurs/{id}', function (\Illuminate\Http\Request $request, $id) use ($livreurs) {

    $livreur = collect($livreurs)->firstWhere('id', (int) $id);
    abort_if(! $livreur, 404);

    // <<validation des champs>>
    $request->validate([
        'nom'       => 'required|min:3',
        'telephone' => ['required', 'regex:/^7[05678][0-9]{7}$/'],
        'zone'      => 'required',
    ], [
        // <<messages d'erreur en français>>
        'nom.required'       => 'Saisissez le nom complet.',
        'nom.min'            => 'Le nom doit contenir au moins 3 caractères.',
        'telephone.required' => 'Saisissez le numéro de téléphone.',
        'telephone.regex'    => 'Numéro invalide : 9 chiffres, sans espaces (ex. 771234567).',
        'zone.required'      => 'Choisissez une zone d\'activité.',
    ]);

    // <<à intégrer: appel API de modification du livreur>>

    // <<retour à la fiche avec message de succès>>
    return redirect('/livreurs/' . $id)->with('succes', 'Informations mises à jour.');
})->whereNumber('id');

// <<afficher le formulaire de modification d'un tricycle>>
Route::get('/tricycles/{id}/modifier', function ($id) use ($tricycles, $livreurs) {

    $tricycle = collect($tricycles)->firstWhere('id', (int) $id);
    abort_if(! $tricycle, 404);

    // <<zones de livraison>>
    $zones = ['Sacré-Cœur', 'Almadies', 'Mamelles', 'Maristes', 'Pikine', 'Keur Massar'];

    // <<livreurs déjà rattachés à un AUTRE tricycle>>
    $autresAttribues = collect($tricycles)
        ->where('id', '!=', $tricycle['id'])
        ->pluck('livreur')
        ->filter()
        ->all();

    // <<livreurs proposés : ceux qui ne sont pas pris par un autre tricycle>>
    $disponibles = collect($livreurs)->pluck('nom')->diff($autresAttribues)->values()->all();

    return view('admin.tricycle-modifier', [
        'tricycle' => $tricycle,
        'zones'    => $zones,
        'livreurs' => $disponibles,
    ]);
})->whereNumber('id');

// <<envoi du formulaire de modification d'un tricycle>>
Route::put('/tricycles/{id}', function (\Illuminate\Http\Request $request, $id) use ($tricycles) {

    $tricycle = collect($tricycles)->firstWhere('id', (int) $id);
    abort_if(! $tricycle, 404);

    // <<validation des champs>>
    $request->validate([
        'plaque'  => ['required', 'regex:/^[A-Z]{2}-[0-9]{3}-[A-Z]{2}$/'],
        'zone'    => 'required',
        'livreur' => 'required',
    ], [
        // <<messages d'erreur en français>>
        'plaque.required'  => 'Saisissez la plaque d\'immatriculation.',
        'plaque.regex'     => 'Format invalide : 2 lettres, 3 chiffres, 2 lettres en majuscules (ex. AA-234-DK).',
        'zone.required'    => 'Choisissez une zone d\'activité.',
        'livreur.required' => 'Choisissez le livreur rattaché.',
    ]);

    // <<à intégrer: appel API de modification du tricycle>>

    // <<retour à la liste avec message de succès>>
    return redirect('/tricycles')->with('succes', 'Tricycle mis à jour.');
})->whereNumber('id');

// <<retrait d'un tricycle>>
Route::delete('/tricycles/{id}', function ($id) use ($tricycles) {

    $tricycle = collect($tricycles)->firstWhere('id', (int) $id);
    abort_if(! $tricycle, 404);

    // <<à intégrer: appel API de suppression du tricycle>>

    // <<retour à la liste avec message de succès>>
    return redirect('/tricycles')->with('succes', 'Le tricycle ' . $tricycle['plaque'] . ' a été retiré.');
})->whereNumber('id');

// <<afficher le formulaire d'ajout d'un produit>>
Route::get('/produits/creer', function () {

    // <<catégories et unités>>
    $categories = ['Fruits', 'Légumes', 'Poissons'];
    $unites     = ['kg' => 'Kilogramme (kg)', 'pc' => 'Pièce (pc)'];

    return view('admin.produit-creer', [
        'categories' => $categories,
        'unites'     => $unites,
    ]);
});

// <<envoi du formulaire d'ajout d'un produit>>
Route::post('/produits', function (\Illuminate\Http\Request $request) {

    // <<validation des champs>>
    $request->validate([
        'nom'       => 'required|min:2',
        'categorie' => 'required|in:Fruits,Légumes,Poissons',
        'quantite'  => 'required|numeric|min:0',
        'unite'     => 'required|in:kg,pc',
        'prix'      => 'required|integer|min:1',
    ], [
        // <<messages d'erreur en français>>
        'nom.required'       => 'Saisissez le nom du produit.',
        'nom.min'            => 'Le nom doit contenir au moins 2 caractères.',
        'categorie.required' => 'Choisissez une catégorie.',
        'categorie.in'       => 'Catégorie invalide.',
        'quantite.required'  => 'Saisissez la quantité en stock.',
        'quantite.numeric'   => 'La quantité doit être un nombre.',
        'quantite.min'       => 'La quantité ne peut pas être négative.',
        'unite.required'     => 'Choisissez une unité.',
        'unite.in'           => 'Unité invalide.',
        'prix.required'      => 'Saisissez le prix.',
        'prix.integer'       => 'Le prix doit être un nombre entier, en francs CFA.',
        'prix.min'           => 'Le prix doit être supérieur à 0.',
    ]);

    // <<à intégrer: appel API de création du produit>>

    // <<retour à la liste avec message de succès>>
    return redirect('/produits')->with('succes', 'Produit ajouté avec succès.');
});

// <<afficher le formulaire de modification d'un produit>>
Route::get('/produits/{id}/modifier', function ($id) use ($produits) {

    $produit = collect($produits)->firstWhere('id', (int) $id);
    abort_if(! $produit, 404);

    // <<catégories et unités>>
    $categories = ['Fruits', 'Légumes', 'Poissons'];
    $unites     = ['kg' => 'Kilogramme (kg)', 'pc' => 'Pièce (pc)'];

    return view('admin.produit-modifier', [
        'produit'    => $produit,
        'categories' => $categories,
        'unites'     => $unites,
    ]);
})->whereNumber('id');

// <<envoi du formulaire de modification d'un produit>>
Route::put('/produits/{id}', function (\Illuminate\Http\Request $request, $id) use ($produits) {

    $produit = collect($produits)->firstWhere('id', (int) $id);
    abort_if(! $produit, 404);

    // <<validation des champs>>
    $request->validate([
        'nom'       => 'required|min:2',
        'categorie' => 'required|in:Fruits,Légumes,Poissons',
        'quantite'  => 'required|numeric|min:0',
        'unite'     => 'required|in:kg,pc',
        'prix'      => 'required|integer|min:1',
    ], [
        // <<messages d'erreur en français>>
        'nom.required'       => 'Saisissez le nom du produit.',
        'nom.min'            => 'Le nom doit contenir au moins 2 caractères.',
        'categorie.required' => 'Choisissez une catégorie.',
        'categorie.in'       => 'Catégorie invalide.',
        'quantite.required'  => 'Saisissez la quantité en stock.',
        'quantite.numeric'   => 'La quantité doit être un nombre.',
        'quantite.min'       => 'La quantité ne peut pas être négative.',
        'unite.required'     => 'Choisissez une unité.',
        'unite.in'           => 'Unité invalide.',
        'prix.required'      => 'Saisissez le prix.',
        'prix.integer'       => 'Le prix doit être un nombre entier, en francs CFA.',
        'prix.min'           => 'Le prix doit être supérieur à 0.',
    ]);

    // <<à intégrer: appel API de modification du produit>>

    // <<retour à la liste avec message de succès>>
    return redirect('/produits')->with('succes', 'Produit mis à jour.');
})->whereNumber('id');

// <<retrait d'un produit>>
Route::delete('/produits/{id}', function ($id) use ($produits) {

    $produit = collect($produits)->firstWhere('id', (int) $id);
    abort_if(! $produit, 404);

    // <<à intégrer: appel API de suppression du produit>>

    // <<retour à la liste avec message de succès>>
    return redirect('/produits')->with('succes', $produit['nom'] . ' a été retiré du catalogue.');
})->whereNumber('id');

// <<afficher la fiche d'une commande>>
Route::get('/commandes/{id}', function ($id) use ($commandes) {

    $commande = collect($commandes)->firstWhere('id', (int) $id);
    abort_if(! $commande, 404);

    // <<total calculé à partir des articles>>
    $total = collect($commande['articles'])->sum(fn ($a) => $a['quantite'] * $a['prix']);

    // <<annulation possible seulement si la commande n'est pas terminée>>
    $annulable = in_array($commande['classe'], ['en-attente', 'en-cours']);

    return view('admin.commande-detail', [
        'commande'  => $commande,
        'total'     => $total,
        'annulable' => $annulable,
    ]);
})->whereNumber('id');

// <<annulation d'une commande>>
Route::post('/commandes/{id}/annuler', function ($id) use ($commandes) {

    $commande = collect($commandes)->firstWhere('id', (int) $id);
    abort_if(! $commande, 404);

    // <<à intégrer: appel API d'annulation de la commande>>

    // <<retour à la fiche avec message de succès>>
    return redirect('/commandes/' . $id)->with('succes', 'La commande ' . $commande['numero'] . ' a été annulée.');
})->whereNumber('id');

// <<réactivation d'un livreur>>
Route::post('/livreurs/{id}/reactiver', function ($id) use ($livreurs) {

    $livreur = collect($livreurs)->firstWhere('id', (int) $id);
    abort_if(! $livreur, 404);

    // <<à intégrer: appel API de réactivation du livreur>>

    // <<retour à la fiche avec message de succès>>
    return redirect('/livreurs/' . $id)->with('succes', $livreur['nom'] . ' a été réactivé.');
})->whereNumber('id');

// <<étape 1 : afficher la page mot de passe oublié>>
Route::get('/mot-de-passe-oublie', function () {
    return view('admin.mot-de-passe-oublie');
});

// <<étape 1 : réception de l'identifiant>>
Route::post('/mot-de-passe-oublie', function (\Illuminate\Http\Request $request) {

    $saisie = trim((string) $request->input('identifiant'));

    // <<champ vide>>
    if ($saisie === '') {
        return back()->withErrors(['identifiant' => 'Saisissez votre email ou votre numéro de téléphone.']);
    }

    // <<téléphone nettoyé : sans espaces, tirets, points ni indicatif +221>>
    $telephone = preg_replace('/[\s\-.]/', '', $saisie);
    $telephone = preg_replace('/^(\+?221)/', '', $telephone);

    // <<détection du canal d'après le format saisi>>
    if (filter_var($saisie, FILTER_VALIDATE_EMAIL)) {
        $canal       = 'email';
        $identifiant = $saisie;
        [$nom, $domaine] = explode('@', $saisie, 2);
        $destination = substr($nom, 0, 1) . '***@' . $domaine;
    } elseif (preg_match('/^7[05678][0-9]{7}$/', $telephone)) {
        $canal       = 'sms';
        $identifiant = $telephone;
        $destination = substr($telephone, 0, 2) . ' *** ** ' . substr($telephone, -2);
    } else {
        return back()->withErrors(['identifiant' => 'Saisissez une adresse email valide ou un numéro à 9 chiffres (ex. 771234567).'])->withInput();
    }

    // <<à intégrer: appel API pour envoyer le code (SMS ou email selon $canal)>>

    // <<on garde en session ce qu'il faut pour les écrans suivants>>
    $request->session()->put([
        'reset_identifiant' => $identifiant,
        'reset_canal'       => $canal,
        'reset_destination' => $destination,
        'reset_verifie'     => false,
    ]);

    return redirect('/mot-de-passe-oublie/code');
});

// <<étape 2 : afficher la saisie du code>>
Route::get('/mot-de-passe-oublie/code', function (\Illuminate\Http\Request $request) {

    // <<verrou : on doit avoir passé l'étape 1>>
    if (! $request->session()->has('reset_identifiant')) {
        return redirect('/mot-de-passe-oublie');
    }

    return view('admin.mot-de-passe-code', [
        'canal'       => $request->session()->get('reset_canal'),
        'destination' => $request->session()->get('reset_destination'),
    ]);
});

// <<étape 2 : vérification du code>>
Route::post('/mot-de-passe-oublie/code', function (\Illuminate\Http\Request $request) {

    if (! $request->session()->has('reset_identifiant')) {
        return redirect('/mot-de-passe-oublie');
    }

    // <<validation du format : exactement 6 chiffres>>
    $request->validate([
        'code' => ['required', 'digits:6'],
    ], [
        'code.required' => 'Saisissez le code reçu.',
        'code.digits'   => 'Le code contient exactement 6 chiffres.',
    ]);

    // <<à intégrer: vérifier le code auprès de l'API>>
    // <<code de démonstration : à supprimer>>
    if ($request->input('code') !== '123456') {
        return back()->withErrors(['code' => 'Code incorrect ou expiré.']);
    }

    // <<code bon : l'étape 3 est maintenant autorisée>>
    $request->session()->put('reset_verifie', true);

    return redirect('/mot-de-passe-oublie/nouveau');
});

// <<étape 2 : renvoyer le code>>
Route::post('/mot-de-passe-oublie/renvoyer', function (\Illuminate\Http\Request $request) {

    if (! $request->session()->has('reset_identifiant')) {
        return redirect('/mot-de-passe-oublie');
    }

    // <<à intégrer: appel API pour renvoyer un nouveau code>>

    return redirect('/mot-de-passe-oublie/code')->with('succes', 'Un nouveau code vient d\'être envoyé.');
});

// <<étape 3 : afficher le choix du nouveau mot de passe>>
Route::get('/mot-de-passe-oublie/nouveau', function (\Illuminate\Http\Request $request) {

    // <<verrou : le code doit avoir été vérifié>>
    if (! $request->session()->get('reset_verifie')) {
        return redirect('/mot-de-passe-oublie');
    }

    return view('admin.mot-de-passe-nouveau');
});

// <<étape 3 : enregistrement du nouveau mot de passe>>
Route::post('/mot-de-passe-oublie/nouveau', function (\Illuminate\Http\Request $request) {

    if (! $request->session()->get('reset_verifie')) {
        return redirect('/mot-de-passe-oublie');
    }

    // <<validation : 8 caractères minimum + confirmation identique>>
    $request->validate([
        'password' => 'required|min:8|confirmed',
    ], [
        'password.required'  => 'Saisissez le nouveau mot de passe.',
        'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
        'password.confirmed' => 'Les deux mots de passe ne sont pas identiques.',
    ]);

    // <<à intégrer: enregistrer le nouveau mot de passe via l'API>>

    // <<on efface la mémoire de la réinitialisation>>
    $request->session()->forget(['reset_identifiant', 'reset_canal', 'reset_destination', 'reset_verifie']);

    // <<retour à la connexion avec message de succès>>
    return redirect('/login')->with('succes', 'Mot de passe modifié. Vous pouvez vous connecter.');
});

// <<afficher le stock du jour de tous les tricycles>>
Route::get('/stock', function () use ($tricycles, $stocks, $etiquettesStock) {

    $liste = collect($tricycles)->map(function ($t) use ($stocks, $etiquettesStock) {
        $stock = $stocks[$t['id']] ?? ['statut' => 'vide', 'lignes' => []];

        return [
            'id'          => $t['id'],
            'plaque'      => $t['plaque'],
            'livreur'     => $t['livreur'],
            'cle'         => $stock['statut'],
            'statut'      => $etiquettesStock[$stock['statut']][0],
            'classe'      => $etiquettesStock[$stock['statut']][1],
            'nb_produits' => count($stock['lignes']),
        ];
    })->all();

    // <<compteurs par statut de remplissage>>
    $compteurs = [
        'confirme' => collect($liste)->where('cle', 'confirme')->count(),
        'attente'  => collect($liste)->where('cle', 'attente')->count(),
        'vide'     => collect($liste)->where('cle', 'vide')->count(),
    ];

    return view('admin.stock', [
        'tricycles' => $liste,
        'compteurs' => $compteurs,
    ]);
});

// <<afficher le détail du stock d'un tricycle>>
Route::get('/stock/{id}', function ($id) use ($tricycles, $stocks, $produits, $etiquettesStock) {

    $tricycle = collect($tricycles)->firstWhere('id', (int) $id);
    abort_if(! $tricycle, 404);

    $stock = $stocks[$tricycle['id']] ?? ['statut' => 'vide', 'lignes' => []];

    // <<calcul du restant pour chaque produit>>
    $lignes = collect($stock['lignes'])->map(function ($l) use ($produits) {
        $produit = collect($produits)->firstWhere('id', $l['produit_id']);
        $restant = $l['initial'] - $l['appli'] - $l['rue'];

        return [
            'nom'     => $produit['nom'],
            'icone'   => $produit['icone'],
            'unite'   => $produit['unite'],
            'initial' => $l['initial'],
            'appli'   => $l['appli'],
            'rue'     => $l['rue'],
            'restant' => $restant,
            'bas'     => $restant <= $l['initial'] * 0.2,
        ];
    })->all();

    return view('admin.stock-detail', [
        'tricycle' => $tricycle,
        'statut'   => $etiquettesStock[$stock['statut']][0],
        'classe'   => $etiquettesStock[$stock['statut']][1],
        'lignes'   => $lignes,
    ]);
})->whereNumber('id');

// <<afficher le formulaire de remplissage du stock>>
Route::get('/stock/{id}/remplir', function ($id) use ($tricycles, $stocks, $produits) {

    $tricycle = collect($tricycles)->firstWhere('id', (int) $id);
    abort_if(! $tricycle, 404);

    // <<quantités actuelles : [produit_id => quantité remplie]>>
    $actuel = collect($stocks[$tricycle['id']]['lignes'] ?? [])
        ->pluck('initial', 'produit_id')
        ->all();

    return view('admin.stock-remplir', [
        'tricycle' => $tricycle,
        'produits' => $produits,
        'actuel'   => $actuel,
    ]);
})->whereNumber('id');

// <<envoi du remplissage du stock>>
Route::put('/stock/{id}', function (\Illuminate\Http\Request $request, $id) use ($tricycles, $stocks) {

    $tricycle = collect($tricycles)->firstWhere('id', (int) $id);
    abort_if(! $tricycle, 404);

    // <<validation des champs>>
    $request->validate([
        'quantites'   => 'required|array',
        'quantites.*' => 'nullable|numeric|min:0',
    ], [
        'quantites.*.numeric' => 'Saisissez un nombre.',
        'quantites.*.min'     => 'La quantité ne peut pas être négative.',
    ]);

    $quantites = $request->input('quantites');
    $erreurs   = [];

    // <<au moins un produit doit être rempli>>
    if (collect($quantites)->filter(fn ($q) => (float) $q > 0)->isEmpty()) {
        $erreurs['quantites'] = 'Renseignez la quantité d\'au moins un produit.';
    }

    // <<on ne peut pas descendre en dessous de ce qui est déjà vendu>>
    foreach (($stocks[$tricycle['id']]['lignes'] ?? []) as $ligne) {
        $saisi = $quantites[$ligne['produit_id']] ?? null;
        $vendu = $ligne['appli'] + $ligne['rue'];

        if ($saisi !== null && $saisi !== '' && (float) $saisi < $vendu) {
            $erreurs['quantites.' . $ligne['produit_id']] = 'Impossible : ' . $vendu . ' déjà vendus aujourd\'hui.';
        }
    }

    if ($erreurs) {
        return back()->withErrors($erreurs)->withInput();
    }

    // <<à intégrer: appel API d'enregistrement du stock du jour>>

    // <<retour au détail avec message de succès>>
    return redirect('/stock/' . $id)->with('succes', 'Stock du jour enregistré. Le livreur doit maintenant le confirmer.');
})->whereNumber('id');

// <<afficher la carte des livreurs en grand>>
Route::get('/carte', function () use ($pointsCarte) {
    return view('admin.carte', ['points' => $pointsCarte]);
});

// <<afficher le chiffre d'affaires>>
Route::get('/chiffre-affaires', function (\Illuminate\Http\Request $request) {

    // <<données fictives : une entrée par période>>
    $periodes = [
        'jour' => [
            'libelle'   => "Aujourd'hui",
            'variation' => '+8%',
            'positif'   => true,
            'commandes' => 126,
            'serie'     => ['8h' => 40000, '9h' => 95000, '10h' => 130000, '11h' => 110000, '12h' => 90000, '13h' => 85000, '14h' => 82000],
        ],
        '7j' => [
            'libelle'   => '7 derniers jours',
            'variation' => '+5%',
            'positif'   => true,
            'commandes' => 880,
            'serie'     => ['J-6' => 540000, 'J-5' => 610000, 'J-4' => 580000, 'J-3' => 690000, 'J-2' => 720000, 'Hier' => 810000, 'Auj.' => 632000],
        ],
        '30j' => [
            'libelle'   => '30 derniers jours',
            'variation' => '+11%',
            'positif'   => true,
            'commandes' => 3400,
            'serie'     => ['Sem. 1' => 3950000, 'Sem. 2' => 4280000, 'Sem. 3' => 4510000, 'Sem. 4' => 4582000],
        ],
    ];

    // <<lecture de la période dans l'adresse : "jour" par défaut>>
    $periode = (string) $request->query('periode', 'jour');
    if (! isset($periodes[$periode])) {
        $periode = 'jour';
    }
    $donnees = $periodes[$periode];

    // <<calculs : total, panier moyen, plus grande barre>>
    $total   = array_sum($donnees['serie']);
    $maximum = max($donnees['serie']);
    $panier  = (int) round($total / $donnees['commandes']);

    // <<barres du graphique : hauteur en % de la plus grande>>
    $barres = collect($donnees['serie'])
        ->map(fn ($valeur, $etiquette) => [
            'etiquette' => $etiquette,
            'k'         => round($valeur / 1000),
            'hauteur'   => round($valeur / $maximum * 100),
        ])
        ->values()
        ->all();

    // <<répartitions : [nom, part en %]>>
    $paiements = [['Orange Money', 38], ['Wave', 34], ['Paiement à la livraison', 20], ['Carte bancaire', 8]];
    $zones     = [['Sacré-Cœur', 24], ['Almadies', 22], ['Mamelles', 18], ['Maristes', 14], ['Pikine', 12], ['Keur Massar', 10]];

    // <<ajoute le montant de chaque part>>
    $repartir = fn ($lignes) => collect($lignes)->map(fn ($l) => [
        'nom'     => $l[0],
        'part'    => $l[1],
        'montant' => (int) round($total * $l[1] / 100),
    ])->all();

    // <<boutons de période : adresse => libellé>>
    $filtres = ['jour' => "Aujourd'hui", '7j' => '7 jours', '30j' => '30 jours'];

    return view('admin.chiffre-affaires', [
        'periode'   => $periode,
        'filtres'   => $filtres,
        'donnees'   => $donnees,
        'total'     => $total,
        'panier'    => $panier,
        'barres'    => $barres,
        'paiements' => $repartir($paiements),
        'zones'     => $repartir($zones),
    ]);
});