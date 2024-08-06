<?php 

	const APP_NAME="NAMEAPP"; //NOMBRE DE MI APLICACIÓN
	const APP_SESSION_NAME="NAMESESSION"; //NOMBRE DE SESSIÓN DE MI APP


	//CONFIGURACIÓN DE ENCRIPTACIÓN
	const METHOD="AES-256-CBC";
	const SECRET_KEY='$'.APP_NAME.'@ADONY';
	const SECRET_IV="5969";

	// RUTA DE LA APLICACIÓN
	const APP_URL="http://localhost/".APP_NAME."/";

	date_default_timezone_set("America/Guatemala");
	setlocale(LC_TIME, 'es', 'spa', 'es_Es')

 ?>