<section class="uzenetek-page">
	<h2>Kapcsolati üzenetek</h2>

	<?php if (!empty($viewData['uzenet'])) : ?>
		<div class="alert <?= (($viewData['eredmeny'] ?? '') === 'OK') ? 'alert-success' : 'alert-danger' ?>" role="alert">
			<?= htmlspecialchars($viewData['uzenet']) ?>
		</div>
	<?php endif; ?>

	<?php if (($viewData['eredmeny'] ?? '') === 'OK') : ?>
		<?php if (!empty($viewData['uzenetek'])) : ?>
			<div class="table-responsive">
				<table class="table table-striped table-hover align-middle">
					<thead class="table-light">
						<tr>
							<th>ID</th>
							<th>Név</th>
							<th>E-mail</th>
							<th>Tárgy</th>
							<th>Üzenet</th>
							<th>Dátum</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($viewData['uzenetek'] as $row) : ?>
							<tr>
								<td><?= (int)$row['id'] ?></td>
								<td><?= htmlspecialchars(trim($row['nev']) !== '' ? $row['nev'] : 'Vendég') ?></td>
								<td><?= htmlspecialchars($row['email']) ?></td>
								<td><?= htmlspecialchars($row['targy']) ?></td>
								<td><?= nl2br(htmlspecialchars($row['szoveg'])) ?></td>
								<td><?= htmlspecialchars($row['letrehozva']) ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php else : ?>
			<p class="alert alert-info">Még nincs eltárolt kapcsolat üzenet.</p>
		<?php endif; ?>
	<?php endif; ?>
</section>
