<section class="upload-page">
	<h2>Képfeltöltés</h2>
	<p class="lead-text">Itt tudsz új képet feltölteni a galériába.</p>

	<?php if (!empty($viewData['uzenet'])) : ?>
		<div class="alert alert-success" role="alert"><?= htmlspecialchars($viewData['uzenet']) ?></div>
	<?php endif; ?>

	<?php if (!empty($viewData['hiba'])) : ?>
		<div class="alert alert-danger" role="alert"><?= htmlspecialchars($viewData['hiba']) ?></div>
	<?php endif; ?>

		<form action="<?= SITE_ROOT ?>kepfeltoltes" method="post" enctype="multipart/form-data" class="upload-form">
			<label for="feltoltes_kep" class="form-label">Válassz képet</label>
			<input class="form-control" type="file" id="feltoltes_kep" name="feltoltes_kep" accept="image/jpeg,image/png,image/gif,image/webp" required>
			<small class="form-text text-muted">Engedélyezett formátumok: JPG, PNG, GIF, WEBP. Maximum méret: 5 MB.</small>
			<button type="submit" class="btn btn-primary mt-3">Feltöltés</button>
			<a href="<?= SITE_ROOT ?>galeria" class="btn btn-outline-secondary mt-3 ms-2">Galéria megnyitása</a>
		</form>

		<?php if (!empty($viewData['uploadedImageUrl'])) : ?>
			<div class="preview-card mt-4">
				<p class="mb-2">Legutóbb feltöltött kép:</p>
				<img src="<?= $viewData['uploadedImageUrl'] ?>" alt="Legutóbb feltöltött kép" loading="lazy">
			</div>
		<?php endif; ?>

</section>
