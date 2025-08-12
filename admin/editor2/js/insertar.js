// insertar.js - Funciones para herramientas de inserción

document.addEventListener('DOMContentLoaded', function() {
    // Insertar enlace
    document.getElementById('link').addEventListener('click', () => {
        const url = prompt('Ingrese la URL:', 'https://');
        if (url) {
            document.execCommand('createLink', false, url);
        }
    });

    // Insertar imagen desde URL
    document.getElementById('image').addEventListener('click', () => {
        const url = prompt('Ingrese la URL de la imagen:', 'https://');
        if (url) {
            document.execCommand('insertImage', false, url);
        }
    });

    // Insertar tabla
    document.getElementById('table').addEventListener('click', () => {
        const rows = prompt('Número de filas:', '2');
        const cols = prompt('Número de columnas:', '2');
        
        if (rows && cols) {
            let tableHTML = '<table border="1" style="border-collapse: collapse; width: 100%;">';
            
            for (let i = 0; i < rows; i++) {
                tableHTML += '<tr>';
                for (let j = 0; j < cols; j++) {
                    tableHTML += `<td style="padding: 8px; border: 1px solid #ccc;">Celda ${i+1}-${j+1}</td>`;
                }
                tableHTML += '</tr>';
            }
            
            tableHTML += '</table>';
            document.execCommand('insertHTML', false, tableHTML);
        }
    });

    // Insertar imagen local
    document.getElementById('imageLocal').addEventListener('click', () => {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        
        input.onchange = e => {
            const file = e.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '70%';
                document.execCommand('insertHTML', false, img.outerHTML);
            };
            reader.readAsDataURL(file);
        };
        
        input.click();
    });

    // Insertar video local
    document.getElementById('videoLocal').addEventListener('click', () => {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'video/*';
        
        input.onchange = e => {
            const file = e.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = function(event) {
                const video = document.createElement('video');
                video.src = event.target.result;
                video.controls = true;
                video.style.maxWidth = '100%';
                video.style.height = 'auto';
                document.execCommand('insertHTML', false, video.outerHTML);
            };
            reader.readAsDataURL(file);
        };
        
        input.click();
    });

    // Insertar video de YouTube
    document.getElementById('videoYoutube').addEventListener('click', () => {
        const url = prompt('Ingrese la URL del video de YouTube:', 'https://www.youtube.com/watch?v=');
        if (url) {
            // Extraer el ID del video
            const videoId = getYoutubeId(url);
            if (videoId) {
                const iframe = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                document.execCommand('insertHTML', false, iframe);
            } else {
                alert('URL de YouTube no válida');
            }
        }
    });

    // Insertar fórmula matemática
    document.getElementById('math').addEventListener('click', () => {
        const latex = prompt('Ingrese la fórmula en LaTeX:');
        if (latex) {
            // Insertamos un span con la clase math para luego renderizar con MathJax
            const mathSpan = `<span class="math">\\[${latex}\\]</span>`;
            document.execCommand('insertHTML', false, mathSpan);
            // Si MathJax está cargado, podemos intentar renderizar
            if (window.MathJax) {
                MathJax.typeset();
            }
        }
    });

    // Función auxiliar para extraer el ID de un video de YouTube
    function getYoutubeId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }
});
