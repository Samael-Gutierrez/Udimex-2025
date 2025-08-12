  
  function emergente(numero){

		const formContainer = document.getElementById('emergente'+numero);
		const closeButton = document.getElementById('close-button');
		
		document.getElementById('oscuro').style.display = 'block';
		formContainer.style.display = 'block';
	}
	
	function cierra(numero){
		document.getElementById('oscuro').style.display = 'none';
		document.getElementById('emergente'+numero).style.display = 'none';
	};



