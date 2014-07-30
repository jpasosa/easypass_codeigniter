<!DOCTYPE html>
<html lang="en" class="error_page">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Error inesperado del motor de bases de datos</title>
		<!-- Bootstrap framework -->
            <link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>assets/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>assets/bootstrap/css/bootstrap-responsive.min.css" />
		<!-- main styles -->
            <link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>assets/admin/css/style.css" />
			
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Jockey+One" />
            
	</head>
	<body>

		<div class="error_box">
			<h1>Error inesperado del motor de bases de datos</h1>
			<p><?php echo $message; ?></p>			
			<a href="<?php echo PUBLIC_FOLDER;?>" class="back_link btn btn-small">Volver al inicio</a>
		</div>

	</body>
</html>	