<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

require_once 'conectar.php';

$code = ($_POST['CODIGO']);

$sql="SELECT CODE_BARR, PROD_NOM, PROD_PVENTA FROM tm_producto WHERE prod_id = $code";
$resultado = $mysqli->query($sql);

while ($row = $resultado->fetch_assoc()){

?> 

<img style="" src="barcode.php?text=<?php echo $row['CODE_BARR'];?>&size=50&orientation=horizontal&codetype=Code39&print=true&sizefactor=1"/>
<p style="margin-top: -10px; font-size: 10px "><?php echo $row['PROD_NOM'];?></p>
<p style="margin-top: -10px; margin-bottom: 100px; font-size: 10px; margin-left: 20px; ">Precio de Venta : <?php echo $row['PROD_PVENTA'];?> CLP</p>

<?php }?>
    
</body>
</html>