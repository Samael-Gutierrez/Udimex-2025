var c_col=0;
var c_al=0;
var c_gal=0;
var c_tarea=0;
var c_fun=0;

function aleatorio(a,b) {
         return Math.round(Math.random()*(b-a)+parseInt(a));
}

function ejecuta(com, val){
	oculta();
	document.execCommand(com, false, val);
}

function tam(){
	val=document.getElementById('tam').value;
	ejecuta("fontSize", val);
}

function cambia_color(val){
	ejecuta("foreColor", val);
}


function ch_color(){
	if (c_col==0) {
		oculta();
		m_color();
	}
	else{
		o_color();
	}
}

function m_color(){
	c_col=1;
	document.getElementById('colores').style.display = 'block';
}

function o_color(){
	c_col=0;
	document.getElementById('colores').style.display = 'none';
}

function f_alin(al){
	if (al=='iz'){
		ejecuta('justifyLeft');
	}
	if (al=='ce'){
		ejecuta('justifyCenter');
	}
	if (al=='de'){
		ejecuta('justifyRight');
	}
	if (al=='ju'){
		ejecuta('justifyFull');
	}

	f= document.getElementById(al).innerHTML;
	document.getElementById('fig_alin').innerHTML=f;
}

function ch_al(){
	if (c_al==0) {
		oculta();
		m_al();
	}
	else{
		o_al();
	}
}

function m_al(){
	c_al=1;
	document.getElementById('alin').style.display = 'block';
}

function o_al(){
	c_al=0;
	document.getElementById('alin').style.display = 'none';
}

function imagen(im, tam){
	codim="<center><img src='" + im + "' width='" + tam + "%'></center><br>";
	ejecuta("insertHTML",codim);
}

function video(im, tam){
	codim="<center><video src='http://udimex.net/general/video/"+ im + "' width='" + tam + "%' height='480' controls='' autoplay='' loop=''></video></center><br>";
	ejecuta("insertHTML",codim);
}

function pdf(im, tam){
	codim="<center><embed src='http://udimex.net/general/PDF/"+ im + "' type='application/pdf' width='" + tam + "%' height='600px'></center><br>";
	ejecuta("insertHTML",codim);
}

function youtube(codim){
	ejecuta("insertHTML",codim);
}






		function ch_gal(){
			if (c_gal==0) {
				oculta();
				m_gal();
			}
			else{
				o_gal();
			}
		}
		
		function ch_tarea(){

			if (c_tarea==0) {
				oculta();
				m_tarea();
			}
			else{
				o_tarea();
			}
		}

		function m_gal(){
			c_gal=1;
			document.getElementById('galeria').style.display = 'block';
		}

		function o_gal(){
			c_gal=0;
			document.getElementById('galeria').style.display = 'none';
		}
		
		function m_tarea(){
			c_tarea=1;
			document.getElementById('tarea').style.display = 'block';
		}
		
		function o_tarea(){
			c_tarea=0;
			document.getElementById('tarea').style.display = 'none';
		}

		function ch_fun(){
			if (c_fun==0) {
				oculta();
				m_fun();
			}
			else{
				o_fun();
			}
		}

		function m_fun(){
			c_fun=1;
			document.getElementById('funciones').style.display = 'block';
		}

		function o_fun(){
			c_fun=0;
			document.getElementById('funciones').style.display = 'none';
		}

		function i_fra(){
			nom="l"+aleatorio(1,999);
			num=document.getElementById('num').value;
			den=document.getElementById('den').value;
			cod=document.getElementById('editor').innerHTML;
			cod=cod + "&nbsp;<canvas id=\""+nom+"\" height=\"40\">a/b</canvas><script>fraccion(\""+num+"\",\""+den+"\",\""+nom+"\");</script>&nbsp;";
			document.getElementById('editor').innerHTML=cod;
		}

		function i_raiz(){
			nom="l"+aleatorio(1,999);
			num=document.getElementById('n').value;
			cod=document.getElementById('editor').innerHTML;
			cod=cod + "&nbsp;<canvas id=\""+nom+"\" height=\"40\">a/b</canvas><script>raiz(\""+num+"\",\""+nom+"\");</script>&nbsp;";
			document.getElementById('editor').innerHTML=cod;
		}


function oculta(){
	o_gal();
	o_color();
	o_al();
	o_fun();
	o_tarea();

}


		function html(c){
			if (c==1){
				cod=document.getElementById('editor').innerHTML;
				document.getElementById('editor').innerHTML = cod.replace(/</g, "&lt;");
				document.getElementById('her').style.display='none';
				document.getElementById('texto').style.display='block';
			}
			else{
				cod=document.getElementById('editor').innerHTML;
				cod2 = cod.replace(/&lt;/g, "<");
				document.getElementById('editor').innerHTML = cod2.replace(/&gt;/g, ">");
				document.getElementById('her').style.display='block';
				document.getElementById('texto').style.display='none';
			}
		}
