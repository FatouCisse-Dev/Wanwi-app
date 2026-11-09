@extends('layouts.admin')

@section('titre', 'Livreurs')
@section('sous-titre', 'Gestion de la flotte')

@section('contenu')

    {{-- <<message de succès>> --}}
    @if (session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif

    {{-- <<boutons d'actions de la page>> --}}
    <div class="actions-page">
        <a href="{{ url('/livreurs/creer') }}" class="bouton-ajouter">+ Ajouter un livreur</a>
        <a href="{{ url('/tricycles') }}" class="bouton-ajouter bouton-secondaire">🛺 Voir les tricycles</a>
    </div>

    {{-- <<compteurs par statut>> --}}
    <section class="compteurs">
        <div class="compteur"><span class="puce en-ligne"></span> <strong>{{ $compteurs['en-ligne'] }}</strong> En ligne</div>
        <div class="compteur"><span class="puce occupe"></span> <strong>{{ $compteurs['occupe'] }}</strong> Occupés</div>
        <div class="compteur"><span class="puce hors-ligne"></span> <strong>{{ $compteurs['hors-ligne'] }}</strong> Hors ligne</div>
        <div class="compteur"><span class="puce suspendu"></span> <strong>{{ $compteurs['suspendu'] }}</strong> Suspendus</div>
    </section>

    {{-- <<barre de recherche>> --}}
    <form method="GET" action="{{ url('/livreurs') }}" class="recherche">
        @if ($statut !== '')
            <input type="hidden" name="statut" value="{{ $statut }}">
        @endif
        <span class="recherche-icone">🔍</span>
        <input type="text" name="q" value="{{ $q }}" placeholder="Rechercher un livreur...">
    </form>

    {{-- <<boutons de filtre>> --}}
    <nav class="filtres" data-maj>
        @foreach ($filtres as $cle => $libelle)
            <a href="{{ url('/livreurs?' . http_build_query(array_filter(['statut' => $cle, 'q' => $q]))) }}"
               class="filtre {{ $statut === (string) $cle ? 'actif' : '' }}">{{ $libelle }}</a>
        @endforeach
    </nav>

    {{-- <<liste des livreurs>> --}}
    <section class="liste-livreurs" data-maj>
        @forelse ($livreurs as $livreur)
            <a href="{{ url('/livreurs/' . $livreur['id']) }}" class="ligne-livreur lien-ligne">

                {{-- <<avatar et point de statut>> --}}
                <div class="avatar-livreur">
                    👤
                    <span class="puce-avatar {{ $livreur['classe'] }}"></span>
                </div>

                {{-- <<infos du livreur>> --}}
                <div class="infos-livreur">
                    <p class="ligne-haut">
                        <strong>{{ $livreur['nom'] }}</strong>
                        <span class="pastille {{ $livreur['classe'] }}">{{ $livreur['statut'] }}</span>
                    </p>
                    <p class="ligne-bas">{{ $livreur['vehicule'] }}</p>
                    <p class="activite">{{ $livreur['activite'] }}</p>
                </div>

                {{-- <<note et nombre de livraisons>> --}}
                <div class="note-livreur">
                    <span class="note">★ {{ $livreur['note'] }}</span>
                    <span>{{ $livreur['livraisons'] }} livr.</span>
                </div>

            </a>
        @empty
            {{-- <<aucun résultat>> --}}
            <p class="vide">Aucun livreur ne correspond à votre recherche.</p>
        @endforelse
    </section>

@endsection