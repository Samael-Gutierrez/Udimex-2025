// Modal
const modal = document.getElementById('modal');
const matematicas = document.getElementById('matematicas');
const comprension = document.getElementById('comprension');
const lengua = document.getElementById('lengua');
const analitico = document.getElementById('analitico');

matematicas.addEventListener('change', function() {
    promediar();
  });

comprension.addEventListener('change', function() {
promediar();
});

lengua.addEventListener('change', function() {
promediar();
});

analitico.addEventListener('change', function() {
promediar();
});

function promediar(){
    const c1 = parseFloat(document.getElementById('matematicas').value);
    const c2 = parseFloat(document.getElementById('comprension').value);
    const c3 = parseFloat(document.getElementById('lengua').value);
    const c4 = parseFloat(document.getElementById('analitico').value);

    const c11 = document.getElementById('matematicas2');
    const c12 = document.getElementById('comprension2');
    const c13 = document.getElementById('lengua2');
    const c14 = document.getElementById('analitico2');

    const cal = document.getElementById('cal');
    const send = document.getElementById('send');

    promedios = (c1 + c2 + c3 + c4)/4;
    promedio = parseFloat(promedios.toFixed(1));

    cal.textContent = promedio;

    if(promedio >= 7){
        send.disabled = false;
    }
    if(promedio < 7){
        send.disabled = true;
    }

    c11.value = c1;
    c12.value = c2;
    c13.value = c3;
    c14.value = c4;
}

function togglePopup(tipo, id, prom){
    let content = document.getElementById('content-popup');
    const alumno = document.getElementById('alumno');

    if(tipo == 1){
        content.innerHTML = `
            <h3>Promedio esperado: <span id='espe'>${prom}</span></h3>
        `;
    }

    if(tipo == 2){
        content.innerHTML = `
            <h3>Promedio min: 7.0</h3>
        `;
    }

    alumno.value = id;

    modal.style.display = 'block';
    setTimeout(() => modal.classList.add('show'), 10);

    matematicas.value = "7";
    comprension.value = "7";
    lengua.value = "7";
    analitico.value = "7";
}

function closeModal() {
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);

    setTimeout(() => {
        vaciar();
    }, 1000);
}

function vaciar() {
    content.innerHTML = "";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 500);
    }
}

let contador = 0;

function cambios() {
    const part1 = document.getElementById('part1');
    const part2 = document.getElementById('part2');
    console.log('ya entre');

    if (contador == 0) {
        part1.style.display = 'none';
        part2.style.display = 'flex';
        contador++;
        console.log('Vista 1');
    } else {
        part1.style.display = 'flex';
        part2.style.display = 'none';
        contador--;
        console.log('Vista 2');
    }
}