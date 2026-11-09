@extends('layouts.admin')

@section('titre', 'Nouveau tricycle')
@section('sous-titre', 'Ajoutez un tricycle à la flotte')

@section('contenu')

    {{-- <<formulaire d'ajout>> --}}
    <form method="POST" action="{{ url('/tricycles') }}" class="formulaire-carte">
        @csrf

        {{-- <<champ plaque>> --}}
        <label for="plaque">Plaque d'immatriculation</label>
        <input type="text" id="plaque" name="plaque" value="{{ old('plaque') }}" placeholder="AA-234-DK">
        @error('plaque')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ zone d'activité>> --}}
        <label for="zone">Zone d'activité</label>
        <select id="zone" name="zone">
            <option value="">Choisir une zone</option>
            @foreach ($zones as $zone)
                <option value="{{ $zone }}" {{ old('zone') === $zone ? 'selected' : '' }}>{{ $zone }}</option>
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
                <option value="{{ $livreur }}" {{ old('livreur') === $livreur ? 'selected' : '' }}>{{ $livreur }}</option>
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

@endsection