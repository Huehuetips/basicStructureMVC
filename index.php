<?php  
	
	require_once "config/app.php";
	require_once "autoload.php";
	require_once "app/views/inc/session_start.php";
	
	use app\controllers\viewsController;
	use app\controllers\loginController;

	$insLogin = new loginController();
	$viewsController = new viewsController();
	
	if (isset($_GET['views'])) {
		$url = explode("/", $_GET['views']); // Divide la URL en partes usando "/"

		$param = [];
		foreach ($url as $key => $value) {
		    if ("-" == (!empty($value[0]) ? $value[0] : "")) { // Verifica si hay parámetros adicionales
		        $_keys = explode('-', substr($value, 1), 2);

		        $param[empty($_keys[0]) ? "Param" : $_keys[0]] = empty($_keys[1]) ? 0 : $_keys[1]; 
		        unset($url[$key]);
		    }
		}

		$url = array_values($url); // Reorganiza la URL

		$file = empty($url[1]) ? "" : $url[0]; // Obtiene el archivo
		$nView = empty($url[1]) ? $url[0] : $url[1]; // Obtiene la vista
		
		$rute = empty($file) ? $nView : $file . "/" . $nView; // Construye la ruta
	} else {
		// LA PÁGINA POR DEFAULT EN CASO DE QUE NO SE ESPECIFIQUE LA RUTA
		$rute = "Login";
		$nView = $rute;
	}

	$view = $viewsController->getControllerViews($rute); // Obtiene la vista correspondiente

	if ($view == "404" || $view == "403") {
		require_once "app/views/content/" . $view . "-view.php"; // Carga la vista de error
	} else {
		require_once $view; // Carga la vista correspondiente
	}
?>

