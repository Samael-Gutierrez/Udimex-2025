// archivo.js - Funciones para herramientas de archivo

document.addEventListener('DOMContentLoaded', function() {
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

    /*document.getElementById('openBtn').addEventListener('click', () => {
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
    });*/

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

    // Función para abrir archivos TXT
    /*function openTxtFile(content) {
        document.getElementById('editor').innerText = content;
        updateCounters();
        alert('Archivo TXT cargado con éxito');
    }*/

    // Función para abrir archivos DOCX/DOC
  /*  function openDocxFile(content, file) {
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
        // const docx = new DOCX.Document();
        // docx.load(content).then(() => {
        //     const html = docx.render();
        //     document.getElementById('editor').innerHTML = html;
        // });
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
    }*/
});
