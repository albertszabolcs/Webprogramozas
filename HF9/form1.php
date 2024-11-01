<?php
$errors = [];
$emailError = "";
$firstName = "";
$lastName = "";
$email = "";
$attend = "";
$tshirt = "";
$tshirtError = "";
$terms = "";
$abstract = "";
$abstractError = "";
$firstNameError = "";
$lastNameError = "";
$attendError = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['firstName'])) {
        $firstNameError = "firstName is required";
    } else {
        $firstName = htmlspecialchars($_POST["firstName"]);
    }
    if (empty($_POST['lastName'])) {
        $lastNameError = "LastName is required";
    } else {
        $lastName = htmlspecialchars($_POST["lastName"]);
    }
    if (empty($_POST['email'])) {
        $emailError = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST['email']);
    }
    if (empty($_POST['attend'])) {
        $attendError = "At least one event  must be selected.";
    } else {
        $attend = array_map('htmlspecialchars', $_POST['attend']);
    }
    if (!isset($_POST['tshirt']) || $_POST['tshirt'] == "P") {
        $tshirtError = "Tshirt size is required";
    } else {
        $tshirt = htmlspecialchars($_POST['tshirt']);
    }
    if (!isset($_FILES['abstract']) || $_FILES['abstract']['error'] == UPLOAD_ERR_NO_FILE) {
        $abstractError = "Uploading the abstract is required.";
    } else {
        $allowedMimeType = 'aplication/pdf';
        $maxFileSize = 3 * 1024 * 1024;

        if ($_FILES['abstract']['type'] !== $allowedMimeType) {
            $abstractError = "Only PDF files are allowed.";
        } elseif ($_FILES['abstract']['size'] > $maxFileSize) {
            $abstractError = "The file size must not exceed 3 MB.";
        }

        if ($_FILES['abstract']['type'] !== $allowedMimeType) {
            $abstractError = "Only PDF files are allowed.";
        } elseif ($_FILES['abstract']['size'] > $maxFileSize) {
            $abstractError = "The file size must not exceed 3 MB.";
        }
    }
    if (empty($_POST['terms'])) {
        $termsError = "You must accept the terms and conditions";
    } else {
        $terms = 1;
    }
    $errors = array_filter([$firstNameError, $lastNameError, $emailError, $attendError, $tshirtError, $abstractError]);
    if (empty($errors)) {
        echo "<h3>Registration successful!</h3>";
        echo "<p><strong>First Name:</strong> " . htmlspecialchars($firstName) . "</p>";
        echo "<p><strong>Last Name:</strong> " . htmlspecialchars($lastName) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<p><strong>Events:</strong> " . implode(", ", array_map('htmlspecialchars', $attend)) . "</p>";
        echo "<p><strong>T-Shirt Size:</strong> " . htmlspecialchars($tshirt) . "</p>";
        echo "<p><strong>Abstract:</strong> " . htmlspecialchars($_FILES['abstract']['name']) . "</p>";
        echo "<p><strong>Terms Accepted:</strong> Yes</p>";
    }


    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style ='color: red;'>$error</p>";
        }
    }
}

?>
    <h3>Online conference registration</h3>

<form method="post" action="process.php"> enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName">
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName">
    </label>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email">
    </label>
    <br><br>
    <label for="attend"> I will attend:<br>
        <input type="checkbox" name="attend[]" value="Event1">Event 1<br>
        <input type="checkbox" name="attend[]" value="Event2">Event2<br>
        <input type="checkbox" name="attend[]" value="Event3">Event2<br>
        <input type="checkbox" name="attend[]" value="Event4">Event3<br>
    </label>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt">
            <option value="P">Please select</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract"/>
    </label>
    <br><br>
    <input type="checkbox" name="terms" value="">I agree to terms & conditions.<br>
    <br><br>
    <input type="submit" name="submit" value="Send registration"/>
</form>

