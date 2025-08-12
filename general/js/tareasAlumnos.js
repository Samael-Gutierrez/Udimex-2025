function examenes() {
    const examenes = document.getElementById('examenes');
    examenes.style.display = 'block';
    examenes.scrollIntoView({ behavior: 'smooth' });
}

function examenesOff() {
    document.getElementById('main-container').scrollIntoView({ behavior: 'smooth' });
    const examenes = document.getElementById('examenes');
    examenes.style.display = 'none';
}

function mensaje(tipo, id) {
    let comentario = document.getElementById('comentario-' + id);
    let cal = document.getElementById('cal-' + id);
    let mensaje = '';
    let calificacion = 0;

    if (tipo == 1) {
        mensaje = 'Excelente trabajo ';
        calificacion = 10;
    }
    if (tipo == 2) {
        mensaje = 'Buen trabajo ';
        calificacion = 9;
    }
    if (tipo == 3) {
        mensaje = 'Regular ';
        calificacion = 8;
    }
    if (tipo == 4) {
        mensaje = 'Faltan detalles : ';
        calificacion = 7;
    }

    cal.value = '';
    cal.value = calificacion;

    comentario.value = '';
    comentario.value = mensaje;

    comentario.focus();
}

function checkAndAddId(id) {
    if (!document.getElementById('table-' + id)) {
        innerHTML = "<p class='no-tareas'>Sin tareas registradas</p>";
        const newElement = document.createElement('div');
        newElement.id = 'table-' + id;
        newElement.innerHTML = innerHTML;
        document.body.appendChild(newElement);
    }
}

function ocultarMaterias(id) {
    var table = document.getElementById('table-' + id);
    if (table.style.display === 'block') {
        table.style.display = 'none';
    } else {
        table.style.display = 'block';
    }
}

function sendForm(tarea, tarus) {
    var formulario = $('#form-'+tarea).serialize();
    $.ajax({
        type: 'POST',
        url: 'calificar-tarea.php',
        data: formulario,
        success: function (response) {
            calificar(tarea, tarus);
            closeModal();
        },
        error: function (xhr, status, error) {
            console.error('Error al enviar los datos: ', error);
        }
    });
}

function changeState(id) {
    const visto = document.getElementById('visto-' + id);
    $.ajax({
        url: 'asignarVisto.php',
        type: 'POST',
        data: { miDato: id },
        success: function (respuesta) {
            console.log('Respuesta del servidor:', respuesta);
            visto.style.color = 'green';
            visto.classList.remove('bi-flag');
            visto.classList.add('bi-flag-fill');
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}



function calificar(idTarea, tarus) {
    const calificacion = document.getElementById('cal-' + idTarea);
    const opciones = document.getElementById('opciones-' + idTarea);
    const detalles = document.getElementById('detalles-' + idTarea);
    const ent = document.getElementById('ent-' + idTarea);
    const fecha = document.getElementById('fecha-' + idTarea);

    if(fecha.value == 1){
        ent.innerHTML = '';
        ent.innerHTML = `<p style='color:green'>A tiempo</p>`;
    }

    if(fecha.value == 0){
        ent.innerHTML = '';
        ent.innerHTML = `<p style='color:red'>Tardía</p>`;
    }

    opciones.innerHTML = '';
    opciones.innerHTML = `<i class='bi bi-check-circle-fill' style='color:green'></i>`;

    detalles.innerHTML = '';
    detalles.innerHTML = `<a href='detalles.php?id_tarus=${tarus}' class='btn btn-warning'>Detalles</a>`;

    let valor = parseFloat(calificacion.value);
    if (!isNaN(valor)) {
    calificacion.value = valor.toFixed(2);
    }
    
    document.getElementById('calificacion-' + idTarea).textContent = calificacion.value;
    document.getElementById('estado-' + idTarea).innerHTML = `<p style='color:green'>Revisado</p>`;
}


function closeModal() {
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);

    setTimeout(() => {
        vaciar();
    }, 1000);
    document.getElementById("container-div").focus();
}

function vaciar() {
    content.innerHTML = "";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
        setTimeout(() => {
            vaciar();
        }, 100);
    }
}