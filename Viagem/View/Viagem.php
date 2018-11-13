<?php 
	error_reporting(0);
	require_once '../Control/Viagem_controller.php';
	date_default_timezone_set('America/Sao_Paulo');


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../Css/Viagem.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<title>Viagens</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
		
</head>
<body>
	<!-- header -->
	<nav class="navbar navbar-light bg-light">
	  <span class="navbar-brand mb-0 h1">Viagens</span>
	  <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" href="#" role="button">Cadastrar Viagem</a>
	</nav>
	<span class="filtro">Filtrar Destino</span>
	<input type="text" id="txtBusca" />
	<!-- Tabela -->
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Nº</th>
	      <th scope="col">Destino</th>
	      <th scope="col">Data</th>
	      <th scope="col">Responsavel</th>
	      <th scope="col">Telefone</th>
	      <th scope="col">Saida</th>
	      <th scope="col">Status</th>
	    </tr>
	  </thead>
	  <tbody id="filtro">  	  
	<?php  
	    $hora = date("d-m-Y");
		$viagemcontroller = new ViagemController();
		$status = 'Pendente';
		$lista = $viagemcontroller->listarViagem();
		//echo $lista;
			if ($lista != 0 ) {
				foreach ($lista as $objeto) {
					echo '<tr>
					       <td>'.$objeto->id.'</td>
					       <td>'.$objeto->local.'</td>
					       <td>'.date("d-m-Y",strtotime($objeto->data)).'</td>
					       <td>'.$objeto->viajante.'</td>
					       <td>'.$objeto->telefone.'</td>
					       <td>'.$objeto->localsaida.'</td>
					       <td><span class="badge badge-success">';
					       if ((date("d-m-Y",strtotime($objeto->data))-$hora) <0) {
					       	$viagemcontroller->alterarStatus($objeto->id,'Finalizado');
					       	echo $objeto->status;
					       }else{
					       	$viagemcontroller->alterarStatus($objeto->id,'Pendente');
					       	echo $objeto->status;
					       }
					       echo '</span></td>
					      </tr>';
				}			
			}else{
			echo "Sem informação";
			}			
	?>
	  </tbody>
	</table>
	<!--Formulario de cadastro-->
	<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar nova viagem</h5>
					<span class="obrigatorio">Campo obrigatório*</span>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="..\Control\Viagem_controller.php?evento=salvarViagem" method="post">
	      		  <div class="form-group">
	      		  	<div class="row">
	      		  		<div class="col">
	      		  			<label for="Destino">Destino da Viagem*</label>
					   		 <input name="local" required class="form-control" id="Destino" aria-describedby="emailHelp" placeholder="Destino">	
	      		  		</div>
	      		  		<div class="col">
	      		  			<label for="DataSaida">Data de Saida*</label>
					    	<input name="data" required type="date" class="form-control" id="DataSaida" aria-describedby="emailHelp" placeholder="Destino">		
	      		  		</div>					    
					</div>
				    <label for="Responsavel">Responsavel*</label>
				    <input name="Responsavel" required class="form-control" id="Responsavel" placeholder="Nome">
				    <label for="Telefone">Telefone*</label>
				    <input name="Telefone" required class="form-control" id="Telefone" placeholder="">
				    <label for="LocalSaida">Local de Saida*</label>
				    <input name="LocalSaida" required class="form-control" id="LocalSaida" placeholder="">
				  </div>				  
				  <button type="submit" class="btn btn-primary">Salvar</button>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <!--<button type="button" class="btn btn-primary">Salvar</button>-->
	      </div>
	    </div>
	  </div>
	</div>	
</body>
</html>
	
	<script type="text/javascript">/*
			$(document).ready(function() {
					alert("Você está executando a versão do jQuery: " + jQuery.fn.jquery);
			});
*/
			$("#txtBusca").keyup(function(){
				var texto = $(this).val();

				//$("#filtro tr").css("display","block");
				$("#filtro tr").each(function(){
				//	alert($(this).text().indexOf(texto));
					if($(this).text().indexOf(texto) < 0){
						$(this).css("display","none");
					}else{
						$(this).css("display","");
					}
					
				});
			});
			
		</script>