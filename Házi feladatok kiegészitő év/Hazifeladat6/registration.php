<?php

function validateStep1 ($data){
    $errors = [];
    if (empty($data['last_name']) || strlen($data['last_name']) < 2) {
        $errors[] = "Vezetéknév legalább 2 karakter legyen!";
    }

    if (empty($data['first_name']) || strlen($data['first_name']) < 2) {
        $errors[] = "Keresztnév legalább 2 karakter legyen!";
    }

    if (empty($data['birth_date'])) {
        $errors[] = "Születési dátum megadása kötelező!";
    } else {
        $birthDate = new DateTime($data['birth_date']);
        $today = new DateTime();
        $age = $birthDate->diff($today)->y;
        if ($age < 18) {
            $errors[] = "A regisztrációhoz legalább 18 évesnek kell lenned.";
        }
    }
    if (empty($data['gender'])) {
        $errors[] = "A nem kiválasztása kötelező.";
    }

    return $errors;
}

if(!isset($_SESSION['step'])) {
    $_SESSION['step'] = 1;
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['step'] == 1) {
    $data = [
        'last_name' => trim($_POST['last_name'] ?? ''),
        'first_name' => trim($_POST['first_name'] ?? ''),
        'birth_date' => $_POST['birth_date'] ?? '',
        'gender' => $_POST['gender'] ?? ''
    ];

    $errors = validateStep1($data);

    if (empty($errors)) {
        $_SESSION['registration']['last_name'] = $data['last_name'];
        $_SESSION['registration']['first_name'] = $data['first_name'];
        $_SESSION['registration']['birth_date'] = $data['birth_date'];
        $_SESSION['registration']['gender'] = $data['gender'];

        $_SESSION['step'] = 2;
        header("Location: index.php");
        exit;
    }
}
if($_SESSION['step'] == 2 && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $country = $_POST['country'] ?? '';
    $city = trim($_POST['city'] ?? '');
    $postal = trim($_POST['postal_code'] ?? '');

    $countries = [
        'HU' => 'Magyarország',
        'RO' => 'Románia',
        'SK' => 'Szlovákia',
        'AT' => 'Ausztria',
        'DE' => 'Németország',
    ];

    if($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Érvényes email cimet adj meg!";
    }
    if(!preg_match('/^\+[0-9]{11,13}$/',$phone)) {
        $errors[] = "A telefonszám formátuma hibás! Pl.: +36301234567";
    }
    if($country === '' || !isset($countries[$country])) {
        $errors[] = "Válassz országot!";
    }
    if($city === '') {
        $errors[] = "A város megadása kötelező";
    }
    if(!preg_match('/^[0-9]{4}$/', $postal)) {
        $errors[] = "Az irányitószám 4 számjegy kell legyen.";
    }
    if(empty($errors)) {
        $_SESSION['registration']['email'] = $email;
        $_SESSION['registration']['phone'] = $phone;
        $_SESSION['registration']['country'] = $country;
        $_SESSION['registration']['city'] = $city;
        $_SESSION['registration']['postal_code'] = $postal;

        $_SESSION['step'] = 3;
        header("Location: index.php");
        exit;
    }
}


if($_SESSION['step'] == 3 && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $newsletter = isset($_POST['newsletter']) ? 1: 0;

    $existing_usernames = ['admin','user1','test_user','user2'];


    if(!preg_match('/^[A-Za-z0-9_]{5,20}$/', $username)) {
        $errors[] = "A felhasználónév 5-20 karakter legyen,csak betű,szám vagy aláhuzás.";
    }
    if(in_array($username, $existing_usernames)) {
        $errors[] = "Ez a felhasználónév már foglalt!";
    }
    if(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $errors[] = "A jelszónak legalább 8 karakterből kell állnia,tartalmaznia kell 1 nagybetűt és 1 számot.";
    }
    if($password !== $confirm) {
        $errors[] = "A két jelszó nem egyezik meg!";
    }
    if(empty($errors)) {
        $_SESSION['registration']['username'] = $username;
        $_SESSION['registration']['password'] = $password;
        $_SESSION['registration']['newsletter'] = $newsletter;

        $_SESSION['step'] = 4;
        header("Location: index.php");
        exit;
    }
}
if($_SESSION['step'] == 4 && $_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['back'])) {
        $_SESSION['step'] = 3;
        header("Location: index.php");
        exit;
    }
    if(isset($_POST['finish'])) {
        echo "<h2>Sikeres regisztráció!</h2>";
        echo "<p>Az adatok rögzitve lettek.</p>";


        session_destroy();

        echo '<a href="index.php">Új regisztráció kezdése</a>';
        exit;
    }
}
?>



