@extends('layouts.admin')

@section('titre', 'Fiche livreur')
@section('sous-titre', $livreur['nom'])

@section('contenu')

    {{-- <<message de succès>> --}}
    @if (session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif
    {{-- <<lien de retour>> --}}
    <a href="{{ url('/livreurs') }}" class="retour">← Retour aux livreurs</a>

    <section class="fiche">

        {{-- <<identité du livreur>> --}}
        <div class="fiche-haut">
            <div class="avatar-livreur gros">
                👤
                <span class="puce-avatar {{ $livreur['classe'] }}"></span>
            </div>
            <div>
                <h2>{{ $livreur['nom'] }}</h2>
                <p class="ligne-haut">
                    <span class="pastille {{ $livreur['classe'] }}">{{ $livreur['statut'] }}</span>
                    <span class="code">{{ $livreur['code'] }}</span>
                </p>
            </div>
        </div>

        {{-- <<statistiques>> --}}
        <div class="fiche-stats">
            <div><strong>{{ $livreur['livraisons'] }}</strong><span>Livraisons</span></div>
            <div><strong>★ {{ $livreur['note'] }}</strong><span>Note</span></div>
            <div><strong>{{ $livreur['taux'] }}</strong><span>Taux</span></div>
        </div>

        {{-- <<informations>> --}}
        <h3>Informations</h3>
        <div class="info-ligne"><span>Téléphone</span><strong>{{ $livreur['telephone'] }}</strong></div>
        <div class="info-ligne"><span>Véhicule</span><strong>{{ $livreur['vehicule'] }}</strong></div>
        <div class="info-ligne"><span>Tricycle</span><strong>{{ $tricycle['plaque'] ?? 'Aucun tricycle' }}</strong></div>
        <div class="info-ligne"><span>Zone</span><strong>{{ $livreur['zone'] }}, Dakar</strong></div>
        <div class="info-ligne"><span>Membre depuis</span><strong>{{ $livreur['membre_depuis'] }}</strong></div>

        {{-- <<activité récente>> --}}
        <h3>Activité récente</h3>
        @foreach ($livreur['historique'] as $evenement)
            <div class="info-ligne">
                <span>{{ $evenement[0] }}</span>
                <small>{{ $evenement[1] }}</small>
            </div>
        @endforeach

        {{-- <<actions>> --}}
        <h3>Actions</h3>
        <div class="boutons-formulaire">
            <a href="{{ url('/livreurs/' . $livreur['id'] . '/modifier') }}" class="bouton-annuler">✏️ Modifier</a>

            @if ($livreur['classe'] !== 'suspendu')
                <button type="button" id="btn-desactiver" class="bouton-danger">⊘ Désactiver</button>
            @else
                <button type="button" id="btn-reactiver" class="bouton-succes">✓ Réactiver</button>
            @endif
        </div>

    </section>

    {{-- <<fenêtre de confirmation de désactivation>> --}}
    <dialog id="fenetre-desactivation" class="fenetre">
        <h2>⚠️ Désactiver ce livreur ?</h2>
        <p>{{ $livreur['nom'] }} ne pourra plus recevoir de commandes tant que son compte n'est pas réactivé.</p>

        <form method="POST" action="{{ url('/livreurs/' . $livreur['id'] . '/desactiver') }}">
            @csrf
            <div class="boutons-fenetre">
                <button type="button" id="annuler-desactivation" class="fenetre-annuler">Annuler</button>
                <button type="submit" class="fenetre-confirmer">Désactiver</button>
            </div>
        </form>
    </dialog>

    {{-- <<script de la fenêtre>> --}}
    <script>
        const fenetreDesactivation = document.getElementById('fenetre-desactivation');
        const boutonDesactiver = document.getElementById('btn-desactiver');

        if (boutonDesactiver) {
            boutonDesactiver.addEventListener('click', () => fenetreDesactivation.showModal());
        }

        document.getElementById('annuler-desactivation')
            .addEventListener('click', () => fenetreDesactivation.close());
    </script>

        {{-- <<fenêtre de confirmation de réactivation>> --}}
    @if ($livreur['classe'] === 'suspendu')
        <dialog id="fenetre-reactivation" class="fenetre">
            <h2>✅ Réactiver ce livreur ?</h2>
            <p>{{ $livreur['nom'] }} pourra de nouveau recevoir des commandes.</p>

            <form method="POST" action="{{ url('/livreurs/' . $livreur['id'] . '/reactiver') }}">
                @csrf
                <div class="boutons-fenetre">
                    <button type="button" id="annuler-reactivation" class="fenetre-annuler">Annuler</button>
                    <button type="submit" class="fenetre-confirmer fenetre-confirmer-vert">Réactiver</button>
                </div>
            </form>
        </dialog>

        {{-- <<script de la fenêtre>> --}}
        <script>
            const fenetreReactivation = document.getElementById('fenetre-reactivation');

            document.getElementById('btn-reactiver')
                .addEventListener('click', () => fenetreReactivation.showModal());

            document.getElementById('annuler-reactivation')
                .addEventListener('click', () => fenetreReactivation.close());
        </script>
    @endif
@endsection