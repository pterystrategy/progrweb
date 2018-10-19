<?php	

	session_start();	
	require_once 'class/GrupoAcessoDAO.php';
	$grupoAcesso = new GrupoAcesso();
		
	if(isset($_GET["idGrupoAcesso"])){
		
		$idGrupoAcesso = $_GET["idGrupoAcesso"];

		$grupoAcessoDAO = new GrupoAcessoDAO();
		$grupoAcesso = $grupoAcessoDAO->buscarPorId($idGrupoAcesso);
	}
			
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
			
			<form id="formGrupoAcesso" action="GrupoAcessoControlador.php?operacao=salvar" method="post">

				<div class="row form-group">
					<div class="col-md-12">
						<label for="descricao">Descrição</label>  
						<input type="hidden" name="idGrupoAcesso" id="idGrupoAcesso" value="<?php echo $grupoAcesso->getIdGrupoAcesso() ?>" >
						<input class="form-control" name="descricao" id="descricao" type="text" value="<?php echo $grupoAcesso->getDescricao() ?>" >
					</div>
				</div>				
				<div class="row form-group">
					<div class="col-md-11">
						<button class="btn btn-success" type="submit" id="salvar">Salvar</button>
						<button class="btn btn-danger" type="reset" id="cancelar">Cancelar</button>						
					</div>											
					<div class="col-md-1">
						<a class="btn btn-primary" href="GrupoAcessoTabela.php">Voltar</a>					
					</div>																
				</div>					
			</form >	
		</div>
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/grupoacesso.js"></script>
    </body>
</html>