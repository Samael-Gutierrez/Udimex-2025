<html>
<head>
<link rel='stylesheet' href=''>
</head>
<body>
<div class=''>

<form action="generar_pdf.php" method="get">
    <!-- ... Resto del formulario ... -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="nom" value="<?php echo $nom; ?>">
    <input type="hidden" name="apepa" value="<?php echo $apepa; ?>">
    <input type="hidden" name="apema" value="<?php echo $apema; ?>">
    <input type="hidden" name="mat" value="<?php echo $mat; ?>">
    <input type="hidden" name="f_pago" value="<?php echo $f_pago; ?>">
    <input type="hidden" name="cole" value="<?php echo $cole;?>">
    <button type="submit" class="">Generar PDF</button>
</form>

</body>
</html>

