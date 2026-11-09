@extends('layouts.admin')

@section('titre', 'Tricycles')
@section('sous-titre', 'Gestion des véhicules')

@section('contenu')

    {{-- <<message de succès>> --}}
    @if (session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif

    {{-- <<boutons d'actions de la page>> --}}
    <div class="actions-page">
        <a href="{{ url('/tricycles/creer') }}" class="bouton-ajouter">+ Ajouter un tricycle</a>
        <a href="{{ url('/stock') }}" class="bouton-ajouter bouton-secondaire">📦 Stock du jour</a>
    </div>
    
    {{-- <<compteurs>> --}}
    <section class="compteurs">
        <div class="compteur"><span class="puce actif"></span> <strong>{{ $compteurs['actif'] }}</strong> Actifs</div>
        <div class="compteur"><span class="puce maintenance"></span> <strong>{{ $compteurs['maintenance'] }}</strong> En maintenance</div>
        <div class="compteur"><span class="puce inactif"></span> <strong>{{ $compteurs['inactif'] }}</strong> Inactifs</div>
        <div class="compteur"><span class="puce suspendu"></span> <strong>{{ $compteurs['sans-livreur'] }}</strong> Sans livreur</div>
    </section>

    {{-- <<liste des tricycles>> --}}
    <section class="liste-livreurs">
        @foreach ($tricycles as $tricycle)
            <a href="{{ url('/tricycles/' . $tricycle['id'] . '/modifier') }}" class="ligne-livreur lien-ligne">

                {{-- <<icône du tricycle>> --}}
                <div class="avatar-livreur">🛺</div>

                {{-- <<infos du tricycle>> --}}
                <div class="infos-livreur">
                    <p class="ligne-haut">
                        <strong>{{ $tricycle['plaque'] }}</strong>
                        <span class="pastille {{ $tricycle['classe'] }}">{{ $tricycle['statut'] }}</span>
                    </p>

                    {{-- <<livreur rattaché>> --}}
                    <p class="ligne-bas">Livreur : {{ $tricycle['livreur'] ?? 'Non attribué' }}</p>
                </div>

                {{-- <<zone>> --}}
                <div class="note-livreur">
                    <span class="note">📍 {{ $tricycle['zone'] }}</span>
                </div>

            </a>
        @endforeach
    </section>

@endsection