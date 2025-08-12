// inicio.js - Funciones para herramientas de inicio

document.addEventListener('DOMContentLoaded', function() {
    // Formato básico de texto
    document.getElementById('bold').addEventListener('click', () => {
        document.execCommand('bold', false, null);
    });

    document.getElementById('italic').addEventListener('click', () => {
        document.execCommand('italic', false, null);
    });

    document.getElementById('underline').addEventListener('click', () => {
        document.execCommand('underline', false, null);
    });

    document.getElementById('strike').addEventListener('click', () => {
        document.execCommand('strikeThrough', false, null);
    });

    // Alineación de texto
    document.getElementById('alignLeft').addEventListener('click', () => {
        document.execCommand('justifyLeft', false, null);
    });

    document.getElementById('alignCenter').addEventListener('click', () => {
        document.execCommand('justifyCenter', false, null);
    });

    document.getElementById('alignRight').addEventListener('click', () => {
        document.execCommand('justifyRight', false, null);
    });

    document.getElementById('alignJustify').addEventListener('click', () => {
        document.execCommand('justifyFull', false, null);
    });

    // Listas
    document.getElementById('listUl').addEventListener('click', () => {
        document.execCommand('insertUnorderedList', false, null);
    });

    document.getElementById('listOl').addEventListener('click', () => {
        document.execCommand('insertOrderedList', false, null);
    });

    // Sangría
    document.getElementById('indent').addEventListener('click', () => {
        document.execCommand('indent', false, null);
    });

    document.getElementById('outdent').addEventListener('click', () => {
        document.execCommand('outdent', false, null);
    });

    // Cambio de fuente
    document.getElementById('fontSelector').addEventListener('change', function() {
        const font = this.value;
        document.execCommand('fontName', false, font);
    });

    // Cambio de tamaño
    document.getElementById('sizeSelector').addEventListener('change', function() {
        document.execCommand('fontSize', false, this.value);
    });

    // Deshacer y rehacer
    document.getElementById('undo').addEventListener('click', () => {
        document.execCommand('undo', false, null);
    });

    document.getElementById('redo').addEventListener('click', () => {
        document.execCommand('redo', false, null);
    });

    // Limpiar formato
    document.getElementById('clear').addEventListener('click', () => {
        document.execCommand('removeFormat', false, null);
    });
});

// Funciones globales para colores
function texto_color(color) {
    document.execCommand('foreColor', false, color);
}

function texto_fondo(color) {
    document.execCommand('hiliteColor', false, color);
}
