<?php

$name = '';
$email = '';
$password = '';
$confirm_password = '';
$dob = '';
$gender = '';
$interests = [];
$country = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
    $dob = htmlspecialchars(trim($_POST["dob"]));
    $gender = isset($_POST["gender"]) ? htmlspecialchars(trim($_POST["gender"])) : '';
    $interests = isset($_POST["interests"]) ? $_POST["interests"] : [];
    $country = isset($_POST["country"]) ? htmlspecialchars(trim($_POST["country"])) : '';

    if (empty($name)) {
        $errorMessage .= "<p>Name cannot be empty.</p>";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage .= "<p>Please enter a valid email address.</p>";
    }

    if (strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[\W_]/', $password)) {
        $errorMessage .= "<p>Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.</p>";
    }

    $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$dobDate || $dobDate->format('Y-m-d') !== $dob) {
        $errorMessage .= "<p>Please enter a valid date of birth.</p>";
    }

    if (!empty($password) && !empty($confirm_password) && !empty($gender)) {

        if ($password === $confirm_password) {
            if (empty($errorMessage)) {

                echo "<h3>Thank you for registering!</h3>";
                echo "<p><strong>Name:</strong> $name</p>";
                echo "<p><strong>Email:</strong> $email</p>";
                echo "<p><strong>Date of Birth:</strong> $dob</p>";
                echo "<p><strong>Gender:</strong> $gender</p>";
                echo "<p><strong>Interests:</strong> " . (!empty($interests) ? implode(", ", $interests) : "None") . "</p>";
                echo "<p><strong>Country:</strong> " . (!empty($country) ? $country : "None") . "</p>";
            }
        } else {
            $errorMessage .= "<p>Passwords do not match. Please try again.</p>";
        }
    } else {
        $errorMessage .= "<p>Please fill in all required fields!</p>";
    }
}


if (!empty($errorMessage)) {
    echo '<div class="error">' . $errorMessage . '</div>';
}
?>

<form action="regisztracio.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required><br><br>

    <p>Gender:</p>
    <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?> required>
    <label for="male">Male</label><br>
    <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?> required>
    <label for="female">Female</label><br>
    <input type="radio" id="other" name="gender" value="Other" <?php echo ($gender == 'Other') ? 'checked' : ''; ?> required>
    <label for="other">Other</label><br><br>

    <p>Interests:</p>
    <input type="checkbox" id="sport" name="interests[]" value="Sport" <?php echo in_array("Sport", $interests) ? 'checked' : ''; ?>>
    <label for="sport">Sport</label><br>
    <input type="checkbox" id="art" name="interests[]" value="Art" <?php echo in_array("Art", $interests) ? 'checked' : ''; ?>>
    <label for="art">Art</label><br>
    <input type="checkbox" id="science" name="interests[]" value="Science" <?php echo in_array("Science", $interests) ? 'checked' : ''; ?>>
    <label for="science">Science</label><br><br>

    <label for="country">Country:</label>
    <select id="country" name="country">
        <option value="">Select your country</option>
        <option value="USA" <?php echo ($country == 'USA') ? 'selected' : ''; ?>>United States</option>
        <option value="Canada" <?php echo ($country == 'Canada') ? 'selected' : ''; ?>>Canada</option>
        <option value="UK" <?php echo ($country == 'UK') ? 'selected' : ''; ?>>United Kingdom</option>
        <option value="Germany" <?php echo ($country == 'Germany') ? 'selected' : ''; ?>>Germany</option>
        <option value="France" <?php echo ($country == 'France') ? 'selected' : ''; ?>>France</option>
        <option value="Hungary" <?php echo ($country == 'Hungary') ? 'selected' : ''; ?>>Hungary</option>

    </select><br><br>

    <input type="submit" value="Register">
</form>

