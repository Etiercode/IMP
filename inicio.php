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
include "../IMP/php/conexion_back.php";
?>
<?php
$id = $_SESSION['id_usuario_log'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMP | Inicio</title>

    <!--Icono Pestaña-->
    <link rel="icon" href="img/IMPlogo.png" type="image" sizes="16x16">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!--FONT OSWALD-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="css/inicio1.css">

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
                <?php if ($_SESSION['rol'] == 3) { ?>
                <li>
                    <i class="fa-sharp fa-solid fa-calendar-days"></i>
                    &nbsp;&nbsp;
                    <a href="Tareas.php">Asignar Tareas</a>
                </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 1) { ?>
                <li>
                    <i class="fa-sharp fa-solid fa-calendar-days"></i>
                    &nbsp;&nbsp;
                    <a href="Tareas.php">Asignar Tareas</a>
                </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 2) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="flujosdetareas.php">Crear Flujos de Tareas</i></a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li>
                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                        &nbsp;&nbsp;
                        <a href="flujosdetareas.php">Crear Flujos de Tareas</i></a>
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
    <br>
    <h2 class="HeaderLista">Bienvenido <?php echo $_SESSION['usuario'] ?></h2>
    <h2 class="HeaderLista">Aqui su carga de trabajo</h2>
    <br>
    <div class="containerTextNoTask" style="display: none;">
        <div class="notasktext">No tienes tareas asignadas</div>
    </div>

    <?php
    $query = mysqli_query($conexion, "SELECT t.id_tareas,t.titulo_tarea,t.descripcion,t.estado,t.progreso,t.fecha_inicio,t.fecha_termino,t.plazo,l.id_usuario,l.nombreusuario FROM tareas t INNER JOIN login l on t.id_funcionario = l.id_usuario WHERE $_SESSION[id_usuario_log]=id_usuario");

    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
    ?>
    <table>
        <tr>
            <?php if ($_SESSION['rol'] == 1) { ?>
                <th>Id tarea</th>
            <?php } ?>
            <?php if ($_SESSION['rol'] == 1) { ?>
                <th>Responsable</th>
            <?php } ?>
            <?php if ($_SESSION['rol'] == 1) { ?>
            <th>Id</th>
            <?php } ?>
            <th>Titulo Tarea</th>
            <th>Descripción de la tarea</th>
            <th>Estado de la tarea</th>
            <th>Progreso</th>
            <th>Fecha de inicio</th>
            <th>Fecha de término</th>
            <th>Plazo (Dias)</th>
            </tr>
        <tr>
            <?php if ($_SESSION['rol'] == 1) { ?>
                <td><?php echo $data["id_tareas"] ?></td>
            <?php } ?>
            <?php if ($_SESSION['rol'] == 1) { ?>
                <td><?php echo $data["nombreusuario"] ?></td>
            <?php } ?>
            <?php if ($_SESSION['rol'] == 1) { ?>
            <td><?php echo $data["id_usuario"] ?></td>
            <?php } ?>
            <td><?php echo $data["titulo_tarea"] ?></td>
            <td><?php echo $data["descripcion"] ?></td>
            <td><?php echo $data["estado"] ?></td>
            <td><?php echo $data["progreso"] ?></td>
            <td><?php echo $data["fecha_inicio"] ?></td>
            <td><?php echo $data["fecha_termino"] ?></td>
            <td><?php echo $data["plazo"] ?></td>
        </tr>
        <?php
            }
        }else{
            echo '<div class="notasktext" style="display: block; 
            background-color: rgb(114, 114, 114);
            width: 300px;
            border: 15px solid rgb(94, 94, 94);
            padding: 50px;
            margin: auto; margin-top: 135px; margin-bottom: 135px">No tienes tareas asignadas</div>';
        }
        ?>
    </table>

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