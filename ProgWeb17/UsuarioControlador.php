<?php

	require_once 'class/UsuarioDAO.php';

	$operacao = $_GET["operacao"];
	$usuarioDAO = new UsuarioDAO();
	$usuario = new Usuario();

	switch($operacao) 
	{
        case 'salvar':

			$usuario->setIdUsuario($_POST["idUsuario"]);
			$usuario->setLogin($_POST["login"]);
			$usuario->setSenha($_POST["senha"]);
			$usuario->setEmail($_POST["email"]);
			$usuario->setSituacao($_POST["situacao"]);
			$usuario->setIdGrupoAcesso($_POST["idGrupoAcesso"]);
			$resultado = $usuarioDAO->salvar($usuario);

			echo $resultado;

			if($resultado == TRUE){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='UsuarioTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='UsuarioTabela.php';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$resultado = $usuarioDAO->excluirPorId($_GET["idUsuario"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='UsuarioTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='UsuarioTabela.php';</script>"; 			
			}			
        	break;   

        case 'verificarLogin':
			
			$login = $_POST["login"];
			$idUsuario = $_GET["idUsuario"];

			$resultado = $usuarioDAO->verificarLogin($idUsuario, $login);

			echo json_encode( $resultado );

		
        	break;          	      	
         	
	}
			
?>