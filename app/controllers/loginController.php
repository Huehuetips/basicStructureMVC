<?php 

	namespace app\controllers;
	use app\classes\userClass;

	/**
	 * CONTROLADOR DE LOGIN
	 */
	class loginController extends userClass
	{
		/**
		 * CONTROLADOR DEL INICIO DE SESION
		 */
		
		public function sessionStart()
		{

			/**
			 * LIMPIANDO Y ALMACENANDO DATOS
			 */

			$this->setUserUser($this->cleanString($_POST['INPUT']));
			$this->setPasswordUser($this->cleanString($_POST['INPUT']));

			// Validaciones del campo Usuario
			if (empty($this->getUserUser())) {
	            $alert = [
	                "type"  => "msg",
	                "title" => "ERROR",
	                "text"  => "USER is empty",
	                "icon"  => "danger",
	                "focus"  => "userUser",
	            ];
	            return json_encode($alert);
	            exit();
	        }

		}

		public function sessionClose()
		{
			session_destroy();

			if (headers_sent()) {
				echo "
					 <script>
					 	window.location.href='".APP_URL."HOME/';
					 </script>
				 ";
			} else {

				header("location: ".APP_URL."HOME/");
				
			}
			

		}



	}

?>