<?php


include 'db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
    }
}

// Ha az űrlap el lett küldve
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "A rekord sikeresen frissítve!";
    } else {
        echo "Hiba: " . $conn->error;
    }
}
?>

<form method="post">
    <label for="name">Név:</label>
    <input type="text" id="name" name="name" value="<?= $name ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= $email ?>" required><br>

    <input type="submit" value="Módosítás">
</form>
