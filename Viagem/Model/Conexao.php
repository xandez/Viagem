<?php
	
	class ConexaoDB{
		private static $host = '127.0.0.1';
		private static $bd = 'viagem';
		private static $user = 'root';
		private static $senha = '';
		private static $conecction;

		public static function conectar(){
			ConexaoDB::$conecction = @mysql_connect(ConexaoDB::$host,ConexaoDB::$user,ConexaoDB::$senha);
			if (!ConexaoDB::$conecction) {
				echo ("<script>alert('Falha ao conectar ao banco!')</script>");
			}

			$banco = mysql_select_db(ConexaoDB::$bd);

			if (!$banco) {
				echo ("<script>alert('Falha ao selecionar o banco!')</script>");
			}

		}

		public static function desconectar(){
			mysql_close(ConexaoDB::$conecction);
		}

		public static function executar($sql){
			$query = mysql_query($sql) or die (mysql_error());
		}

		public function __destruct(){
			ConexaoDB::desconectar();
		}
	}


?>