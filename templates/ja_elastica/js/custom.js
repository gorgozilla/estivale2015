jQuery(function(){
	jQuery(".block-home-event img")
	.mouseover(function () {
		var src=jQuery(this).attr("src");
		var overSrc = src.substr(0, src.length-4)+"_over.jpg";
		jQuery(this).attr("src", overSrc);
	})
	.mouseout(function () {
		var src=jQuery(this).attr("src");
		var overSrc = src.substr(0, src.length-9)+".jpg";
		jQuery(this).attr("src", overSrc);
	});
	
	jQuery(".prog_entry")
	.mouseover(function () {
		jQuery(this).css('background-color', '#ffdd52');
	})
	.mouseout(function () {
		jQuery(this).css("background-color", "#ffea94");
	});
	
	
	if(jQuery('.prog_day').length>0){
		jQuery('.prog_day').get(1).hide();
		jQuery('.prog_day').get(2).hide();
		jQuery('.prog_day').get(3).hide();
		
		jQuery('.prog_title').click(function() {
			jQuery('.prog_day:visible').hide(300);
			if(jQuery(this).next('.prog_day').is(':visible')){
				jQuery(this).next('.prog_day').hide(300);
			}else{
				jQuery(this).next('.prog_day').show(300);
			}
		});
		
		jQuery(".prog_title")
		.mouseover(function () {
			jQuery(this).css('background-color', '#ffdd52');
		})
		.mouseout(function () {
			jQuery(this).css("background-color", "#fff");
		});
	}
});