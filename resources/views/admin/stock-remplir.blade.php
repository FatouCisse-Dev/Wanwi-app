@extends('layouts.admin')

@section('titre', 'Remplir le stock')
@section('sous-titre', $tricycle['plaque'])

@section('contenu')

    {{-- <<formulaire de remplissage>> --}}
    <form method="POST" action="{{ url('/stock/' . $tricycle['id']) }}" class="formulaire-carte">
        @csrf
        @method('PUT')

        {{-- <<erreur générale>> --}}
        @error('quantites')
            <p class="erreur erreur-haut">{{ $message }}</p>
        @enderror

        <p class="aide">Quantités remplies ce matin pour ce tricycle. Laissez vide les produits non chargés.</p>

        {{-- <<un champ par produit>> --}}
        @foreach ($produits as $produit)
            <label for="q{{ $produit['id'] }}">{{ $produit['icone'] }} {{ $produit['nom'] }} (en {{ $produit['unite'] }})</label>
            <input type="text" id="q{{ $produit['id'] }}" name="quantites[{{ $produit['id'] }}]"
                   value="{{ old('quantites.' . $produit['id'], $actuel[$produit['id']] ?? '') }}"
                   placeholder="0">
            @error('quantites.' . $produit['id'])
                <p class="erreur">{{ $message }}</p>
            @enderror
        @endforeach

        {{-- <<boutons>> --}}
        <div class="boutons-formulaire">
            <a href="{{ url('/stock/' . $tricycle['id']) }}" class="bouton-annuler">Annuler</a>
            <button type="submit">✓ Enregistrer</button>
        </div>
    </form>

@endsection