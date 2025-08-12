<?php
echo"
<script src='../js/jquery-1.6.4.js'></script>
<script>
    
function actividadUsuario() {
$.ajax({
url:'guarda.php',
success: function(){}
});
}

setInterval(actividadUsuario, 3000);
</script>
";
?>