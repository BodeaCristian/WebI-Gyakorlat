<?php

class Error_Controller
{
	public $baseName = 'error';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$view = new View_Loader($this->baseName.'_main');
		$view->assign('type', $vars[0]);
		$view->assign('message', $vars[1]);
	}
}

?>