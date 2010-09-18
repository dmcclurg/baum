<?php
	
	//Load WP Version
	 global $wp_version;
	
	//if we have submitted
	if(isset($_POST['submitDDSlides'])) {
		
		$mySliders = get_option('DDSliderSlides');
		
		//update_option('DDSliderSlides', $$mySliders);
		
		//gets the total of slides
		$totalSlides = $_POST['DDTotalSlidesPost'];
		
		//creates the initial array for our slides
		$mySlidesArray = array();
		
		//formats the array
		for($i=0;$i<$totalSlides;$i++) {
			
			$newI = ($i+1);
			
			$mySlidesArray[$i]['pos'] = $_POST[$newI];
			$mySlidesArray[$i]['type'] = $_POST['type_'.$newI];
			$mySlidesArray[$i]['img_src'] = $_POST['img_src_'.$newI];
			$mySlidesArray[$i]['img_alt'] = $_POST['img_alt_'.$newI];
			$mySlidesArray[$i]['img_url'] = $_POST['img_url_'.$newI];
			$mySlidesArray[$i]['content'] = htmlentities($_POST['content_'.$newI]);
			$mySlidesArray[$i]['transition'] = $_POST['transition_'.$newI];
			$mySlidesArray[$i]['bg_color'] = $_POST['bg_color'.$newI];
			$mySlidesArray[$i]['crop'] = $_POST['crop_'.$newI];
			
		}
		
		$mySliders[$_GET['slider_id']] = $mySlidesArray;
		
		//updates the array
		if(update_option('DDSliderSlides', $mySliders)) {
			
			echo '<div class="updated fade fadeOut" id="message"><p><strong>Changes saved successfully.</strong></p></div>';
			
		} else {
			
			echo '<div class="updated fade fadeOut" id="message"><p><strong>Changes not saved.</strong></p></div>';
			
		};
		
		
		
	}

?>

<?php
	
	//Let's not forget our plugin path so we can load jQuery
	global $DDSliderPath;
	$DDOptions = get_option('DDSliderOptions');

?>
<script src="<?php echo $DDSliderPath ?>js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $DDSliderPath ?>js/DDSliderManagerScripts.js" type="text/javascript" charset="utf-8"></script>
<?php if(version_compare($wp_version, "2.8", ">")) : ?>
	<script src="<?php echo $DDSliderPath ?>js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $DDSliderPath ?>js/jquery.checkbox.min.js" type="text/javascript" charset="utf-8"></script>
<?php endif; ?>
<script type="text/javascript" src="../wp-includes/js/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo $DDSliderPath ?>js/colorpicker.js"></script>
<link rel="stylesheet" href="<?php echo $DDSliderPath ?>css/colorpicker.css" type="text/css" />
<link rel='stylesheet'  href='<?php echo $DDSliderPath ?>css/adminTheme.css' type='text/css' media='screen' />

<?php
	
	if((isset($_GET['slider_id'])) && ($_GET['slider_id'] != NULL) && (!isset($_GET['delete_slider']))) :
	
?>

<script type="text/javascript">
<!--
	tinyMCE.init({
		
		theme : "advanced",
		mode : "exact",
		elements : "DDSlider_Content",
		width : "565",
		height : "200"
		
});
-->
</script>

