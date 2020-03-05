/* jQuery codes and functions used in MARVELA Template */
(function(jQuery) {
   
   "use strict";
    jQuery('#s').attr('placeholder','Type & Hit Enter...');   
		
	jQuery(".menu-item-type-custom a").each(function(i){
	jQuery(this).addClass('custom-scroll-link');
	})
				
	var shs = eval(jQuery(".share-container").attr("data-share"));
		jQuery(".share-container").share({
			networks: shs
		});				
					


})(jQuery);