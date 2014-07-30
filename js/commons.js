$(function(){
	//Menu lateral
	$('#myAffix').affix({
	    offset: {
	      top: 0
	    , bottom: function () {
	        return (this.bottom = $('.bs-footer').outerHeight(true))
	      }
	    }
	  });
	//Fin menu lateral

	//Scroll up
	  $(window).scroll(function(){
	        if ($(this).scrollTop() > 80) {
	            $('.scrollup').fadeIn();
	        } else {
	            $('.scrollup').fadeOut();
	        }
	    });

	    $('.scrollup').click(function(){
	        $("html, body").animate({ scrollTop: 0 }, 600);
	        return false;
	    });
	//Fin Scroll up
});