<script type="text/javascript">

	jQuery(document).ready(function($) {
		
		$('#DDSlider_BgColor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		$('.DDSliderThisBgColor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
	
});
<?php if(version_compare($wp_version, "2.8", ">")) : ?>
jQuery(document).ready(function() {
				
			//Check if element exists
				jQuery.fn.exists = function(){return jQuery(this).length;}
		  
		  
		  //AJAX upload
			jQuery('#DDUploadImage').each(function(){
				
				var the_button=jQuery(this);
				var image_input=jQuery(this).prev();
				var image_id=jQuery(this).attr('id');
				
				new AjaxUpload(image_id, {
					  action: ajaxurl,
					  name: image_id,
					  
					  // Additional data
					  data: {
						action: 'DDAjaxImageUpload',
						data: image_id
					  },
					  autoSubmit: true,
					  responseType: false,
					  onChange: function(file, extension){},
					  onSubmit: function(file, extension) {
							the_button.attr('disabled', 'disabled').val("Uploading...");				  
						},
					  onComplete: function(file, response) {	
							the_button.removeAttr('disabled').val("Upload Image");
							
							if(response.search("Error") > -1){
								alert("There was an error uploading:\n"+response);
							}
							
							else{							
								image_input.val(response);
																
								}
							
						}
				});
			});
});	
<?php endif; ?>

</script>

<script type="text/javascript">

	function viewHelpFile(sect) {
		
		window.open('<?php echo $DDSliderPath."helpfile.html#" ?>'+sect,'help','width=650,height=600,scrollbars=yes,resizable=no');
		
	}

</script>

<div class="wrap">
	<form method="post" action="" id="DDSlideManager">
    <!-- Page Title -->
	<h2>DDSlider - Slide Manager<input type="button" class="button autowidth" id="DDviewDoc" value="View Help File" style="margin-left: 20px;" onclick="viewHelpFile('add');" /></h2>
        
        <h3>Slider Manager: <input style="float:right; margin-left: 10px;" type="button" name="DDAddSlider" class="button autowidth" id="DDAddSlider" value="Add Slide" onclick="DDaddNewSlider();" /><input style="float: right;" type="submit" name="submitDDSlides" class="button-primary autowidth" id="submitDDSlides" value="Save Changes" /></h3>
        
		<table cellspacing="0" class="widefat themeTable ddTableHead">
        
        	<thead>
            
				<tr>
              	
	               	<th scope="row" width="50">Order:</th>
                	<th scope="row" width="100" align="center">Type:</th>
                	<th scope="row" width="500" align="center">Content:</th>
                	<th scope="row" width="130" align="center">Transition:</th>
                	<th scope="row" width="50" align="center">BG Color:</th>
                	<th scope="row" width="16" align="center">&nbsp;</th>
                
				</tr>
            
            </thead>
            <input type="hidden" class="hidden" value="" id="DDTotalSlidesPost" name="DDTotalSlidesPost" />
            <tbody>
            
            	<?php
				
					//get the slides				
					$allSlider = get_option('DDSliderSlides');
					
					$allSlider = $allSlider[$_GET['slider_id']];
					
					//sets the current slide number
					$curSlide = 1;
					
					//sorts the array by position
					if($allSlider != NULL) {
						
						sort($allSlider);
						
					}
					
					//starts loop
					if($allSlider != NULL) :
					foreach($allSlider as $slide) :
				
				?>
                
            	<table cellspacing="0" class="widefat themeTable ddTable DDt_<?php echo $slide['pos']; ?>" style="border-bottom-width: 1px; margin: 3px 0;">
                
                        <tr>
                        
                            <th scope="row" width="50" class="DDDefinePos">
                            
                                <select name="pos" onchange="DDreorganizeTables(this);">
                                
                                    <?php
									
										$sliderCount = count($allSlider);
										
										for($i=1;$i<=$sliderCount;$i++) :
									
									?>
                                    <option value="<?php echo $i; ?>" <?php if($i == $slide['pos']) { echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
                                    <?php
									
										endfor;
									
									?>
                                
                                </select>
                            
                            </th>
                        
                            <th scope="row" width="100" class="DDDefineType">
                            <select name="type" onchange="DDefineField(this);">
                                <?php
								
									if($slide['type'] == 'image') {
										
										echo '<option value="image" selected="selected">Image</option>
                                    <option value="inline">Inline</option>';
										
									} else {
										
										echo '<option value="image">Image</option>
                                    <option value="inline" selected="selected">Inline</option>';
										
									}
								
								?>
                                
                                </select>
                            
                            </th>
                        
                            <th scope="row" width="500" class="DDinput_content" style="overflow: visible;">
                            
                                <div class="DDSliderThisImage<?php if($slide['type']=='inline') {  echo ' hidden';  } ?>">
                                
                                	<input type="text" onchange="alertMadeChanges();" name="img_src" class="DDThisImgSrc" value="<?php echo $slide['img_src']; ?>" style="width: 88%; padding: 2px;" /><?php
                                    
										if($slide['crop'] == 1) :
									
									?>
                                    
                                    <input onchange="alertMadeChanges();" checked="checked" type="checkbox" name="crop" class="DDThisCrop" value="1" />
                                    
                                    <?php else: ?>
                                    
                                    <input onchange="alertMadeChanges();" type="checkbox" name="crop" class="DDThisCrop" value="1" />
                                    
                                    <?php endif; ?><br /><br />
                                	<input type="text" onchange="alertMadeChanges();" name="img_url" class="DDThisImgUrl" value="<?php echo $slide['img_url']; ?>" style="width: 45%; padding: 2px;" />
                                    <input type="text" onchange="alertMadeChanges();" name="img_alt" class="DDThisImgAlt" value="<?php echo $slide['img_alt']; ?>" style="width: 45%; padding: 2px;" /> 
                                    
                                </div>
                            
                                <div class="DDSliderThisInline<?php if($slide['type']=='image') {  echo ' hidden';  } ?>">
                                
                                	<textarea name="content" onchange="alertMadeChanges();" rows="3" style="width: 93%;"><?php echo stripslashes($slide['content']); ?></textarea>
                                    
                                </div>
                            
                            </th>
                        
                            <th scope="row" width="130" class="DDDefineTrans">
                            
                                <select name="transition" onchange="DDRemoveSelected(this);">
                                
                                    <?php
					
									  $allTransitions = array('default', 'random', 'fading', 'barTop', 'barBottom', 'barFade', 'barFadeRandom', 'square', 'squareOut', 'squareRandom', 'squareMoving', 'squareOutMoving', 'rowInterlaced');
											  
									  foreach($allTransitions as $trans) {
											  												
											  if($trans == 'default') {
																									  
												  if($slide['transition'] == 'default') {
													  
													  echo '<option value="default" selected="selected">[ default ]</option>'; 
													  
												  } else {
													  
													  echo '<option value="default">[ default ]</option>'; 
													  
												  }
												  
											  } else {
												  
												  if($trans == $slide['transition']) {
													  
													  echo '<option selected="selected" value="'.$trans.'">'.$trans.'</option>'; 
													  
												  } else {
													  
													  echo '<option value="'.$trans.'">'.$trans.'</option>'; 
													  
												  }
												  
											  }
										  
									  }
									
									?>
                                
                                </select>
                            
                            </th>
                        
                            <th scope="row" width="50">
                            
                                <input class="DDSliderThisBgColor" type="text" name="bg_color" value="<?php echo $slide['bg_color'] ?>" onchange="alertMadeChanges();" maxlength="6" style="width: 50px;" />
                            
                            </th>
                        
                            <th scope="row" width="16">
                            
                                <span class="DDdeleteThis" onclick="DDdeleteThis(this);"></span>
                            
                            </th>
                        
                        </tr>
                
                </table>
                
                <?php endforeach; endif; ?>
            
            </tbody>
            
        
        </table>
        
        </form>
    <p>&nbsp;</p>
    <h3>Add a Slider <input style="float: right;" type="button" name="DDAddSlider" class="button autowidth" id="DDAddSlider" value="Add Slide" onclick="DDaddNewSlider();" /></h3>
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              	
                <th colspan="2" scope="row" align="left">Add Slide</th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="50px">Type:</th>
                
                <td style="padding-top: 15px; overflow: visible;" width="200px">
                
                	<select name="type" id="DDSliderManager_Type" style="width: 300px;" onchange="DDSliderManagerType(this);">
                    
                    	<option value"image">Image</option>
                    	<option value"inline">Inline</option>
                    
                    </select><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Select the type of content your slide will have. If you wish to include HTML in your slide, please select 'Inline'.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr id="DDSliderType-Image">
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="50px">Image Options:</th>
                
                <td style="padding-top: 15px; overflow: visible;" width="200px">
                        				
					<input type="text" value="" id="DDSlider_ImgSrc" name="img_src" class="DDThisImgSrc" style="width: 300px;">
                    
                    <?php if(version_compare($wp_version, "2.8", ">")) : ?><input style="margin-left: 10px;" type="button" name="DDUploadImage" class="button-primary autowidth" id="DDUploadImage" value="Upload Image" /> <?php endif; ?><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Input in the field the URL of any image or click the 'Upload Image' button to upload one from your file.</p></span><br /><br />
                        				
					<input type="text" value="" id="DDSlider_ImgURL" name="img_url" class="DDThisImgUrl" style="width: 300px;"><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Input in the field an URL link that you wish your image is linked to.</p></span><br /><br />
                        				
					<input type="text" value="" id="DDSlider_ImgALT" name="img_alt" class="DDThisImgAlt" style="width: 300px;"><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Alternate text to your image.</p></span><br /><br />
                    
                    <input type="checkbox" value="1" id="DDSlider_Crop" name="crop" /> : check to crop image.<span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>If your image is bigger or smaller than the standard slider width and height, select this option to either crop or zoom in your image to fit the slider.</p></span><br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr id="DDSliderType-Inline" class="hidden">
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="50px">Inline Content:</th>
                
                <td style="padding-top: 15px; overflow: visible;" width="200px">		
                        				
					<textarea name="content" id="DDSlider_Content" rows="3" cols="" style="width: 300px;"></textarea><br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="100px">Transition:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                	<select name="transition" id="DDSliderManager_Transition" style="width: 300px;" onchange="DDSliderManagerType(this);">
                
                	<?php
					
					  $allTransitions = array('default', 'random', 'fading', 'barTop', 'barBottom', 'barFade', 'barFadeRandom', 'square', 'squareOut', 'squareRandom', 'squareMoving', 'squareOutMoving', 'rowInterlaced');
							  
					  foreach($allTransitions as $trans) {
						  
						  if($trans == 'default') {
							  
							  echo '<option value="default">[ default ]</option>';
							  
						  } else {
							  
							  echo '<option value="'.$trans.'">'.$trans.'</option>';
							  
						  }
						  
					  }
					
					?>
                    
                    </select><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Define a transition for your slide</p></span><br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="100px">Background Color:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                	<input type="text" value="ff0000" id="DDSlider_BgColor" name="bg_color" maxlength="6" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Select a color as your backgroud color. This will prevent weird transitions when using smaller images. You can achieve background images easily using the inline content. See documentation for more info.<br />If you want it transparent, leave blank.</p></span><br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
        
        <p>&nbsp;</p>
        
        

</div>

<?php else: ?>

<div class="wrap">
	
    <!-- Page Title -->
	<h2>DDSlider Slide Manager</h2>
    
    <h3>Choose a slider: <input type="button" class="button autowidth" id="DDviewDoc" value="View Help File" style="float: right;" onclick="viewHelpFile('configure');" /></h3>
        
        <form method="post" action="" id="DDSliderGeneralOptions">
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead style="margin-bottom: 3px;">
            
              <tr>
              	
                <th colspan="2" scope="row" width="100">Slider Name</th>
                <th colspan="2" scope="row" width="330">Description</th>
                <th colspan="2" scope="row" width="70">Action</th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
            	<?php
					
					if($DDOptions != NULL) :
					
					foreach($DDOptions as $slider) :
				
				?>
            
            	<table cellspacing="0" class="widefat themeTable" style="border-bottom-width: 1px; margin: 5px 0 0 0;">
                
                	<tr>
              	
                		<th colspan="2" scope="row" width="100"><?php echo $slider['name']; ?></th>
               			<th colspan="2" scope="row" width="330" style="font-weight: normal"><?php echo $slider['description']; ?></th>
                		<th colspan="2" scope="row" width="70">
                        
                        	<a href="<?php echo get_bloginfo('wpurl').'/wp-admin/admin.php?page=manager-DDSlider&amp;slider_id='.$slider['name']; ?>">Manage Slides</a>
                        
                        </th>
                    
                    </tr>
                
                </table>
                
                <?php endforeach; endif; ?>
            
            </tbody>
            
          </table>
          
        </div>
        
    </form>

<p>&nbsp;</p>

</div>

<?php

	endif;

?>