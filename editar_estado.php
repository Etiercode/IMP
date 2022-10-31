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
?>

<?php
if (empty($_GET['id'])) {
    echo '
    <script>
        alert("Id de tarea no existe");
    </script>';
    header('location: inicio.php');
}

$id_tarea = $_GET['id'];
$progreso_tarea = $_GET ['progreso_tarea'];

if (empty($_GET['progreso_tarea'])) {
    echo '
    <script>
        alert("Progreso de Tarea Invalido");
    </script>';
    header('location: inicio.php');
}

$sql = mysqli_query($conexion, "SELECT t.id_tareas, t.id_funcionario, l.id_usuario, t.titulo_tarea, t.descripcion, t.estado, t.fecha_inicio, t.fecha_termino, t.plazo 
    FROM tareas t 
    INNER JOIN login l 
    ON t.id_funcionario = l.id_usuario");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    echo '
        <script>
            alert("Tarea no existe");
            window.location = "usuarios.php";
        </script>
        ';
    header('location: inicio.php');
} else {
    while ($data = mysqli_fetch_array($sql)) {
        $id_tareas = $data['id_tareas'];
        $id_funcionario = $data['id_usuario'];
        $estado = $data['estado'];

    }
}

?>
<?php
if (!empty($_POST)) {
    $estado = $_POST['estado'];
    $progreso = $_POST['progreso'];

    $sql_update = mysqli_query($conexion, "UPDATE tareas SET estado='$estado', progreso='$progreso' WHERE id_tareas='$id_tarea'");

    if ($sql_update) {
        echo '
                <script>
                    alert("Tarea Actualizada Correctamente");
                    window.location = "inicio.php";
                </script>';
    } else {
        echo '
                <script>
                    alert("Error al actualizar tarea");
                    window.location = "inicio.php";
                </script>';
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
    <title>IMP | Editar Estado</title>
</head>

<body>
    <div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
    </div>
    <br>
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
                <?php if ($_SESSION['rol'] == 3) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="Tareas.php">Crear Tareas</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="Tareas.php">Crear Tareas</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 2) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="flujosdetareas.php">Crear Flujos</i></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="flujosdetareas.php">Crear Flujos</i></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="Flujos_tarea.php">Ver Flujos</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 3) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="Flujos_tarea.php">Ver Flujos</a>
                    </li>
                <?php } ?>
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
        <h2>Editar Estado</h2>
        <h3>Usted está Editando Estado de tarea</h3>
        
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="Registro_Usuario">
            <form action="" method="POST" class="formulario_registro">
                <input type="hidden" name="progreso" value="<?php echo $progreso_tarea ?>">
                <select name="estado" class="sexo">
                    <option type="text" placeholder="estado" name="estado">En Progreso</option>
                    <option type="text" placeholder="estado" name="estado">Terminado</option>
                </select>
                <button class="btn" type="submit" style="margin-left: 25%;">Actualizar</button>
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