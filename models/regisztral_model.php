<?php

class Regisztral_Model
{
	public function get_data($vars)
	{
		$retData = array(
			'eredmeny' => 'ERROR',
			'uzenet' => ''
		);

		$csaladiNev = trim($vars['csaladi_nev'] ?? '');
		$utonev = trim($vars['utonev'] ?? '');
		$bejelentkezes = trim($vars['login'] ?? '');
		$jelszo = $vars['password'] ?? '';
		$jelszoUjra = $vars['password_again'] ?? '';

		if($csaladiNev == '' || $utonev == '' || $bejelentkezes == '' || $jelszo == '' || $jelszoUjra == '')
		{
			$retData['uzenet'] = 'Minden mező kitöltése kötelező.';
			return $retData;
		}

		if($jelszo !== $jelszoUjra)
		{
			$retData['uzenet'] = 'A megadott jelszavak nem egyeznek meg.';
			return $retData;
		}

		try {
			$connection = Database::getConnection();

			$stmt = $connection->prepare('select count(*) from felhasznalok where bejelentkezes = :bejelentkezes');
			$stmt->execute(array(':bejelentkezes' => $bejelentkezes));

			if($stmt->fetchColumn() > 0)
			{
				$retData['uzenet'] = 'A választott bejelentkezési név már foglalt.';
				return $retData;
			}

			$stmt = $connection->prepare(
				'insert into felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo, jogosultsag) values (:csaladi_nev, :utonev, :bejelentkezes, :jelszo, :jogosultsag)'
			);
			$stmt->execute(array(
				':csaladi_nev' => $csaladiNev,
				':utonev' => $utonev,
				':bejelentkezes' => $bejelentkezes,
				':jelszo' => password_hash($jelszo, PASSWORD_DEFAULT),
				':jogosultsag' => '_1_'
			));

			$retData['eredmeny'] = 'OK';
			$retData['uzenet'] = 'Sikeres regisztráció. Most már bejelentkezhetsz a létrehozott adatokkal.';
		}
		catch (PDOException $e) {
			$retData['uzenet'] = 'Adatbázis hiba: '.$e->getMessage().'!';
		}

		return $retData;
	}
}

?>