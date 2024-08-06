<?php 
	
	namespace app\models;
	use \PDO;

	if(file_exists(__DIR__."/../../config/server.php")){
		require_once __DIR__."/../../config/server.php";
	}

	/**
	 * MODELOS PRINCIPALES
	 */
	class mainModel
	{

		private $server = DB_SERVER;
		private $db = DB_NAME;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $port = DB_PORT;

		
		protected function conect()
		{
			try {
			    $link = new PDO("mysql:host=".DB_SERVER.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS);
			    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
			    die("Connection failed: " . $e->getMessage());
			}
		    
		    return $link;

		}

		protected function execQue($query,$dataReturn=true)
		{
			$sql=$this->conect()->prepare($query);
			
			$sql->execute();

			if ($dataReturn) {
				return $sql -> fetchAll(PDO::FETCH_CLASS);
			} else {
				return $sql;
			}

		}


		public function cleanString($string)
		{
			$blackList = ["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::","EXECUTE","EXEC"];

			$string = trim($string);
			$string = stripcslashes($string);

			foreach ($blackList as $word) {
				$string = str_ireplace($word, "", $string);
			}

			$string = trim($string);
			$string = stripcslashes($string);

			if(empty($string)){
				$string="";
			}

			return $string;

		}

		protected function dataValid($filter, $string)
		{
			if (preg_match("/^".$filter."$/", $string)) {
				return false;
			} else {
				return true;
			}
			
		}


		protected function queSP($SP,$fields,$dataReturn=true)
		{
			$SP=$this->cleanString($SP);
			foreach ($fields as $field) {
				$field["field_value"]=$this->cleanString($field["field_value"]);
			}

			$query="Call $SP (";

			$cont=0;
			foreach ($fields as $field) {
				$query.= $field["field_mark"].",";
			}
			$query = substr($query, 0, -1);

			$query.=")";
			
			$sql=$this->conect()->prepare($query);

			foreach ($fields as $field) {
				$sql->bindParam($field["field_mark"],$field["field_value"]);
			}

			$sql->execute();

			if ($dataReturn) {
				return $sql -> fetchAll(PDO::FETCH_CLASS);
			} else {
				return $sql;
			}
			
		}

		public function encryption($string)
		{
			// return urlencode(base64_encode($string));
			/*-------------------------------------------*/
			$output=false;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

		public function decryption($string)
		{
			// return base64_decode(urldecode($string));
			/*-------------------------------------------*/
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

}
 ?>