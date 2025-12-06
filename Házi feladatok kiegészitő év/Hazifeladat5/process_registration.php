<?php
$errors = [];

if (empty($_POST['firstName'])) $errors[] = "FirstName is required";
if (empty($_POST['lastName'])) $errors[] = "LastName is required";
if(empty($_POST['email'])) {
    $errors[] = "Email is required";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors[] = "Invalid email format";
}
if(empty($_POST['attend'])) $errors[] = "Please select at least one event";
if(!isset($_POST['terms'])) $errors[] = "You must accept the terms";

if(!isset($_FILES['abstract']) || $_FILES['abstract']['error'] != 0) {
    $errors[] = "You must upload your abstract";
} else {
    $fileType = mime_content_type($_FILES['abstract']['tmp_name']);
    $fileSize = $_FILES['abstract']['size'];

    if ($fileType !== "application/pdf") {
        $errors[] = "Only PDF files are allowed";
    }
    if ($fileSize > 3 * 1024 * 1024) {
        $errors[] = "File size must be under 3MB.";
    }
}
    if(!empty($errors)) {
        echo "<h2>Errors occured:</h2><ul>";
        foreach($errors as $error) {
            echo "<li>$error</li>";
        }
            echo "</ul>";
            echo '<a href = "register.php">Back to the form</a>';
            exit;
        }
$uploadDir = "uploads/";
if(!is_dir($uploadDir)) mkdir($uploadDir);

$targetPath = $uploadDir . basename($_FILES['abstract']['name']);
move_uploaded_file($_FILES['abstract']['tmp_name'], $targetPath);

echo "<h2>Registration successful!</h2>";

echo"<p><strong>First Name:</strong> " . htmlspecialchars($_POST['firstName']) . "</p>";
echo"<p><strong>Last Name: </strong> " . htmlspecialchars($_POST['lastName']) . "</p>";
echo"<p><strong>Email: </strong> " . htmlspecialchars($_POST['email']) . "</p>";

echo "<p><strong>Events:</strong><br>";
foreach($_POST['attend'] as $event) {
    echo " - " . htmlspecialchars($event) . "<br>";
}
echo "</p>";

echo "<p><strong>T-shirt size:</strong>" . htmlspecialchars($_POST['tshirt']) . "</p>";
echo "<p><strong>Upload abstract:</strong> " . htmlspecialchars($_FILES['abstract']['name']) . "</p>";

?>




