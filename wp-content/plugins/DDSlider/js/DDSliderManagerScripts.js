jQuery(document).ready(function() {
	
	DDrenameFields();
	
	DDfadeOutAlert();
	
	justAdded = 0;
	
	showInfo();
	
	showInfoCrop();
	
});

function DDSliderManagerType(el) {
	
	var _this = jQuery(el).children('option:selected');
		
	if (_this.html() === 'Inline') {
		
		jQuery('#DDSliderType-Image').fadeOut(300, function() {
			
			jQuery('#DDSliderType-Inline').css({ background: '#fffaba' }).fadeIn(500, function() {
				
				jQuery(this).animate({ 'backgroundColor': '#ffffff' },500);
				
			});
			
		});
		
	}
		
	if (_this.html() === 'Image') {
		
		jQuery('#DDSliderType-Inline').fadeOut(300, function() {
			
			jQuery('#DDSliderType-Image').css({ background: '#fffaba' }).fadeIn(500, function() {
				
				jQuery(this).animate({ 'backgroundColor': '#ffffff' },500);
				
			});
			
		});
		
	}
	
	jQuery(el).css({ background: '#fffaba' }).animate({ 'backgroundColor': '#ffffff' }, 500);
	
}

function DDRemoveSelected(el) {
	
	var curTrans = jQuery(el).children('option:selected');
	
	jQuery(el).children('option').removeAttr('selected');
	
	curTrans.attr('selected', 'selected');
	
	jQuery(el).css({ background: '#fffaba' }).animate({ 'backgroundColor': '#ffffff' }, 500);
	
	alertMadeChanges();
	
}

function DDefineField(el) {
	
	var _this = jQuery(el).children('option:selected');
	
	if (_this.html() === 'Inline') {
		
		_this.parent().parent().parent().children('.DDinput_content').children('.DDSliderThisImage').fadeOut(300, function() {
			
			jQuery(el).children('option[value=image]').removeAttr('selected');
			_this.parent().parent().parent().children('.DDinput_content').children('.DDSliderThisInline').children('textarea').css({ 'background': '#fffaba' }).parent().fadeIn(300, function() {
				
				jQuery(this).children('textarea').animate({opacity: 1},500).animate({ 'backgroundColor': '#ffffff' },500);
				
			});
			
		});
		
	}
		
	if (_this.html() === 'Image') {
		
		_this.parent().parent().parent().children('.DDinput_content').children('.DDSliderThisInline').fadeOut(300, function() {
			
			jQuery(el).children('option[value=inline]').removeAttr('selected');
			_this.parent().parent().parent().children('.DDinput_content').children('.DDSliderThisImage').children('input').css({ 'background-color': '#fffaba' }).parent().fadeIn(300, function() {
				
				jQuery(this).children('input').animate({opacity: 1},200).animate({ 'backgroundColor': '#ffffff' },500);
				
			});
			
		});
		
	}	
	
	jQuery(el).css({ background: '#fffaba' }).animate({ 'backgroundColor': '#ffffff' }, 500);
	
	alertMadeChanges();
	
}

