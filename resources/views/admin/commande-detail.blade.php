@extends('layouts.admin')

@section('titre', 'Commande ' . $commande['numero'])
@section('sous-titre', 'Passée à ' . $commande['heure'])

@section('contenu')

    {{-- <<message de succès>> --}}
    @if (session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif

    {{-- <<lien de retour>> --}}
    <a href="{{ url('/commandes') }}" class="retour">← Retour aux commandes</a>

    <section class="fiche">

        {{-- <<numéro et statut>> --}}
        <div class="fiche-haut">
            <div>
                <h2>{{ $commande['numero'] }}</h2>
                <p class="ligne-haut">
                    <span class="pastille {{ $commande['classe'] }}">{{ $commande['statut'] }}</span>
                    <span class="code">{{ $commande['heure'] }}</span>
                </p>
            </div>
        </div>

        {{-- <<informations>> --}}
        <h3>Informations</h3>
        <div class="info-ligne"><span>Client</span><strong>{{ $commande['client'] }}</strong></div>
        <div class="info-ligne"><span>Téléphone</span><strong>{{ $commande['telephone'] }}</strong></div>
        <div class="info-ligne"><span>Livreur</span><strong>{{ $commande['livreur'] }}</strong></div>
        <div class="info-ligne"><span>Adresse</span><strong>{{ $commande['adresse'] }}</strong></div>
        <div class="info-ligne"><span>Paiement</span><strong>{{ $commande['paiement'] }}</strong></div>

        {{-- <<articles commandés>> --}}
        <h3>Articles</h3>
        @foreach ($commande['articles'] as $article)
            <div class="info-ligne">
                <span>{{ $article['nom'] }} · {{ $article['quantite'] }} {{ $article['unite'] }}</span>
                <strong>{{ number_format($article['quantite'] * $article['prix'], 0, ',', ' ') }} F</strong>
            </div>
        @endforeach

        {{-- <<total>> --}}
        <div class="info-ligne total-ligne">
            <span>Total</span>
            <strong>{{ number_format($total, 0, ',', ' ') }} F</strong>
        </div>

        {{-- <<historique de la commande>> --}}
        <h3>Suivi de la commande</h3>
        <ul class="chronologie">
            @foreach ($commande['historique'] as $etape)
                <li>
                    <span>{{ $etape[0] }}</span>
                    <small>{{ $etape[1] }}</small>
                </li>
            @endforeach
        </ul>

        {{-- <<actions>> --}}
        @if ($annulable)
            <h3>Actions</h3>
            <div class="boutons-formulaire">
                <button type="button" id="btn-annuler-commande" class="bouton-danger">⊘ Annuler la commande</button>
            </div>
        @endif

    </section>

    {{-- <<fenêtre de confirmation d'annulation>> --}}
    @if ($annulable)
        <dialog id="fenetre-annulation" class="fenetre">
            <h2>⚠️ Annuler cette commande ?</h2>
            <p>La commande {{ $commande['numero'] }} de {{ $commande['client'] }} sera annulée. Cette action ne peut pas être annulée.</p>

            <form method="POST" action="{{ url('/commandes/' . $commande['id'] . '/annuler') }}">
                @csrf
                <div class="boutons-fenetre">
                    <button type="button" id="garder-commande" class="fenetre-annuler">Garder</button>
                    <button type="submit" class="fenetre-confirmer">Annuler la commande</button>
                </div>
            </form>
        </dialog>

        {{-- <<script de la fenêtre>> --}}
        <script>
            const fenetreAnnulation = document.getElementById('fenetre-annulation');

            document.getElementById('btn-annuler-commande')
                .addEventListener('click', () => fenetreAnnulation.showModal());

            document.getElementById('garder-commande')
                .addEventListener('click', () => fenetreAnnulation.close());
        </script>
    @endif

@endsection