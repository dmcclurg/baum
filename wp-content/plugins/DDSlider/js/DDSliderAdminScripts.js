jQuery(document).ready(function($) {
	
	showCollapse();
	
	DDsubmitGeneralForm();
	
	showInfo();
	
});

function arrowsSelector(el) {
	
	if(jQuery(el).children('option:selected').val() == 'custom') {
		
		jQuery('.automaticArrows').each(function() {
			
			jQuery(this).fadeOut(300, function() {
				
				jQuery('.customArrows').fadeIn(300);
				
			});
			
		});
		
	} else {
		
		jQuery('.customArrows').each(function() {
			
			jQuery(this).fadeOut(300, function() {
				
				jQuery('.automaticArrows').fadeIn(300);
				
			});
			
		});
		
	}
	
}

function selectorsSelector(el) {
	
	if(jQuery(el).children('option:selected').val() == 'custom') {
		
		jQuery('.automaticSelectors').each(function() {
			
			jQuery(this).fadeOut(300, function() {
				
				jQuery('.customSelectors').fadeIn(300);
				
			});
			
		});
		
	} else {
		
		jQuery('.customSelectors').each(function() {
			
			jQuery(this).fadeOut(300, function() {
				
				jQuery('.automaticSelectors').fadeIn(300);
				
			});
			
		});
		
	}
	
}

jQuery().ready(function() {
	
	jQuery('#DDSliderGeneralOptions').validate({
		
		rules: {
			
			width: {
				
				required: true,
				digits: true
				
			},
			
			height: {
				
				required: true,
				digits: true
				
			},
			
			bars: {
				
				required: true,
				digits: true
				
			},
			
			crop_quality: {
				
				required: true,
				digits: true
				
			},
			
			rows: {
				
				required: true,
				digits: true
				
			},
			
			columns: {
				
				required: true,
				digits: true
				
			},
			
			delay: {
				
				required: true,
				digits: true
				
			},
			
			waitTime: {
				
				required: true,
				digits: true
				
			},
			
			duration: {
				
				required: true,
				digits: true
				
			},
			
			ease: {
				
				required: true
				
			}
			
		}
		
	});
	
});

function showCollapse() {
	
	jQuery('.DDShowCollapse').click(function() {
		
		if(jQuery(this).attr('class') === 'DDShowCollapse DDShow') {
			
			jQuery(this).parent().parent().parent().children('tbody').slideDown(300);
			jQuery(this).children('.DDShowSection').removeClass('DDShowSection').addClass('DDCollapseSection');
			jQuery(this).removeClass('DDShow').addClass('DDCollapse');
			
		} else {
			
			jQuery(this).parent().parent().parent().children('tbody').slideUp(300);
			jQuery(this).children('.DDCollapseSection').removeClass('DDCollapseSection').addClass('DDShowSection');
			jQuery(this).removeClass('DDCollapse').addClass('DDShow');
			
		}
				
	});
	
}

function DDsubmitGeneralForm() {
	
	jQuery('#DDSliderGeneralOptions').submit(function() {
		
		
	});
	
}

function showInfo() {
	
	var _this = jQuery('.DDGetInfo');
	
	jQuery('.DDGetInfo').click(function() {
		
		jQuery('.hover > p').fadeOut(300).parent().removeClass('hover');
		
		if(jQuery(this).children('p').css('display') == 'none') {
			
			jQuery(this).children('p').fadeIn(300);
			jQuery(this).addClass('hover');
			clicked = 1;
			
		} else {
			
			jQuery(this).children('p').fadeOut(300);
			jQuery(this).removeClass('hover');
			clicked = 0;
			
		}
		
	});
	
}