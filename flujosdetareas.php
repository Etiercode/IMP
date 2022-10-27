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
include "php/conexion_back.php";
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
    <link rel="stylesheet" href="css/flujosdetareas.css">
    <title>IMP | Crear Flujos de Tareas</title>
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
    <div class="showcase">
        <h2>Crear Flujos de Tareas</h2>
        <h3>Usted está creando flujos de tareas como <?php echo $_SESSION['usuario'] ?></h3>
        <P><span style="color: red;">RECUERDA QUE DEBEN HABER MINIMO 3 TAREAS PARA CREAR UN FLUJO</span></P>
        <P><span style="color: red;">Al crear un flujo NO puedes eliminar tareas ni usuarios relacionados a esta</span></P>
        <form action="php/flujo_tarea_back.php" method="POST" class="formulario_registro">
            <label>Asignar Funcionario <span style="color: red;">*</span></label>
            <select name="id_funcionario_flujo">
                <?php
                $query = mysqli_query($conexion, "SELECT id_usuario, nombreusuario FROM login");
                $funcionarios = mysqli_num_rows($query);
                if ($funcionarios > 0) {
                    while ($responsable = mysqli_fetch_array($query)) {
                ?>
                        <option value="<?php echo $responsable["id_usuario"]; ?>"><?php echo $responsable["nombreusuario"]; ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <label>Seleccionar Tarea 1 <span style="color: red;">*</span></label>
            <select name="id_tarea_flujo1">
                <?php
                $query_tarea1 = mysqli_query($conexion, "SELECT id_tareas, titulo_tarea FROM tareas");
                $tarea1 = mysqli_num_rows($query_tarea1);
                if ($tarea1 > 0) {
                    while ($tarea1 = mysqli_fetch_array($query_tarea1)) {
                ?>
                        <option value="<?php echo $tarea1["id_tareas"]; ?>"><?php echo $tarea1["titulo_tarea"]; ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <div id="id_tarea_flujo2">
                <label>Seleccionar Tarea 2 <span style="color: red;">*</span></label>
                <select name="id_tarea_flujo2">
                    <?php
                    $query_tarea2 = mysqli_query($conexion, "SELECT id_tareas, titulo_tarea FROM tareas");
                    $tarea2 = mysqli_num_rows($query_tarea2);
                    if ($tarea2 > 0) {
                        while ($tarea2 = mysqli_fetch_array($query_tarea2)) {
                    ?>
                            <option value="<?php echo $tarea2["id_tareas"]; ?>"><?php echo $tarea2["titulo_tarea"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div id="id_tarea_flujo3">
                <label>Seleccionar Tarea 3 <span style="color: red;">*</span></label>
                <select name="id_tarea_flujo3">
                    <?php
                    $query_tarea3 = mysqli_query($conexion, "SELECT id_tareas, titulo_tarea FROM tareas");
                    $tarea3 = mysqli_num_rows($query_tarea3);
                    if ($tarea3 > 0) {
                        while ($tarea3 = mysqli_fetch_array($query_tarea3)) {
                    ?>
                            <option value="<?php echo $tarea3["id_tareas"]; ?>"><?php echo $tarea3["titulo_tarea"]; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <label>Titulo Flujo de Tareas <span style="color: red;">*</span></label>
            <input type="text" placeholder="Titulo Flujo de Tareas" name="titulo_flujo">
            <label>Descripción del Flujo <span style="color: red;">*</span></label>
            <input type="text" placeholder="Descripción del Flujo" name="desc_flujo">
            <div class="row">
                <div class="col">
                    <label style="padding-right: 30px;">Fecha Inicio <span style="color: red;">*</span></label>
                    <input type="date" name="fecha_inicio_f">
                    <label style="padding-right: 30px;">Hora Inicio</label>
                    <input type="time" name="hora_inicio_f">
                </div>
                <div class="col">
                    <label style="padding-right: 15px;">Fecha Termino <span style="color: red;">*</span></label>
                    <input type="date" name="fecha_termino_f">
                    <label style="padding-right: 15px;">Hora Termino</label>
                    <input type="time" name="hora_termino_f">
                </div>
            </div>
            <button class="btn" style="margin-top: 15px;" type="submit">Crear Flujo</button>
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