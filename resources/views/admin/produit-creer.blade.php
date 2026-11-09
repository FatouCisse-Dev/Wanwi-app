@extends('layouts.admin')

@section('titre', 'Nouveau produit')
@section('sous-titre', 'Ajoutez un produit au catalogue')

@section('contenu')

    {{-- <<formulaire d'ajout>> --}}
    <form method="POST" action="{{ url('/produits') }}" class="formulaire-carte">
        @csrf

        {{-- <<champ nom>> --}}
        <label for="nom">Nom du produit</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Ex. Tomates">
        @error('nom')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ catégorie>> --}}
        <label for="categorie">Catégorie</label>
        <select id="categorie" name="categorie">
            <option value="">Choisir une catégorie</option>
            @foreach ($categories as $categorie)
                <option value="{{ $categorie }}" {{ old('categorie') === $categorie ? 'selected' : '' }}>{{ $categorie }}</option>
            @endforeach
        </select>
        @error('categorie')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<quantité et unité côte à côte>> --}}
        <div class="ligne-deux">
            <div>
                <label for="quantite">Quantité en stock</label>
                <input type="text" id="quantite" name="quantite" value="{{ old('quantite') }}" placeholder="Ex. 50">
            </div>
            <div>
                <label for="unite">Unité</label>
                <select id="unite" name="unite">
                    @foreach ($unites as $cle => $libelle)
                        <option value="{{ $cle }}" {{ old('unite') === $cle ? 'selected' : '' }}>{{ $libelle }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @error('quantite')
            <p class="erreur">{{ $message }}</p>
        @enderror
        @error('unite')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ prix>> --}}
        <label for="prix">Prix par unité (en F CFA)</label>
        <input type="text" id="prix" name="prix" value="{{ old('prix') }}" placeholder="Ex. 700">
        @error('prix')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<boutons>> --}}
        <div class="boutons-formulaire">
            <a href="{{ url('/produits') }}" class="bouton-annuler">Annuler</a>
            <button type="submit">✓ Enregistrer</button>
        </div>
    </form>

@endsection