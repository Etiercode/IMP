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
if ($_SESSION['rol'] == 3) {
    echo '
    <script>
        alert("Debes iniciar sesión con un rol diferente");
        window.location = "inicio.php";
    </script>';
}
?>
<?php
include "../IMP/php/conexion_back.php";
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
    <link rel="stylesheet" href="css/flujos.css">

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
    <br>
    <h2 class="HeaderLista">Bienvenido <?php echo $_SESSION['usuario'] ?></h2>
    <h2 class="HeaderLista">Todos los Flujos Creados</h2>
    <br>
    <?php
    $query = mysqli_query($conexion, "SELECT f.id_flujo, f.titulo_flujo, l.id_usuario, l.nombreusuario, t.id_tareas, f.id_tarea_flujo2, f.id_tarea_flujo3
    FROM flujos_tarea f
    INNER JOIN login l
    ON f.id_funcionario_flujo=l.id_usuario
    INNER JOIN tareas t
    ON f.id_tarea_flujo1=t.id_tareas AND f.id_tarea_flujo2 AND f.id_tarea_flujo3");

    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
    ?>
            <table>
                <tr>
                    <th>Id Flujo</th>
                    <th>Titulo Flujo</th>
                    <th>Id Responsable</th>
                    <th>Nombre Funcionario</th>
                    <th>Tarea 1</th>
                    <th>Tarea 2</th>
                    <th>Tarea 3</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <td data-titulo="Id Flujo"><?php echo $data["id_flujo"] ?></td>
                    <td data-titulo="Titulo Flujo"><?php echo $data["titulo_flujo"] ?></td>
                    <td data-titulo="Id Usuario"><?php echo $data["id_usuario"] ?></td>
                    <td data-titulo="Nombre Usuario"><?php echo $data['nombreusuario'] ?></td>
                    <td data-titulo="Descripcion"><?php echo $data["id_tareas"] ?></td>
                    <td data-titulo="Estado"><?php echo $data["id_tarea_flujo2"] ?></td>
                    <td data-titulo="Progreso"><?php echo $data["id_tarea_flujo3"] ?></td>
                    <td data-titulo="Acciones">
                        <a class="link_edit" href="editar_flujo.php?id=<?php echo $data["id_tareas"]; ?>">Editar</a>
                        <a class="link_delete" href="eliminar_flujo.php?id=<?php echo $data["id_tareas"]; ?>">Eliminar</a>
                        <?php if ($_SESSION['rol'] == 1) { ?>
                            <a class="link_reasignar" href="reasignar_f?id=<?php echo $data["id_usuario"]; ?>">Reasignar</a>
                        <?php } ?>
                    </td>
                </tr>
        <?php
        }
    } else {
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