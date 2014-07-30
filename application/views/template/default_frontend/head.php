<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="es">
  <head>

    <?php echo 'pepepe'; die(); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="AllyTech Desarrollo">
    <link rel="shortcut icon" hrlogo-agimedef="<?php echo ASSETS;?>ico/favicon.png">
    <title>eAsYpaSs</title>



    <!-- Bootstrap core CSS -->
    <link href="<?php echo PUBLIC_FOLDER;?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo ASSETS;?>css/docs.css" rel="stylesheet">
    <link href="<?php echo ASSETS;?>css/pygments-manni.css" rel="stylesheet">

    <!-- Jquery -->
    <script type="text/javascript" src="<?php echo PUBLIC_FOLDER;?>js/jquery-1.9.1.js"></script>

    <!-- Jquery UI -->
    <link href="<?php echo PUBLIC_FOLDER;?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo PUBLIC_FOLDER;?>js/jquery-ui-1.10.3.custom.min.js"></script>

       <!-- DatePicker -->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <script>
  $(function() {

        $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };

    $.datepicker.setDefaults($.datepicker.regional['es']);
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
  </script>
    <!-- END DatePicker -->



    <!-- CSS Principal -->
    <link href="<?php echo PUBLIC_FOLDER;?>css/main.css" rel="stylesheet">

    <!-- Extras CSS -->
    <?php if(isset($scripts_css)):?>
    <?php echo $scripts_css;?>
    <?php endif;?>
    <!-- Fin Extras CSS -->



    <script type="text/javascript">
    var _public_folder = '<?php echo PUBLIC_FOLDER;?>'; var _base_url = '<?php echo base_url();?>'; var _this_url = '<?php echo $this_url;?>';
    </script>

    <!-- Extras scripts -->
	<?php if(isset($scripts)):?>
	<?php echo $scripts;?>
	<?php endif;?>
	<!-- Fin Extras scripts -->

    <!-- Choosen Select -->

    <link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>assets/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_FOLDER;?>assets/chosen/chosen.css" />
    <style type="text/css" media="all">
      /* fix rtl for demo */
      .chosen-rtl .chosen-drop { left: -9000px; }
    </style>

 </head>
 <body>
