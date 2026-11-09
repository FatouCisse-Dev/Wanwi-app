@extends('layouts.admin')

@section('titre', 'Commandes')
@section('sous-titre', 'Suivi et filtres avancés')

@section('contenu')

    {{-- <<barre de recherche>> --}}
    <form method="GET" action="{{ url('/commandes') }}" class="recherche">
        @if ($statut !== '')
            <input type="hidden" name="statut" value="{{ $statut }}">
        @endif
        <span class="recherche-icone">🔍</span>
        <input type="text" name="q" value="{{ $q }}" placeholder="Rechercher #id, client, livreur...">
    </form>

    {{-- <<boutons de filtre>> --}}
    <nav class="filtres" data-maj>
        @foreach ($filtres as $cle => $libelle)
            <a href="{{ url('/commandes?' . http_build_query(array_filter(['statut' => $cle, 'q' => $q]))) }}"
               class="filtre {{ $statut === (string) $cle ? 'actif' : '' }}">{{ $libelle }}</a>
        @endforeach
    </nav>

    {{-- <<liste des commandes>> --}}
    <section class="liste-commandes" data-maj>
        @forelse ($commandes as $commande)
            <a href="{{ url('/commandes/' . $commande['id']) }}" class="carte-commande lien-ligne">

                {{-- <<numéro et statut>> --}}
                <div class="commande-haut">
                    <strong>{{ $commande['numero'] }}</strong>
                    <span class="pastille {{ $commande['classe'] }}">{{ $commande['statut'] }}</span>
                </div>

                {{-- <<client, livreur, zone>> --}}
                <div class="commande-detail">
                    <p>👤 {{ $commande['client'] }}</p>
                    <p>🛺 {{ $commande['livreur'] }}</p>
                    <p>📍 {{ $commande['zone'] }}</p>
                </div>

                {{-- <<heure et montant>> --}}
                <div class="commande-bas">
                    <span>{{ $commande['heure'] }}</span>
                    <strong>{{ $commande['montant'] }} ›</strong>
                </div>

            </a>
        @empty
            {{-- <<aucun résultat>> --}}
            <p class="vide">Aucune commande ne correspond à votre recherche.</p>
        @endforelse
    </section>

@endsection