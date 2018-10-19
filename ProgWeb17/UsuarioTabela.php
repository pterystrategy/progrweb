<?php	
	session_start();
	require_once 'class/UsuarioDAO.php';
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Usuário</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/usuario.css"/>
		
    </head>

    <body>	
		
		<div class="cabecalho">	
			<?php 
				$menu = "usuario";
				include_once("Cabecalho.php");  	
			?>
		</div>		
				
		<div class="container">				
			<table id="tabelaUsuario" class="table table-striped">
				<thead>			
					<tr>
						<th class="col-md-4">Usuário</th>
						<th class="col-md-4">E-mail</th>
						<th class="col-md-1" colspan='2'>Último acesso</th>
						<th class="col-md-1"></th>
						<th class="col-md-1"><a class="btn btn-primary" href="UsuarioFormulario.php">Novo</a></th>
					</tr>
				</thead>
				<tbody>
					<?php

						$usuarioDAO = new UsuarioDAO();
						$lista = $usuarioDAO->listar();

						foreach($lista as $usuario){
		
							echo"<tr>";			
							echo"<td>{$usuario->getLogin()}</td>";
							echo"<td>{$usuario->getEmail()}</td>";
							if(strlen($usuario->getUltimoAcesso()) > 0){
								echo"<td>".date("d/m/Y", strtotime($usuario->getUltimoAcesso()))."</td>";
								echo"<td>".date("H:i:s", strtotime($usuario->getUltimoAcesso()))."</td>";								
							}else{
								echo"<td></td>";
								echo"<td></td>";
							}

							echo"<td> <a class='btn btn-success' href='UsuarioFormulario.php?idUsuario={$usuario->getIdUsuario()}'> editar </a> </td>";
							echo"<td> <a class='btn btn-danger'  href='UsuarioControlador.php?operacao=excluir&idUsuario={$usuario->getIdUsuario()}'> excluir </a> </td>";								
							echo"</tr>";					
						}
						
					?>		
						
				</tbody>
			</table>	
		<div>				
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/usuario.js"></script>
		
    </body>
</html>