function DDreorganizeTables(el) {
	
	var mainCont = jQuery(el).parent().parent().parent().parent().parent();
	var allTables = jQuery(el).parent().parent().parent().parent().parent().children('table:not(table:first)');
	var totalTables = (jQuery(el).parent().parent().parent().parent().parent().children('table').length)-1;
	
	var _this = jQuery(el);
	
	var _thisNewPos = parseInt(_this.children('option:selected').attr('value'));
	var _thisCurPosArr = _this.parent().parent().parent().parent().attr('class').split(' ');
	var _thisCurPosArr_2 = _thisCurPosArr[3].split('_');
	var _thisCurPos = parseInt(_thisCurPosArr_2[1]);
	
	var newType = jQuery('.DDt_'+_thisCurPos+' > tbody > tr > th.DDDefineType > select > option:selected').attr('value');
	var newTrans = jQuery('.DDt_'+_thisCurPos+' > tbody > tr > th.DDDefineTrans > select > option:selected').text();
	
	if(_thisCurPos < _thisNewPos) {
		
		for(i = _thisCurPos; i <= _thisNewPos; i++) {
						
			if(i === _thisCurPos) {
				
				jQuery('.DDt_'+_thisCurPos).removeClass('DDt_'+_thisCurPos).addClass('DDt_'+_thisNewPos);
				
			} else {
				
				
				var NewI = (i-1);
				jQuery('.DDt_'+i+':last > tbody > tr > th.DDDefinePos > select > option[value='+i+']').removeAttr('selected');
				jQuery('.DDt_'+i+':last > tbody > tr > th.DDDefinePos > select > option[value='+NewI+']').attr('selected', 'selected');
				jQuery('.DDt_'+i+':last').removeClass('DDt_'+i).addClass('DDt_'+NewI);
				
			}
			
		}
		
		jQuery('.DDt_'+(_thisNewPos-1)).after(jQuery('.DDt_'+_thisNewPos).clone().css({ opacity: 0, background: '#fffaba' }).animate({opacity: 1}, 500, function() {
			
			jQuery(this).animate({ 'backgroundColor': '#ffffff' }, 500);
			
		}));
		jQuery('.DDt_'+_thisNewPos+':first').remove();
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefinePos > select > option[value='+_thisCurPos+']').removeAttr('selected');
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefinePos > select > option[value='+_thisNewPos+']').attr('selected', 'selected');
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefineType > select > option[value='+newType+']').attr('selected', 'selected');
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefineTrans > select > option[value='+newTrans+']').attr('selected', 'selected');
		
	} else {
		
		for(i = _thisCurPos; i >= _thisNewPos; i--) {
			
			if(i === _thisCurPos) {
				
				jQuery('.DDt_'+_thisCurPos).removeClass('DDt_'+_thisCurPos).addClass('DDt_'+_thisNewPos);
				
			} else {
				
				var NewI = (i+1);
				jQuery('.DDt_'+i+':first > tbody > tr > th.DDDefinePos > select > option[value='+i+']').removeAttr('selected');
				jQuery('.DDt_'+i+':first > tbody > tr > th.DDDefinePos > select > option[value='+NewI+']').attr('selected', 'selected');
				jQuery('.DDt_'+i+':first').removeClass('DDt_'+i).addClass('DDt_'+NewI);
				
			}
			
		}
		
		jQuery('.DDt_'+(_thisNewPos+1)).before(jQuery('.DDt_'+_thisNewPos).clone().css({ opacity: 0, background: '#fffaba' }).animate({opacity: 1}, 500, function() {
			
			jQuery(this).animate({ 'backgroundColor': '#ffffff' }, 500);
			
		}));
		jQuery('.DDt_'+_thisNewPos+':last').remove();
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefinePos > select > option[value='+_thisCurPos+']').removeAttr('selected');
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefinePos > select > option[value='+_thisNewPos+']').attr('selected', 'selected');
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefineType > select > option[value='+newType+']').attr('selected', 'selected');
		jQuery('.DDt_'+_thisNewPos+' > tbody > tr > th.DDDefineTrans > select > option[value='+newTrans+']').attr('selected', 'selected');
		
	}
	
	DDrenameFields();
	
	jQuery('.DDSliderThisBgColor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				jQuery(el).val(hex);
				jQuery(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			jQuery(this).ColorPickerSetColor(this.value);
		});
	
	alertMadeChanges();
	showInfoCrop();
	
}

