<?php



?>

<?php
	
	//Let's not forget our plugin path so we can load jQuery
	global $DDSliderPath;
	$DDOptions = get_option('DDSliderOptions');

?>

<!-- Loads jQuery -->
<script src="<?php echo $DDSliderPath ?>js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $DDSliderPath ?>js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $DDSliderPath ?>js/DDSliderAdminScripts.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $DDSliderPath ?>js/iphone-style-checkboxes.js" type="text/javascript" charset="utf-8"></script>

	<script src="<?php echo $DDSliderPath ?>js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo $DDSliderPath ?>js/jquery.checkbox.min.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet"  href="<?php echo $DDSliderPath ?>css/adminTheme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $DDSliderPath ?>css/iPhoneCheckbox.css" type="text/css" media="screen" charset="utf-8" />


<?php
	
	if((isset($_GET['slider_id'])) && ($_GET['slider_id'] != NULL) && (!isset($_GET['delete_slider']))) :
	
?>

<?php

	if(isset($_POST['submitDDGeneralOptions'])) {
		
		$DDGeneralOptionsErrors = NULL;
		
		$DDOptions[$_GET['slider_id']] = $_POST;
		
		update_option('DDSliderOptions', $DDOptions);
		
		echo '<div class="updated fade" id="message"><p><strong>Options saved successfully.</strong></p></div>';
		
		//if($DDGeneralOptionsErrors == NULL) {
//			
//			//Let's create the options array based on the info given
//			//Create this array
//			$DDSliderOptionsArray = $_POST;
//			
//			//Lets remove the submit button from our array
//			$DDSliderSubmit = array_pop($DDSliderOptionsArray);
//			
//			//updates the array in the DB
//			update_option('DDSliderOptions', $DDSliderOptionsArray);
//			
//			echo '<div class="updated fade" id="message"><p><strong>Options saved successfully.</strong></p></div>';
//			
//		}
		
		
		
	}
	
	$DDOptions = $DDOptions[$_GET['slider_id']];

?>

<script type="text/javascript">

	function viewHelpFile(sect) {
		
		window.open('<?php echo $DDSliderPath."helpfile.html#" ?>'+sect,'help','width=650,height=600,scrollbars=yes,resizable=no');
		
	}
	
	jQuery(document).ready(function() {
		
		jQuery('#DDSliderActivateArrows').iphoneStyle();
		jQuery('#DDSliderActivateSelectors').iphoneStyle();
		
		 //Check if element exists
				jQuery.fn.exists = function(){return jQuery(this).length;}
		  
		  
		  //AJAX upload
			jQuery('#DDUploadLeftArrow').each(function(){
				
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
								jQuery('#leftArrowImage').attr('src', response);
								jQuery('#leftArrowImage').load(function() {
									
									jQuery('#leftArrowWidth').val(jQuery(this).width());
									jQuery('#leftArrowHeight').val(jQuery(this).height());
									
								});	
								}
							
						}
				});
			});
		  
		  
		  //AJAX upload
			jQuery('#DDUploadRightArrow').each(function(){
				
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
								jQuery('#rightArrowImage').attr('src', response);	
								
								jQuery('#rightArrowImage').load(function() {
									
									jQuery('#rightArrowWidth').val(jQuery(this).width());
									jQuery('#rightArrowHeight').val(jQuery(this).height());
									
								});		
								}
							
						}
				});
			});
		  
		  
		  //AJAX upload
			jQuery('#DDUploadSelectorOff').each(function(){
				
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
								jQuery('#selectorOffImage').attr('src', response);
								jQuery('#selectorOffImage').load(function() {
									
									jQuery('#selectorOffWidth').val(jQuery(this).width());
									jQuery('#selectorOffHeight').val(jQuery(this).height());
									
								});		
								}
							
						}
				});
			});
		  
		  
		  //AJAX upload
			jQuery('#DDUploadSelectorOn').each(function(){
				
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
								jQuery('#selectorOnImage').attr('src', response);
								jQuery('#selectorOnImage').load(function() {
									
									jQuery('#selectorOnWidth').val(jQuery(this).width());
									jQuery('#selectorOnHeight').val(jQuery(this).height());
									
								});		
								}
							
						}
				});
			});
		
	});

