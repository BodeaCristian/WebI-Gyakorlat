<?php

class Galeria_Controller
{
	public $baseName = 'galeria';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$retData = array(
			'images' => array(),
		);

		$uploadDir = SERVER_ROOT.'images/gallery/';
		$uploadUrlBase = SITE_ROOT.'images/gallery/';

		if(!is_dir($uploadDir)) {
			@mkdir($uploadDir, 0755, true);
		}

		if(is_dir($uploadDir)) {
			$files = scandir($uploadDir);
			rsort($files);

			foreach($files as $fileName) {
				if($fileName === '.' || $fileName === '..') {
					continue;
				}

				$path = $uploadDir.$fileName;
				if(!is_file($path)) {
					continue;
				}

				$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
				if(!in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'webp'), true)) {
					continue;
				}

				$retData['images'][] = array(
					'name' => $fileName,
					'url' => $uploadUrlBase.$fileName
				);
			}
		}

		$view = new View_Loader($this->baseName."_main");
		foreach($retData as $name => $value) {
			$view->assign($name, $value);
		}
	}
}

?>