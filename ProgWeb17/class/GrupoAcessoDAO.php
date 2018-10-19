<?php	
	require_once 'Banco.php';
	require_once 'GrupoAcesso.php';

	class GrupoAcessoDAO
	{

		public function salvar($grupoAcesso){	
			$situacao = FALSE;
			try{
				
				if($grupoAcesso->getIdGrupoAcesso()==0){

					$situacao = $this->incluir($grupoAcesso);

				}else{	
					$situacao = $this->atualizar($grupoAcesso);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($grupoAcesso){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbGrupoAcesso (descricao) VALUES (:descricao)";

				$run = $pdo->prepare($sql);
				$run->bindParam(':descricao', $grupoAcesso->getDescricao(), PDO::PARAM_STR); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$grupoAcesso->setIdGrupoAcesso($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($grupoAcesso){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbGrupoAcesso SET descricao = :descricao WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':descricao', $grupoAcesso->getDescricao(), PDO::PARAM_STR);
	  			$run->bindParam(':idGrupoAcesso', $grupoAcesso->getIdGrupoAcesso(), PDO::PARAM_INT);				
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

		public function excluir($grupoAcesso){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbGrupoAcesso WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idGrupoAcesso', $grupoAcesso->getIdGrupoAcesso(), PDO::PARAM_INT);			
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
					
				$sql = "DELETE FROM tbGrupoAcesso WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idGrupoAcesso', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbGrupoAcesso";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$grupoAcesso = new GrupoAcesso();
					$grupoAcesso->setIdGrupoAcesso($objeto['idGrupoAcesso']);
					$grupoAcesso->setDescricao($objeto['descricao']);
					array_push($objetos, $grupoAcesso);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$grupoAcesso = new GrupoAcesso();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbGrupoAcesso WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idGrupoAcesso', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$grupoAcesso->setIdGrupoAcesso($resultado['idGrupoAcesso']);
				$grupoAcesso->setDescricao($resultado['descricao']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $grupoAcesso;
		}		
	}
	
?> 