<?php

include 'db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Sikeresen regisztrált!";
    } else {
        echo "Hiba: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<form method="post">
    <label for="username">Felhasználónév:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Jelszó:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Regisztráció">
</form>
