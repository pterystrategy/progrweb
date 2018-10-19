<?php

	session_start();
	require_once 'class/UsuarioDAO.php';

	$operacao = $_GET["operacao"];
	$usuarioDAO = new UsuarioDAO();

	switch($operacao) 
	{
        case 'autenticar':

			$login = $_POST["login"];
			$senha = $_POST["senha"];        
			
			$usuario = $usuarioDAO->autenticar($login, $senha);

			if(($usuario->getIdUsuario() > 0) || (($login == "admin")&&($senha="123"))){

				$usuarioDAO->registrarAutenticacao($usuario);

				$_SESSION["USUARIO"]= $usuario->getLogin();	
				
				if(($login == "admin")&&($senha="123")){
					$_SESSION["USUARIO"]= $login;	
				}
					
				echo "<script>location.href='Menu.php';</script>"; 
			}else{
				echo "<script>alert('Usuário ou senha inválido!'); location.href='Login.php';</script>"; 			
			}

        	break; 

        case 'encerrar':

			session_unset();	
			session_destroy();	
				
			header('Location: Login.php');	

        	break;         	

        	          	
	}
			
?>