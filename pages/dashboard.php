<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <script src='main.js'></script>
</head>
<body>
    
    
    <?php
    session_start();
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<h1>Benvenuto, $username";
        echo "</h1>";
    } else {
        echo "Non sei autenticato.";
    }
    if(isset($_SESSION['tipo'])) {
        $tipo = $_SESSION['tipo'];
        echo "<p>hai un account  $tipo";
        echo "</p>";
       
    } else {
        echo "Non hai un account con permessi.";
    }

    
    if($tipo == "admin"){
        include "connect.php";
        $q = "SELECT * FROM organizzare.utenti;";
        $result = $conn -> query($q);
        if ($result->rowCount() > 0) {
            echo "<table>";
            echo "
            <th>nome</th>
            <th>cognome</th>
            <th>username</th>
            <th>tipo</th>
            ";
        while ($row = $result -> fetch(PDO::FETCH_OBJ)) {
            $id = $row -> id_utente;
            echo "<tr>"; 
            echo "
            <form action='elimina.php' method='post'>
            <input type='hidden' name='id' value='".$id."'>
            <td>".$row -> nome."</td>
            <td>".$row -> cognome."</td>
            <td>".$row -> username."</td>
            <td>".$row -> tipo."</td>
            <td><input type='submit' value = 'cancella'></td>
            </tr></form>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red; text-align: center;'>Nessun utente trovato</p>";
    }

    }


    ?>
    </form>
</body>
</html>