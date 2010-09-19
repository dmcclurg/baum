<?php
/*
	
		Plugin Name: DDSlider WP
		Version: 1.0
		Description: Add DDSlider to your WP Theme.
		Author: Guilherme Salum - DDStudios
		Author URI: http://themeforest.net/user/DDStudios
		Plugin URI: http://themeforest.net/user/DDStudios
	
*/
	
	//Let's check the WP Version
	global $wp_version;
	$exit_msg = 'DDSlider Plugin requires WordPress 2.6 or newer, please update!';
	
	if(version_compare($wp_version, "2.6", "<")) {
		
		exit($exit_msg);
		
	}
		
	//Plugin Path
	$DDSliderPath = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	
	//Let's insert the necessary js files and css
	//Inserts the necessary .js file
	add_action('wp_print_scripts', 'insDDSliderJS');
	
	//Inserts the necessary .css file
	add_action('wp_head', 'insDDSliderCSS');
	
	//WHEN PLUGIN IS DEACTIVATED, LET's ERASE OUR OPTIONS FROM THE DB
	register_deactivation_hook( __FILE__, 'DDUninstall' );
	
	//Let's add the options page to the menu
	add_action('admin_menu', DDAdminMenu);
	
	
	//-------------------------------
	//--------------------- SHORTCODE
	//-------------------------------
	
	function displayDDSlider($atts) {
		extract(
		
			shortcode_atts(
		
				array(
				
					'name' => '',
				
				),
			
				$atts
			
			)
		
		);
		
		if($name != '') {

		
			$DDOptions = get_option('DDSliderOptions');
			
			$error = 1;
			
			foreach($DDOptions as $opt) {
				
				if($opt['name'] == $name) {
					
					$error = 0;
				}
				
			}
					
			//Now we get all slides from our options
			$DDSliderSlides = get_option('DDSliderSlides');
			
			//Select the right slider
			$DDSliderSlides = $DDSliderSlides[$name];
			
			if($DDSliderSlides != NULL) {
			
				if($error == 0) {
				
					$DDOptions = $DDOptions[$name];
					global $DDSliderPath;
					
					$DDContent = '<script type="text/javascript">
			
				jQuery(document).ready(function($) {
					
					$("#DDSlider").DDSlider({
						
						trans: "'.$DDOptions['trans'].'",
						delay: '.$DDOptions['delay'].',
						waitTime: '.$DDOptions['waitTime'].',
						duration: '.$DDOptions['duration'].',
						stopSlide: '.$DDOptions['stopSlide'].',
						bars: '.$DDOptions['bars'].',
						columns: '.$DDOptions['columns'].',
						rows: '.$DDOptions['rows'].',
						ease: "'.$DDOptions['ease'].'",
						'.checkDDOption($DDOptions['selector'], 'selector', $DDOptions).'
						'.checkDDOption($DDOptions['nextSlide'], 'nextSlide', $DDOptions).'
						'.checkDDOption($DDOptions['prevSlide'], 'prevSlide', $DDOptions).'
						
					});
					
				});
				
			</script>
			
			<style type="text/css">
			
				#DDSlider, #DDSlider li {
					
					width: '.$DDOptions['width'].'px;
					height: '.$DDOptions['height'].'px;
					
				}
			
			</style>
			';
					
					if($DDOptions['automaticArrows'] == 'on') {
					
						  $DDContent .= '<style type="text/css">
		  
			  #DDPrevSlide {
				  
				  width: '.$DDOptions['leftArrowWidth'].'px;
				  height: '.$DDOptions['leftArrowHeight'].'px;
				  background: url('.$DDOptions['leftArrowImage'].') no-repeat center center;
				  position: absolute;
				  z-index: 15;
				  cursor: pointer;';
				  
			  ;
		  
					  switch($DDOptions['arrowPosition']) {
						  
						  case 'topLeft':
							  $DDContent .= 'top: 10px; left: 10px;';
							  break;
							  
						  case 'bottomLeft':
							  $DDContent .= 'bottom: 10px; left: 10px;';
							  break;
							  
						  case 'topRight':
							  $left = ($DDOptions['rightArrowWidth'] + 10 + 5);
							  $DDContent .= 'top: 10px; right: '.$left.'px;';
							  break;
							  
						  case 'bottomRight':
							  $left = ($DDOptions['rightArrowWidth'] + 10 + 5);
							  $DDContent .= 'bottom: 10px; right: '.$left.'px;';
							  break;
						  
					  }
					  
						  $DDContent .= '}';
						  
						  $DDContent .= '#DDNextSlide {
				  
				  width: '.$DDOptions['rightArrowWidth'].'px;
				  height: '.$DDOptions['rightArrowHeight'].'px;
				  background: url('.$DDOptions['rightArrowImage'].') no-repeat center center;
				  position: absolute;
				  z-index: 15;
				  cursor: pointer;';
				  
					  switch($DDOptions['arrowPosition']) {
						  
						  case 'topLeft':
						  $left = ($DDOptions['leftArrowWidth'] + 10 + 5);
							  $DDContent .= 'top: 10px; left: '.$left.'px;';
							  break;
							  
						  case 'bottomLeft':
						  $left = ($DDOptions['leftArrowWidth'] + 10 + 5);
							  $DDContent .= 'bottom: 10px; left: '.$left.'px;';
							  break;
							  
						  case 'topRight':
							  $DDContent .= 'top: 10px; right: 10px;';
							  break;
							  
						  case 'bottomRight':
							  $DDContent .= 'bottom: 10px; right: 10px;';
							  break;
						  
					  }
						  
						  $DDContent .= '}</style>';
						
					}
					
					if($DDOptions['automaticSelectors'] == 'on') {
						
						$DDContent .= '<style type="text/css">';
				
						$DDContent .= '#DDSelectors {
							
								position: absolute;
								list-style: none;
								z-index: 15;
								padding: 0;
								margin: 0;';
								
								
					
						switch($DDOptions['selectorPosition']) {
							
							case 'topLeft':
								$DDContent .= 'top: 10px; left: 10px;';
								break;
								
							case 'bottomLeft':
								$DDContent .= 'bottom: 10px; left: 10px;';
								break;
								
							case 'topRight':
								$DDContent .= 'top: 10px; right: 10px;';
								break;
								
							case 'bottomRight':
								$DDContent .= 'bottom: 10px; right: 50%;';
								break;
							
						}
								
								
								$DDContent .= '
							
								}
								
								#DDSelectors li {
									
									float: left;
									margin: 0 3px;
									padding: 0;
									cursor: pointer;
									height: '.$DDOptions['selectorOffHeight'].'px;
									width: '.$DDOptions['selectorOffWidth'].'px;
									background: url('.$DDOptions['selectorOffImage'].') no-repeat center center;
									
								}
								
								#DDSelectors li.current {
									
									float: left;
									margin: 0 3px;
									cursor: pointer;
									height: '.$DDOptions['selectorOnHeight'].'px;
									width: '.$DDOptions['selectorOnWidth'].'px;
									background: url('.$DDOptions['selectorOnImage'].') no-repeat center center;
									
								}
								
								';
						
						$DDContent .= '</style>';
						
					}
					
					$DDContent .= '<div id="DDSliderCont" style="position: relative; float: left;"><ul id="DDSlider">';
					
					//Let's sort our Sliders by position
					sort($DDSliderSlides);
					
					//Let's loop in the array and create our <li> tags
					foreach($DDSliderSlides as $slide) {
						
						//Let's begin by opening our <li> tag and setting the BG color
						$DDContent .= '<li style="background: #'.$slide['bg_color'].';"';
						
						//Now we check whether a transition has been defined for this slider
						if($slide['transition'] != NULL) {
							
							if($slide['transition'] == 'default') {
								
								$DDContent .= ' title="'.$DDOptions['trans'].'"';
								
							} else {
							
								$DDContent .= ' title="'.$slide['transition'].'"';
								
							}
							
						}
						
						//Let's finish our opening <li> tag
						$DDContent .= '>';
						
						//Now let's check what kind of content we're dealing, images or inline content
						if($slide['type'] == 'image') {
							
							//Let's check if the user has attributed a link to the image
							if($slide['img_url'] != NULL) {
								
								//If user has attributed link
								//Lets open the <a> tag 
								$DDContent .= '<a href="'.$slide['img_url'].'">';
								
								//Check if user wants to crop the image
								if($slide['crop'] == 1) {
								
									//Let's get out image tag
									$DDContent .= '<img src="'.$DDSliderPath.'includes/timthumb.php?src='.$slide['img_src'].'&w='.$DDOptions['width'].'&h='.$DDOptions['height'].'&q='.$DDOptions['crop_quality'].'&zc=1" alt="'.$slide['img_alt'].'" />';
									
								} else {
									
									$DDContent .= '<img src="'.$slide['img_src'].'" alt="'.$slide['img_alt'].'" />';
									
								}
								
								//Close our <a> tag
								$DDContent .= '</a>';
								
							} else {
								
								//If user has attributed NO Link whatsoever
								//Let's get out image tag
								//Check if user wants to crop the image
								if($slide['crop'] == 1) {
								
									//Let's get out image tag
									$DDContent .= '<img src="'.$DDSliderPath.'includes/timthumb.php?src='.$slide['img_src'].'&w='.$DDOptions['width'].'&h='.$DDOptions['height'].'&q='.$DDOptions['crop_quality'].'&zc=1" alt="'.$slide['img_alt'].'" />';
									
								} else {
									
									$DDContent .= '<img src="'.$slide['img_src'].'" alt="'.$slide['img_alt'].'" />';
									
								}
								
							}
							
						} elseif($slide['type'] == 'inline') {
							
							//If the slider is an inline content
							$DDContent .= stripslashes(html_entity_decode($slide['content']));
							
						}
						
						//Let's finish by closing our <li> tag
						$DDContent .= '</li>';
						
					}
					
					$DDContent .= '</ul>';
					
					if($DDOptions['automaticArrows'] == 'on') {
						
						$DDContent .= '<div id="DDNextSlide"></div>';
						$DDContent .= '<div id="DDPrevSlide"></div>';
						
					}
					
					if($DDOptions['automaticSelectors'] == 'on') {
						
						$DDContent .= '<ul id="DDSelectors"></ul>';
						
					}
					
					$DDContent .= '</div>';
					
					return $DDContent;
				
			}
			
			}
		
		}
		
		
	}
	
	add_shortcode('DDSlider', 'displayDDSlider');
	
	
	//-------------------------------
	//--------- INCLUDES THE .JS FILE
	//-------------------------------
	
	function insDDSliderJS() {
		
		global $DDSliderPath;
		
		if(!is_admin()) {
			
			wp_enqueue_script('jquery');
			wp_enqueue_script('DDSlider_jquery_plugin', $DDSliderPath.'js/jquery.DDSlider.min.js', array('jquery'));
			
		}
		
	}
	
	
	//-------------------------------
	//-------- INCLUDES THE .CSS FILE
	//-------------------------------
	
	function insDDSliderCSS() {
		
		$DDOptions = get_option('DDSliderOptions');
		
		//Get the path of our plugin
		global $DDSliderPath;
		
		//Get our slider options
		$DDDefaults = get_option('DDSliderOptions');
		
		//If we're not in the admin
		if(!is_admin()) {
			
			//Includes the Slider CSS
			echo '<link rel="stylesheet" href="'.$DDSliderPath.'css/DDSlider.css" type="text/css" />';
			
		}
		
	}
	
	
	//-------------------------------
	//----------- ADDS THE ADMIN PAGE
	//-------------------------------
	function DDAdminMenu() {
		
		add_menu_page( 'DDSlider', 'DDSlider', 10, 'manager-DDSlider', 'DDloadManagerPage' );
		add_submenu_page( 'manager-DDSlider', 'DD Slide Manager', 'Slide Manager', 10, 'manager-DDSlider', 'DDloadManagerPage');
		add_submenu_page('manager-DDSlider', 'General Settings', 'General Options', 10, 'DDSlider-options', 'DDloadOptionsPage');
		
	}
	
	//-------------------------------
	// ERASE OPTIONS WHEN UNINSTALLED
	//-------------------------------
	
	function DDUninstall() {
		
		//erase the options
		delete_option('DDSliderOptions');
		delete_option('DDSliderSlides');
		
	}
	
	if(version_compare($wp_version, "2.8", ">")) {
		
		//Make sure we load this in our <head>
		require_once('includes/DDAjaxImage.php');
	
	}
	
	//Let's load the options page and include it
	function DDloadOptionsPage() {
		
		require_once('DDSliderOptions.php');
		
	}
	
	//Let's load the manager page and include it
	function DDloadManagerPage() {
		
		require_once('DDSlideManager.php');
		
	}
	
	//checks if the element exists, if it does, return the right value
	function checkDDOption($el, $field, $arr) {		
		
		if(($arr['automaticSelectors'] == 'on') || ($arr['automaticArrows'] == 'on') || ($el != '')) {
			
			if($field == 'selector') {
				
				if($arr['automaticSelectors'] == 'on') {
				
					return 'selector: "#DDSelectors",';
					
				} else {
					
					return 'selector: "'.$el.'",';
					
				}
				
			} elseif($field == 'nextSlide') {
				
				if($arr['automaticArrows'] == 'on') {
				
					return 'nextSlide: "#DDNextSlide",';
					
				} else {
					
					return 'nextSlide: "'.$el.'",';
					
				}
				
			} elseif($field == 'prevSlide') {
				
				if($arr['automaticArrows'] == 'on') {
				
					return 'prevSlide: "#DDPrevSlide"';
					
				} else {
					
					return 'prevSlide: "'.$el.'"';
					
				}
				
			}
			
		}
		
	}
	
	function checkCheck($el) {
		
		if($el == 'on') {
			
			echo 'checked="checked"';
			
		}
		
	}
	
	function checkHidden($val, $field) {
		
		if($val != $field) {
			
			echo 'style="display: none;"';
			
		}
		
	}
	
	function checkHiddenOp($val, $field) {
		
		if($val == $field) {
			
			echo 'style="display: none;"';
			
		}
		
	}

?>