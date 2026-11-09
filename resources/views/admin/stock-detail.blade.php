@extends('layouts.admin')

@section('titre', 'Stock du jour')
@section('sous-titre', $tricycle['plaque'])

@section('contenu')

    {{-- <<message de succès>> --}}
    @if (session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif

    {{-- <<lien de retour>> --}}
    <a href="{{ url('/stock') }}" class="retour">← Retour au stock du jour</a>

    <section class="fiche">

        {{-- <<identité du tricycle>> --}}
        <div class="fiche-haut">
            <div class="avatar-livreur gros">🛺</div>
            <div>
                <h2>{{ $tricycle['plaque'] }}</h2>
                <p class="ligne-haut">
                    <span class="pastille {{ $classe }}">{{ $statut }}</span>
                    <span class="code">{{ $tricycle['livreur'] ?? 'Aucun livreur' }}</span>
                </p>
            </div>
        </div>

        {{-- <<tableau du stock>> --}}
        <h3>Stock du jour</h3>

        @if (count($lignes))
            <div class="ligne-stock entete-stock">
                <span>Produit</span>
                <span>Rempli</span>
                <span>Appli</span>
                <span>Rue</span>
                <span>Restant</span>
            </div>

            @foreach ($lignes as $ligne)
                <div class="ligne-stock">
                    <span>{{ $ligne['icone'] }} {{ $ligne['nom'] }}</span>
                    <span>{{ $ligne['initial'] }} {{ $ligne['unite'] }}</span>
                    <span>{{ $ligne['appli'] }}</span>
                    <span>{{ $ligne['rue'] }}</span>
                    <strong class="restant {{ $ligne['bas'] ? 'bas' : '' }}">{{ $ligne['restant'] }}</strong>
                </div>
            @endforeach
        @else
            <p class="vide">Le stock de ce tricycle n'a pas encore été rempli aujourd'hui.</p>
        @endif

        {{-- <<actions>> --}}
        <h3>Actions</h3>
        <div class="boutons-formulaire">
            <a href="{{ url('/stock/' . $tricycle['id'] . '/remplir') }}" class="bouton-annuler">
                ✏️ {{ count($lignes) ? 'Modifier le remplissage' : 'Remplir le stock' }}
            </a>
        </div>

    </section>

@endsection