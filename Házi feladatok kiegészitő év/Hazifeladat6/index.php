<?php
session_start();

require_once "registration.php";
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció – 1. lépés</title>
    <style>
     .error-box{
         border: 2px solid red;
         padding: 10px;
         margin-bottom: 15px;
         background: #ffe6e6;
     }
     .summary {
         border: 2px solid #333;
         padding: 15px;
         margin: 15px 0;
         background-color: #f2f2f2;
     }
     .summary h3 {
         margin-top: 10px;
         color: #333;

     }
     .summary p {
         margin: 5px 0;
     }

     </style>
</head>
<body>

<div class="progress-bar">
    <div class="step <?= ($_SESSION['step']>=1)?'active':'' ?>">1. Személyes</div>
    <div class="step <?= ($_SESSION['step']>=2)?'active':'' ?>">2. Elérhetőség</div>
    <div class="step <?= ($_SESSION['step']>=3)?'active':'' ?>">3. Fiók</div>
    <div class="step <?= ($_SESSION['step']>=4)?'active':'' ?>">4. Összegzés</div>
</div>
<h1>1.Lépés személyes adatok</h1>
<?php if(!empty($errors)): ?>
<div class="error-box"
     <?php foreach($errors as $error): ?>
        <p><?= htmlspecialchars($error) ?></p>
     <?php endforeach; ?>
</div>
<?php endif; ?>

<form method="POST">


    <label>Vezetéknév:</label><br>
    <input type="text" name="last_name"
           value="<?= $_SESSION['registration']['last_name'] ?? '' ?>"><br><br>

    <label>Keresztnév:</label><br>
    <input type="text" name="first_name"
           value="<?= $_SESSION['registration']['first_name'] ?? '' ?>"><br><br>

    <label>Születési dátum:</label><br>
    <input type="date" name="birth_date"
           value="<?= $_SESSION['registration']['birth_date'] ?? '' ?>"><br><br>

    <label>Nem:</label><br>
    <input type="radio" name="gender" value="Férfi"
           <?= (($_SESSION['registration']['gender']?? '') === 'Férfi') ? 'checked' : '' ?>> Férfi
    <input type="radio" name="gender" value="Nő"
           <?= (($_SESSION['registration']['gender']?? '') === 'Nő') ? 'checked' : '' ?>> Nő
    <input type="radio" name="gender" value="Egyéb"
           <?= (($_SESSION['registration']['gender']?? '') === 'Egyéb') ? 'checked' : '' ?>> Egyéb
    <br><br>

    <button type="submit">Tovább</button>
</form>
</body>
</html>

<?php if ($_SESSION['step'] == 2): ?>

<h1>2. Lépés - Elérhetőség</h1>

<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php
    $countries = [
        'HU' => 'Magyar',
        'RO' => 'Románia',
        'SK' => 'Szlovákia',
        'AT' => 'Ausztria',
        'DE' => 'Németország'
];
 ?>

<form method="POST">

    <label>Email cim:</label><br>
    <input type="email" name="email"
            value="<?= $_SESSION['registration']['email'] ?? '' ?>"><br><br>
    <label>Telefonszám (+36301234567):</label><br>
    <input type="tel" name="phone"
            value="<?= $_SESSION['registration']['phone'] ?? '' ?>"><br><br>

    <label>Ország:</label><br>
    <select name="country">
          <option value="">-- válassz --</option>
          <?php foreach($countries as $code => $name): ?>
              <option value="<?= $code ?>"
                    <?= (($_SESSION['registration']['country'] ?? '') === $code) ? 'selected' : ''?>>
                    <?= $name ?>
              </option>
          <?php endforeach; ?>
    </select><br><br>


    <label>Város:</label><br>
    <input type="text" name="city"
            value="<?= $_SESSION['registration']['city'] ?? '' ?>"><br><br>

    <label>Irányitószám:</label><br>
    <input type="text" name="postal_code"
             value="<?= $_SESSION['registration']['postal_code'] ?? '' ?>"><br><br>


    <button type="submit">Tovább</button>
</form>

<form method="POST">
    <button type="submit" name="back">Vissza</button>
</form>

<?php endif; ?>


<?php if ($_SESSION['step'] == 3): ?>
<h1>3. Lépés - Felhasználói fiók</h1>

<?php if (!empty($errors)): ?>
<div class="error-box">
    <?php foreach($errors as $error): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<form method="POST">

      <label>Felhasználónév:</label><br>
      <input type="text" name="username"
             value="<?= $_SESSION['registration']['username'] ?? '' ?>"><br><br>

      <label>Jelszó:</label><br>
      <input type="password" name="password"><br><br>


        <label>Jelszó megerősitése:</label><br>
        <input type="password" name="confirm_password"><br><br>

      <label>
          <input type="checkbox" name="newsletter"
          <?= (!empty($_SESSION['registration']['newsletter'])) ? 'checked' : '' ?>>
          Feliratkozom a hirlevélre
      </label><br><br>

      <button type="submit">Tovább</button>
</form>

<form method="POST">
      <button type="submit" name="back">Vissza</button>
</form>
<?php endif; ?>


<?php if ($_SESSION['step'] == 4): ?>

<h1>4. Lépés - Összegzés és megerősités</h1>

<div class="summary">
    <h3>Személyes adatok</h3>
    <p>Név: <?= htmlspecialchars($_SESSION['registration']['last_name'] . ' ' . $_SESSION['registration']['first_name']) ?></p>
    <p>Születési dátum: <?= htmlspecialchars($_SESSION['registration']['birth_date']) ?></p>
    <p>Nem: <?= htmlspecialchars($_SESSION['registration']['gender']) ?></p>

    <h3>Elérhetőség</h3>
    <p>Email: <?= htmlspecialchars($_SESSION['registration']['email']) ?></p>
    <p>Telefonszám: <?= htmlspecialchars($_SESSION['registration']['phone']) ?></p>
    <p>Ország:  <?= htmlspecialchars($_SESSION['registration']['country']) ?></p>
    <p>Város: <?= htmlspecialchars($_SESSION['registration']['city']) ?></p>
    <p>Irányitószám: <?= htmlspecialchars($_SESSION['registration']['postal_code']) ?></p>


    <h3>Felhasználói fiok</h3>
    <p>Felhasználónév: <?= htmlspecialchars($_SESSION['registration']['username']) ?></p>
    <p>Jelszó: ********</p>
    <p>Hirlevél: <?= !empty($_SESSION['registration']['newsletter']) ? 'Igen' : 'Nem' ?></p>
</div>

<form method="POST">
      <button type="submit" name="back">Vissza</button>
</form>
<?php endif; ?>

<form method="POST">
    <button type="submit" name="finish">Regisztráció befejezése</button>
</form>


