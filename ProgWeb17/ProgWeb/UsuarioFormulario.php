<?php	

	session_start();

	require_once 'class/UsuarioDAO.php';
	require_once 'class/GrupoAcessoDAO.php';

	$usuario = new Usuario();		
	
	if(isset($_GET["idUsuario"])){
		
		$idUsuario = $_GET["idUsuario"];

		$usuarioDAO = new UsuarioDAO();
		$usuario = $usuarioDAO->buscarPorId($idUsuario);

	}
			
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
						

		<form id="formUsuario" action="UsuarioControlador.php?operacao=salvar" method="post">
			<div class="container">
				<div class="row form-group">
					<div class="col-md-12">
						<label for="login">Usuário</label>  
						<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $usuario->getIdUsuario() ?>" >
						<input class="form-control" name="login" id="login" type="text" value="<?php echo $usuario->getLogin() ?>">
					</div>			
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<label for="senha">Senha</label>
						<input class="form-control" id="senha" name="senha" type="password" value="<?php echo $usuario->getSenha() ?>">
					</div>			
				</div>	
				<div class="row form-group">
					<div class="col-md-12">
						<label for="email">E-mail</label>
						<input class="form-control" id="email" name="email" type="text" value="<?php echo $usuario->getEmail() ?>">
					</div>			
				</div>	
				
  
				<div class="row form-group">
					<div class="col-md-12">
						<legend class="col-form-label">Situação</legend>

						<div class="form-check">
							<input class="form-check-input" type="radio" name="situacao" id="situacaoHabilitado" value="1" <?php if($usuario->getSituacao() == 1){echo 'checked';} ?>>
							<label class="form-check-label" for="situacaoHabilitado">Habilitado</label>
						</div>
						
						<div class="form-check">
							<input class="form-check-input" type="radio" name="situacao" id="situacaoBloqueado" value="0" <?php if($usuario->getSituacao() == 0){echo 'checked';} ?>>
							<label class="form-check-label" for="situacaoBloqueado">Bloqueado</label>
						</div>
					</div>
				</div>

				<div class="row form-group">		
					<div class="col-md-12">
						<label for="idGrupoAcesso">Grupo de Acesso</label>
						<select id="idGrupoAcesso" name="idGrupoAcesso" class="form-control" required>						  
							<?php
								$grupoAcessoDAO = new GrupoAcessoDAO();
								$lista = $grupoAcessoDAO->listar();

								if($usuario->getIdGrupoAcesso() == 0){
									echo "<option value='' disabled selected>Selecione um grupo de acesso</option>";
								}

								foreach($lista as $grupoAcesso){	
									if($grupoAcesso->getIdGrupoAcesso() == $usuario->getIdGrupoAcesso()){
										echo "<option selected value='{$grupoAcesso->getIdGrupoAcesso()}'>{$grupoAcesso->getDescricao()}</option>";
									}
									else{
										echo "<option value='{$grupoAcesso->getIdGrupoAcesso()}'>{$grupoAcesso->getDescricao()}</option>";
									}
									
								}
							?>	
					
						</select>
						
					</div>								
				</div>	
				
				<div class="row form-group">
					<div class="col-md-11">
						<button class="btn btn-success" type="submit" name="action">Salvar</button>
						<button class="btn btn-danger" type="reset" name="action">Cancelar</button>						
					</div>											
					<div class="col-md-1">
						<a class="btn btn-primary" href="UsuarioTabela.php">Voltar</a>
					</div>																									
				</div>					
			</div>
		</form >	
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/usuario.js"></script>
    </body>
</html>