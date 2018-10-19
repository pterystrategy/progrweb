

		<nav class="navbar navbar-expand-md navbar-dark bg-dark">

		  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
			
			  <li class="nav-item <?php if($menu=='inicio'){echo 'active';} ?>">
				<a class="nav-link" href="Menu.php">Início</a>
			  </li>			
			
			  <li class="nav-item <?php if($menu=='usuario'){echo 'active';} ?>">
				<a class="nav-link" href="UsuarioTabela.php">Usuário</a>
			  </li>
			  
			  <li class="nav-item <?php if($menu=='grupoAcesso'){echo 'active';} ?>">
				<a class="nav-link" href="GrupoAcessoTabela.php">Grupo de Acesso</a>
			  </li>
			  	  
		  			  
			</ul>
			<div class="form-inline my-2 my-lg-0">
			  <label class="form-control mr-sm-2" readonly> <?php echo $_SESSION["USUARIO"] ?> </label>
			  <a class="btn btn-outline-danger my-2 my-sm-0" href="LoginControlador.php?operacao=encerrar">Sair</a>
			</div>
		  </div>
		</nav>
		


