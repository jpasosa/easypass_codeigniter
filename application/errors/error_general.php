<?php $ci = &get_instance();print_r($ci->user);?>
<!DOCTYPE html>
<html lang="es" class="error_page">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>P&aacute;gina de error - 404</title>
		<!-- Bootstrap framework -->
            <link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>css/bootstrap.min.css" />
            
		<!-- main styles -->
            <link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>css/main.css" />
             <link href="<?php echo PUBLIC_FOLDER;?>css/signin.css" rel="stylesheet">
            
			
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Jockey+One" />
            
	</head>
	<body>


	<div class="container">
  <div class="row">
    <div class="span12">
      <div class="thumbnail hero-unit text-center">
          <h1><span style="color:red;">404</span> - P&aacute;gina o archivo no encontrado</h1>
          <br />
          <p><?php echo $message; ?></p>
          <br>
          <?php if($ci->session->userdata('rol_key')== 'administrador') $url = PUBLIC_FOLDER."admin/"; else $url = PUBLIC_FOLDER;?>
          <a href="<?php echo $url;?>" class="back_link btn btn-large btn-info">Volver al inicio</a>
          <br />      
          <br />                          
        </div>        
    </div>
  </div>
</div>
	
	</body>
</html>