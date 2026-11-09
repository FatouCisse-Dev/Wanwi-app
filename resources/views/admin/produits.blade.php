@extends('layouts.admin')

@section('titre', 'Produits')
@section('sous-titre', 'Catalogue & stocks')

@section('contenu')

        {{-- <<message de succès>> --}}
    @if (session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif

    {{-- <<recherche et bouton ajouter>> --}}
    <div class="barre-outils">
        <form method="GET" action="{{ url('/produits') }}" class="recherche">
            <span class="recherche-icone">🔍</span>
            <input type="text" name="q" value="{{ $q }}" placeholder="Rechercher un produit...">
        </form>
                <a href="{{ url('/produits/creer') }}" class="bouton-plus" title="Ajouter un produit">+</a>
    </div>

    {{-- <<résumé du stock>> --}}
    <section class="compteurs">
        <div class="compteur"><strong>{{ $totaux['total'] }}</strong> Total</div>
        <div class="compteur"><strong>{{ $totaux['stock-bas'] }}</strong> Stock bas</div>
        <div class="compteur"><strong>{{ number_format($totaux['valeur'], 0, ',', ' ') }} F</strong> Valeur</div>
    </section>

    {{-- <<grille des produits>> --}}
    <section class="grille-produits" data-maj>
        @forelse ($produits as $produit)
            <a href="{{ url('/produits/' . $produit['id'] . '/modifier') }}" class="carte-produit lien-ligne">

                {{-- <<icône et alerte de stock>> --}}
                <div class="produit-haut">
                    <div class="icone-produit">{{ $produit['icone'] }}</div>
                    @if ($produit['alerte'])
                        <span class="badge-stock {{ strtolower($produit['alerte']) }}">{{ $produit['alerte'] }}</span>
                    @endif
                </div>

                {{-- <<nom et catégorie>> --}}
                <p class="produit-nom">{{ $produit['nom'] }}</p>
                <p class="produit-categorie">{{ $produit['categorie'] }}</p>

                {{-- <<quantité et barre de niveau>> --}}
                <p class="produit-quantite">{{ $produit['quantite'] }} <small>{{ $produit['unite'] }}</small></p>
                <div class="barre">
                    <div class="barre-niveau {{ $produit['alerte'] ? strtolower($produit['alerte']) : '' }}"
                         style="width: {{ $produit['niveau'] }}%;"></div>
                </div>

                {{-- <<prix>> --}}
                <p class="produit-prix">{{ number_format($produit['prix'], 0, ',', ' ') }} F / {{ $produit['unite'] }}</p>

            </a>
        @empty
            {{-- <<aucun résultat>> --}}
            <p class="vide">Aucun produit ne correspond à votre recherche.</p>
        @endforelse
    </section>

@endsection