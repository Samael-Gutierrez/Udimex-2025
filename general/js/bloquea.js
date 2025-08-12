function bloquea(elemento) {
    document.getElementById('bloquea').style.display='block';
    document.getElementById('emergente').style.display='block';
    document.getElementById(elemento).focus();
}
