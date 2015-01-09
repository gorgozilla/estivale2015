jQuery(function(){
	jQuery("#mikaEventImg")
	.mouseover(function () {
		jQuery(this).attr("src", "images/mika_event_on.jpg");
	})
	.mouseout(function () {
		jQuery(this).attr("src", "images/mika_event_off.jpg");
	});
	
	jQuery("#kadebostanyEventImg")
	.mouseover(function () {
		jQuery(this).attr("src", "images/kadebostany_event_on.jpg");
	})
	.mouseout(function () {
		jQuery(this).attr("src", "images/kadebostany_event_off.jpg");
	});
});