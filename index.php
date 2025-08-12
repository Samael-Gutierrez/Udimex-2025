<!doctype html>
<html lang="es-MX">
	<head>
		<meta charset="UTF-8" />
        <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
		<meta name="Udimex" content="Pagina ilustrativa." />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- Main setyles -->
		<link rel="stylesheet" href="general/css/principal_estilo.css" />
		<link rel="stylesheet" href="general/css/principal_estilos.css" />
		<link rel="stylesheet" href="general/css/principal_responsive.css" />
		<!-- Swiper styles -->
		<link rel="stylesheet" href="general/css/swiper-bundle.min.css" />
		<!-- Boostrap Icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
        <!-- Logo -->
        <link rel='icon' href='general/imagen/icono.png' type='image/png' sizes='16x16'>
		<title>Udimex</title>
	</head>
	<body>
        <div class="backdrop" id="backdrop"></div>
        <div class="popup">
            <div class="close-btn">&times;</div>
            <div id="content-popup"></div>
        </div>
        <header>
            <div class="logo">
                <img src="general/imagen/logo.png" alt="">
            </div>
            <button class="abrir-menu" id="abrir"><i class="bi bi-list"></i></button>
            <nav class="nav" id="nav">
            <div class="container-cerrar">
                <button class="cerrar-menu" id="cerrar"><i class="bi bi-box-arrow-left"></i></button>
            </div>
            <ul class="nav-list">
                <li><a  class='hover-underline' onclick="togglePopup(1,'a',1)"><i class="bi bi-person icon-tab"></i> Iniciar Sesión</a></li>
                <li><a id="ofertas" class='hover-underline'><i class="bi bi-cash-stack icon-tab"></i> Ofertas</a></li>
                <li><a id="alumnos" class='hover-underline'><i class="bi bi-people icon-tab"></i> Alumnos</a></li>
                <li><a id="contacto" class='hover-underline'><i class="bi bi-telephone icon-tab"></i> Contáctanos</a></li>
            </ul> 
        </nav>
    </header>
    <div id='loader' class='loader'></div>

	<main class="main dfcr mw" id='main'>
        <img src="general/imagen/pagina/main.png" alt="Efectivo" class="main-img-1 ha">
        <img src="general/imagen/pagina/u.png" alt="Lugar" class="main-img-2 ha">
	</main>

	<section class="s2-carrucel dfcr mw">
        <div class="s2-carrusel-container mySwiper mw">
            <div class="swiper-wrapper">
                <div class="swiper-slide dfcc">
                    <img src="general/imagen/escuela/escuela3.jpg" alt="Ing" class="bs"/></img>
                </div>
                <div class="swiper-slide dfcc">
                    <img src="general/imagen/escuela/escuela2.jpg" alt="Ing" class="bs"/></img>
                </div>
                <div class="swiper-slide dfcc">
                    <img src="general/imagen/escuela/escuela1.jpg" alt="Ing" class="bs"/></img>
                </div>
                <div class="swiper-slide dfcc">
                    <img src="general/imagen/escuela/escuela4.jpg" alt="Ing" class="bs"/></img>
                </div>
                <div class="swiper-slide dfcc">
                    <img src="general/imagen/escuela/escuela5.jpg" alt="Ing" class="bs"/></img>
                </div>
                <div class="swiper-slide dfcc">
                    <img src="general/imagen/escuela/escuela6.jpg" alt="Ing" class="bs"/></img>
                </div>
            </div>
            <div id="ofertas-educativas"></div>
        </div>
	</section>

	<section class="s3-cards-materias dfcc mw">
		<div class="s3-info">
			<h2>Educación de calidad a un click de distancia</h2>
			<h3>Estudia con los profesores más capacitados, obtén un beneficio permanente para tu vida, somos Innovación, somos Creación y somos tu mejor opción</h3>
		</div>
		<div class="s3-cards-container dfcr mw">
			<div class="s3-cards dfcc bs">
                <div class="s3-card-img">
                    <Image src='general/imagen/publicidad-r/escuela13.jpg' class="s3-img" alt="Imagen materia" loading=lazy></Image>
                </div>
                <div class="s3-card-title info dfcr">
                    <h2>Secundaria</h2>
                </div>
                <div class="s3-card-description info dfcr">
                    <a href='https://wa.me/+525665692220?text=Buenas tardes, podría mandarme información sobre la secundaria por favor?' target="_blank">Informes</a>
                </div>
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <div class="s3-cards dfcc bs">
                <div class="s3-card-img">
                    <Image src='general/imagen/publicidad-r/escuela4.jpg' class="s3-img" alt="Imagen materia" loading=lazy></Image>
                </div>
                <div class="s3-card-title info dfcr">
                    <h2>Preparatoria</h2>
                </div>
                <div class="s3-card-description info dfcr">
                    <a href='https://wa.me/+525665692220?text=Buenas tardes, podría mandarme información sobre la preparatoria por favor?' target="_blank">Informes</a>
                </div>
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <div class="s3-cards dfcc bs">
                <div class="s3-card-img">
                    <Image src='general/imagen/publicidad-r/escuela12.jpg' class="s3-img" alt="Imagen materia" loading=lazy></Image>
                </div>
                <div class="s3-card-title info dfcr">
                    <h2>Curso de computación</h2>
                </div>
                <div class="s3-card-description info dfcr">
                    <a href='https://wa.me/+525665692220?text=Buenas tardes, podría mandarme información sobre el curso de compuatción por favor?' target="_blank">Informes</a>
                </div>
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <div class="s3-cards dfcc bs">
                <div class="s3-card-img">
                    <Image src='general/imagen//publicidad-r/licgestion.png' class="s3-img" alt="Imagen materia" loading=lazy></Image>
                </div>
                <div class="s3-card-title info dfcr">
                    <h2>Lic. gestión y administracion publica</h2>
                </div>
                <div class="s3-card-description info dfcr">
                    <a href='https://wa.me/+525665692220?text=Buenas tardes, podría mandarme información sobre la licenciatura en administracion publica por favor?' target="_blank">Informes</a>
                </div>
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <div class="s3-cards dfcc bs">
                <div class="s3-card-img">
                    <Image src='general/imagen/publicidad-r/ingindustrial.jfif' class="s3-img" alt="Imagen materia" loading=lazy></Image>
                </div>
                <div class="s3-card-title info dfcr">
                    <h2>Ing. Industrial</h2>
                </div>
                <div class="s3-card-description info dfcr">
                    <a href='https://wa.me/+525665692220?text=Buenas tardes, podría mandarme información sobre la licenciatura en administracion publica por favor?' target="_blank">Informes</a>
                </div>
            </div>
            <!-- -------------------------------------------------------------------------------- -->
            <div class="s3-cards dfcc bs">
                <div class="s3-card-img">
                    <Image src='general/imagen/publicidad-r/licciencias.jpg' class="s3-img" alt="Imagen materia" loading=lazy></Image>
                </div>
                <div class="s3-card-title info dfcr">
                    <h2>Lic. Ciencias de la Educación</h2>
                </div>
                <div class="s3-card-description info dfcr">
                    <a href='https://wa.me/+525665692220?text=Buenas tardes, podría mandarme información sobre la licenciatura en ciencias de la educacion' target="_blank">Informes</a>
                </div>
            </div>
		</div>
	</section>
	
	<section class="s4-beneficios dfcc mw">
        <div class='s4-beneficios-part1 mw'>
            <p><span class='tcprimary'>Estudia</span> con nosotros y vive la gran <span class="tcsecondary">experiencia</span>.</p>
        </div>

        <div class="s4-beneficios-part2 dfcc mw">
            <div class="beneficios">
                <div class="inciso dfcr"><p>1</p></div>
                <div class="beneficio"><p>Posibilidad de estudiar en línea.</p></div>
            </div>

            <div class="beneficios">
                <div class="inciso dfcr"><p>2</p></div>
                <div class="beneficio"><p>Maestros capacitados en cada especialidad.</p></div>
            </div>

            <div class="beneficios">
                <div class="inciso dfcr"><p>3</p></div>
                <div class="beneficio"><p>Precios accesibles.</p></div>
            </div>

            <div class="beneficios">
                <div class="inciso dfcr"><p>4</p></div>
                <div class="beneficio"><p>Atención por parte de la familia UDIMEX.</p></div>
            </div>

            <div class="beneficios">
                <div class="inciso dfcr"><p>5</p></div>
                <div class="beneficio"><p>Diversidad de cursos y ofertas educativas.</p></div>
            </div>
        </div>
        </section>

	<section class="s4-banner dfcc mw">
		<div class="s4-banner-part1">
            <h2>Inscríbete y obtén tu certificado en pocos meses.</h2>
        </div>

        <div class="s4-banner-part2 dfcr">
            <div class="s4-banner-1 mw">
                <p><span>-</span> Logra tus objetivos.</p>
                <p><span>-</span> Estudia en cualquier hora que tengas disponible en el día.</p>
                <p><span>-</span> Nuestros profesores están 100% capacitados.</p>
                <p><span>-</span> Aprende y desarrolla todo tu potencial con nosotros.</p>
            </div>
            <div class="s4-banner-2 mw">
                <h2 id="nuestros-alumnos">Certificado 100% avalado por la SEP.</h2>
            </div>
        </div>
	</section>

	<section class="s5-testimonios dfcr mw">
		<div class="s5-nosotros mw">
            <!-- Aqui me quede -->
			<h2>Somos una gran comunidad</h2>
			<h3>Forma parte de una gran experiencia que cambiaria tu vida.</h3>
			<p>- Nuestro pizarrón digital se adapta a tus necesidades.</p>
			<p>- La forma de enseñanza es didáctica e interactiva</p>
			<p>- Los docentes siempre estarán al pendiente de tu avance.</p>
			<p  id="contactanos">- Date la oportunidad de ser un estudiante ejemplar y logra tus sueños.</p>
		</div>

		<div class="s5-testimonial mySwiper mw">
            <div class="s5-testimonios-title dfcr">
                <h2>Testimonios</h2>
            </div>
            <div class="swiper-wrapper">
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno1.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Franco Vargas"</span>
                    <p>"Los recomiendo mucho; enseñan de manera dinámica y son pacientes"</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno2.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Álvaro Morales (Lacio)"</span>
                    <p>"Udimex se erige como un faro de excelencia académica y compromiso con el desarrollo integral de sus estudiantes."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno3.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Alondra Corral Julio"</span>
                    <p>"Hay un buen ambiente laboral y estudiantil, dan buenas asesorías."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno4.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Mariana teresita esquivel"</span>
                    <p>"Udimex ha sido una gran experiencia, con un gran compañerismo que contagia la alegría y ganas de seguir adelante."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno5.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Alvaro Garatachia (chino)"</span>
                    <p>"Es una escuela muy buena con profesores altamente capacitados y actualizados."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno6.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Jesús Corral Almazan"</span>
                    <p>"Es una gran oportunidad para superarnos como personas y como estudiantes."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno7.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Rafael Estrada (Haswer)"</span>
                    <p>"Accesible para quienes queremos estudiar desde casa y contamos con poco tiempo libre."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno8.jpg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Areli Quintana"</span>
                    <p>"Buen ambiente estudiantil, LLENO DE APRENDIZAJE."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno9.jpeg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Alexandra Martinez"</span>
                    <p>"Es una gran escuela en la que eh aprendido desde mi inicio y se que sera el principio de muchos éxitos mas."</p>
                </div>
                <div class="s5-slide swiper-slide">
                    <img src="general/imagen/alumnos/alumno10.jpeg" alt="testimonio" class="bs">
                    <span class="s5-testimonio-nombre">"Litzi yesenia palmas"</span>
                    <p>"Excelente escuela, con docentes altamente capacitados y con la pación de enseñar. Es una gran oportunidad de continuar estudiando y alcanzar nuestras metas."</p>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
	</section>

	<section class="s6-ubicacion dfcc mw">
		<div class="s6-title">
			<h2>Ubicación</h2>
		</div>
		<div class="s6-container mw">
			<div class="s6-datos">
				<h2>Udimex Zinacantepec</h2>
				<p><i class="bi bi-geo-alt"></i>Av. 16 de Septiembre 303, San Miguel, 51354 San Miguel Zinacantepec, Méx.</p>
				<p><i class="bi bi-telephone"></i>Télefono: (+52) 566 569 2220</p>
				<p><i class="bi bi-envelope"></i>Email: direccion@udimex.net</p>
				<p class="s6-horarios"><i>Horarios de atención: </i></p>
				<p><i class="bi bi-clock"></i>Lunes a Sábado de 9:00 am a 5:00 pm </p>
				<p><i class="bi bi-clock"></i>Domingo de 9:00 am a 1:00 pm</p>
				<div class="s6-contactanos dfcr mw">
					<a href="https://wa.me/+527221122248" class="s6-boton" target="_blank">Contactanos <i class="bi bi-whatsapp"></i></a>
				</div>
			</div>
			<div class="s6-mapa">
				<iframe title="Mapa UDIMEX" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1119.614378684298!2d-99.7354956860187!3d19.285894010015763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd89064cadc80d%3A0x6dc9d7f6cb83ffcb!2sUDIMEX%20-%20Universidad%20Digital%20de%20M%C3%A9xico!5e0!3m2!1ses-419!2smx!4v1716483191724!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</section>

	<section class="s7-banner mw">
        <h2 class="s7-banner-texto">Termina tu prepa en un solo examen</h2>
	</section>

	<section class="s8-team dfcc mw">
		<h2>Conoce a nuestro equipo de trabajo</h2>
		<h3>Dirección general</h3>
		<div class="s8-card-container dfcr">
            <div class="s8-card dfcc">
                <div class="s8-card-title mw">
                    <h2>Ing. Alfredo T. Dorado</h2>
                </div>

                <div class="s8-card-content mw">
                    <h3>Director General</h3>
                    <div class="s8-content mw">
                        <img src="general/imagen/equipo/alf.jpg" alt="Director" class="bs" loading="lazy">
                        <p>Programador de profesión y docente por vocación, fundador de la escuela y plataforma de UDIMEX.</p>
                    </div>
                </div>

                <div class="s8-card-link mw">
                    <a href='https://wa.me/+527202874706' target="_blank"><i class="bi bi-whatsapp"></i></a>
                    <a onclick="togglePopup(1,'Alfredo T.',2)"><i class="bi bi-envelope"></i></a>
                </div>
            </div>

            <div class="s8-card dfcc">
                <div class="s8-card-title mw">
                    <h2>Lic. Itzel Pineda M.</h2>
                </div>

                <div class="s8-card-content mw">
                    <h3>Control Escolar</h3>
                    <div class="s8-content mw">
                        <img src="general/imagen/equipo/itzel.jpeg" alt="" class="bs" loading="lazy">
                        <p>Joven dedicada, leal y con sentido de responsabilidad; combina liderazgo y gran habilidad para enfrentar retos.</p>
                    </div>
                </div>

                <div class="s8-card-link mw">
                    <a href='https://wa.me/+525665692220' target="_blank"><i class="bi bi-whatsapp"></i></a>
                    <a onclick="togglePopup(2,'Itzel P.',2)"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
		</div>
        <h3>Área de sistemas</h3>
		<div class="s8-card-container dfcr">
            <div class="s8-card dfcc">
                <div class="s8-card-title mw">
                    <h2>Ing. Samael Gutiérrez</h2>
                </div>

                <div class="s8-card-content mw">
                    <h3>Programador</h3>
                    <div class="s8-content mw">
                        <img src="general/imagen/equipo/sama.jpg" alt="" class="bs" loading="lazy">
                        <p>Programador dinámico, combina código y estética para crear experiencias digitales impactantes y agradables.</p>
                    </div>
                </div>

                <div class="s8-card-link mw">
                    <a href='https://wa.me/+525665692220' target="_blank"><i class="bi bi-whatsapp"></i></a>
                    <a onclick="togglePopup(3,'Samael G.',2)"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="s8-card dfcc">
                <div class="s8-card-title mw">
                    <h2>Alvaro Garatachia Chino</h2>
                </div>

                <div class="s8-card-content mw">
                    <h3>Programador</h3>
                    <div class="s8-content mw">
                        <img src="general/imagen/alumnos/alumno5.jpg" alt="" class="bs" loading="lazy">
                        <p>Un buen programador resuelve problemas con lógica, escribe código limpio y se adapta rápidamente a nuevas tecnologías.</p>
                    </div>
                </div>

                <div class="s8-card-link mw">
                    <a href='https://wa.me/+525665692220' target="_blank"><i class="bi bi-whatsapp"></i></a>
                    <a onclick="togglePopup(6,' Alvaro G.',2)"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
		</div>
		<h3>Plantilla docente</h3>
		<div class="s8-card-container dfcr">
            <div class="s8-card dfcc">
                <div class="s8-card-title mw">
                    <h2>Lic. Alondra Vilchis</h2>
                </div>

                <div class="s8-card-content mw">
                    <h3>Docente</h3>
                    <div class="s8-content mw">
                        <img src="general/imagen/equipo/alon.jpeg" alt="" class="bs" loading="lazy">
                        <p>Apasionada educadora, guía comprometida, inspira el aprendizaje, cultiva talentos, nutre curiosidad, transforma vidas con dedicación.</p>
                    </div>
                </div>

                <div class="s8-card-link mw">
                    <a href='https://wa.me/+525665692220' target="_blank"><i class="bi bi-whatsapp"></i></a>
                    <a onclick="togglePopup(4,'Docente Alondra V.',2)"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="s8-card dfcc">
                <div class="s8-card-title mw">
                    <h2>Lic. Miguel A. Arrieta</h2>
                </div>

                <div class="s8-card-content mw">
                    <h3>Docente</h3>
                    <div class="s8-content mw">
                        <img src="general/imagen/equipo/miguel.png" alt="" class="bs" loading="lazy">
                        <p>Persona dinámica, comprometido a sus objetivos y a la constante superación, lleno de energía, entusiasmo y propósito.</p>
                    </div>
                </div>
                <div class="s8-card-link mw">
                    <a href='https://wa.me/+525665692220' target="_blank"><i class="bi bi-whatsapp"></i></a>
                    <a onclick="togglePopup(5,'Docente Miguel A.',2)"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
		</div>
	</section>

    <div align='right' id='chat' onclick='ver_chat();'>
		<img src='general/imagen/chat.png' height='60px' class='w3-margin'>
	</div>
    <iframe src='chat/index.php?c=2' id='frame_chat' hidden></iframe>
    <div id='oc' onclick='oculta_chat();' hidden><img src='chat/imagen/cerrar.png' width='25px'></div>

	<footer class="s9-footer dfcc mw">
		<h2>Todos los derechos reservados ®</h2>
		<div class="s9-redes mw">
			<a href="https://wa.me/+527294504745" target="_blank"><i class="bi bi-whatsapp"></i></a>
			<a href="https://www.facebook.com/www.udimex.net" target="_blank"><i class="bi bi-facebook"></i></a>
			<a href="mailto:=controlescolar@udimex.net" target="_blank"><i class="bi bi-envelope-at"></i></a>
		</div>
	</footer>
    <script src="general/js/js-swiper/swiper-bundle.min.js"></script>
    <script src="general/js/js-swiper/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</body>
</html>
