<?php
if(!isset($_COOKIE['random_szam'])) {
    $random_szam = rand(1, 100);
    setcookie("random_szam", $random_szam, time() + 3600);
} else {
    $random_szam = $_COOKIE['random_szam'];
}

$eredmeny = null;
$uzenet = '';
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['elkuld'])) {
    $szam1 = $_POST['szam1'];
    $szam2 = $_POST['szam2'];
    $muv = $_POST['muv'];

    if (empty($szam2)) {
        $uzenet = "Kérlek, add meg a második számot!";
    } else {
        $szam2 = (float)$szam2;

        switch ($muv) {
            case '+':
                $eredmeny = $szam1 + $szam2;
                break;
            case '-':
                $eredmeny = $szam1 - $szam2;
                break;
            case '*':
                $eredmeny = $szam1 * $szam2;
                break;
            case '/':
                $eredmeny = ($szam2 != 0) ? $szam1 / $szam2 : "Error: division by zero!";
                break;
            default:
                $eredmeny = "Invalid operation";
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kitalalt_szam'])) {
    $kitalalt_szam = (int)$_POST['kitalalt_szam'];

    if ($kitalalt_szam === $random_szam) {
        $uzenet = "Gratulálok! Kitaláltad a számot: $random_szam.";

        setcookie("random_szam", "", time() - 3600);
    } elseif ($kitalalt_szam < $random_szam) {
        $uzenet = "A kitalált szám kisebb, mint a keresett szám.";
    } else {
        $uzenet = "A kitalált szám nagyobb, mint a keresett szám.";
    }
}
?>

<form method="POST" action="">
    <br>Az első szám:
    <input type="number" name="szam1" required>
    <br>A második szám:
    <input type="number" name="szam2" required>
    <br>Műveleti jel:
    <select name="muv">
        <option>+</option>
        <option>-</option>
        <option>*</option>
        <option>/</option>
    </select><br>
    <input type="submit" name="elkuld" value="Szamol">
</form>

<?php if ($eredmeny !== null): ?>
    <h3>Eredmény: <?php echo $eredmeny; ?></h3>
<?php endif; ?>


<form method="post" action="">
    <input type="number" name="kitalalt_szam" required placeholder="Kitalált szám">
    <input type="submit" name="kitalal" value="Küldés">
</form>

<?php if ($uzenet): ?>
    <p><?php echo $uzenet; ?></p>
<?php endif; ?>




