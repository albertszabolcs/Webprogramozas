<?php

include 'db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $email);
        $stmt->fetch();
    } else {
        echo "Nincs ilyen felhasználó!";
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
        echo "A rekord sikeresen frissítve!";
    } else {
        echo "Hiba: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<form method="post">
    <label for="name">Név:</label>
    <input type="text" id="name" name="name" value="<?= $name ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= $email ?>" required><br>

    <input type="submit" value="Módosítás">
</form>
