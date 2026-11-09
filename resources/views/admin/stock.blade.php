@extends('layouts.admin')

@section('titre', 'Stock du jour')
@section('sous-titre', 'Remplissage des tricycles')

@section('contenu')

    {{-- <<message de succès>> --}}
    @if (session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif

    {{-- <<lien de retour>> --}}
    <a href="{{ url('/tricycles') }}" class="retour">← Retour aux tricycles</a>

    {{-- <<compteurs>> --}}
    <section class="compteurs">
        <div class="compteur"><span class="puce actif"></span> <strong>{{ $compteurs['confirme'] }}</strong> Confirmés</div>
        <div class="compteur"><span class="puce maintenance"></span> <strong>{{ $compteurs['attente'] }}</strong> En attente</div>
        <div class="compteur"><span class="puce inactif"></span> <strong>{{ $compteurs['vide'] }}</strong> Non remplis</div>
    </section>

    {{-- <<liste des tricycles>> --}}
    <section class="liste-livreurs">
        @foreach ($tricycles as $tricycle)
            <a href="{{ url('/stock/' . $tricycle['id']) }}" class="ligne-livreur lien-ligne">

                {{-- <<icône du tricycle>> --}}
                <div class="avatar-livreur">🛺</div>

                {{-- <<infos du tricycle>> --}}
                <div class="infos-livreur">
                    <p class="ligne-haut">
                        <strong>{{ $tricycle['plaque'] }}</strong>
                        <span class="pastille {{ $tricycle['classe'] }}">{{ $tricycle['statut'] }}</span>
                    </p>
                    <p class="ligne-bas">Livreur : {{ $tricycle['livreur'] ?? 'Non attribué' }}</p>
                </div>

                {{-- <<nombre de produits>> --}}
                <div class="note-livreur">
                    <span class="note">{{ $tricycle['nb_produits'] }} produit(s)</span>
                </div>

            </a>
        @endforeach
    </section>

@endsection