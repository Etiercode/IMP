<?php

include 'conexion_back.php';

$usuario = $_POST['usuario'];
$nombreusuario = $_POST['nombreusuario'];
$clave = $_POST['clave'];
$rol = $_POST['rol'];
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$numero_telef = $_POST['numero_telef'];
$direccion = $_POST['direccion'];

if (empty($usuario)) {
    echo '
    <script>
        alert("Campo usuario vacio");
        window.location = "../agregar_usuarios.php";
    </script>';
    
} elseif (is_numeric($usuario)) {
    echo '
        <script>
            alert("Campo usuario tiene que ser de formato texto");
            window.location = "../agregar_usuarios.php";
        </script>';
} elseif (empty($nombreusuario)) {
    echo '
    <script>
        alert("Campo Nombre de Usuario Vacio");
        window.location = "../agregar_usuarios.php";
    </script>';
} elseif (is_numeric($nombreusuario)) {
    echo '
    <script>
        alert("Campo de Nombre de usuario debe ser de formato texto");
        window.location = "../agregar_usuarios.php";
        </script>';
} elseif (empty($clave)) {
    echo '
    <script>
        alert("Campo de Clave no debe estar vacio");
        window.location = "../agregar_usuarios.php";
    </script>';
} elseif (empty($correo)) {
    echo '
    <script>
        alert("Campo de Correo no debe estar vacio");
        window.location = "../agregar_usuarios.php";
    </script>';
} elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '
    <script>
        alert("Campo Correo Invalido");
        window.location = "../agregar_usuarios.php";
    </script>';
} elseif (empty($numero_telef)) {
    echo '
    <script>
        alert("Campo de numero de telefono vacio");
        window.location = "../agregar_usuarios.php";

    </script>';
} elseif (empty($direccion)) {
    echo '
    <script>
        alert("Campo Dirección vacio");
        window.location = "../agregar_usuarios.php";
    </script>';
} else {
    $query = "INSERT INTO login(usuario, nombreusuario, clave, rol, correo, sexo, direccion, numero_telef) 
    VALUES('$usuario', '$nombreusuario', '$clave', '$rol', '$correo', '$sexo', '$direccion', '$numero_telef')";

    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
        echo '
    <script>
        alert("Usuario Agregado");
        header("../usuarios.php");
    </script>';
    } else {

        echo '
    <script>
        alert("Usuario no Agregado");
        header("../usuarios.php");
    </script>';
    }

    mysqli_close($conexion);
}
