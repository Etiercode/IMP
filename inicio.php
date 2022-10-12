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
    <link rel="stylesheet" href="css/inicio.css">

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
                <li>
                    <i class="fa-sharp fa-solid fa-user"></i>
                    &nbsp;&nbsp;
                    <a href="Usuarios.php">Usuarios</a>
                </li>
                <li>
                    <i class="fa-sharp fa-solid fa-calendar-days"></i>
                    &nbsp;&nbsp;
                    <a href="Tareas.php">Asignar Tareas</a>
                </li>
                <li>
                    <i class="fa-sharp fa-solid fa-user"></i>
                    &nbsp;&nbsp;
                    <a href="agregar_usuario.php">Agregar Usuarios</i></a>
                </li>
                <li>
                    <i class="fa-solid fa-circle-user"></i>
                    &nbsp;&nbsp;
                    <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
                </li>
                <li>
                    <i class="fa-sharp fa-solid fa-user-shield"></i>
                    &nbsp;&nbsp;
                    <a href=""><?php echo $_SESSION['usuario']?></a>
                </li>
            </ul>
        </nav>
    </div>
        <h2 class="HeaderLista">Bienvenido <?php echo $_SESSION['usuario']?></h2>
            <p class="subTitleHeader">(PANEL DE CARGA DE TRABAJO PERSONAL)</p>

            <h2 class="HeaderLista">Listado de Tareas</h2>
            <p class="subTitleHeader">Lista de tareas asignadas</p>
    <table>
            <tr>
                <th>Id tarea</th>
                <th>Descripción de la tarea</th>
                <th>Estado de la tarea</th>
                <th>Progreso</th>
                <th>Fecha de inicio</th>
                <th>Fecha de término</th>
                <th>Plazo</th>
            </tr>
        <?php

            $query = mysqli_query($conexion, "SELECT id,descripcion,estado,progreso,fecha_inicio,fecha_termino,plazo FROM tareas");

            $result = mysqli_num_rows($query);
            if($result > 0){

                while ($data = mysqli_fetch_array($query)) {

            ?>
                <tr>
                    <td><?php echo $data["id"]?></td>
                    <td><?php echo $data["descripcion"]?></td>
                    <td><?php echo $data["estado"]?></td>
                    <td><?php echo $data["progreso"]?></td>
                    <td><?php echo $data["fecha_inicio"]?></td>
                    <td><?php echo $data["fecha_termino"]?></td>
                    <td><?php echo $data["plazo"]?></td>

                </tr>
        <?php          
                }
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