@extends('layouts.admin')

@section('titre', 'Modifier le tricycle')
@section('sous-titre', 'Mettez à jour ' . $tricycle['plaque'])

@section('contenu')

    {{-- <<formulaire de modification>> --}}
    <form method="POST" action="{{ url('/tricycles/' . $tricycle['id']) }}" class="formulaire-carte">
        @csrf
        @method('PUT')

        {{-- <<champ plaque>> --}}
        <label for="plaque">Plaque d'immatriculation</label>
        <input type="text" id="plaque" name="plaque" value="{{ old('plaque', $tricycle['plaque']) }}">
        @error('plaque')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ zone d'activité>> --}}
        <label for="zone">Zone d'activité</label>
        <select id="zone" name="zone">
            <option value="">Choisir une zone</option>
            @foreach ($zones as $zone)
                <option value="{{ $zone }}" {{ old('zone', $tricycle['zone']) === $zone ? 'selected' : '' }}>{{ $zone }}</option>
            @endforeach
        </select>
        @error('zone')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ livreur rattaché>> --}}
        <label for="livreur">Livreur rattaché</label>
        <select id="livreur" name="livreur">
            <option value="">{{ count($livreurs) ? 'Choisir un livreur' : 'Aucun livreur disponible' }}</option>
            @foreach ($livreurs as $livreur)
                <option value="{{ $livreur }}" {{ old('livreur', $tricycle['livreur']) === $livreur ? 'selected' : '' }}>{{ $livreur }}</option>
            @endforeach
        </select>
        @error('livreur')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<boutons>> --}}
        <div class="boutons-formulaire">
            <a href="{{ url('/tricycles') }}" class="bouton-annuler">Annuler</a>
            <button type="submit">✓ Enregistrer</button>
        </div>
    </form>

    {{-- <<bouton retirer le tricycle>> --}}
    <div class="zone-danger">
        <button type="button" id="btn-retirer" class="bouton-retirer">🗑 Retirer ce tricycle</button>
    </div>

    {{-- <<fenêtre de confirmation de retrait>> --}}
    <dialog id="fenetre-retrait" class="fenetre">
        <h2>⚠️ Retirer ce tricycle ?</h2>
        <p>Le tricycle {{ $tricycle['plaque'] }} sera retiré de la flotte. Cette action ne peut pas être annulée.</p>

        <form method="POST" action="{{ url('/tricycles/' . $tricycle['id']) }}">
            @csrf
            @method('DELETE')
            <div class="boutons-fenetre">
                <button type="button" id="annuler-retrait" class="fenetre-annuler">Annuler</button>
                <button type="submit" class="fenetre-confirmer">Retirer</button>
            </div>
        </form>
    </dialog>

    {{-- <<script de la fenêtre>> --}}
    <script>
        const fenetreRetrait = document.getElementById('fenetre-retrait');

        document.getElementById('btn-retirer')
            .addEventListener('click', () => fenetreRetrait.showModal());

        document.getElementById('annuler-retrait')
            .addEventListener('click', () => fenetreRetrait.close());
    </script>

@endsection