<h2>Belépés</h2>
<form action="<?= SITE_ROOT ?>beleptet" method="post">
    <label for="login">Felhasználó:</label>
    <input type="text" name="login" id="login" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+">
    <label for="password">Jelszó:</label>
    <input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+">
    <input type="submit" value="Küldés">
</form>
<?php if (isset($viewData['uzenet']) && $viewData['uzenet'] !== "") : ?>
    <p class="mt-3 fw-semibold"><?= $viewData['uzenet'] ?></p>
<?php endif; ?>
