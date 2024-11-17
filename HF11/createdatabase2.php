<?php

include 'db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];


    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");

    $stmt->bind_param("ss", $name, $email);


    if ($stmt->execute()) {
        echo "Új rekord létrehozva sikeresen!";
    } else {
        echo "Hiba: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<form method="post">
    <label for="name">Név:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <input type="submit" value="Hozzáadás">
</form>
