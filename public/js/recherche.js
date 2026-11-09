// <<recherche en direct>>
const formulaire = document.querySelector('form.recherche');

if (formulaire) {
    const champ = formulaire.querySelector('input[name="q"]');
    let minuteur;
    let derniereRequete = 0;

    // <<demande au serveur et mise à jour de la page>>
    const rechercher = async () => {
        const numero = ++derniereRequete;

        // <<construction de l'adresse avec les champs non vides>>
        const params = new URLSearchParams(new FormData(formulaire));
        for (const [cle, valeur] of [...params]) {
            if (valeur === '') params.delete(cle);
        }
        const adresse = formulaire.action + (params.toString() ? '?' + params : '');

        const reponse = await fetch(adresse);
        const html = await reponse.text();

        // <<on ignore une réponse arrivée trop tard>>
        if (numero !== derniereRequete) return;

        // <<remplacement des zones marquées data-maj>>
        const page = new DOMParser().parseFromString(html, 'text/html');
        const nouvelles = page.querySelectorAll('[data-maj]');
        document.querySelectorAll('[data-maj]').forEach((zone, i) => {
            zone.innerHTML = nouvelles[i].innerHTML;
        });

        // <<mise à jour de l'adresse du navigateur, sans recharger>>
        history.replaceState(null, '', adresse);
    };

    // <<à chaque lettre tapée : on attend 250 ms puis on cherche>>
    champ.addEventListener('input', () => {
        clearTimeout(minuteur);
        minuteur = setTimeout(rechercher, 250);
    });
}