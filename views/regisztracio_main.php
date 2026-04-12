<h2>Regisztráció</h2>
<form action="<?= SITE_ROOT ?>regisztral" method="post">
    <label for="csaladi_nev">Családi név:</label>
    <input type="text" name="csaladi_nev" id="csaladi_nev" required maxlength="45">
    <label for="utonev">Utónév:</label>
    <input type="text" name="utonev" id="utonev" required maxlength="45">
    <label for="login">Felhasználó:</label>
    <input type="text" name="login" id="login" required maxlength="12" pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+">
    <label for="password">Jelszó:</label>
    <input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+">
    <label for="password_again">Jelszó újra:</label>
    <input type="password" name="password_again" id="password_again" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+">
    <input type="submit" value="Regisztráció">
</form>
<?php if (isset($viewData['uzenet']) && $viewData['uzenet'] !== '') : ?>
    <p class="mt-3 fw-semibold"><?= $viewData['uzenet'] ?></p>
<?php endif; ?>