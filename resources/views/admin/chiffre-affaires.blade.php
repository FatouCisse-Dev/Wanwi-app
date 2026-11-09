@extends('layouts.admin')

@section('titre', "Chiffre d'affaires")
@section('sous-titre', $donnees['libelle'])

@section('contenu')

    {{-- <<lien de retour>> --}}
    <a href="{{ url('/dashboard') }}" class="retour">← Retour au tableau de bord</a>

    {{-- <<boutons de période>> --}}
    <nav class="filtres">
        @foreach ($filtres as $cle => $libelle)
            <a href="{{ url('/chiffre-affaires?periode=' . $cle) }}"
               class="filtre {{ $periode === $cle ? 'actif' : '' }}">{{ $libelle }}</a>
        @endforeach
    </nav>

    {{-- <<total et indicateurs>> --}}
    <section class="carte-ca">
        <div class="ca-haut">
            <p class="ca-total">{{ number_format($total, 0, ',', ' ') }} F</p>
            <span class="variation {{ $donnees['positif'] ? 'positif' : 'negatif' }}">{{ $donnees['variation'] }}</span>
        </div>
        <p class="libelle">Chiffre d'affaires · {{ $donnees['libelle'] }}</p>

        <div class="ca-meta">
            <div><strong>{{ number_format($donnees['commandes'], 0, ',', ' ') }}</strong> Commandes</div>
            <div><strong>{{ number_format($panier, 0, ',', ' ') }} F</strong> Panier moyen</div>
        </div>
    </section>

    {{-- <<graphique en barres>> --}}
    <section class="carte-ca">
        <h3>Évolution</h3>
        <div class="graphique">
            @foreach ($barres as $barre)
                <div class="colonne">
                    <div class="colonne-zone">
                        <div class="colonne-barre" style="height: {{ $barre['hauteur'] }}%;" title="{{ $barre['k'] }} k F"></div>
                    </div>
                    <span class="colonne-label">{{ $barre['etiquette'] }}</span>
                    <small>{{ $barre['k'] }} k</small>
                </div>
            @endforeach
        </div>
    </section>

    {{-- <<répartition par mode de paiement>> --}}
    <section class="carte-ca">
        <h3>Par mode de paiement</h3>
        @foreach ($paiements as $ligne)
            <div class="repartition-ligne">
                <div class="repartition-haut">
                    <strong>{{ $ligne['nom'] }}</strong>
                    <span>{{ number_format($ligne['montant'], 0, ',', ' ') }} F · {{ $ligne['part'] }}%</span>
                </div>
                <div class="barre"><div class="barre-niveau" style="width: {{ $ligne['part'] }}%;"></div></div>
            </div>
        @endforeach
    </section>

    {{-- <<répartition par zone>> --}}
    <section class="carte-ca">
        <h3>Par zone</h3>
        @foreach ($zones as $ligne)
            <div class="repartition-ligne">
                <div class="repartition-haut">
                    <strong>{{ $ligne['nom'] }}</strong>
                    <span>{{ number_format($ligne['montant'], 0, ',', ' ') }} F · {{ $ligne['part'] }}%</span>
                </div>
                <div class="barre"><div class="barre-niveau" style="width: {{ $ligne['part'] }}%;"></div></div>
            </div>
        @endforeach
    </section>

@endsection