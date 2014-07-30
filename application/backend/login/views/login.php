<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo ASSETS;?>ico/favicon.png">

	<title><?php echo $this->config->item('default_title');?> :: login</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo PUBLIC_FOLDER;?>css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php echo PUBLIC_FOLDER;?>css/signin.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="<?php echo ASSETS;?>js/html5shiv.js"></script>
<script src="<?php echo ASSETS;?>js/respond.min.js"></script>
<![endif]-->
</head>

<body>

	<div class="container">

		<form class="form-signin" action="" method="post" id="pass_form">
			<h2 class="form-signin-heading">Ingrese sus datos</h2>
			<input type="text" class="form-control" name="email" placeholder="Dirección de email" autofocus>
			<input type="password" name="clave" class="form-control" placeholder="Clave">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
		</form>

	</div>

</body>
</html>
