document.getElementById("toggleSidebar").addEventListener("click", function() {
    // Sélection de la barre latérale
    var sidebar = document.querySelector(".sidebar");
    if (sidebar) {
        // Masque ou affiche la barre latérale en changeant la propriété CSS display
        sidebar.classList.toggle("d-none");
    } 
});