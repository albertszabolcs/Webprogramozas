<?php


include 'db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "A rekord sikeresen törölve!";
    } else {
        echo "Hiba: " . $conn->error;
    }
}

$conn->close();
?>
