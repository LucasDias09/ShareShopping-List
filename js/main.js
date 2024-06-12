// Get the modal
var modal = document.getElementById('insert');
var modalchange = document.getElementById('change');
var modallogout = document.getElementById('logout');
var modalmercado = document.getElementById('mercado');

// Sair da janela sempre que o utilizador clicar fora da janela
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
window.onclick = function(event) {
    if (event.target == modalmercado) {
        modal.style.display = "none";
    }
}
window.onclick = function(event) {
    if (event.target == modallogout) {
        modal.style.display = "none";
    }
}
window.onclick = function(event) {
    if (event.target == modalchange) {
        modalchange.style.display = "none";
    }
}

