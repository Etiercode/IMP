<?php

include 'conexion_back.php';
date("Y-m-d");

$date1 = strtotime($_REQUEST['fecha_inicio']);
$date2 = strtotime($_REQUEST['fecha_termino']);

$plazo = round((((($date2 - $date1) / 60) / 60) / 24), 2);

$id_usuario = $_POST['id_funcionario'];
$titulo_tarea = $_POST['titulo_tarea'];
$descripcion = $_POST['descripcion'];
$estado = $_POST['estado'];
$progreso = $_POST['progreso'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];
$id_asignador = $_POST['id_asignador'];

if (empty($descripcion)) {
    echo '<script>alert("Campo Descripción Vacío");
        window.location = "../agregar_usuario.php";</script>';
    mysqli_close($conexion);
}

if ($plazo < 0) {
    echo '<script>alert("Plazo tiene un valor Negativo, Revisar las fechas");
    window.location = "../tareas.php";</script>';
    mysqli_close($conexion);
}


$query = "INSERT INTO tareas(id_funcionario,id_asignador,titulo_tarea, descripcion, estado, progreso, fecha_inicio, fecha_termino, plazo) 
VALUES('$id_usuario','$id_asignador','$titulo_tarea','$descripcion', '$estado', '$progreso', '$fecha_inicio', '$fecha_termino', '$plazo')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '

        <script>
        alert("Tarea Agregada");
        window.location = "../tareas.php";
        </script>

        ';
} else {

    echo '

        <script>
        alert("Tarea no Agregada favor de revisar bien");
        window.location = "../tareas.php";
        </script>

        ';
}

mysqli_close($conexion);
