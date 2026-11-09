@extends('layouts.admin')

@section('titre', 'Nouveau livreur')
@section('sous-titre', 'Ajoutez un livreur à la flotte')

@section('contenu')

    {{-- <<formulaire d'ajout>> --}}
    <form method="POST" action="{{ url('/livreurs') }}" class="formulaire-carte">
        @csrf

        {{-- <<champ nom>> --}}
        <label for="nom">Nom complet</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Ex. Moussa Diop">
        @error('nom')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ téléphone>> --}}
        <label for="telephone">Téléphone</label>
        <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="771234567">
        @error('telephone')
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

        {{-- <<boutons>> --}}
        <div class="boutons-formulaire">
            <a href="{{ url('/livreurs') }}" class="bouton-annuler">Annuler</a>
            <button type="submit">✓ Enregistrer</button>
        </div>
    </form>

@endsection