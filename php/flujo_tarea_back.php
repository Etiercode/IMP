<?php

include_once "conexion_back.php";

$id_funcionario_flujo = $_POST['id_funcionario_flujo'];
$id_tarea_flujo1 = $_POST['id_tarea_flujo1'];
$id_tarea_flujo2 = $_POST['id_tarea_flujo2'];
$id_tarea_flujo3 = $_POST['id_tarea_flujo3'];
$titulo_flujo = $_POST['titulo_flujo'];
$desc_flujo = $_POST['desc_flujo'];
$fecha_inicio_f = $_POST['fecha_inicio_f'];
$fecha_termino_f = $_POST['fecha_termino_f'];

date("Y-m-d");

$date1 = strtotime($_REQUEST['fecha_inicio_f']);
$date2 = strtotime($_REQUEST['fecha_termino_f']);

$plazo = round((((($date2 - $date1) / 60) / 60) / 24), 2);

if ($id_tarea_flujo1 == $id_tarea_flujo2) {
    echo '
        <script>
            alert("La tarea 1 no puede ser la misma que la tarea 2");
            window.location = "../flujosdetareas.php";
        </script>';
}
if ($id_tarea_flujo2 == $id_tarea_flujo3) {
    echo '
        <script>
            alert("La tarea 2 no puede ser la misma que la tarea 3");
            window.location = "../flujosdetareas.php";
        </script>';
}
if ($id_tarea_flujo1 == $id_tarea_flujo3) {
    echo '
        <script>
            alert("La tarea 1 no puede ser la misma que la tarea 3");
            window.location = "../flujosdetareas.php";
        </script>';
}

$query_flujo = "INSERT INTO flujos_tarea(id_funcionario_flujo, id_tarea_flujo1, id_tarea_flujo2, id_tarea_flujo3, titulo_flujo, desc_flujo, fecha_inicio_f, fecha_termino_f) 
    VALUES('$id_funcionario_flujo', '$id_tarea_flujo1', '$id_tarea_flujo2', '$id_tarea_flujo3', '$titulo_flujo', '$desc_flujo', '$fecha_inicio_f', '$fecha_termino_f')";


$ejecutar_flujo = mysqli_query($conexion, $query_flujo);

if ($ejecutar_flujo) {
    echo '

        <script>
        alert("Flujo de Tareas Creado");
        window.location = "../flujosdetareas.php";
        </script>

        ';
} else {

    echo '

        <script>
        alert("Flujo de Tareas no Creado");
        window.location = "../flujosdetareas.php";
        </script>

        ';
}

mysqli_close($conexion);
