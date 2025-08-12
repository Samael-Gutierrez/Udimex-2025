function muestra(elemento, menuElement) {
    oculta();
    document.getElementById(elemento).style.display='contents';
    
    // Remover clase activa de todos los menús
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
    
    // Agregar clase activa al menú seleccionado
    menuElement.classList.add('active');
}

function oculta() {
    document.getElementById('archivo').style.display='none';
    document.getElementById('inicio').style.display='none';
    document.getElementById('insertar').style.display='none';
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


document.getElementById('fontSelector').addEventListener('change', function() {
    const font = this.value;
    document.execCommand('fontName', false, font);
});

// Cambio de tamaño
document.getElementById('sizeSelector').addEventListener('change', function() {
    document.execCommand('fontSize', false, this.value);
});

function texto_color(color){
	document.execCommand('foreColor', false, color);
}

function texto_fondo(color){
        document.execCommand('hiliteColor', false, color);
}

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

// Insertar enlace
document.getElementById('link').addEventListener('click', () => {
    const url = prompt('Ingrese la URL:', 'https://');
    if (url) {
        document.execCommand('createLink', false, url);
    }
});

// Insertar imagen
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

// Botones de acción
document.getElementById('saveBtn').addEventListener('click', () => {
    alert('Documento guardado con éxito');
});

document.getElementById('printBtn').addEventListener('click', () => {
    window.print();
});

document.getElementById('shareBtn').addEventListener('click', () => {
    alert('Compartiendo documento...');
});

// Evento para actualizar contadores
document.getElementById('editor').addEventListener('input', updateCounters);

// Actualizar contadores al cargar
updateCounters();



// ... código existente ...

// Botones de acción - Archivo
document.getElementById('newBtn').addEventListener('click', () => {
    if (confirm('¿Está seguro de que desea crear un nuevo documento? Se perderán los cambios no guardados.')) {
        document.getElementById('editor').innerHTML = '';
        updateCounters();
    }
});

document.getElementById('openBtn').addEventListener('click', () => {
    alert('Funcionalidad de abrir archivo implementada en el sistema principal');
});

document.getElementById('saveBtn').addEventListener('click', () => {
    alert('Documento guardado con éxito');
});

// Exportar a Word
document.getElementById('exportWordBtn').addEventListener('click', () => {
    const content = document.getElementById('editor').innerHTML;
    const blob = new Blob([`
        <html xmlns:o='urn:schemas-microsoft-com:office:office' 
              xmlns:w='urn:schemas-microsoft-com:office:word' 
              xmlns='http://www.w3.org/TR/REC-html40'>
        <head><meta charset='utf-8'><title>Documento Exportado</title></head>
        <body>${content}</body></html>
    `], {type: 'application/msword'});
    
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'documento.doc';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
});

// Exportar a PDF (usando la API de impresión del navegador)
document.getElementById('exportPdfBtn').addEventListener('click', () => {
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>Documento PDF</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                img { max-width: 100%; }
                table { border-collapse: collapse; width: 100%; }
                table, th, td { border: 1px solid #ddd; }
                th, td { padding: 8px; text-align: left; }
            </style>
        </head>
        <body>
            ${document.getElementById('editor').innerHTML}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
});

// Imprimir solo el contenido del editor
document.getElementById('printBtn').addEventListener('click', () => {
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>Impresión</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                img { max-width: 100%; }
                table { border-collapse: collapse; width: 100%; }
                table, th, td { border: 1px solid #ddd; }
                th, td { padding: 8px; text-align: left; }
            </style>
        </head>
        <body>
            ${document.getElementById('editor').innerHTML}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
});

// ... código existente ...




// ... código existente ...

// Botones de acción - Archivo
document.getElementById('newBtn').addEventListener('click', () => {
    if (confirm('¿Está seguro de que desea crear un nuevo documento? Se perderán los cambios no guardados.')) {
        document.getElementById('editor').innerHTML = `
            <h1>Documento Nuevo</h1>
            <p>Comience a escribir aquí...</p>
        `;
        updateCounters();
    }
});

document.getElementById('openBtn').addEventListener('click', () => {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = '.txt,.docx,.doc,.odt';
    
    input.onchange = e => {
        const file = e.target.files[0];
        if (!file) return;
        
        const extension = file.name.split('.').pop().toLowerCase();
        const reader = new FileReader();
        
        reader.onload = function(event) {
            const content = event.target.result;
            
            switch(extension) {
                case 'txt':
                    openTxtFile(content);
                    break;
                case 'docx':
                case 'doc':
                    openDocxFile(content, file);
                    break;
                case 'odt':
                    openOdtFile(content, file);
                    break;
                default:
                    alert('Formato de archivo no soportado');
            }
        };
        
        if (extension === 'odt') {
            reader.readAsArrayBuffer(file);
        } else {
            reader.readAsText(file);
        }
    };
    
    input.click();
});

// Función para abrir archivos TXT
function openTxtFile(content) {
    document.getElementById('editor').innerText = content;
    updateCounters();
    alert('Archivo TXT cargado con éxito');
}

// Función para abrir archivos DOCX/DOC
function openDocxFile(content, file) {
    try {
        // Convertir DOCX a HTML (simulación)
        const htmlContent = `
            <h2>${file.name}</h2>
            <p>Contenido de documento Word (.docx/.doc)</p>
            <p>${content.substring(0, 500)}...</p>
            <p><em>Nota: En un entorno real, se usaría una librería para convertir DOCX a HTML</em></p>
        `;
        document.getElementById('editor').innerHTML = htmlContent;
        updateCounters();
        alert('Documento Word cargado con éxito (simulado)');
    } catch (error) {
        console.error('Error al abrir documento Word:', error);
        alert('Error al procesar el documento Word');
    }
    
    // Ejemplo con docx.js
const docx = new DOCX.Document();
docx.load(content).then(() => {
    const html = docx.render();
    document.getElementById('editor').innerHTML = html;
});

}



// Función para abrir archivos ODT
function openOdtFile(content, file) {
    try {
        // Convertir ODT a HTML (simulación)
        const htmlContent = `
            <h2>${file.name}</h2>
            <p>Contenido de documento ODT</p>
            <p>${new TextDecoder().decode(content).substring(0, 500)}...</p>
            <p><em>Nota: En un entorno real, se usaría odt2html para convertir ODT a HTML</em></p>
        `;
        document.getElementById('editor').innerHTML = htmlContent;
        updateCounters();
        alert('Documento ODT cargado con éxito (simulado)');
    } catch (error) {
        console.error('Error al abrir documento ODT:', error);
        alert('Error al procesar el documento ODT');
    }
}

// ... resto del código existente ...


// ... código existente ...

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

// Función auxiliar para extraer el ID de un video de YouTube
function getYoutubeId(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

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

// ... resto del código existente ...
