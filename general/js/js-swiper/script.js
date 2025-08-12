var swiper = new Swiper(".mySwiper", {
  spaceBetween: 30,
  loop: true,
  centeredSlides: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

// Abrir navbar
const nav = document.getElementById("nav");
const abrir = document.getElementById("abrir");
const cerrar = document.getElementById("cerrar");

function closeNavBar() {
  nav.classList.remove("visible");
}

abrir.addEventListener("click", () => {
    nav.classList.add("visible");
})

cerrar.addEventListener("click", () => {
  nav.classList.remove("visible");
})

// Links del navbar
document.getElementById('ofertas').addEventListener('click', () => {
  document.getElementById('ofertas-educativas').scrollIntoView({behavior: 'smooth'});
  closeNavBar();
});

document.getElementById('alumnos').addEventListener('click', () => {
  document.getElementById('nuestros-alumnos').scrollIntoView({behavior: 'smooth'});
  closeNavBar();
});

document.getElementById('contacto').addEventListener('click', () => {
  document.getElementById('contactanos').scrollIntoView({behavior: 'smooth'});
  closeNavBar();
});

// Acciones del Popup
const popup = document.querySelector(".popup");
const backdrop = document.getElementById("backdrop");
let content = document.getElementById("content-popup");

function togglePopup(id,name,tipo) {
    if(tipo == 1){
      console.log('Soy login');
      content.innerHTML = `
        <form class='form' method='POST' action='alumno/login.php' id='login'>
            <h2 id='popup-title'>Alumnos</h2>
            <div class='bar'></div>
            <div class='form-element'>
                <input type='text' id='email' name='us' placeholder='Usuario' required>
            </div>
            <div class='form-element'>
                <input type='password' id='password' name='pas' placeholder='Contraseña' required>
            </div>
            <input type='hidden' id='alumno-name' name='alumno_name'>
            <div class='form-element'>
                <input type='submit' value='Entrar'>
            </div>
            <hr>
        </form>
      `;
      // closeNavBar();
      var elemento = document.getElementById('login');
      elemento.scrollIntoView({ behavior: 'smooth' });
    }

    if(tipo == 2){
        content.innerHTML = `
            <form class='form' id='sendEmail'>
                <h2 id='popup-title'>Correo para ${name}</h2>
                <p>Recuerda dejar algun metodo de contacto para poder responderte.</p>
                <div class='bar'></div>
                <div class='form-element'>
                    <input class='inputs-form' type='text' id='remisor' name='remisor' placeholder='Tu nombre' autocomplete='off' oninput='checkInputs()'>
                </div>
                <div class='form-element'>
                    <input class='inputs-form' type='text' id='asunto' name='asunto' placeholder='Asunto' autocomplete='off' oninput='checkInputs()'>
                </div>
                <div class='form-element'>
                    <input class='inputs-form' type='text' id='contacto' name='contacto' placeholder='Celular o correo' autocomplete='off' oninput='checkInputs()'>
                </div>
                <div class='form-element'>
                    <textarea id='mensaje' class='inputs-form' name='mensaje' placeholder='Escribe tu mensaje' autocomplete='off' oninput='checkInputs()'></textarea>
                </div>
                <input type='hidden' id='destinatario' name='destinatario' value='${name}'>
                <input type='hidden' id='id' name='id' value='${id}'>
                <div class='form-element'>
                    <input type='button' class='disabled' id='btnEnviar' value='ENVIAR' onclick='sendForm();'>
                </div>
            </form>
        `;
        closeNavBar();
        var sendEmail = document.getElementById('sendEmail');
        sendEmail.scrollIntoView({ behavior: 'smooth' });
        backdrop.style.opacity = "1";
        backdrop.style.visibility = "visible";
    }

    popup.classList.add("active");
}

function closePopup() {
  popup.classList.remove("active");
    backdrop.style.opacity = "0";
    backdrop.style.visibility = "hidden";
    content.innerHTML = "";
}

function showLoader(){
  document.getElementById('loader').style.display = 'flex';
}

function hiddeLoader(){
  setTimeout(function() {
          document.getElementById('loader').style.display = 'none';
      }, 50);
  closePopup();
}

document.getElementById("backdrop").addEventListener("click", closePopup);
document.querySelector(".popup .close-btn").addEventListener("click", closePopup);

function sendForm() {
  showLoader(); 

  var formData = $('#sendEmail').serialize();
  remisor = document.getElementById('remisor').value;

  $.ajax({
    url: 'herramientas/mandarEmail.php',
    type: 'POST',
    data: formData,
    success: function(response) {
      console.log(response);
      $('#sendEmail')[0].reset();
      hiddeLoader();
    },
    error: function(xhr, status, error) {
      console.error('Error en la solicitud AJAX: ', status, error);
    }
  });
}

function checkInputs() {
  // Obtiene los valores de los inputs
  const input1 = document.getElementById('remisor').value;
  const input2 = document.getElementById('asunto').value;
  const input3 = document.getElementById('contacto').value;
  const input4 = document.getElementById('mensaje').value;

  // Verifica si todos los inputs tienen algún valor
  const allFilled = input1 !== '' && input2 !== '' && input3 !== '' && input4 !== '';

  // Obtiene el botón
  const submitButton = document.getElementById('btnEnviar');

  if (allFilled) {
      submitButton.classList.add('activated');
      submitButton.classList.remove('disabled');
  } else {
      submitButton.classList.add('disabled');
      submitButton.classList.remove('activated');
  }
}

// ChatBot
function ver_chat(){
  document.getElementById('frame_chat').style.display='block';
  document.getElementById('oc').style.display='block';
}


function oculta_chat(){
  document.getElementById('frame_chat').style.display='none';
  document.getElementById('oc').style.display='none';
}
