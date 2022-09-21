<?php

	$acao = 'recuperar';
	require 'tarefa_controler.php';
	// echo "<pre>";
	// print_r($tarefas);
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function editar(id, descricao){
				let id_div = 'tarefa_'+id
				let id_icones = 'icones_'+id
				let div_alteracao = document.getElementById(id_div)
				let div_icones = document.getElementById(id_icones)

				let form = document.createElement('form')
				form.action = 'tarefa_controler.php?acao=atualizar'
				form.method = 'post'
				form.className = 'row'

				let input_tarefa = document.createElement('input')
				input_tarefa.type = 'text'
				input_tarefa.name = 'tarefa'
				input_tarefa.className = 'col-9 form-control'
				input_tarefa.value = descricao

				let input_id = document.createElement('input')
				input_id.type = 'hidden'
				input_id.name = 'id'
				input_id.value = id

				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'col-3 btn btn-info'
				button.innerHTML = 'Atualizar'
	
				form.appendChild(input_tarefa)
				form.appendChild(button)
				form.appendChild(input_id)

				div_icones.innerHTML = ''
				div_alteracao.appendChild(form)
			}

			function remover(id){
				location.href = 'todas_tarefas.php?acao=remover&id='+id;
				
			}

			function marcar_realizada(id){
				location.href = 'todas_tarefas.php?acao=marcar_realizada&id='+id;
			}

		</script>

	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />
								<?php
									foreach ($tarefas as $indice => $tarefa) { ?>
										<div class="row mb-3 d-flex align-items-center tarefa">
											<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
												<?php echo $tarefa->tarefa ?> (<?php echo $tarefa->status?>)
											</div>
											<div class="col-sm-3 mt-2 d-flex justify-content-between" id="icones_<?= $tarefa->id ?>">
												<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?=$tarefa->id?>)"></i>
												<?php if($tarefa->status == 'pendente'){ ?>
												<i class="fas fa-edit fa-lg text-info" onclick="editar(<?=$tarefa->id?>, '<?=$tarefa->tarefa?>')"></i>
												<i class="fas fa-check-square fa-lg text-success" onclick="marcar_realizada(<?=$tarefa->id?>)"></i>
												<?php } ?> 

											</div>
										</div>
								<?php
									}

								?>

							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>