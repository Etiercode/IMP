<?php

include 'conexion_back.php';

$titulo_tarea_r = $_POST['titulo_tarea_r'];
$descripcion_r = $_POST['descripcion_r'];
$id_asignador_r = $_POST['id_asignador_r'];
$fecha_creacion_flujo = $_POST['fecha_creacion_flujo'];
$duracion_flujo = $_POST ['duracion_flujo'];

if (strlen($descripcion_r) > 200) {
    echo '<script>alert("Campo Descripcion supera lo permitido");
    window.location = "../tareas_sin.php";</script>';
    mysqli_close($conexion);
}
if (strlen($titulo_tarea_r) > 30) {
    echo '<script>alert("Campo Titulo supera lo permitido");
    window.location = "../tareas_sin.php";</script>';
    mysqli_close($conexion);
}
if (empty($titulo_tarea_r)) {
    echo '<script>alert("Campo Titulo Vacío");
        window.location = "../tareas_sin.php";</script>';
    mysqli_close($conexion);
}
if (empty($descripcion_r)) {
    echo '<script>alert("Campo Descripción Vacío");
        window.location = "../tareas_sin.php";</script>';
    mysqli_close($conexion);
}

$query = "INSERT INTO tareas_sin(id_asignador_r,titulo_tarea_r,descripcion_r,fecha_creacion_flujo,duracion_flujo) 
VALUES('$id_asignador_r','$titulo_tarea_r','$descripcion_r','$fecha_creacion_flujo','$duracion_flujo')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '

        <script>
        alert("Tarea Agregada");
        window.location = "../tareas_sin.php";
        </script>

        ';
} else {

    echo '

        <script>
        alert("Tarea no Agregada favor de revisar bien");
        window.location = "../tareas_sin.php";
        </script>

        ';
}

mysqli_close($conexion);
