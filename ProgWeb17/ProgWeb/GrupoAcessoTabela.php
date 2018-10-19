<?php	
	session_start();
	require_once 'class/GrupoAcessoDAO.php';
?>
	
<html>
    <head>
		<meta charset="utf-8">
		<title>Grupo de Acesso</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/grupoacesso.css"/>
    </head>

    <body>	
	
		<div class="cabecalho">	
			<?php 
				$menu = "grupoAcesso";
				include_once("Cabecalho.php");  	
			?>
		</div>
	
		<div class="container">				
			
			<table class="table table-striped">
				<thead>					
					<tr>
						<th class="col-md-10">Descrição</th>
						<th class="col-md-1"></th>
						<th class="col-md-1"><a class="btn btn-primary" href="GrupoAcessoFormulario.php">Novo</a></th>
					</tr>
				</thead>
				<tbody>
					<?php
	
						$grupoAcessoDAO = new GrupoAcessoDAO();
						$lista = $grupoAcessoDAO->listar();

						foreach($lista as $grupoAcesso){						echo"<tr>";			
							echo"<td>{$grupoAcesso->getDescricao()}</td>";
							echo"<td> <a class='btn btn-success' href='GrupoAcessoFormulario.php?idGrupoAcesso={$grupoAcesso->getIdGrupoAcesso()}'> editar </a> </td>";
							echo"<td> <a class='btn btn-danger'  href='GrupoAcessoControlador.php?operacao=excluir&idGrupoAcesso={$grupoAcesso->getIdGrupoAcesso()}'> excluir </a> </td>";								
							echo"</tr>";							
						}						
						
					?>		
						
				</tbody>
			</table>	
		<div>				
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>