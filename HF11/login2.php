<?php

include 'db_connection.php';
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";


$conn = new mysqli($servername, $username, $password, $dbname);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            echo "Bejelentkezés sikeres! Üdvözöljük, " . $_SESSION['username'];
            header("Location: hallgatoi_muveletek.php");
            exit;
        } else {
            echo "Hibás jelszó!";
        }
    } else {
        echo "Nincs ilyen felhasználó!";
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

    <input type="submit" value="Bejelentkezés">
</form>
