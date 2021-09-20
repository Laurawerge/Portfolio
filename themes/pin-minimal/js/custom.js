jQuery(window).load(function() {
      jQuery('.slide_info h2').html(function(index, curHTML) {
       var text = curHTML.split(/[\s-]/),
         newtext = '<span>' + text.pop() + '</span>';
       return text.join(' ').concat(' ' + newtext);
      });
});

// Front Page Nivo Slider Transition Effects
jQuery(window).load(function() {
		if(jQuery('#slider') > 0) {
        jQuery('.nivoSlider').nivoSlider({
        	effect:'fade',
    });
		} else {
			jQuery('#slider').nivoSlider({
        	effect:'fade',
    });
		}
});