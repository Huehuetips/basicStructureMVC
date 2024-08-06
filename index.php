<?php  
	
	require_once "config/app.php";
	require_once "autoload.php";
	require_once "app/views/inc/session_start.php";
	
	use app\controllers\viewsController;
	use app\controllers\loginController;

	$insLogin = new loginController();
	$viewsController = new viewsController();
	
	if (isset($_GET['views'])) {
		$url=explode("/", $_GET['views']);

		$param = [];
		foreach ($url as $key => $value) {
		    if ("-" == (!empty($value[0]) ? $value[0] : "")) {
		        $_keys = explode('-', substr($value, 1), 2);

		        $param[empty($_keys[0]) ? "Param" : $_keys[0]] = empty($_keys[1]) ? 0 : $_keys[1]; 
		        unset($url[$key]);
		    }
		}

		$url = array_values($url);

		$file = empty($url[1]) ?   ""	: $url[0];
		$nView = empty($url[1]) ? $url[0]: $url[1];
		
		$rute = empty($file)? $nView: $file."/".$nView;
	} else {
		// LA PÁGINA POR DEFAULT EN CASO DE QUE NO SE ESPECIFIQUE LA RUTA
		$rute="HOME";
		$nView=$rute;
	}

	$view = $viewsController->getControllerViews($rute);

	if ($view=="404" || $view=="403") {
		require_once "app/views/content/".$view."-view.php";
	} else {
		require_once $view;
	}
?>

