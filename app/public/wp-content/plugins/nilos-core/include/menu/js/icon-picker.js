(function ($) {
  "use strict";
	
	$(document).ready(function() {
		
		$(document).on('click', 'input.nilosicon-picker', function(event){
			event.preventDefault(); 
			$(this).closest('.nilos-field-iconfield').find('.nilos-iconsholder-wrapper').slideToggle();
		});
		
		
		$(document).on('click', '.nilos-iconbox', function(event){	
			$(this).closest('.nilos-field-iconfield').find('input.nilosicon-picker').val($(this).find('i').attr('class'));
			$(this).closest('.nilos-field-iconfield').find('.nilos-iconsholder-wrapper').slideToggle();
		});
		
		
		var nilosicon = 'nilosicon-store nilosicon-magnifying-glass nilosicon-search nilosicon-heart nilosicon-user nilosicon-menu nilosicon-menu-1 nilosicon-watermelon nilosicon-broccoli nilosicon-cupcake nilosicon-bread nilosicon-apple nilosicon-fish nilosicon-snack nilosicon-eggs nilosicon-coffee nilosicon-pet nilosicon-basketball-match nilosicon-milk nilosicon-vegan nilosicon-smarniloshone nilosicon-camera nilosicon-monitor nilosicon-home nilosicon-store-1 nilosicon-gift nilosicon-discount nilosicon-voucher nilosicon-price-tag nilosicon-football nilosicon-running nilosicon-play-button',
			
		nilosiconArray = nilosicon.split(' '); // creating array

		// This loop will add icons inside BOX
		for (var i = 0; i < nilosiconArray.length; i++) {
			jQuery(".nilos-iconsholder").append('<div class="nilos-iconbox"><p class="icon"><i class="' + nilosiconArray[i] + '"></i>'+nilosiconArray[i]+'</p></div>');
		}

		var timeout;
		$("input.iconsearch").on("keyup", function() {
			if(timeout) {
				clearTimeout(timeout);
			}
			
			var value = this.value.toLowerCase().trim();
			var iconbox = $(this).closest('.nilos-field-iconfield').find('.nilos-iconbox');
			timeout = setTimeout(function() {
			  $(iconbox).show().filter(function() {
				return $(this).text().toLowerCase().trim().indexOf(value) == -1;
			  }).hide();
			}, 500);
		});

	});

})(jQuery);
