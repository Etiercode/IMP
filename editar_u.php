<?php
include "../IMP/php/conexion_back.php";
?>

<?php
$id = $_GET['id'];

$sql = "SELECT * FROM login WHERE id_usuario='$id_usuario'";
$query = mysqli_query($conexion, $sql);

$row = mysqli_fetch_array($query);

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
            </ul>
        </nav>
    </div>
    <div class="showcase">
        <h2>Editar Usuarios</h2>
        <h3>Usted está Editando Usuarios</h3>
        <div class="Registro_Usuario">

            <form action="php/actualizar.php" method="POST" class="formulario_registro">
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <input type="text" placeholder="Nuevo Usuario" name="usuario" value="<?php echo $row['usuario'] ?>">
                <input type="text" placeholder="Nuevo Nombre de usuario" name="nombreusuario" value="<?php echo $row['nombreusuario'] ?>">
                <input type="text" placeholder="Nueva Clave" name="clave" value="<?php echo $row['clave'] ?>">
                <input type="text" placeholder="Correo" name="correo" value="<?php echo $row['correo'] ?>">
                <select name="rol">
                    <option type="text" placeholder="rol" name="rol">Administrador</option>
                    <option type="text" placeholder="rol" name="rol">Funcionario</option>
                    <option type="text" placeholder="rol" name="rol">Diseñador de Procesos</option>
                </select>
                <select name="sexo" class="sexo">
                    <option type="text" placeholder="Sexo" name="sexo">M</option>
                    <option type="text" placeholder="Sexo" name="sexo">F</option>
                </select>
                <input type="text" placeholder="Numero de Telefono" name="numero_telef">
                <input type="text" placeholder="Dirección" name="direccion">
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