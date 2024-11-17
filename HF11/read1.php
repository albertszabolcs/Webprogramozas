<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);


include 'db_connection.php';

$sql = "SELECT id, name, email FROM users";
$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Név</th><th>Email</th><th>Műveletek</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>
        <a href='update.php?id=" . $row["id"] . "'>Módosítás</a> |
        <a href='delete.php?id=" . $row["id"] . "'>Törlés</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "Nincsenek adatok!";
}

$stmt->close();
$conn->close();
?>
