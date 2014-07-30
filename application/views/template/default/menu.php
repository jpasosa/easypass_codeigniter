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
			<a href="<?php echo base_url('admin/login');?>" class="navbar-brand" style="color:#FFFFFF; font-weight:bold; text-decoration:underline;">
				eAsYpaSs
			</a>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<div align="right" >
				<br />
				<a class="btn-success btn" href="<?php echo base_url('claves/buscar');?>">Buscar Accesos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="btn-info btn" href="<?php echo base_url('claves/agregar');?>">Crear Nuevo Acceso</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
					Easy Pass :: Administrador de Accesos
				</div>
					<ul class="nav bs-sidenav">
						<li><br /></li>
						<li	class="<?php if(strtolower($this->router->fetch_module()) == 'usuarios') echo 'active';?> active">
							<a	href="<?php echo base_url('admin/usuarios/listar');?>">ACCESOS</a>
							<ul class="nav">
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'usuarios') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>">
									<a href="<?php echo base_url('claves/buscar');?>">Buscar</a>
								</li>
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'usuarios') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>">
									<a href="<?php echo base_url('claves/agregar');?>">Crear</a>
								</li>
							</ul>
						</li>
						<li	class="<?php if(strtolower($this->router->fetch_module()) == 'usuarios') echo 'active';?> active">
							<a	href="<?php echo base_url('categorias/listar');?>">Categorias</a>
							<ul class="nav">
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'usuarios') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>">
									<a href="<?php echo base_url('categorias/listar');?>">Listar</a>
								</li>
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'usuarios') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>">
									<a href="<?php echo base_url('categorias/agregar');?>">Crear</a>
								</li>
							</ul>
						</li>
						<li	class="<?php if(strtolower($this->router->fetch_module()) == 'categorias') echo 'active';?> active">
							<a	href="<?php echo base_url('admin/categorias');?>">Tags</a>
							<ul class="nav">
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'categorias') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>">
									<a href="<?php echo base_url('tags/listar');?>">Listar</a>
								</li>
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'categorias') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>">
									<a href="<?php echo base_url('tags/agregar');?>">Crear</a>
								</li>
							</ul>
						</li>
						<li	class="<?php if(strtolower($this->router->fetch_module()) == 'emails') echo 'active';?> active">
							<a	href="<?php echo base_url('admin/emails');?>">Emails</a>
							<ul class="nav">
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'emails') and strtolower($this->router->fetch_method()) == 'listar') echo 'active';?>">
									<a href="<?php echo base_url('emails/listar');?>">Listar</a>
								</li>
								<li class="<?php if((strtolower($this->router->fetch_module()) == 'emails') and strtolower($this->router->fetch_method()) == 'alta') echo 'active';?>">
									<a href="<?php echo base_url('emails/agregar');?>">Crear</a>
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
					<a href="<?php echo base_url('admin/' . $this->router->fetch_module()) . '.html' ?>"><?php echo ucfirst($this->router->fetch_module());?></a>
				</li>
				<?php if($this->router->fetch_method() != '' or $this->router->fetch_method() != 'index' ):?>
					<li class="active">
						<?php echo ucfirst($this->router->fetch_method());?>
					</li>
				<?php endif;?>
			</ol>
		<!-- Fin BreadCrumb -->