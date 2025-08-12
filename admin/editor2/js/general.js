// general.js - Funciones generales del editor

function muestra(elemento, menuElement) {
    oculta();
    document.getElementById(elemento).style.display = 'contents';
    
    // Remover clase activa de todos los menús
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
    
    // Agregar clase activa al menú seleccionado
    menuElement.classList.add('active');
}

function oculta() {
    document.getElementById('archivo').style.display = 'none';
    document.getElementById('inicio').style.display = 'none';
    document.getElementById('insertar').style.display = 'none';
    document.getElementById('herramientas').style.display = 'none';
}

// Contador de palabras y caracteres
function updateCounters() {
    const editor = document.getElementById('editor');
    const text = editor.innerText;
    
    // Contar palabras (elimina espacios extra y cuenta)
    const words = text.trim().split(/\s+/).filter(word => word.length > 0);
    document.getElementById('wordCount').textContent = words.length;
    
    // Contar caracteres (incluyendo espacios)
    document.getElementById('charCount').textContent = text.length;
}

// Evento para actualizar contadores
document.getElementById('editor').addEventListener('input', updateCounters);

// Actualizar contadores al cargar
window.addEventListener('DOMContentLoaded', updateCounters);






