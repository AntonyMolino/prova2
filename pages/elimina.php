<?php

    include "connect.php";
    $id = $_POST["id"];
    $q = "DELETE FROM `organizzare`.`utenti` WHERE (`id_utente` = '". $id."');";
    $result = $conn -> query($q);
    header("Location: dashboard.php");
?>