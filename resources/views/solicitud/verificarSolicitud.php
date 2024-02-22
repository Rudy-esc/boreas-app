<?php

// Conexion a la base de datos
require_once('bdd.php');

/* Maneja la actualización de eventos en la base de datos
cuando se recibe una solicitud POST con valores
para 'id', 'start', y 'end' en una matriz llamada 'Event'.*/

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {

    $id = $_POST['Event'][0];
    $start = $_POST['Event'][1];
    $end = $_POST['Event'][2];

    // Obtener la sala asociada a la solicitud
    $sql_get_sala = "SELECT SitiosId FROM solicitudes WHERE id = :id";
    $query_get_sala = $bdd->prepare($sql_get_sala);
    $query_get_sala->bindParam(':id', $idSolicitud, PDO::PARAM_INT);
    $query_get_sala->execute();
    $result_sala = $query_get_sala->fetch(PDO::FETCH_ASSOC);

    $SitiosId = $result_sala['SitiosId'];

    // Verificar duplicidad
    $sql_check = "SELECT COUNT(*) FROM solicitudes 
                  WHERE ((start <= :start AND end >= :start) OR (start <= :end AND end >= :end)) 
                  AND SitiosId = :SitiosId AND id <> :id";

    $query_check = $bdd->prepare($sql_check);
    $query_check->bindParam(':start', $start, PDO::PARAM_STR);
    $query_check->bindParam(':end', $end, PDO::PARAM_STR);
    $query_check->bindParam(':SitiosId', $SitiosId, PDO::PARAM_INT);
    $query_check->bindParam(':id', $id, PDO::PARAM_INT);

    $query_check->execute();
    $result = $query_check->fetchColumn();

    if ($result > 0) {
        echo 'Error: La reserva del centro de cómputo coincide con una existente. INTENTE NUEVAMENTE';
    } else {
        // Actualización
        $sql = "UPDATE solicitudes SET start = :start, end = :end WHERE id = :id ";

        $query = $bdd->prepare($sql);

        $query->bindParam(':start', $start, PDO::PARAM_STR);
        $query->bindParam(':end', $end, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $sth = $query->execute();

        if ($sth == true) {
            echo 'OK';
        } else {
            print_r($query->errorInfo());
            echo 'Error: No se pudo actualizar la reserva del centro de cómputo.';
        }
    }
}
?>