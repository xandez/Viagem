<?php

header('Content-Type: text/html; charset=utf-8');

	class Viagem{
		private $id;
		private $local;
		private $data;
		private $viajante;
		private $telefone;
		private $localsaida;
		private $status;

		public function set($propriedade, $valor){
			$this->$propriedade = $valor;
		}

		public function salvardados(){
			$sql = "insert into viagem (local,data,viajante,telefone,localsaida,status) values ('".$this->local."','".$this->data."','".$this->viajante."','".$this->telefone."','".$this->localsaida."','".$this->status."')";

			if (mysql_query($sql)) {
			 	return true;
			 }else{
			 	return false;
			 }
		}

		public function listarviagem(){
			$sql = "SELECT * FROM `viagem` ORDER BY `viagem`.`data` DESC";
			$res = mysql_query($sql);
			$lista = null;
			while ($objeto = mysql_fetch_object($res)) {
				if ($objeto != null) {
					$lista[] = $objeto;
				}else{
					return "erro de retorno";
				}
			}
			return $lista;
		}

		public function alterarstatus(){
			$sql = "UPDATE viagem set status = '".$this->status."' where id ='".$this->id."'";

			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}
		}
	}

	?>