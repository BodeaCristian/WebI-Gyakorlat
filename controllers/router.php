<?php

session_start();
if(! isset($_SESSION['userid'])) $_SESSION['userid'] = 0;
if(! isset($_SESSION['userfirstname'])) $_SESSION['userfirstname'] = "";
if(! isset($_SESSION['userlastname'])) $_SESSION['userlastname'] = "";
if(! isset($_SESSION['userlevel'])) $_SESSION['userlevel'] = "1__";

include(SERVER_ROOT . 'includes/database.inc.php');
include(SERVER_ROOT . 'includes/menu.inc.php');

// Felbontjuk a paramétereket. Az / elválasztó jellel végzett felbontás megfelelõ lesz.
// Az elsõ eleme a megtekinteni kívánt oldal neve, a második az aloldal (almenü ponthoz
// tartozó oldal) neve vagy paraméter lehet.

$page = "nyitolap";
$subpage = "";
$vars = array();

$request = "";

if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== "" && strpos($_SERVER['QUERY_STRING'], '=') === false)
{
	$request = trim($_SERVER['QUERY_STRING'], '/');
}
else if(isset($_SERVER['REQUEST_URI']))
{
	$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$scriptName = $_SERVER['SCRIPT_NAME'] ?? "";
	$basePath = str_replace('\\', '/', dirname($scriptName));

	if($basePath == "/" || $basePath == ".")
	{
		$basePath = "";
	}

	if(is_string($requestPath))
	{
		if($basePath !== "" && strpos($requestPath, $basePath) === 0)
		{
			$requestPath = substr($requestPath, strlen($basePath));
		}

		$indexPath = '/'.basename($scriptName);
		if($indexPath !== '/' && strpos($requestPath, $indexPath) === 0)
		{
			$requestPath = substr($requestPath, strlen($indexPath));
		}

		$request = trim($requestPath, '/');
	}
}

if($request != "")
{
	$params = explode('/', $request);
	$page = array_shift($params); // a kért oldal neve
	
	if(array_key_exists($page, Menu::$menu) && count($params)>0) // Az oldal egy menüpont oldala és van még adat az url-ben
	{
		$subpage = array_shift($params); // a kért aloldal
		if(! (array_key_exists($subpage, Menu::$menu) && Menu::$menu[$subpage][1] == $page)) // ha nem egy alolal
		{
			$vars[] = $subpage; // akkor ez egy parameter
			$subpage = ""; // és nincs aloldal
		}
		
	}
	
	foreach($params as $p) // a paraméterek tömbje feltöltése
	{
		$vars[] = $p;
	}

	$vars += $_POST;
}

// Meghatározzuk a kért oldalhoz tartozó vezérlõt. Ha megtaláltuk
// a fájlt és a hozzá tartozó vezérlõ oldalt is, akkor betöltjük az
// elõbbiekben lekérdezett paramétereket továbbadva. 

$controllerfile = $page.($subpage != "" ? "_".$subpage : "");
$target = SERVER_ROOT.'controllers/'.$controllerfile.'.php';
if(! file_exists($target))
{
	$target = SERVER_ROOT.'controllers/error.php';
	$vars[0] = "A vezérlő nem található";
	$vars[1] = "Hiányzó oldal <strong>".$controllerfile."</strong>";
	$controllerfile = "error";
}

include_once($target);
$class = ucfirst($controllerfile).'_Controller';
if(! class_exists($class))
{
	include_once(SERVER_ROOT.'controllers/error.php');
	$vars[0] = "A vezérlő főosztálya nem található";
	$vars[1] = "Hiányos oldal megadása <strong>".$controllerfile."</strong>";
	$class = 'Error_Controller';
}


include_once(SERVER_ROOT.'models/view_loader.php');

$controller = new $class;
$controller->main($vars);
