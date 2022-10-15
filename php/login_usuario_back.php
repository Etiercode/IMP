<?php

$nombreusuario = $_POST['nombreusuario'];
$clave = $_POST['clave'];

session_start();

include 'conexion_back.php';

$consulta = "SELECT * FROM login WHERE nombreusuario='$nombreusuario' AND clave='$clave'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_fetch_array($resultado);

if ($filas['rol'] == 1) {
    header("location: ../admin.php");
} else
    if ($filas['rol'] == 2) {
    header("location: ../diseñadorProcesos.php");
} else
    if ($filas['rol'] == 3) {
    header("location: ../funcionario.php");
} else {
    echo '
            <script>
                alert("Usuario no existe, verifique datos introducidos.");
                window.location = "../login/login.php";
            </script>
        ';
    exit;
}

