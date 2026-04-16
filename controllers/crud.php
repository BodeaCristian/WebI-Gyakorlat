<?php

class Crud_Controller
{
	public $baseName = 'crud';  //meghat�rozni, hogy melyik oldalon vagyunk

	private function redirectWithMessage($message)
	{
		header('Location: '.SITE_ROOT.'crud?msg='.urlencode($message));
		exit;
	}

	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
		$retData = array(
			'eredmeny' => 'OK',
			'uzenet' => isset($_GET['msg']) ? (string)$_GET['msg'] : '',
			'action' => isset($_GET['action']) ? (string)$_GET['action'] : 'list',
			'editingId' => isset($_GET['id']) ? (int)$_GET['id'] : 0,
			'gepek' => array(),
			'processzorok' => array(),
			'oprendszerek' => array(),
			'form' => array(
				'gyarto' => '',
				'tipus' => '',
				'kijelzo' => '',
				'memoria' => '',
				'merevlemez' => '',
				'vezerlo' => '',
				'ar' => '',
				'processzorid' => '',
				'oprendszerid' => '',
				'db' => ''
			)
		);



		include_once(SERVER_ROOT.'models/crud_model.php');
		$model = new Crud_Model;

		try {
			if($retData['action'] === 'delete' && $retData['editingId'] > 0) {
				$model->deleteGep($retData['editingId']);
				$this->redirectWithMessage('A rekord törlése sikeres volt.');
			}

			if($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($retData['action'] === 'create') {
					$result = $model->createGep($_POST);
					if($result['ok']) {
						$this->redirectWithMessage('A rekord létrehozása sikeres volt.');
					}
					$retData['eredmeny'] = 'ERROR';
					$retData['uzenet'] = $result['error'];
					$retData['form'] = array_merge($retData['form'], $_POST);
				}

				if($retData['action'] === 'edit' && $retData['editingId'] > 0) {
					$result = $model->updateGep($retData['editingId'], $_POST);
					if($result['ok']) {
						$this->redirectWithMessage('A rekord módosítása sikeres volt.');
					}
					$retData['eredmeny'] = 'ERROR';
					$retData['uzenet'] = $result['error'];
					$retData['form'] = array_merge($retData['form'], $_POST);
				}
			}

			$retData['processzorok'] = $model->getProcesszorok();
			$retData['oprendszerek'] = $model->getOprendszerek();

			if($retData['action'] === 'edit' && $retData['editingId'] > 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
				$record = $model->getGepById($retData['editingId']);
				if($record) {
					$retData['form'] = array_merge($retData['form'], $record);
				} else {
					$retData['eredmeny'] = 'ERROR';
					$retData['uzenet'] = 'A szerkeszteni kívánt rekord nem található.';
					$retData['action'] = 'list';
				}
			}

			$retData['gepek'] = $model->getGepek();
		}
		catch (PDOException $e) {
			$retData['eredmeny'] = 'ERROR';
			$retData['uzenet'] = 'Adatbázis hiba: '.$e->getMessage();
		}

		$view = new View_Loader($this->baseName.'_main');
		foreach($retData as $name => $value) {
			$view->assign($name, $value);
		}
	}
}

?>