@extends('layouts.admin')

@section('titre', 'Modifier le livreur')
@section('sous-titre', 'Mettez à jour les informations de ' . $livreur['nom'])

@section('contenu')

    {{-- <<formulaire de modification>> --}}
    <form method="POST" action="{{ url('/livreurs/' . $livreur['id']) }}" class="formulaire-carte">
        @csrf
        @method('PUT')

        {{-- <<champ nom>> --}}
        <label for="nom">Nom complet</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom', $livreur['nom']) }}">
        @error('nom')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ téléphone>> --}}
        <label for="telephone">Téléphone</label>
        <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $livreur['telephone']) }}">
        @error('telephone')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ zone d'activité>> --}}
        <label for="zone">Zone d'activité</label>
        <select id="zone" name="zone">
            <option value="">Choisir une zone</option>
            @foreach ($zones as $zone)
                <option value="{{ $zone }}" {{ old('zone', $livreur['zone']) === $zone ? 'selected' : '' }}>{{ $zone }}</option>
            @endforeach
        </select>
        @error('zone')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<boutons>> --}}
        <div class="boutons-formulaire">
            <a href="{{ url('/livreurs/' . $livreur['id']) }}" class="bouton-annuler">Annuler</a>
            <button type="submit">✓ Enregistrer</button>
        </div>
    </form>

@endsection