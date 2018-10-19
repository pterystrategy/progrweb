<?php
	class GrupoAcesso
	{
		private  $idGrupoAcesso;
		private  $descricao;
                
        function __construct() {
            $this->setIdGrupoAcesso(0);
            $this->setDescricao("");
        }

		function __toString() 
		{
			return $this->getDescricao();
		}
        		
        function getIdGrupoAcesso() {
            return $this->idGrupoAcesso;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function setIdGrupoAcesso($idGrupoAcesso) {
            $this->idGrupoAcesso = intval($idGrupoAcesso);
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
	}
?>
