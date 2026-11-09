// <<boutons voir / masquer le mot de passe>>
document.querySelectorAll('[data-voir]').forEach((bouton) => {
    const champ = document.getElementById(bouton.dataset.voir);

    bouton.addEventListener('click', () => {
        const estVisible = champ.type === 'text';

        // <<bascule entre texte visible et points>>
        champ.type = estVisible ? 'password' : 'text';

        // <<change l'icône et le nom du bouton>>
        bouton.classList.toggle('actif', ! estVisible);
        bouton.setAttribute(
            'aria-label',
            estVisible ? 'Afficher le mot de passe' : 'Masquer le mot de passe'
        );

        // <<le curseur reste dans le champ>>
        champ.focus();
    });
});