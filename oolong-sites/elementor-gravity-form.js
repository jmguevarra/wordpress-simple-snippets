var OOL = {};
var d = document;
var $;

// Ready, go
jQuery(d).ready(function () {
    $ = jQuery; // if you need
    OOL.init();

    OOL.gravityform_helper();
    //console.log('Document is ready, jquery is present');
    //OOL.exemple_function(); // call to a function, see below
});

OOL.gravityform_helper = function(){
	$(d).bind('gform_post_render', function(){
		$('#gfp1-btn').click(function(){
			$('.gfp2').show().removeClass('hide');
			$('.gfp1').hide();
		});

		$('.gfrad-next input[type="radio"]').click(function(){
			if($(this).prop('checked')){
				$(this).parents('.gform_page').find('.gform_next_button').click();
			}
		});
	
	});
};