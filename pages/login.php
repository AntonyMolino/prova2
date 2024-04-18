<?php

include "connect.php";
$username = $_POST['username'];
$password = $_POST['password'];



$sql = "SELECT * FROM utenti WHERE username=:username AND password=:password";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Utente autenticato con successo
    session_start();
    $_SESSION['username'] = $username;
    $q = "SELECT * FROM utenti WHERE username='$username' AND password='$password'";
    $result = $conn -> query($q);
    while ($row = $result -> fetch(PDO::FETCH_OBJ)) {
        $tipo = $row-> tipo;
        $_SESSION['tipo'] = $tipo;
    }
    header("Location: dashboard.php"); // Redirect alla dashboard dopo il login
} else {
    // Credenziali non valide, reindirizzamento alla pagina di login con un messaggio di errore
    header("Location: login.php?error=1");
}


?>
