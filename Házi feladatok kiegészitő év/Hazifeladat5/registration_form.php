<?php

$errors = [];
$name = $email = $password = $confirm_password = $birthdate = $gender = "";
$interests = $country = [];

function validatePassword($password){
    if(strlen($password) < 8){
        return "A jelszónak legalább 8 karakter hosszúnak kell lennie!";

    }
    if(!preg_match('/[A-Z]/',$password)) {
        return "A jelszónak tartalmaznia kell legalább 1 nagybetűt!";
    }
    if(!preg_match('/[0-9]/',$password)) {
        return "A jelszónak tartalmaznia kell legalább 1 számot!";
    }
    if(!preg_match('/[!@#$%^&*]/',$password)) {
        return "A jelszónak tartalmaznia kell legalább 1 speciális karaktert";
    }
    return true;
}
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(empty($_POST['name'])) {
        $errors[] = "A név mező nem lehet üres!";
    } else {
        $name = htmlspecialchars($_POST['name']);
        }
    if(empty($_POST['email'])) {
        $errors[] = "Az email mező nem lehet üres!";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Érvénytelen e-mail formátum!";
    } else {
        $email  = htmlspecialchars($_POST['email']);
    }
    if(empty($_POST['password'])) {
        $errors[] = "A jelszó mező nem lehet üres!";
    } else {
        $password = $_POST['password'];
        $result = validatePassword($password);
        if($result !== true) {
            $errors[] = $result;
        }
    }
    if(empty($_POST['confirm_password'])) {
        $errors[]  = "A jelszó megerősitése nem lehet üres!";
    }elseif ($_POST['confirm_password'] !== $_POST['password']) {
        $errors[] = "A jelszó és a  megerősités nem egyezik!";
    } else {
        $confirm_password = $_POST['confirm_password'];
    }
    if(!empty($_POST['birthdate'])) {
        $birthdate = $_POST['birthdate'];
        $date_check = date_create_from_format('Y-m-d', $birthdate);
        if (!$date_check || $date_check->format('Y-m-d') !== $birthdate) {
            $errors[] = "Érvénytelen születési dátum!";
        }
    }
}
if(!empty($_POST['gender'])) {
    $gender = $_POST['gender'];
}

if(!empty($_POST['interests'])) {
    $interests =  $_POST['interests'];
}

if(!empty($_POST['country'])) {
    $country = $_POST['country'];
}

if(empty($errors)) {
    echo "<h2>Sikeres regisztráció!</h2>";
    echo "Név: $name <br>";
    echo "Email: $email <br>";
    echo "Születési dátum: $birthdate <br>";
    echo "Nem: $gender <br>";
    if (!empty($interests)) {
        echo "Érdeklődési területek: " . implode(", ", $interests) . "<br>";
    }
    if (!empty($country)) {
        echo "Ország:  $country <br>";
    }
    exit;

}
?>

<h1>Regisztrációs ürlap</h1>

<?php

if(!empty($errors)) {
    echo "<ul style = 'color:red;'>";
    foreach ($errors as $error) echo "<li>$error</li>";
    echo "</ul>";
}
?>

<form method="POST" action="">
    Név: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"> <br><br>
    Email: <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"> <br><br>
    Jelszó: <input type="password" name="password"> <br><br>
    Jelszó megerősitése: <input type="password" name="confirm_password"> <br><br>
    Születési dátum: <input type="date" name="birthdate" value="<?= $birthdate ?>"> <br><br>
    Nem:
    <input type="radio" name="gender" value="male" <?=$gender === 'male' ? 'checked' : '' ?>> Férfi<br>
    <input type="radio" name="gender" value="female" <?=$gender === 'female' ? 'checked' : '' ?>> Nő<br>
    Érdeklődési területek: <br>
    <input type="checkbox" name="interests[]" value="Sport" <?= in_array("Sport", $interests) ? 'checked' : '' ?>> Sport<br>
    <input type="checkbox" name="interests[]" value="Művészet" <?= in_array("Művészet", $interests) ? 'checked' : '' ?>> Művészet<br>
    <input type="checkbox" name="interests[]" value="Tudomány" <?= in_array("Tudomány", $interests) ? 'checked' : '' ?>> Tudomány<br>
    Ország:
    <select name="country">
        <option value="">Válassz országot</option>
        <option value="Magyarország" <?= $country === 'Magyarország' ? 'selected' : '' ?>>Magyarország</option>
        <option value="USA" <?= $country === 'USA' ? 'selected' : '' ?>>USA</option>
        <option value="Németország" <?= $country === 'Németország' ? 'selected' : '' ?>>Németország</option>
    </select> <br><br>
    <input type="submit" name="submit" value="Regisztráció">
</form>

