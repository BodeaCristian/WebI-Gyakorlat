<section class="kapcsolat-result-page">
    <h2>Üzenet elküldve</h2>
    <p class="alert alert-success">Az üzenetedet rögzítettük.</p>

    <div class="card p-3">
        <p><strong>Név:</strong> <?= htmlspecialchars($viewData['kuldo_nev'] ?? '') ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($viewData['form']['email'] ?? '') ?></p>
        <p><strong>Tárgy:</strong> <?= htmlspecialchars($viewData['form']['targy'] ?? '') ?></p>
        <p><strong>Üzenet:</strong><br><?= nl2br(htmlspecialchars($viewData['form']['szoveg'] ?? '')) ?></p>
    </div>

    <p class="mt-3">
        <a href="<?= SITE_ROOT ?>kapcsolat" class="btn btn-outline-secondary">Vissza a kapcsolat oldalra</a>
    </p>
</section>
