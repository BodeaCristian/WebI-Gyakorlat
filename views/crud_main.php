<section class="crud-page">
	<h2>Gép adatok - CRUD</h2>

	<?php if (!empty($viewData['uzenet'])) : ?>
		<div class="alert <?= (($viewData['eredmeny'] ?? '') === 'OK') ? 'alert-success' : 'alert-danger' ?>" role="alert">
			<?= htmlspecialchars($viewData['uzenet']) ?>
		</div>
	<?php endif; ?>

	<?php if (($viewData['eredmeny'] ?? '') !== 'ERROR' || !empty($viewData['gepek'])) : ?>
		<p>
			<a class="btn btn-primary" href="<?= SITE_ROOT ?>crud?action=create">Új gép létrehozása</a>
			<?php if (($viewData['action'] ?? 'list') !== 'list') : ?>
				<a class="btn btn-outline-secondary ms-2" href="<?= SITE_ROOT ?>crud">Vissza a listához</a>
			<?php endif; ?>
		</p>

		<?php if (($viewData['action'] ?? 'list') === 'create' || ($viewData['action'] ?? 'list') === 'edit') : ?>
			<div class="card p-3 mb-4">
				<h5><?= (($viewData['action'] ?? '') === 'create') ? 'Új gép felvétele' : 'Gép szerkesztése' ?></h5>
				<form method="post" action="<?= SITE_ROOT ?>crud?action=<?= htmlspecialchars($viewData['action']) ?><?= (($viewData['action'] ?? '') === 'edit' ? '&id='.(int)($viewData['editingId'] ?? 0) : '') ?>">
					<div class="row g-3">
						<div class="col-md-6">
							<label class="form-label">Gyártó</label>
							<input class="form-control" type="text" name="gyarto" value="<?= htmlspecialchars($viewData['form']['gyarto'] ?? '') ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Típus</label>
							<input class="form-control" type="text" name="tipus" value="<?= htmlspecialchars($viewData['form']['tipus'] ?? '') ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Kijelző</label>
							<input class="form-control" type="text" name="kijelzo" value="<?= htmlspecialchars((string)($viewData['form']['kijelzo'] ?? '')) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Memória</label>
							<input class="form-control" type="text" name="memoria" value="<?= htmlspecialchars((string)($viewData['form']['memoria'] ?? '')) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Merevlemez</label>
							<input class="form-control" type="text" name="merevlemez" value="<?= htmlspecialchars((string)($viewData['form']['merevlemez'] ?? '')) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Ár</label>
							<input class="form-control" type="text" name="ar" value="<?= htmlspecialchars((string)($viewData['form']['ar'] ?? '')) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Videovezérlő</label>
							<input class="form-control" type="text" name="vezerlo" value="<?= htmlspecialchars($viewData['form']['vezerlo'] ?? '') ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Processzor</label>
							<select class="form-select" name="processzorid">
								<option value="">- válassz -</option>
								<?php foreach (($viewData['processzorok'] ?? array()) as $p) : ?>
									<option value="<?= (int)$p['id'] ?>" <?= ((string)($viewData['form']['processzorid'] ?? '') === (string)$p['id']) ? 'selected' : '' ?>>
										<?= htmlspecialchars($p['gyarto'].' '.$p['tipus']) ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-3">
							<label class="form-label">Operációs rendszer</label>
							<select class="form-select" name="oprendszerid">
								<option value="">- válassz -</option>
								<?php foreach (($viewData['oprendszerek'] ?? array()) as $o) : ?>
									<option value="<?= (int)$o['id'] ?>" <?= ((string)($viewData['form']['oprendszerid'] ?? '') === (string)$o['id']) ? 'selected' : '' ?>>
										<?= htmlspecialchars($o['nev']) ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-3">
							<label class="form-label">Db</label>
							<input class="form-control" type="text" name="db" value="<?= htmlspecialchars((string)($viewData['form']['db'] ?? '')) ?>">
						</div>
					</div>

					<button class="btn btn-success mt-3" type="submit">Mentés</button>
				</form>
			</div>
		<?php endif; ?>

		<div class="table-responsive">
			<table class="table table-striped table-hover align-middle table-sm">
				<thead class="table-light">
					<tr>
						<th>ID</th>
						<th>Gyártó</th>
						<th>Típus</th>
						<th>Kijelző</th>
						<th>Memória</th>
						<th>HDD</th>
						<th>Videovezérlő</th>
						<th>Ár</th>
						<th>Processzor</th>
						<th>OS</th>
						<th>Db</th>
						<th>Művelet</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach (($viewData['gepek'] ?? array()) as $g) : ?>
						<tr>
							<td><?= (int)$g['id'] ?></td>
							<td><?= htmlspecialchars($g['gyarto']) ?></td>
							<td><?= htmlspecialchars($g['tipus']) ?></td>
							<td><?= htmlspecialchars((string)$g['kijelzo']) ?></td>
							<td><?= htmlspecialchars((string)$g['memoria']) ?></td>
							<td><?= htmlspecialchars((string)$g['merevlemez']) ?></td>
							<td><?= htmlspecialchars((string)$g['vezerlo']) ?></td>
							<td><?= htmlspecialchars((string)$g['ar']) ?></td>
							<td><?= htmlspecialchars(trim(($g['processzor_gyarto'] ?? '').' '.($g['processzor_tipus'] ?? ''))) ?></td>
							<td><?= htmlspecialchars((string)($g['oprendszer_nev'] ?? '')) ?></td>
							<td><?= htmlspecialchars((string)$g['db']) ?></td>
							<td class="crud-actions">
								<a class="btn btn-sm btn-outline-primary" href="<?= SITE_ROOT ?>crud?action=edit&id=<?= (int)$g['id'] ?>">Szerkeszt</a>
								<a class="btn btn-sm btn-outline-danger" href="<?= SITE_ROOT ?>crud?action=delete&id=<?= (int)$g['id'] ?>" onclick="return confirm('Biztosan törlöd ezt a rekordot?');">Töröl</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php endif; ?>
</section>
