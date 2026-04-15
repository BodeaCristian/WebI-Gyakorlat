<?php

class Kapcsolat_Controller
{
	public $baseName = 'kapcsolat';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$retData = array(
			'eredmeny' => '',
			'uzenet' => '',
			'errors' => array(),
			'form' => array(
				'nev' => '',
				'email' => '',
				'targy' => '',
				'szoveg' => ''
			)
		);

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			include_once(SERVER_ROOT.'models/kapcsolat_model.php');
			$kapcsolatModel = new Kapcsolat_Model;
			$retData = $kapcsolatModel->get_data($vars);

			if($retData['eredmeny'] === 'OK') {
				$this->baseName = 'kapcsolat_uzenet';
			}
		}

		$view = new View_Loader($this->baseName."_main");
		foreach($retData as $name => $value) {
			$view->assign($name, $value);
		}
	}
}

?>