function DDaddNewSlider() {
		
	var DDAddNewType = jQuery('#DDSliderManager_Type').children('option:selected').text();
	
	var DDAddNewImgSrc = jQuery('#DDSlider_ImgSrc').val();
	var DDAddNewImgUrl = jQuery('#DDSlider_ImgURL').val();
	var DDAddNewImgAlt = jQuery('#DDSlider_ImgALT').val();
	var DDAddNewCrop = jQuery('#DDSlider_Crop').attr('checked');
	
	var DDAddNewContent = jQuery('#DDSlider_Content').val();
	
	var DDAddNewTransition = jQuery('#DDSliderManager_Transition').children('option:selected').text();
	
	var DDAddNewBgColor = jQuery('#DDSlider_BgColor').val();
	
	var DDAddNewAfterPos = (jQuery('.ddTable').length);
	var DDAddNewPos = (DDAddNewAfterPos+1);
	
	var DDAddTableHTML = '<table cellspacing="0" style="border-bottom-width: 1px; margin: 3px 0pt;" class="widefat themeTable ddTable DDt_'+DDAddNewPos+'"><tbody><tr><th width="50" class="DDDefinePos" scope="row"><select onchange="DDreorganizeTables(this);" name="pos"></select></th><th width="100" class="DDDefineType" scope="row"><select onchange="DDefineField(this);" name="type"><option value="image" '+checkTypeSelected(DDAddNewType, 'Image')+'>Image</option><option value="inline" '+checkTypeSelected(DDAddNewType, 'Inline')+'>Inline</option></select></th><th width="500" class="DDinput_content" scope="row" style="overflow: visible;"><div class="DDSliderThisImage '+checkTypeSelectedContainer(DDAddNewType, 'Image')+'"><input type="text" style="width: 88%; padding: 2px;" class="DDThisImgSrc" value="'+DDAddNewImgSrc+'" name="img_src"><input type="checkbox" name="crop" class="DDThisCrop" value="1" '+checkChecked(DDAddNewCrop)+' /><br /><br /><input type="text" style="width: 45%; padding: 2px;" class="DDThisImgUrl" value="'+DDAddNewImgUrl+'" name="img_url"><input type="text" onchange="alertMadeChanges();" name="img_alt" class="DDThisImgAlt" value="'+DDAddNewImgAlt+'" style="width: 45%; padding: 2px;" /></div><div class="DDSliderThisInline '+checkTypeSelectedContainer(DDAddNewType, 'Inline')+'"><textarea style="width: 93%;" rows="3" name="content">'+DDAddNewContent+'</textarea></div></th><th width="130" class="DDDefineTrans" scope="row"><select onchange="DDRemoveSelected(this);" name="transition"><option selected="selected" value="default">[ default ]</option><option value="random">random</option><option value="fading">fading</option><option value="barTop">barTop</option><option value="barBottom">barBottom</option><option value="barFade">barFade</option><option value="barFadeRandom">barFadeRandom</option><option value="square">square</option><option value="squareOut">squareOut</option><option value="squareRandom">squareRandom</option><option value="squareMoving">squareMoving</option><option value="squareOutMoving">squareOutMoving</option><option value="rowInterlaced">rowInterlaced</option></select></th><th width="50" scope="row"><input type="text" style="width: 50px;" maxlength="6" value="'+DDAddNewBgColor+'" name="bg_color" class="DDSliderThisBgColor"></th><th width="16" scope="row"><span onclick="DDdeleteThis(this);" class="DDdeleteThis"></span></th></tr></tbody></table>';
	
	var ddTableI = 1;
	
	jQuery('.ddTable').each(function() {
		
		jQuery('.DDt_'+ddTableI+' > tbody > tr > th.DDDefinePos > select > option:last').after('<option value="'+DDAddNewPos+'">'+DDAddNewPos+'</option>');
		ddTableI++;
		
	})
	
	var addNewOptions = '';
	for(i=1;i<=DDAddNewPos;i++) {
		
		if(DDAddNewPos == i) {
			
			addNewOptions = addNewOptions + '<option value="'+i+'" selected="selected">'+i+'</option>';
			
		} else {
			
			addNewOptions = addNewOptions + '<option value="'+i+'">'+i+'</option>';
			
		}
		
	}
	
	if(DDAddNewAfterPos === 0) {
		
		jQuery('.ddTableHead').after(DDAddTableHTML);
		
	} else {
		
		jQuery('.DDt_'+DDAddNewAfterPos).after(DDAddTableHTML);
		
	}
	
	jQuery('.DDSliderThisBgColor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				jQuery(el).val(hex);
				jQuery(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				jQuery(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			jQuery(this).ColorPickerSetColor(this.value);
		});
	
	jQuery('.DDt_'+DDAddNewPos).css({ opacity: 0, background: '#fffaba' }).animate({ opacity: 1 }, 500, function() {
		
		jQuery(this).animate({ 'backgroundColor': '#ffffff' }, 500);
		
	});
	
	jQuery('.DDt_'+DDAddNewPos+' > tbody > tr > th.DDDefinePos > select').append(addNewOptions);
	jQuery('.DDt_'+DDAddNewPos+' > tbody > tr > th.DDDefineTrans > select > option[value='+DDAddNewTransition+']').attr('selected','selected');
	
	DDrenameFields();
	alertMadeChanges();
	showInfoCrop();
	
}

function checkTypeSelected(el, field) {
	
	if(field == 'Image') {
		
		if(el=='I') {
			
			return 'selected="selected"';
			
		}
		
	}
	
	if(field == 'Inline') {
		
		if(el=='Inline') {
			
			return 'selected="selected"';
			
		}
		
	}
	
}

function checkTypeSelectedContainer(el, field) {
	
	if(el == 'Image') {
		
		if(field=='Inline') {
			
			return 'hidden"';
			
		}
		
	}
	
	if(el == 'Inline') {
		
		if(field=='Image') {
			
			return 'hidden';
			
		}
		
	}
	
}

function DDdeleteThis(el) {
	
	isDeletedClicked = 1;
	
	var objDeleteIndex = jQuery(el).parent().parent().parent().parent().attr('class');
	objDeleteIndex = objDeleteIndex.split(' ');
	objDeleteIndex = objDeleteIndex[3].split('_');
	objDeleteIndex = objDeleteIndex[1];
	
	var totalTables = jQuery('.ddTable').length;
	
	//Disables multiple clicks
	jQuery(el).attr('onClick', '');
	
	jQuery(el).parent().parent().parent().parent().animate({ 'backgroundColor': '#e68383' }, 500, function() {
		
		jQuery(this).fadeOut(200, function() {
			
			jQuery(this).remove();
			DDrenameFields();
			
		})
		
	});
	
	jQuery('.ddTable > tbody > tr > th.DDDefinePos > select').each(function() {
		
		jQuery(this).children('option:last').remove();
		
		
	});
	
	for(i=objDeleteIndex;i<=totalTables;i++) {
		
		var NewI = (i-1);
		
		jQuery('.DDt_'+i+' > tbody > tr > th.DDDefinePos > select > option[value='+NewI+']').attr('selected', 'selected');
		//jQuery('.DDt_'+i).children('tbody').children('tr').children('th.DDDefinePos').children('select').children('option[value='+NewI+']').after('<option>ihaaaaaaa</option>');
		
		jQuery('.DDt_'+i).removeClass('DDt_'+i).addClass('DDt_'+NewI);
		
	}
	
	
	alertMadeChanges()
	
	
}

function DDrenameFields() {
	
	var totalTables = jQuery('.ddTable').length;
	
	jQuery('#DDTotalSlidesPost').attr('value', totalTables);
	
	for(i=1;i<=totalTables;i++) {
		
		jQuery('.DDt_'+i+' > tbody > tr > th.DDDefinePos > select').attr('name', i);
		jQuery('.DDt_'+i+' > tbody > tr > th.DDDefineType > select').attr('name', 'type_'+i);
		jQuery('.DDt_'+i+' > tbody > tr > th.DDinput_content > .DDSliderThisImage > input.DDThisImgSrc').attr('name', 'img_src_'+i);
		jQuery('.DDt_'+i+' > tbody > tr > th.DDinput_content > .DDSliderThisImage > input.DDThisImgAlt').attr('name', 'img_alt_'+i);
		jQuery('.DDt_'+i+' > tbody > tr > th.DDinput_content > .DDSliderThisImage > input.DDThisImgUrl').attr('name', 'img_url_'+i);
		jQuery('.DDt_'+i+' > tbody > tr > th.DDinput_content > .DDSliderThisInline > textarea').attr('name', 'content_'+i);
		jQuery('.DDt_'+i+' > tbody > tr > th.DDDefineTrans > select').attr('name', 'transition_'+i);
		jQuery('.DDt_'+i+' > tbody > tr > th > .DDSliderThisBgColor').attr('name', 'bg_color'+i);
		jQuery('.DDt_'+i+' > tbody > tr > th.DDinput_content > .DDSliderThisImage > input.DDThisCrop').attr('name', 'crop_'+i);
		
	}
	
}

function DDfadeOutAlert() {
	
	jQuery('.fadeOut').animate({ opacity: 1 }, 4000, function() {
		
		jQuery(this).fadeOut(500, function() { jQuery(this).remove(); });
		
	});
	
}

function checkChecked(el) {
	
	if(el === true) {
		
		var val = 'checked="checked"'
		return val;
		
	}
	
}

function alertMadeChanges() {
	
	if(justAdded === 0) {
		
		jQuery('.ddTable:last').after('<p><div class="updated fade" id="changesMade"><p><strong>You have made changes to your slider. Hit \'Save Changes\' for them to take effect</strong></p></div></p>');
		jQuery('#changesMade').css({ opacity: 0 }).animate({ opacity: 1 }, 500);
		
	}
	
	justAdded = 1;
	
	
	
}

function showInfo() {
	
	var _this = jQuery('.DDGetInfo');
	
	jQuery('.DDGetInfo').click(function() {
		
		jQuery('.hover > p').fadeOut(300).parent().removeClass('hover');
		
		if(jQuery(this).children('p').css('display') == 'none') {
			
			jQuery(this).children('p').fadeIn(300);
			jQuery(this).addClass('hover');
			
		} else {
			
			jQuery(this).children('p').fadeOut(300);
			jQuery(this).removeClass('hover');
			
		}
		
	});
	
}

function showInfoCrop() {
	
	jQuery('.DDThisCrop').hoverIntent(function() {
		
		jQuery(this).after('<div class="DDCropThisToolTip" style="background: none; width: 1px; height: 1px; position: relative; float: left;"><p class="DDinfo"><span class="infoBoxArrow"></span>Crop Image?</p><div>');
		
	}, function() {
		
		jQuery('.DDCropThisToolTip').fadeOut(200, function() {
			
			jQuery(this).remove();
			
		});
		
	});
	
}

/**
* hoverIntent r5 // 2007.03.27 // jQuery 1.1.2+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
* 
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne <brian@cherne.net>
*/
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY;};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev]);}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev]);};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode;}catch(e){p=this;}}if(p==this){return false;}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}}};return this.mouseover(handleHover).mouseout(handleHover);};})(jQuery);