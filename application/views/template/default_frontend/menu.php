<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<!-- Docs master nav -->

	<?php echo 'menu del frontend'; ?>
	<?php die(); ?>
	<header class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
					<span class="sr-only">Habilitar menú</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo PUBLIC_FOLDER;?>" class="navbar-brand" style="color:#428bca;">Agimed</a>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                            <div   align="right" >
                                <br />
                                <a class="btn-danger btn" href="<?php echo PUBLIC_FOLDER;?>login/close.html">Cerrar Sesión</a>
                            </div>

			</nav>
		</div>
	</header>
	<div class="container bs-docs-container">
		<div class="row">
			<!-- MENU -->
			<div class="col-md-3">


				<div class="bs-sidebar" data-spy="affix" data-offset-top="0" id="myAffix" role="complementary">
                                    <div class="logo-agimed"><a href="<?php echo PUBLIC_FOLDER;?>"><img src="<?php echo PUBLIC_FOLDER;?>imagenes/logo-agimed.png"></a></div>
					<ul class="nav bs-sidenav">
						<li
							class="<?php if(strtolower($this->router->fetch_module()) == 'medicos') echo 'active';?> active"><a
							href="<?php echo PUBLIC_FOLDER;?>hospitales/medicos.html">Médicos</a>
							<ul class="nav">
								<li
									class="<?php if((strtolower($this->router->fetch_module()) == 'medicos') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>"><a
									href="<?php echo PUBLIC_FOLDER;?>hospitales/medicos/listar.html">Listar</a>
								</li>
								<li
									class="<?php if((strtolower($this->router->fetch_module()) == 'medicos') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>"><a
									href="<?php echo PUBLIC_FOLDER;?>hospitales/medicos/alta.html">Crear</a></li>
							</ul>
						</li>
						<li
							class="<?php if(strtolower($this->router->fetch_module()) == 'pacientes') echo 'active';?> active"><a
							href="<?php echo PUBLIC_FOLDER;?>hospitales/pacientes.html">Pacientes</a>
							<ul class="nav">
								<li
									class="<?php if((strtolower($this->router->fetch_module()) == 'pacientes') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>"><a
									href="<?php echo PUBLIC_FOLDER;?>hospitales/pacientes/listar.html">Listar</a>
								</li>
								<li
									class="<?php if((strtolower($this->router->fetch_module()) == 'pacientes') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>"><a
									href="<?php echo PUBLIC_FOLDER;?>hospitales/pacientes/alta.html">Crear</a></li>
							</ul>
						</li>
						<li
							class="<?php if(strtolower($this->router->fetch_module()) == 'pedidos') echo 'active';?> active"><a
							href="<?php echo PUBLIC_FOLDER;?>pedidos.html">Pedidos</a>
							<ul class="nav">
								<li
									class="<?php if((strtolower($this->router->fetch_module()) == 'pedidos') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>"><a
									href="<?php echo PUBLIC_FOLDER;?>pedidos/listar.html">Listar</a>
								</li>
								<li
									class="<?php if((strtolower($this->router->fetch_module()) == 'pedidos') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>"><a
									href="<?php echo PUBLIC_FOLDER;?>pedidos/agregar.html">Crear</a></li>
							</ul>
						</li>
					</ul>
				</div>

			</div>

		<!-- FIN MENU -->
		<div class="col-md-9" role="main" id="contenedor">
			<!-- BreadCrumb -->
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo PUBLIC_FOLDER  .$this->router->fetch_module();?>.html"><?php echo ucfirst($this->router->fetch_module());?></a>
				</li>
				<?php if($this->router->fetch_method() != '' or $this->router->fetch_method() != 'index' ):?>
				<li class="active">
					<?php echo ucfirst($this->router->fetch_method());?>
				</li>
				<?php endif;?>
			</ol>
			<!-- Fin BreadCrumb -->