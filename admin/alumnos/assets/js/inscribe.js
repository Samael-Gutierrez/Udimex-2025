const modal = document.getElementById('modal');
const openModalButton = document.getElementById('openModal');
const closeModalButton = document.getElementById('closeModal');
const carreraHidden = document.getElementById('carreraHidden');
const carrera = document.getElementById('carrera');


function sendForm() {
    var formData = $('#sendGroup').serialize();
    
    $.ajax({
        url: 'assets/functions/crearGrupo.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log(response);
            $('#sendGroup')[0].reset();
            closeModalButton.click();
            setTimeout(function() {
                carrera.value = carreraHidden.value;

                let event = new Event('change');
                carrera.dispatchEvent(event);
              }, 500);
        },
        error: function(xhr, status, error) {
        console.error('Error en la solicitud AJAX: ', status, error);
        }
    });
}

$(document).ready(function () {
    $('#carrera').on('change', function () {
		var idCarrera = $(this).val();

		if(idCarrera != ''){
			carreraHidden.value = idCarrera;
			openModal.style.display='inline-block';
		}else{
			openModal.style.display='none';
			carreraHidden.value = 0;
		}

		if (idCarrera !== "") {
			$.ajax({
			url: 'assets/functions/buscar_grupo.php',
			method: 'POST',
			data: { carrera : idCarrera },
			success: function (data) {
				$('#resultado').html(data);
			},
			error: function () {
				$('#resultado').html('Error al obtener los datos.');
			}
			});
		} else {
			$('#resultado').html('');
		}
    });
});

openModalButton.onclick = function() {
    modal.style.display = 'block';
    setTimeout(() => modal.classList.add('show'), 10);
}


closeModalButton.onclick = function() {
    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 500);
    }
}

function checa_edad(){
    curp=document.getElementById('curp').value;
    if(curp.length==18){
        fecha=new Date();
        anio = fecha.getFullYear().toString().slice(-2);			
        anio=parseInt(anio);
        
        mes = fecha.getMonth() + 1; 

        a_nacimiento=curp.charAt(4)+curp.charAt(5);
        a_nacimiento=parseInt(a_nacimiento);
        
        mes_nac=curp.charAt(6)+curp.charAt(7);
        mes_nac=parseInt(mes_nac);

        edad=anio-a_nacimiento;
        
        if(a_nacimiento>anio){
            edad=edad+100;
        }
        
        if(mes_nac>mes){
            edad=edad-1;
        }
        
        capa_edad = document.getElementById('edad');
        p_edad=document.getElementById('p_edad');
        capa_edad.className='w3-panel';
        menor=document.getElementById('menor_edad').style;
        tb_menor=document.getElementById('tb_menor').style;


        if(edad<18){
            if(edad==17){
                diferencia=mes_nac-mes;
                if(diferencia<=0){
                    diferencia=diferencia+12;
                }
                if(diferencia<7){
                    capa_edad.classList.add('w3-pale-yellow');
                    menor.display='block';
                    tb_menor.display='table-row';
                    p_edad.innerHTML="<center>El alumno tiene "+edad+" años de edad, y cumple años en los siguientes "+diferencia+" meses, puede aplicar para curso de 6 meses";
                }
                else{
                    capa_edad.classList.add('w3-pale-red');
                    menor.display='block';
                    tb_menor.display='table-row';
                    p_edad.innerHTML='<center>El alumno tiene '+edad+" años de edad, no puede cursar a 6 meses";
                }
            }
            else{
                capa_edad.classList.add('w3-pale-red');
                menor.display='block';
                tb_menor.display='table-row';
                p_edad.innerHTML='<center>El alumno tiene '+edad+" años de edad, no puede cursar a 6 meses";
            }
        }
        else{
            capa_edad.classList.add('w3-pale-green');
            menor.display='none';
            tb_menor.display='none';
            p_edad.innerHTML="<center>El alumno tiene "+edad+" años, es mayor de edad";
        }
    }
}

