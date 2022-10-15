<?php
session_start();
if(isset($_SESSION['rol'])!=1){
    header("location: errorderol.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PHP</title>
</head>
<body>
    <h2>PAGINA DE ADMIN YEY</h2>
</body>
</html>