@extends('layouts.admin')

@section('titre', 'Carte des livreurs')
@section('sous-titre', count($points) . ' livreurs actifs en direct')

@section('contenu')

    {{-- <<lien de retour>> --}}
    <a href="{{ url('/dashboard') }}" class="retour">← Retour au tableau de bord</a>

    {{-- <<grande carte>> --}}
    <section class="carte-livreurs grande">
        @foreach ($points as $point)
            {{-- <<point livreur : touchable>> --}}
            <button type="button" class="point"
                    style="top: {{ $point['haut'] }}%; left: {{ $point['gauche'] }}%;"
                    data-id="{{ $point['id'] }}"
                    data-nom="{{ $point['nom'] }}"
                    data-statut="{{ $point['statut'] }}"
                    data-classe="{{ $point['classe'] }}"
                    data-activite="{{ $point['activite'] }}"
                    data-url="{{ url('/livreurs/' . $point['id']) }}">
                {{ $point['icone'] }}
            </button>
        @endforeach

        {{-- <<point dépôt>> --}}
        <div class="point depot" style="top: 78%; left: 90%;">🏠</div>
    </section>

    {{-- <<panneau d'informations du livreur sélectionné>> --}}
    <section class="panneau-livreur">
        <p id="panneau-vide" class="aide">Touchez un livreur sur la carte pour voir ses informations.</p>

        <div id="panneau-info" hidden>
            <p class="ligne-haut">
                <strong id="p-nom"></strong>
                <span id="p-statut" class="pastille"></span>
            </p>
            <p id="p-activite" class="activite"></p>
            <a id="p-lien" href="#" class="bouton-ajouter">Voir la fiche</a>
        </div>
    </section>

    {{-- <<liste des livreurs actifs>> --}}
    <div class="titre-bloc"><h2>Livreurs actifs</h2></div>
    <section class="liste-livreurs">
        @foreach ($points as $point)
            <a href="{{ url('/livreurs/' . $point['id']) }}" class="ligne-livreur lien-ligne">
                <div class="avatar-livreur">
                    👤
                    <span class="puce-avatar {{ $point['classe'] }}"></span>
                </div>
                <div class="infos-livreur">
                    <p class="ligne-haut">
                        <strong>{{ $point['nom'] }}</strong>
                        <span class="pastille {{ $point['classe'] }}">{{ $point['statut'] }}</span>
                    </p>
                    <p class="activite">{{ $point['activite'] }}</p>
                </div>
            </a>
        @endforeach
    </section>

    {{-- <<script du panneau>> --}}
    <script>
        const pointsCarte = document.querySelectorAll('.point[data-id]');
        const panneauVide = document.getElementById('panneau-vide');
        const panneauInfo = document.getElementById('panneau-info');

        pointsCarte.forEach((point) => {
            point.addEventListener('click', () => {

                // <<un seul point sélectionné à la fois>>
                pointsCarte.forEach((p) => p.classList.remove('selectionne'));
                point.classList.add('selectionne');

                // <<remplissage du panneau>>
                document.getElementById('p-nom').textContent = point.dataset.nom;
                document.getElementById('p-activite').textContent = point.dataset.activite;
                document.getElementById('p-lien').href = point.dataset.url;

                const statut = document.getElementById('p-statut');
                statut.textContent = point.dataset.statut;
                statut.className = 'pastille ' + point.dataset.classe;

                panneauVide.hidden = true;
                panneauInfo.hidden = false;
            });
        });
    </script>

@endsection