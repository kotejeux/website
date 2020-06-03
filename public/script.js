function confirm_delete_jeu() {
    if (confirm("Supprimer le jeu ?\nAttention, cette action est définitive !")) {
        window.location.replace("{{ jeu.id }}/delete");
    }
}
