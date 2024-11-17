<?php

session_start();
session_unset();
session_destroy();

echo "Sikeresen kijelentkezett!";
header("Location: login.php");
exit;
?>
