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
    <title>IMP | Usuarios</title>
    <!--Icono Pestaña-->
    <link rel="icon" href="img/IMPlogo.png" type="image" sizes="16x16">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!--FONT OSWALD-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="css/usuarios1.css">

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
    <h2 class="HeaderLista">Listado de Usuarios</h2>
    <p class="subTitleHeader">Lista de Usuarios creados en la base de datos</p>
    <table>
        <tr>
            <th>id</th>
            <th>usuario</th>
            <th>nombreusuario</th>
            <th>clave</th>
            <th>rol</th>
            <th>sexo</th>
            <th>correo</th>
            <th>Acciones</th>
        </tr>
    <?php

        $query = mysqli_query($conexion, "SELECT id_usuario, usuario, nombreusuario, clave, rol, sexo, correo FROM login");

        $result = mysqli_num_rows($query);
        if($result > 0){

            while ($data = mysqli_fetch_array($query)) {

        ?>
            <tr>
                <td><?php echo $data["id_usuario"]?></td>
                <td><?php echo $data["usuario"]?></td>
                <td><?php echo $data["nombreusuario"]?></td>
                <td><?php echo $data["clave"]?></td>
                <td><?php echo $data["rol"]?></td>
                <td><?php echo $data["sexo"]?></td>
                <td><?php echo $data["correo"]?></td>
                <td>
                    <a class="link_edit" href="editar_u.php?id=<?php echo $data["id_usuario"]?>">Editar</a>
                    <a class="link_delete" href="eliminar_u.php?id=<?php echo $data["id_usuario"]?>">Eliminar</a>
                </td>
            </tr>
    <?php          
            }
        }
    ?>
    </table>
    <!----------------------------------------------FOOTER-->
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