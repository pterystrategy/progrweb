<?php
	class Usuario
	{
        private  $idUsuario;
        private  $login;
        private  $senha;
        private  $email;
        private  $ultimoAcesso;
        private  $situacao;
        private  $idGrupoAcesso;
                
        function __construct() {
            $this->setIdUsuario(0);
            $this->setLogin("");
            $this->setSenha("");
            $this->setEmail("");
            $this->setUltimoAcesso("");
            $this->setSituacao(1);
            $this->setIdGrupoAcesso(0);
        }

		function __toString() 
		{
			return $this->getLogin();
		}

        function getIdUsuario(){
            return $this->idUsuario;
        }
        function setIdUsuario($idUsuario){
            $this->idUsuario = intval($idUsuario);
        }

        function getLogin(){
            return $this->login;
        }
        function setLogin($login){
            $this->login = $login;
        }        

        function getSenha(){
            return $this->senha;
        }
        function setSenha($senha){
            $this->senha = $senha;
        }   

        function getEmail(){
            return $this->email;
        }
        function setEmail($email){
            $this->email = $email;
        }  

        function getUltimoAcesso(){
            return $this->ultimoAcesso;
        }
        function setUltimoAcesso($ultimoAcesso){
            $this->ultimoAcesso = $ultimoAcesso;
        }

        function getSituacao(){
            return $this->situacao;
        }
        function setSituacao($situacao){
            $this->situacao = intval($situacao);
        }
     		
        function getIdGrupoAcesso() {
            return $this->idGrupoAcesso;
        }

        function setIdGrupoAcesso($idGrupoAcesso) {
            $this->idGrupoAcesso = intval($idGrupoAcesso);
        }

	}
?>
