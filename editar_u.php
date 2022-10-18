<?php
include "../IMP/php/conexion_back.php";
?>
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
if (empty($_GET['id'])) {
    echo '
    <script>
        alert("Id de usuario no existe");
    </script>';
    header('location: usuarios.php');
}
$id_usuario = $_GET['id'];

$sql = mysqli_query($conexion, "SELECT l.id_usuario, l.usuario, l.nombreusuario, l.clave, l.rol, l.correo, l.sexo,l.numero_telef,l.direccion,(r.id_rol) AS rol 
FROM login l 
INNER JOIN roles r on l.rol = r.id_rol 
WHERE id_usuario=$id_usuario");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    echo '
    <script>
        alert("Usuario no existe");
        window.location = "usuarios.php";
    </script>
    ';
    header('location: usuarios.php');
} else {
    while ($data = mysqli_fetch_array($sql)) {
        $option = '';
        $id_usuario = $data['id_usuario'];
        $usuario = $data['usuario'];
        $nombreusuario = $data['nombreusuario'];
        $clave = $data['clave'];
        $rol = $data['rol'];
        $correo = $data['correo'];
        $sexo = $data['sexo'];
        $numero_telef = $data['numero_telef'];
        $direccion = $data['direccion'];
    }
}

?>
<?php

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['usuario']) || empty($_POST['nombreusuario']) || empty($_POST['clave']) || empty($_POST['correo']) || empty($_POST['numero_telef']) || empty($_POST['direccion'])) {
        echo '
        <script>
            alert("Todos los campos son obligatorios");
            header("Refresh:0");
        </script>';
    } else {
        $idUsuario = $_POST['idUsuario'];
        $usuario = $_POST['usuario'];
        $nombreusuario = $_POST['nombreusuario'];
        $clave = $_POST['clave'];
        $rol = $_POST['rol'];
        $correo = $_POST['correo'];
        $sexo = $_POST['sexo'];
        $numero_telef = $_POST['numero_telef'];
        $direccion = $_POST['direccion'];

        $sql_update = mysqli_query($conexion, "UPDATE login SET usuario='$usuario', nombreusuario='$nombreusuario', clave='$clave', rol='$rol', correo='$correo', sexo='$sexo', direccion='$direccion', numero_telef='$numero_telef'
            WHERE id_usuario='$idUsuario'");

        if ($sql_update) {
            echo '
            <script>
                alert("Usuario Actualizado Correctamente");
                window.location = "usuarios.php";
            </script>';
        } else {
            echo '
            <script>
                alert("Error al actualizar usuario");
                window.location = "usuarios.php";
            </script>';
        }
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
    <div class="showcase">
        <h2>Editar Usuarios</h2>
        <h3>Usted está Editando Usuarios</h3>
        <div class="Registro_Usuario">
            <form action="" method="POST" class="formulario_registro">
                <input type="hidden" name="idUsuario" value="<?php echo $id_usuario ?>">
                <input type="text" placeholder="Nuevo Usuario" name="usuario" value="<?php echo $usuario ?>">
                <input type="text" placeholder="" name="nombreusuario" value="<?php echo $nombreusuario ?>">
                <input type="text" placeholder="Nueva Clave" name="clave" value="<?php echo $clave ?>">
                <select name="rol">
                    <option type="text" placeholder="rol" name="rol" value="1">Administrador</option>
                    <option type="text" placeholder="rol" name="rol" value="2">Funcionario</option>
                    <option type="text" placeholder="rol" name="rol" value="3">Diseñador de Procesos</option>
                </select>
                <input type="text" placeholder="Correo" name="correo" value="<?php echo $correo ?>">
                <select name="sexo" class="sexo">
                    <option type="text" placeholder="Sexo" name="sexo">M</option>
                    <option type="text" placeholder="Sexo" name="sexo">F</option>
                </select>
                <input type="text" placeholder="Numero de Telefono" name="numero_telef" value="<?php echo $numero_telef ?>">
                <input type="text" placeholder="Dirección" name="direccion" value="<?php echo $direccion ?>">
                <button class="btn" type="submit">Actualizar</button>
            </form>
        </div>
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