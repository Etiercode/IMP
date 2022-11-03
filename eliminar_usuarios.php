<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '
            <script>
                alert("Debes iniciar sesión.");
                window.location = "login/login.php";
            </script>
        ';
    session_destroy();
    die();
}
if ($_SESSION['rol'] == 2) {
    echo '
    <script>
        alert("Debes iniciar sesión con un rol diferente");
        window.location = "inicio.php";
    </script>';
}
if ($_SESSION['rol'] == 3) {
    echo '
    <script>
        alert("Debes iniciar sesión con un rol diferente");
        window.location = "inicio.php";
    </script>';
}
?>
<?php

include "php/conexion_back.php";

if (!empty($_POST)) {
    $idusuario = $_POST['idusuario'];

    $query_delete = mysqli_query($conexion, "DELETE FROM login WHERE id_usuario='$idusuario'");
    if ($query_delete) {
        echo '
        <script>
            alert("Usuario Eliminado");
            window.location = "Usuarios.php";
        </script>';
        header("location: Usuarios.php");
    } else {
        echo '
        <script>
            alert("Error al eliminar usuario");
            window.location = "Usuarios.php";
        </script>';
    }
}

if (empty($_REQUEST['id'])) {
    echo '
    <script>
        alert("Usuario No existe");
        window.location = "Usuarios.php";
    </script>';
} else {

    include "php/conexion_back.php";

    $id_usuario = $_REQUEST['id'];

    $sql = mysqli_query($conexion, "SELECT l.id_usuario, l.usuario, l.nombreusuario, l.clave, l.rol, l.correo, l.sexo,l.numero_telef,l.direccion,(r.id_rol) AS rol 
    FROM login l 
    INNER JOIN roles r on l.rol = r.id_rol 
    WHERE id_usuario=$id_usuario");

    $result = mysqli_num_rows($sql);

    if ($result > 0) {
        while ($data = mysqli_fetch_array($sql)) {
            $nombreusuario = $data['nombreusuario'];
            $rol = $data['rol'];
            $correo = $data['correo'];
        }
    } else {
        header("location: Usuarios.php");
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icono Pestaña-->
    <link rel="icon" href="img/IMPlogo.png" type="image" sizes="16x16">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!--FONT OSWALD-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <!--CSS-->
    <link rel="stylesheet" href="css/editar_u.css">
    <title>IMP | Editar Usuarios</title>
</head>

<body>
    <div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
    </div>
    <div class:="container">
        <nav class="nav-main">
            <img src="img/IMPlogo.png" alt="Imp Logo" class="nav-brand">
            <ul class="nav-menu">
                <li>
                    <i class="fa-solid fa-inbox"></i>
                    &nbsp;&nbsp;
                    <a href="inicio.php">Inicio</a>
                </li>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-user"></i>
                        &nbsp;&nbsp;
                        <a href="Usuarios.php">Usuarios</a>
                    </li>
                <?php } ?>
                <li>
                    <i class="fa-sharp fa-solid fa-calendar-days"></i>
                    &nbsp;&nbsp;
                    <a href="Tareas.php">Asignar Tareas</a>
                </li>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-user"></i>
                        &nbsp;&nbsp;
                        <a href="agregar_usuario.php">Agregar Usuarios</i></a>
                    </li>
                <?php } ?>
                <li>
                    <i class="fa-solid fa-circle-user"></i>
                    &nbsp;&nbsp;
                    <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
                </li>
                <li>
                    <i class="fa-sharp fa-solid fa-user-shield"></i>
                    &nbsp;&nbsp;
                    <a href=""><?php echo $_SESSION['usuario'] ?></a>
                </li>
            </ul>
        </nav>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="showcase">
        <h2>Eliminar Usuario</h2>
        <h3>¿Estás seguro que quieres eliminar este usuario?</h3>
        <br>
        <br>
        <p style="font-size: 25px;">Usuario: <span style="font-weight: bold; color: #4f72d4; font-size: 20px;"><?php echo $nombreusuario ?></span></p>
        <p style="font-size: 25px;">Correo: <span style="font-weight: bold; color: #4f72d4; font-size: 20px;"><?php echo $correo ?></span></p>
        <p style="font-size: 25px;">Rol: <span style="font-weight: bold; color: #4f72d4; font-size: 20px;"><?php echo $rol ?></span></p>

        <form method="POST" action="">
            <input type="hidden" name="idusuario" value="<?php echo $id_usuario ?>">
            <a href="Usuarios.php" class="btn_cancel" style="width: 124px;background: rgb(177, 68, 68);color: white;display: inline-block;padding: 9px;border-radius: 5px;cursor: pointer;">Cancelar</a>
            <input type="submit" value="Aceptar" class="btn_ok" style="width: 124px;background: rgb(51, 151, 89);color: white;display: inline-block;border-radius: 5px;cursor: pointer;">
        </form>
    </div>

    <div class="footer-links">
        <div class="footer-container">
            <ul>
                <li>
                    <h2>Recuerda Guardar Bien tus Documentos</h2>
                </li>
            </ul>
            <ul>
                <li>
                    <h2>Aplicación de Escritorio</h2>
                </li>
                <li>

                    <a href="">(URL DESCARGA)</a>
                </li>
            </ul>
        </div>
        <footer class="footer">
            <h3>Improve My Process Copyright</h3>
        </footer>
        <script src="js/navbar.js"></script>
    </div>
</body>

</html>