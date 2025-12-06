<?php

$errors = [];
$submitted = false;


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['firstName'])) $errors[] = "First name is required";
    if(empty($_POST['lastName'])) $errors[] = "Last name is required";
    if(empty($_POST['email'])) {
        $errors[] = "Email is required";
    } elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if(empty($_POST['attend'])) $errors[] = "Select at least one event";
    if(!isset($_POST['terms'])) $errors[] = "You must accept the terms";

    if(!isset($_FILES['abstract']) || $_FILES['abstract']['error'] != 0) {
        $errors[] = "You must upload a PDF abstract.";
    } else {
        $fileType = mime_content_type($_FILES['abstract']['tmp_name']);
        $fileSize = $_FILES['abstract']['size'];

        if($fileType != "application/pdf") $errors[] = "Only PDF allowed.";
        if($fileSize > 3 * 1024 * 1024) $errors[] = "Max siz: 3MB.";
        }
    if(empty($errors)) {
        $submitted = true;
        $uploadDir = "uploads/";
        if(!is_dir($uploadDir)) mkdir($uploadDir);
        move_uploaded_file($_FILES['abstract']['tmp_name'], $uploadDir . $_FILES['abstract']['name']);
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Online conference registration</title>
</head>
<body>

<?php if ($submitted): ?>
    <h2>Registration succesful</h2>
    <p><strong>First Name:</strong> <?= htmlspecialchars($_POST['firstName']) ?></p>
    <p><strong>Last Name:</strong>  <?= htmlspecialchars($_POST['lastName'])  ?></p>
    <p><strong>Email:</strong>       <?= htmlspecialchars($_POST['email'])     ?></p>
    <p><strong>Events:</strong><br>
        <?php foreach($_POST['attend'] as  $event) echo " - " . htmlspecialchars($event) . "<br>"; ?>
    </p>
    <p><strong>T-Shirt size:</strong> <?= htmlspecialchars($_POST['tshirt']) ?></p>
<p><strong>File uploaded:</strong>    <?= htmlspecialchars($_FILES['abstract']['name']) ?></p>


<?php else: ?>

    <?php
    if(!empty($errors)) {
        echo "<h3>Errors:</h3><ul>";
        foreach($errors as $error) echo "<li>$error</li>";
        echo "</ul>";
        }
    ?>

    <h3>Online conference registration</h3>

    <form method="POST" enctype="multipart/form-data">

        <label>First name:
            <input type="text" name="firstName"
                   value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>">
        </label><br><br>

        <label>Last name:
            <input type="text" name="lastName"
                   value="<?= htmlspecialchars($_POST['lastName'] ?? '')  ?>">
        </label><br><br>

        <label>E-mail:
            <input type="text" name="email"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </label><br><br>

        <label>I will attend:<br>
            <?php
            $events = ["Event1", "Event2","Event3", "Event4"];
            foreach($events as $event) {
                $checked = (isset($_POST['attend']) && in_array($event, $_POST['attend'])) ? 'checked' : '';
                echo "<input type='checkbox' name='attend[]' value='$event' $checked> $event<br>";
            }
            ?>

        </label><br><br>

        <label>T-shirt size:<br>
            <select name="tshirt">
                <?php
                $sizes = ["p" => "Please select", "S"=> "S", "M" => "M", "L" => "L", "XL"=> "XL"];
                foreach($sizes as $key => $value) {
                    $selected = (($_POST['tshirt'] ?? '') == $key) ? 'selected' :  '';
                    echo "<option value='$key' $selected>$value</option>";
                }
                ?>
            </select>
        </label><br><br>


        <label>Upload your abstract <br>
            <input type="file" name="abstract">
        </label><br><br>

        <input type="checkbox" name="terms" value="accepted"
               <?= isset($_POST['terms']) ? 'checked' : '' ?>>
        I agree to terms & conditions.<br><br>
        
        <input type="submit" value="Send registration">
        </form>
        
        <?php endif; ?>
               
</body>
</html>