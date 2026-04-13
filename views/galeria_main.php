<section class="gallery-page">
	<h2>Képgaléria</h2>
	<p class="lead-text">A feltöltött képek itt jelennek meg.</p>


	<div class="gallery-grid">
		<?php if (!empty($viewData['images'])) : ?>
			<?php foreach ($viewData['images'] as $image) : ?>
				<figure class="gallery-card">
					<a href="<?= $image['url'] ?>" target="_blank" rel="noopener noreferrer">
						<img src="<?= $image['url'] ?>" alt="Feltöltött kép: <?= htmlspecialchars($image['name']) ?>" loading="lazy">
					</a>
					<figcaption><?= htmlspecialchars($image['name']) ?></figcaption>
				</figure>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="empty-note">Még nincs feltöltött kép a galériában.</p>
		<?php endif; ?>
	</div>
</section>