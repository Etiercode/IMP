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
    <title>IMP | Flujos de Tarea</title>

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
    <?php
    include "header.php";
    ?>
    <br>
    <h2 class="HeaderLista">Bienvenido <?php echo $_SESSION['usuario'] ?></h2>
    <h2 class="HeaderLista">Todos los Flujos Creados</h2>
    <br>
    <?php
    $query = mysqli_query($conexion, "SELECT 	
    f.id_flujo,	
    f.id_funcionario_flujo,	
    f.id_creador_flujo,	
    f.titulo_flujo,	
    f.desc_flujo,	
    f.tareas_sin_f,
    tsf.titulo_tarea_r,
    f.estatus,
    l.nombreusuario
    FROM flujos_tarea f
    INNER JOIN login l
    ON id_funcionario_flujo=id_usuario
    INNER JOIN tareas_sin tsf
    ON id_tarea_sin=tareas_sin_f");

    $result = mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
    ?>
            <table>
                <tr>
                    <th>Id Flujo</th>
                    <th>Id Responsable</th>
                    <th>Responsable</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Estatus</th>
                    <th>Tareas Asignadas al Flujo</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <td data-titulo="Id Flujo"><?php echo $data["id_flujo"] ?></td>
                    <td data-titulo="Id Funcionario"><?php echo $data["id_funcionario_flujo"] ?></td>
                    <td data-titulo="Nombre Usuario"><?php echo $data['nombreusuario'] ?></td>
                    <td data-titulo="Titulo Flujo"><?php echo $data["titulo_flujo"] ?></td>
                    <td data-titulo="Descripcion"><?php echo $data["desc_flujo"] ?></td>
                    <?php
                    if ($data['estatus'] == '1') {
                        echo '<td data-titulo="Estatus"><a style="color: green" href="editar_estatus.php?id_flujo=' . $data['id_flujo'] . '&estatus=0">Activado</a></td>';
                    }
                    if ($data['estatus'] == '0') {
                        echo '<td data-titulo="Estatus"><a style="color: red" href="editar_estatus.php?id_flujo=' . $data['id_flujo'] . '&estatus=1">Desactivado</a></td>';
                    }
                    ?></td>

                    <td data-titulo="Tareas Asignadas">
                        <ul>
                            <?php foreach (explode(', ', $data['tareas_sin_f']) as $tareas_sin){ ?>
                               <li><?php echo 'Id: ',htmlspecialchars($tareas_sin) ?></li> 
                            <?php } ?>
                        </ul>
                    </td>
                    <td data-titulo="Acciones">
                        <a class="link_reasignar" href="reasignar_flujo.php?id_flujo=<?php echo $data["id_flujo"]; ?>&responsable_actual=<?php echo $data['nombreusuario'] ?>">Reasignar</a>
                        <br>
                        <a href="editar_flujo.php?id_flujo=<?php echo $data["id_flujo"]; ?>" style="color: rgb(4, 167, 4);">Editar</a>
                        <br>
                        <a class="link_delete" href="eliminar_flujo.php?id_flujo=<?php echo $data["id_flujo"]; ?>&titulo_flujo=<?php echo $data["titulo_flujo"]; ?>">Eliminar</a>
                        <br>
                        <a class="link_edit" href="reporte_f.php?id_flujo=<?php echo $data["id_flujo"]; ?>">Reporte</a>
                    </td>
                </tr>
                
        <?php
        }
    } else {
        echo '<div class="notasktext" style="display: block; 
        background-color: rgb(114, 114, 114);
        width: 300px;
        border: 15px solid rgb(94, 94, 94);
        padding: 50px;
        margin: auto; margin-top: 135px; margin-bottom: 135px">No hay flujos creados</div>';
    }
        ?>
            </table>
            <?php
            include "footer.php";
            ?>
</body>

</html>