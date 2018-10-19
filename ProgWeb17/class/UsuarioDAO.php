<?php	
	require_once 'Banco.php';
	require_once 'Usuario.php';

	class UsuarioDAO
	{

		public function salvar($usuario){	
			$situacao = FALSE;
			try{
				
				if($usuario->getIdUsuario()==0){

					$situacao = $this->incluir($usuario);

				}else{	
					$situacao = $this->atualizar($usuario);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbUsuario(login, senha, email, situacao, idGrupoAcesso) VALUES (:login, :senha, :email, :situacao, :idGrupoAcesso)";

				$run = $pdo->prepare($sql);
				$run->bindParam(':login', $usuario->getLogin(), PDO::PARAM_STR); 
				$run->bindParam(':senha', $usuario->getSenha(), PDO::PARAM_STR); 
				$run->bindParam(':email', $usuario->getEmail(), PDO::PARAM_STR); 
				$run->bindParam(':situacao', $usuario->getSituacao(), PDO::PARAM_INT); 
				$run->bindParam(':idGrupoAcesso', $usuario->getIdGrupoAcesso(), PDO::PARAM_INT); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$usuario->setIdUsuario($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbUsuario SET login = :login, senha = :senha, email = :email, situacao = :situacao, idGrupoAcesso = :idGrupoAcesso WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
				$run->bindParam(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT); 
				$run->bindParam(':login', $usuario->getLogin(), PDO::PARAM_STR); 
				$run->bindParam(':senha', $usuario->getSenha(), PDO::PARAM_STR); 
				$run->bindParam(':email', $usuario->getEmail(), PDO::PARAM_STR); 
				$run->bindParam(':situacao', $usuario->getSituacao(), PDO::PARAM_INT); 
				$run->bindParam(':idGrupoAcesso', $usuario->getIdGrupoAcesso(), PDO::PARAM_INT); 
	  			$run->execute(); 
				
				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;
		}						

		public function excluir($usuario){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbUsuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT);			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;

		}

		public function excluirPorId($codigo){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbUsuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idUsuario', $codigo, PDO::PARAM_INT);			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;

		}					

		public function listar(){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbUsuario";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$usuario = new Usuario();
					$usuario->setIdUsuario($objeto['idUsuario']);
					$usuario->setLogin($objeto['login']);
					$usuario->setSenha($objeto['senha']);
					$usuario->setEmail($objeto['email']);
					$usuario->setUltimoAcesso($objeto['ultimoAcesso']);
					$usuario->setSituacao($objeto['situacao']);
					$usuario->setIdGrupoAcesso($objeto['idGrupoAcesso']);
					array_push($objetos, $usuario);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$usuario = new Usuario();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbUsuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idUsuario', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$usuario = new Usuario();
				$usuario->setIdUsuario($resultado['idUsuario']);
				$usuario->setLogin($resultado['login']);
				$usuario->setSenha($resultado['senha']);
				$usuario->setEmail($resultado['email']);
				$usuario->setUltimoAcesso($resultado['ultimoAcesso']);
				$usuario->setSituacao($resultado['situacao']);
				$usuario->setIdGrupoAcesso($resultado['idGrupoAcesso']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $usuario;
		}		

		public function autenticar($login, $senha){

			$usuario = new Usuario();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbUsuario WHERE login = :login AND senha = :senha";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':login', $login, PDO::PARAM_STR);			
	  			$run->bindParam(':senha', $senha, PDO::PARAM_STR);	
				$run->execute(); 
				$resultado = $run->fetch();

				$usuario = new Usuario();
				$usuario->setIdUsuario($resultado['idUsuario']);
				$usuario->setLogin($resultado['login']);
				$usuario->setSenha($resultado['senha']);
				$usuario->setEmail($resultado['email']);
				$usuario->setUltimoAcesso($resultado['ultimoAcesso']);
				$usuario->setSituacao($resultado['situacao']);
				$usuario->setIdGrupoAcesso($resultado['idGrupoAcesso']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $usuario;
		}	

		public function verificarLogin($codigo, $login){

			$situacao = TRUE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "SELECT * FROM tbUsuario WHERE idUsuario <> :idUsuario AND login = :login";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idUsuario', $codigo, PDO::PARAM_INT);			
	  			$run->bindParam(':login', $login, PDO::PARAM_STR);	
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = FALSE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;

		}

		public function registrarAutenticacao($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbUsuario SET ultimoAcesso = NOW() WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
				$run->bindParam(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT);  
	  			$run->execute(); 
				
				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;
		}						

	}
	
?> 