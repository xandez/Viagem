<?php

require_once '../Model/Conexao.php';
require_once '../Model/Viagem.php';

class ViagemController{
	public function __construct(){
		call_user_func(array($this, $_REQUEST["evento"]));
	}

	public function listarViagem(){
		ConexaoDB::conectar();

		$viagem = new Viagem();
		//$viagem->set('status',$status);
		$listar = $viagem->listarviagem();

		return $listar;
	}

	public function salvarViagem(){		

		ConexaoDB::conectar();
		//PEGAR DADOS DO VIAGEM.PHP PARA SALVAR VIA POST.
		$inlocal 		= $_POST['local'];
		$indata  		= $_POST['data'];
		$inviajante 	= $_POST['Responsavel'];
		$intelefone 	= $_POST['Telefone'];
		$inlocalsaida   = $_POST['LocalSaida'];
		$instatus 		= 'Pendente';

		//SETAR VALORES NA CLASSE.
		$viagem = new Viagem();
		$viagem->set('local',$inlocal);
		$viagem->set('data',$indata);
		$viagem->set('viajante',$inviajante);
		$viagem->set('telefone',$intelefone);
		$viagem->set('localsaida',$inlocalsaida);
		$viagem->set('status',$instatus);


		//echo $viagem->salvardados();
		if ($viagem->salvardados()) {
			header("refresh:1;url=../View/Viagem.php");
		}else{
			echo $inlocal,$indata,$inviajante,$intelefone,$inlocalsaida,$instatus;
		}
		
	}

	public function alterarStatus($id,$status){
		ConexaoDB::conectar();

		$viagem = new Viagem();
		$viagem->set('id',$id);
		$viagem->set('status',$status);

		$viagem->alterarstatus();
	}
}


$controller = new ViagemController();


?>