</script>

<div class="wrap">
	
    <!-- Page Title -->
	<h2>DDSlider General Options - Slide: <?php echo $DDOptions['name']; ?></h2>
    
    <h3>General Options <input type="button" class="button autowidth" id="DDviewDoc" value="View Help File" style="float: right; margin-left: 10px" onclick="viewHelpFile('configure');" /><input type="button" class="button-primary autowidth" id="DDgoBack" value="Go back" style="float: right;" onclick="window.location='<?php bloginfo('wpurl') ?>/wp-admin/admin.php?page=DDSlider-options';" /></h3>
        
        <form method="post" action="" id="DDSliderGeneralOptions">
        
        <input type="hidden" name="name" value="<?php echo $DDOptions['name']; ?>" />
        <input type="hidden" name="description" value="<?php echo $DDOptions['description']; ?>" />
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              	
                <th colspan="2" scope="row" class="DDShowCollapse DDCollapse">Dimensions<span class="DDCollapseSection"></span></th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Width:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                	<input type="text" value="<?php echo $DDOptions['width']; ?>" id="DDSlider_Width" name="width" style="width: 120px;">px<span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Define you slider total width in pixels.</p></span>
                    
                    <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Height:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                	<input type="text" value="<?php echo $DDOptions['height']; ?>" id="DDSlider_Height" name="height" style="width: 120px;">px<span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Define you slider total height in pixels.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Cropped image quality:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                	<input type="text" value="<?php echo $DDOptions['crop_quality']; ?>" id="DDSlider_CropQuality" maxlength="3" name="crop_quality" style="width: 120px;"><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Whenever you upload an image and this image is smaller or bigger than the slider's total height and width, if this image is indeed being cropped, this will be either cropped or zoomed to fill the entire container. Input here a value between 1 and 100 for the quality of the generated image. 1 being the lowest and 100 being the highest.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
        
        <br>
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              
                <th colspan="2" scope="row" class="DDShowCollapse DDCollapse">Transition Options<span class="DDCollapseSection"></span></th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Default Transition:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    	<select id="DDSlider_Transition" name="trans" style="width: 350px;">
                        
                        <?php
						
							$allTransitions = array('random', 'fading', 'barTop', 'barBottom', 'barFade', 'barFadeRandom', 'square', 'squareOut', 'squareRandom', 'squareMoving', 'squareOutMoving', 'rowInterlaced');
							
							foreach($allTransitions as $trans) {
								
								if($DDOptions['trans'] == $trans) {
									
									echo '<option selected="selected" value="'.$trans.'">'.$trans.' [default]</option>';
									
								} else {
									
									echo '<option value="'.$trans.'">'.$trans.'</option>';
									
								}
								
							}
						
						?> </select><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Define here the default transition.</p></span>
                        
                        <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top">Bars Number:</th>
                
                <td style="padding-top: 15px; overflow:visible;">
                	<input type="text" value="<?php echo $DDOptions['bars']; ?>" id="DDSlider_Bars" name="bars" style="width: 120px;"><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>In the 'bars' transition series, define a number of bars in which the slider will be divided into.<br />Try to always choose a number that the slider width is dividable by.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" style="padding-top: 15px;">Columns Number:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                	<input type="text" value="<?php echo $DDOptions['columns']; ?>" id="DDSlider_Columns" name="columns" style="width: 120px;"><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>In the 'square' transition series, define a number of columns in which the slider will be divided into.<br />Try to always choose a number that the slider width is dividable by.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" style="padding-top: 15px;">Rows Number:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                	<input type="text" value="<?php echo $DDOptions['rows']; ?>" id="DDSlider_Rows" name="rows" style="width: 120px;"><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>In the 'square' transition series, define a number of rows in which the slider will be divided into.<br />Try to always choose a number that the slider height is dividable by.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
        
        <br>
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              
                <th colspan="2" scope="row" class="DDShowCollapse DDCollapse">Timing Options<span class="DDCollapseSection"></span></th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Delay Between Animation:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <input type="text" value="<?php echo $DDOptions['delay']; ?>" id="DDSlider_Delay" name="delay" style="width: 120px;"> miliseconds<span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>This is the delay between each block starts animating. For example, in the bar transition, the first bar will be played at timeframe 0, the second bar will play X miliseconds after and so on.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" style="padding-top: 15px;">Wait Time:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                	<input type="text" value="<?php echo $DDOptions['waitTime']; ?>" id="DDSlider_WaitTime" name="waitTime" style="width: 120px;"> miliseconds<span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Define here the delay which each slide will have to wait to be played.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" style="padding-top: 15px;">Duration:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                	<input type="text" value="<?php echo $DDOptions['duration']; ?>" id="DDSlider_Duration" name="duration" style="width: 120px;"> miliseconds<span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Define the duration of the animations. This is the animation time of each 'bar'or 'square'.<br />For example: The default duration is 500 miliseconds, meaning that it'll take 500 miliseconds for each 'bar' or 'square' to finish its animation<br />500 is recommended</p></span>
                    
                    <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" style="padding-top: 15px;">Stop Slide on Hover:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                	<select id="DDSlider_StopSlide" name="stopSlide" style="width: 250px;">
                    
                    	<?php
                        
							if($DDOptions['stopSlide'] == '1') {
								
								echo '<option selected="selected" value="1">Stop on Hover</option>
                    			<option value="0">DO NOT Stop on Hover</option>';
								
							} else {
								
								echo '<option value="1">Stop on Hover</option>
                    			<option selected="selected" value="0">DO NOT Stop on Hover</option>';
								
							}
						
						?>
                    
                    </select><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>Choose whether you want the slider to stop on hover or not.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
        
        <br>
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              
                <th colspan="2" scope="row" class="DDShowCollapse DDCollapse">Arrows Options<span class="DDCollapseSection"></span></th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Activate Arrows?</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <input type="checkbox" <?php checkCheck($DDOptions['automaticArrows']); ?> id="DDSliderActivateArrows" name="automaticArrows">
                  
                  <br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Arrows Position</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <select id="DDSliderArrowPos" name="arrowPosition" style="width: 250px;" onchange="arrowsSelector(this);">
                    
                    <?php
					
						$els = array('custom', 'topLeft', 'topRight', 'bottomLeft', 'bottomRight');
						
						foreach($els as $el) {
							
							if($el == $DDOptions['arrowPosition']) {
								
								echo '<option selected="selected" value="'.$el.'">'.$el.'</option>';
								
							} else {
								
								echo '<option  value="'.$el.'">'.$el.'</option>';
								
							}
							
						}
					
					?>
                    
                    </select><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The position of your arrows based on your slider.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr class="automaticArrows" <?php checkHiddenOp('custom', $DDOptions['arrowPosition']); ?>>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Left Arrow Image</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                <?php
					
						if($DDOptions['leftArrowImage'] != NULL) {
							
							echo '<img src="'.$DDOptions['leftArrowImage'].'" alt="leftArrow" style="float: left; margin-right: 10px;" id="leftArrowImage" />';
							
						}
					
					?>
                    
                    <input type="text" name="leftArrowImage" value="<?php echo $DDOptions['leftArrowImage']; ?>" style=" width: 200px;" /><input style="margin-left: 10px;" type="button" name="" class="button-primary autowidth" id="DDUploadLeftArrow" value="Upload Image" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The image URL of your left pointing arrow (calls previous slider). Insert a URL Path to the image or upload a new one.</p></span>
                    
                    <input type="hidden" name="leftArrowWidth" id="leftArrowWidth" value="<?php echo $DDOptions['leftArrowWidth']; ?>" />
                    <input type="hidden" name="leftArrowHeight" id="leftArrowHeight" value="<?php echo $DDOptions['leftArrowHeight']; ?>" />
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr class="automaticArrows" <?php checkHiddenOp('custom', $DDOptions['arrowPosition']); ?>>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Right Arrow Image</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                <?php
					
						if($DDOptions['rightArrowImage'] != NULL) {
							
							echo '<img src="'.$DDOptions['rightArrowImage'].'" alt="rightArrow" style="float: left; margin-right: 10px;" id="rightArrowImage" />';
							
						}
					
					?>
                    
                    <input type="text" name="rightArrowImage" value="<?php echo $DDOptions['rightArrowImage']; ?>" style=" width: 200px;" /><input style="margin-left: 10px;" type="button" name="" class="button-primary autowidth" id="DDUploadRightArrow" value="Upload Image" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The image URL of your right pointing arrow (calls next slider). Insert a URL Path to the image or upload a new one.</p></span>
                    
                    <input type="hidden" name="rightArrowWidth" id="rightArrowWidth" value="<?php echo $DDOptions['rightArrowWidth']; ?>" />
                    <input type="hidden" name="rightArrowHeight" id="rightArrowHeight" value="<?php echo $DDOptions['rightArrowHeight']; ?>" />
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr class="customArrows" <?php checkHidden('custom', $DDOptions['arrowPosition']); ?>>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Next Slide Arrow</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <input type="text" name="nextSlide" value="<?php echo $DDOptions['nextSlide']; ?>" style=" width: 200px;" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The jQuery selector of your custom NEXT arrow</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr class="customArrows" <?php checkHidden('custom', $DDOptions['arrowPosition']); ?>>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Previous Slide Arrow</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <input type="text" name="prevSlide" value="<?php echo $DDOptions['prevSlide']; ?>" style=" width: 200px;" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The jQuery selector of your custom PREVIOUS arrow</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
        
        <br>
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              
                <th colspan="2" scope="row" class="DDShowCollapse DDCollapse">Selector Options<span class="DDCollapseSection"></span></th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Activate Selectors?</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <input type="checkbox" <?php checkCheck($DDOptions['automaticSelectors']); ?> id="DDSliderActivateSelectors" name="automaticSelectors">
                  
                  <br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Selectors Position</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <select id="DDSliderArrowPos" name="selectorPosition" style="width: 250px;" onchange="selectorsSelector(this);">
                    
                    <?php
					
						$els = array('custom', 'topLeft', 'topRight', 'bottomLeft', 'bottomRight');
						
						foreach($els as $el) {
							
							if($el == $DDOptions['selectorPosition']) {
								
								echo '<option selected="selected" value="'.$el.'">'.$el.'</option>';
								
							} else {
								
								echo '<option  value="'.$el.'">'.$el.'</option>';
								
							}
							
						}
					
					?>
                    
                    </select><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The position of your selector based on your slider.</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr class="automaticSelectors" <?php checkHiddenOp('custom', $DDOptions['selectorPosition']); ?>>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">OFF State selector</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                <?php
					
						if($DDOptions['selectorOffImage'] != NULL) {
							
							echo '<img src="'.$DDOptions['selectorOffImage'].'" alt="selectorOffImage" style="float: left; margin-right: 10px;" id="selectorOffImage" />';
							
						}
					
					?>
                    
                    <input type="text" name="selectorOffImage" value="<?php echo $DDOptions['selectorOffImage']; ?>" style=" width: 200px;" /><input style="margin-left: 10px;" type="button" name="" class="button-primary autowidth" id="DDUploadSelectorOff" value="Upload Image" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The image URL of your selector on OFF state (When the respective slider is NOT the current one). Insert an Image URL or upload a new image.</p></span>
                    
                    <input type="hidden" name="selectorOffWidth" id="selectorOffWidth" value="<?php echo $DDOptions['selectorOffWidth']; ?>" />
                    <input type="hidden" name="selectorOffHeight" id="selectorOffHeight" value="<?php echo $DDOptions['selectorOffHeight']; ?>" />
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr class="automaticSelectors" <?php checkHiddenOp('custom', $DDOptions['selectorPosition']); ?>>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">ON State selector</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                <?php
					
						if($DDOptions['selectorOnImage'] != NULL) {
							
							echo '<img src="'.$DDOptions['selectorOnImage'].'" alt="selectorOnImage" style="float: left; margin-right: 10px;" id="selectorOnImage" />';
							
						}
					
					?>
                    
                    <input type="text" name="selectorOnImage" value="<?php echo $DDOptions['selectorOnImage']; ?>" style=" width: 200px;" /><input style="margin-left: 10px;" type="button" name="" class="button-primary autowidth" id="DDUploadSelectorOn" value="Upload Image" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The image URL of your selector on On state (When the respective slider IS the current one). Insert an Image URL or upload a new image.</p></span>
                    
                    <input type="hidden" name="selectorOnWidth" id="selectorOnWidth" value="<?php echo $DDOptions['selectorOnWidth']; ?>" />
                    <input type="hidden" name="selectorOnHeight" id="selectorOnHeight" value="<?php echo $DDOptions['selectorOnHeight']; ?>" />
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr class="customSelectors" <?php checkHidden('custom', $DDOptions['arrowPosition']); ?>>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Custom Selector</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <input type="text" name="selector" value="<?php echo $DDOptions['selector']; ?>" style=" width: 200px;" /><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>The jQuery selector of your selector UL</p></span>
                  
                  <br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
        
        <br>
        
        <div class="themeTableWrapper">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              
                <th colspan="2" scope="row" class="DDShowCollapse DDCollapse">Advanced Options<span class="DDCollapseSection"></span></th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="300px">Ease:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                    
                    <input type="text" value="<?php echo $DDOptions['ease']; ?>" id="DDSlider_Ease" name="ease" style="width: 200px;"><span class="DDGetInfo">&nbsp;<p><span class="infoBoxArrow"></span>This option allows you to define a default animation 'easing' for your transitions. ONLY CHANGE THIS IF YOU HAVE EASING jQUERY PLUGIN ON YOUR THEME<br />'swing' is recommended.</p></span>
                    
                    <br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
    
		<p class="submit"><input type="submit" name="submitDDGeneralOptions" class="button-primary autowidth" id="submitDDGeneralOptions" value="Save Changes" /></p>
        
	</form>

