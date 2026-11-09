@extends('layouts.admin')

@section('titre', 'Modifier le produit')
@section('sous-titre', 'Mettez à jour ' . $produit['nom'])

@section('contenu')

    {{-- <<formulaire de modification>> --}}
    <form method="POST" action="{{ url('/produits/' . $produit['id']) }}" class="formulaire-carte">
        @csrf
        @method('PUT')

        {{-- <<champ nom>> --}}
        <label for="nom">Nom du produit</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom', $produit['nom']) }}">
        @error('nom')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<champ catégorie>> --}}
        <label for="categorie">Catégorie</label>
        <select id="categorie" name="categorie">
            <option value="">Choisir une catégorie</option>
            @foreach ($categories as $categorie)
                <option value="{{ $categorie }}" {{ old('categorie', $produit['categorie']) === $categorie ? 'selected' : '' }}>{{ $categorie }}</option>
            @endforeach
        </select>
        @error('categorie')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<quantité et unité côte à côte>> --}}
        <div class="ligne-deux">
            <div>
                <label for="quantite">Quantité en stock</label>
                <input type="text" id="quantite" name="quantite" value="{{ old('quantite', $produit['quantite']) }}">
            </div>
            <div>
                <label for="unite">Unité</label>
                <select id="unite" name="unite">
                    @foreach ($unites as $cle => $libelle)
                        <option value="{{ $cle }}" {{ old('unite', $produit['unite']) === $cle ? 'selected' : '' }}>{{ $libelle }}</option>
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
        <input type="text" id="prix" name="prix" value="{{ old('prix', $produit['prix']) }}">
        @error('prix')
            <p class="erreur">{{ $message }}</p>
        @enderror

        {{-- <<boutons>> --}}
        <div class="boutons-formulaire">
            <a href="{{ url('/produits') }}" class="bouton-annuler">Annuler</a>
            <button type="submit">✓ Enregistrer</button>
        </div>
    </form>

    {{-- <<bouton retirer le produit>> --}}
    <div class="zone-danger">
        <button type="button" id="btn-retirer-produit" class="bouton-retirer">🗑 Retirer ce produit</button>
    </div>

    {{-- <<fenêtre de confirmation de retrait>> --}}
    <dialog id="fenetre-retrait-produit" class="fenetre">
        <h2>⚠️ Retirer ce produit ?</h2>
        <p>{{ $produit['nom'] }} sera retiré du catalogue. Cette action ne peut pas être annulée.</p>

        <form method="POST" action="{{ url('/produits/' . $produit['id']) }}">
            @csrf
            @method('DELETE')
            <div class="boutons-fenetre">
                <button type="button" id="annuler-retrait-produit" class="fenetre-annuler">Annuler</button>
                <button type="submit" class="fenetre-confirmer">Retirer</button>
            </div>
        </form>
    </dialog>

    {{-- <<script de la fenêtre>> --}}
    <script>
        const fenetreRetraitProduit = document.getElementById('fenetre-retrait-produit');

        document.getElementById('btn-retirer-produit')
            .addEventListener('click', () => fenetreRetraitProduit.showModal());

        document.getElementById('annuler-retrait-produit')
            .addEventListener('click', () => fenetreRetraitProduit.close());
    </script>

@endsection