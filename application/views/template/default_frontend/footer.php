<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

			</div>
			<!-- Fin col -->
		</div>
    <!-- Fin row -->
    <!-- Fin Content -->

    <span  class="scrollup"><img src="http://www.iconpng.com/png/pictograms/arrow_up_1.png" width="100" height="100"></span>


    <!-- BootStrap JS -->
    <script src="<?php echo PUBLIC_FOLDER;?>js/bootstrap.min.js"></script>
    <!--
    <script src="<?php echo ASSETS;?>js/jquery.js"></script>
    <script src="<?php echo ASSETS;?>js/holder.js"></script>
    <script src="<?php echo ASSETS;?>js/application.js"></script>
    <script src="<?php echo PUBLIC_FOLDER;?>js/commons.js"></script>-->
	<?php if(isset($scripts)):?>
	<?php echo $scripts;?>
	<?php endif;?>

    <!-- Footer -->

    <div class="bs-footer" role="contentinfo" style="padding-top: 220px;">
    <div class="container">
        <div class="col-md-9" >
            <p class="text-muted credit">
                <a href="http://www.agimed.com.ar/" target="_blank">Agimed</a> :: Soluciones para la salud
                <br> Desarrollado por <a href="http://www.allytech.com/"> AllyTech Cloud Hosting</a> &copy; <?php echo date('Y');?>
            </p></div>
        <!-- <div class="col-md-3" style="float:right;">
        <img src="<?php echo PUBLIC_FOLDER;?>imagenes/img.png">
        </div> -->
    </div>

    </div>
    <!-- End Footer -->

</body>
</html>
