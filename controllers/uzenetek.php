<?php

class Uzenetek_Controller
{
	public $baseName = 'uzenetek';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		include_once(SERVER_ROOT.'models/uzenetek_model.php');
		$model = new Uzenetek_Model;
		$retData = $model->get_data();

		$view = new View_Loader($this->baseName.'_main');
		foreach($retData as $name => $value) {
			$view->assign($name, $value);
		}
	}
}

?>