</div>

<?php else : ?>

<?php

	

	if((isset($_GET['delete_slider'])) && ($_GET['delete_slider'] == 1) && ($_GET['slider_id'] != NULL)) {
		
		unset($DDOptions[$_GET['slider_id']]);
		
		update_option('DDSliderOptions', $DDOptions);
		
		$mySlides = get_option('DDSliderSlides');
		
		unset($mySlides[$_GET['slider_id']]);
		
		update_option('DDSliderSlides', $mySlides);
		
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.get_bloginfo('wpurl').'/wp-admin/admin.php?page=DDSlider-options">';
		
		exit();
		
	}

	if(isset($_POST['submitNewSlider'])) {
		
		$error = 0;
		
		$DDOptions = get_option('DDSliderOptions');
		
		if($DDOptions != NULL) {
		
			foreach($DDOptions as $slider) {
				
				if($slider['name'] == $_POST['newSliderName']) {
					
					$error = 1;
					
				} elseif($_POST['newSliderName'] == '') {
					
					$error = 2;
					
				}
				
			}
		
		}
		
		if($error == 1) {
			
			echo '<div class="updated fade" id="message"><p><strong>Please enter a different name. Each Slide needs to have an unique name.</strong></p></div>';
			
		} elseif($error == 2) {
			
			echo '<div class="updated fade" id="message"><p><strong>Please enter a name for your slider.</strong></p></div>';
			
		} else {
		
			$DDSliders = get_option('DDSliderSlides');
			
			$DDSliders[$_POST['newSliderName']] = array();
			
			$DDOptions[$_POST['newSliderName']] = array(
			
					'name' => $_POST['newSliderName'],
					'description' => $_POST['newSliderDesc'],
					'height'=>'300',
					'width'=>'960', 
					'trans'=>'random',
					'delay'=>'50',
					'waitTime'=>'5000',
					'duration'=>'500',
					'stopSlide'=>'1',
					'bars'=>'15',
					'columns'=>'10',
					'rows'=>'3',
					'ease'=>'swing',
					'selector'=>'',
					'prevSlide'=>'',
					'nextSlide'=>'',
					'crop_quality' => 90,
					'automaticArrows' => 'on',
					'automaticSelectors' => 'on',
					'arrowPosition' => 'bottomLeft',
					'leftArrowWidth' => 22,
					'leftArrowHeight' => 22,
					'rightArrowWidth' => 22,
					'rightArrowHeight' => 22,
					'selectorPosition' => 'bottomRight',
					'selectorOffWidth' => 10,
					'selectorOffHeight' => 10,
					'selectorOnWidth' => 10,
					'selectorOnHeight' => 10,
					'leftArrowImage' => $DDSliderPath.'images/arrowLeft.png',
					'rightArrowImage' => $DDSliderPath.'images/arrowRight.png',
					'selectorOffImage' => $DDSliderPath.'images/selectorOff.png',
					'selectorOnImage' => $DDSliderPath.'images/selectorOn.png'
			
			);
			
			update_option('DDSliderOptions', $DDOptions);
			update_option('DDSliderSlides', $DDSliders);
			
			echo '<div class="updated fade" id="message"><p><strong>Options saved successfully.</strong></p></div>';
			
			$DDOptions = get_option('DDSliderOptions');
			
		}
		
	}

