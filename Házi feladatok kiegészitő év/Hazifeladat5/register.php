
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Online conference registration</title>
</head>
<body>
<h3>Online conference registration</h3>

<form method="POST" action="process_registration.php" enctype="multipart/form-data">
    <label>First name:
        <input type="text" name="firstName">
    </label><br><br>

    <label>Last name:
        <input type="text" name="lastName">
    </label><br><br>

    <label>Email:
        <input type="text" name="email">
    </label><br><br>

    <label>I will attend:<br>
        <input type="checkbox" name="attend[]" value="Event1"> Event1 <br>
        <input type="checkbox" name="attend[]" value="Event2"> Event2 <br>
        <input type="checkbox" name="attend[]" value="Event3"> Event3 <br>
        <input type="checkbox" name="attend[]" value="Event4"> Event4 <br>
    </label><br><br>

    <label>What's your T-Shirt size?<br>
        <select name="tshirt">
            <option value="P">Please select</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>
    </label><br><br>

    <label>Upload your abstract<br>
        <input type="file" name="abstract">
    </label><br><br>

    <input type="checkbox" name="terms" value="accepted"> I agree to terms & conditions<br><br>

    <input type="submit" name="submit" value="Send registration">
</form>

</body>
</html>