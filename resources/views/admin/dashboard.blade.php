@extends('layouts.admin')

@section('titre', 'Tableau de bord')
@section('sous-titre', "Vue d'ensemble en direct")

@section('contenu')

    {{-- <<cartes de statistiques>> --}}
    <section class="stats">
        @foreach ($stats as $stat)
            <a href="{{ url($stat['lien']) }}" class="carte-stat lien-ligne">

                {{-- <<icône et variation>> --}}
                <div class="carte-haut">
                    <div class="icone-stat">{{ $stat['icone'] }}</div>
                    <span class="variation {{ $stat['positif'] ? 'positif' : 'negatif' }}">
                        {{ $stat['variation'] }}
                    </span>
                </div>

                {{-- <<valeur et libellé>> --}}
                <p class="valeur">{{ $stat['valeur'] }}</p>
                <p class="libelle">{{ $stat['libelle'] }}</p>

            </a>
        @endforeach
    </section>

        {{-- <<titre carte des livreurs>> --}}
    <div class="titre-bloc">
        <h2>Carte des livreurs <small class="en-direct">● En direct</small></h2>
        <span class="badge-actifs">{{ count($livreurs) }} actifs</span>
    </div>

    {{-- <<carte>> --}}
    <a href="{{ url('/carte') }}" class="carte-livreurs carte-cliquable">
        <span class="etiquette-agrandir">⤢ Agrandir</span>
        @foreach ($livreurs as $livreur)
            {{-- <<point livreur>> --}}
            <div class="point" style="top: {{ $livreur['haut'] }}%; left: {{ $livreur['gauche'] }}%;">
                {{ $livreur['icone'] }}
            </div>
        @endforeach

        {{-- <<point dépôt>> --}}
        <div class="point depot" style="top: 78%; left: 90%;">🏠</div>
    </a>

        {{-- <<titre commandes récentes>> --}}
    <div class="titre-bloc">
        <h2>Commandes récentes</h2>
        <a href="{{ url('/commandes') }}">Tout voir →</a>
    </div>

    {{-- <<liste des commandes>> --}}
    <section class="liste-commandes">
        @foreach ($commandes as $commande)
            <a href="{{ url('/commandes/' . $commande['id']) }}" class="ligne-commande lien-ligne">

                {{-- <<icône du statut>> --}}
                <div class="icone-statut {{ $commande['classe'] }}">{{ $commande['icone'] }}</div>

                {{-- <<infos de la commande>> --}}
                <div class="infos-commande">
                    <p class="ligne-haut">
                        <strong>{{ $commande['numero'] }}</strong>
                        <span class="pastille {{ $commande['classe'] }}">{{ $commande['statut'] }}</span>
                    </p>
                    <p class="ligne-bas">{{ $commande['client'] }} · {{ $commande['livreur'] }}</p>
                </div>

                {{-- <<montant et heure>> --}}
                <div class="montant-commande">
                    <strong>{{ $commande['montant'] }}</strong>
                    <span>{{ $commande['heure'] }}</span>
                </div>

            </a>
        @endforeach
    </section>
@endsection