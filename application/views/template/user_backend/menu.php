<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!-- Docs master nav -->
<header class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo base_url('login');?>" class="navbar-brand" style="color:#428bca;">Clasificom</a>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<div align="right" >
				<br />
				<a class="btn-success btn" href="<?php echo base_url('creditos');?>">Creditos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="btn-info btn" href="<?php echo base_url('usuarios/mi_cuenta');?>">Mi Cuenta</a>&nbsp;
				<a style="float:right;" class="btn-danger btn" href="<?php echo base_url('login/close');?>">Cerrar Sesión</a>
			</div>
			<br />
		</nav>
	</div>
</header>

<div class="container bs-docs-container">
	<div class="row">
		<!-- MENU -->
		<div class="col-md-3">
			<div class="bs-sidebar" data-spy="affix" data-offset-top="0" id="myAffix" role="complementary">
				<div class="logo-agimed">
					CLASIFICOM :: PANEL DEL VENDEDOR
				</div>
					<ul class="nav bs-sidenav">
						<li	class="<?php if(strtolower($this->router->fetch_module()) == 'publicaciones') echo 'active';?> active">
							<a	href="<?php echo base_url('publicaciones/listar');?>">Publicaciones</a>
							<ul class="nav">
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'publicaciones') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>">
									<a href="<?php echo base_url('publicaciones/listar');?>">Listar</a>
								</li>
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'publicaciones') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>">
									<a href="<?php echo base_url('publicaciones/alta');?>">Crear</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav bs-sidenav">
						<li	class="<?php if(strtolower($this->router->fetch_module()) == 'publicaciones') echo 'active';?> active">
							<a	href="<?php echo base_url('mediospago/edit') . '/1.html';?>">Métodos de Pago</a>
							<ul class="nav">
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'publicaciones') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>">
									<a href="<?php echo base_url('mediospago/edit') . '/1.html';?>">Configurar</a>
								</li>
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
					<a href="<?php echo base_url($this->router->fetch_module()) . '.html' ?>"><?php echo ucfirst($this->router->fetch_module());?></a>
				</li>
				<?php if($this->router->fetch_method() != '' or $this->router->fetch_method() != 'index' ):?>
					<li class="active">
						<?php echo ucfirst($this->router->fetch_method());?>
					</li>
				<?php endif;?>
			</ol>
		<!-- Fin BreadCrumb -->