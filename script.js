// script.js

document.addEventListener('DOMContentLoaded', function() {
    
    const articleForm = document.getElementById('article-form');

    // S'il n'y a pas de formulaire sur la page, ne rien faire.
    if (!articleForm) {
        return;
    }

    // --- FONCTIONNALITÉ : ALERTE DE MODIFICATIONS NON SAUVEGARDÉES ---

    // 1. Récupérer l'état initial du formulaire au chargement de la page.
    const getFormState = (form) => {
        const formData = new FormData(form);
        let state = '';
        // Trier les clés pour s'assurer que l'ordre ne change pas.
        const sortedKeys = Array.from(formData.keys()).sort();
        sortedKeys.forEach(key => {
            state += key + '=' + formData.get(key) + '&';
        });
        return state;
    };
    
    const initialState = getFormState(articleForm);
    let formChanged = false;

    // 2. Détecter les changements dans le formulaire.
    articleForm.addEventListener('input', () => {
        const currentState = getFormState(articleForm);
        formChanged = (initialState !== currentState);
    });

    // 3. Avant que l'utilisateur ne quitte la page (rechargement, fermeture, etc.)...
    window.addEventListener('beforeunload', (event) => {
        // Si le formulaire a été modifié, afficher une demande de confirmation.
        if (formChanged) {
            // Standard pour la plupart des navigateurs modernes.
            event.preventDefault();
            // Pour certains navigateurs plus anciens.
            event.returnValue = '';
        }
    });

    // 4. Si l'utilisateur soumet le formulaire, on désactive l'alerte.
    articleForm.addEventListener('submit', () => {
        formChanged = false;
    });

});