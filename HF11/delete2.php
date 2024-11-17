<?php

include 'db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "A rekord sikeresen törölve!";
    } else {
        echo "Hiba: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
