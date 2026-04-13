<?php

class Kepfeltoltes_Controller
{
	public $baseName = 'kepfeltoltes';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$retData = array(
			'uzenet' => '',
			'hiba' => '',
			'uploadedImageUrl' => ''
		);

		$uploadDir = SERVER_ROOT.'images/gallery/';
		$uploadUrlBase = SITE_ROOT.'images/gallery/';

		if(!is_dir($uploadDir)) {
			@mkdir($uploadDir, 0755, true);
		}

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isset($_FILES['feltoltes_kep'])) {
				$retData['hiba'] = 'Nem érkezett feltöltendő fájl.';
			} else {
				$file = $_FILES['feltoltes_kep'];
				$maxSize = 5 * 1024 * 1024; // 5 MB
				$allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');

				if($file['error'] !== UPLOAD_ERR_OK) {
					$retData['hiba'] = 'A feltöltés nem sikerült. Hibakód: '.$file['error'];
				} elseif($file['size'] > $maxSize) {
					$retData['hiba'] = 'A kép túl nagy. A maximum méret 5 MB.';
				} else {
					$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
					if(!in_array($ext, $allowedExt, true)) {
						$retData['hiba'] = 'Csak JPG, PNG, GIF vagy WEBP képek tölthetők fel.';
					} else {
						$targetName = uniqid('kep_', true).'.'.$ext;
						$targetPath = $uploadDir.$targetName;

						if(move_uploaded_file($file['tmp_name'], $targetPath)) {
							$retData['uzenet'] = 'A kép sikeresen feltöltve. A galériában már meg is jelenik.';
							$retData['uploadedImageUrl'] = $uploadUrlBase.$targetName;
						} else {
							$retData['hiba'] = 'A kép mentése nem sikerült a szerveren.';
						}
					}
				}
			}
		}

		$view = new View_Loader($this->baseName."_main");
		foreach($retData as $name => $value) {
			$view->assign($name, $value);
		}
	}
}

?>