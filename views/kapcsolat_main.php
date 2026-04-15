<section class="kapcsolat-page">
	<h2>Kapcsolat</h2>
	<p>Küldj üzenetet az oldal tulajdonosának az alábbi űrlap kitöltésével.</p>

	<?php if (!empty($viewData['uzenet'])) : ?>
		<div class="alert alert-danger" role="alert"><?= htmlspecialchars($viewData['uzenet']) ?></div>
	<?php endif; ?>

	<?php if (!empty($viewData['errors'])) : ?>
		<div class="alert alert-danger" role="alert">
			<ul class="mb-0">
				<?php foreach ($viewData['errors'] as $error) : ?>
					<li><?= htmlspecialchars($error) ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<form action="<?= SITE_ROOT ?>kapcsolat" method="post" id="kapcsolatForm" novalidate>
		<label for="email">E-mail cím</label>
		<input type="text" id="email" name="email" value="<?= htmlspecialchars($viewData['form']['email'] ?? '') ?>">

		<label for="targy">Tárgy</label>
		<input type="text" id="targy" name="targy" value="<?= htmlspecialchars($viewData['form']['targy'] ?? '') ?>">

		<label for="szoveg">Üzenet</label>
		<textarea id="szoveg" name="szoveg" rows="5"><?= htmlspecialchars($viewData['form']['szoveg'] ?? '') ?></textarea>

		<button type="submit" class="btn btn-primary mt-2">Üzenet küldése</button>
		<div id="formHiba" class="text-danger mt-2 fw-semibold"></div>
	</form>
</section>

<script>
(function () {
	var form = document.getElementById('kapcsolatForm');
	var hibaElem = document.getElementById('formHiba');

	if (!form || !hibaElem) {
		return;
	}

	form.addEventListener('submit', function (e) {
		var email = document.getElementById('email').value.trim();
		var targy = document.getElementById('targy').value.trim();
		var szoveg = document.getElementById('szoveg').value.trim();
		var hibak = [];
		var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		if (!emailRegex.test(email)) {
			hibak.push('Adj meg érvényes e-mail címet.');
		}

		if (targy.length < 5) {
			hibak.push('A tárgy legyen legalább 5 karakter.');
		}

		if (szoveg.length < 10) {
			hibak.push('Az üzenet legyen legalább 10 karakter.');
		}

		if (hibak.length > 0) {
			e.preventDefault();
			hibaElem.textContent = hibak.join(' ');
		} else {
			hibaElem.textContent = '';
		}
	});
})();
</script>