?>

<script type="text/javascript">

</script>

<div class="wrap">
	
    <!-- Page Title -->
	<h2>DDSlider General Options</h2>
    
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
                        
                        	<a href="<?php echo get_bloginfo('wpurl').'/wp-admin/admin.php?page=DDSlider-options&amp;slider_id='.$slider['name']; ?>">Edit</a> / <a onclick="return confirm('Are you sure you want to delete the slide <?php echo $slider['name']; ?>?');" href="<?php echo get_bloginfo('wpurl').'/wp-admin/admin.php?page=DDSlider-options&amp;delete_slider=1&amp;slider_id='.$slider['name']; ?>">Delete</a>
                        
                        </th>
                    
                    </tr>
                
                </table>
                
                <?php endforeach; endif; ?>
            
            </tbody>
            
          </table>
          
        </div>
        
    </form>

<p>&nbsp;</p>

<div class="themeTableWrapper">

<form method="post" action="" id="addNewSlider">
        
          <table cellspacing="0" class="widefat themeTable">
          
            <thead>
            
              <tr>
              	
                <th colspan="2" scope="row" align="left">Add Slide</th>
                
              </tr>
              
            </thead>
            
            <tbody>
            
              <tr>
              
              
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="200px">Unique Slider Name:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                	<input type="text" value="" id="SliderName" name="newSliderName" maxlength="32" style="width: 250px;" /><br /><br />
                    
                 </td>
                 
              </tr>
            
              <tr>
              
              
              
                <th style="padding-top: 15px;" scope="row" valign="top" width="200px">Slider Description:</th>
                
                <td style="padding-top: 15px; overflow: visible;">
                
                	<input type="text" value="" id="newSliderDesc" name="newSliderDesc" maxlength="32" style="width: 250px;" /><br /><br />
                    
                 </td>
                 
              </tr>
              
            </tbody>
            
          </table>
          
        </div>
    
		<p class="submit"><input type="submit" name="submitNewSlider" class="button-primary autowidth" id="submitNewSlider" value="Add New Slider" /></p>
        
    </form>
    
</div>
        

<?php endif; ?>