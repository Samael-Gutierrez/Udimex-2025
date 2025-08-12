<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
.loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.loader::after {
  content: '';
  border: 8px solid #f3f3f3;
  border-top: 8px solid #3498db;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<body>
    <div id='loader' class='loader'></div>
    <button onclick="showLoader()">Enviar</button>
<script>
function showLoader(){
    document.getElementById('loader').style.display = 'flex';
    hiddeLoader('Todo listo');
}

function hiddeLoader(mensaje){
    setTimeout(function() {
            document.getElementById('loader').style.display = 'none';
            alert(`${mensaje} para enviar.`);
        }, 500);
}
</script>
</body>
</html>