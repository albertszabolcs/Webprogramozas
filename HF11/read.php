<?php
include 'db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
echo "<table><tr><th>ID</th><th>Név</th><th>Email</th><th>Műveletek</th></tr>";
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>
            <a href='update.php?id=" . $row["id"] . "'>Módosítás</a> |
            <a href='delete.php?id=" . $row["id"] . "'>Törlés</a></td></tr>";
    }
    echo "</table>";
} else {
echo "Nincsenek adatok!";
}

$conn->close();
?>
