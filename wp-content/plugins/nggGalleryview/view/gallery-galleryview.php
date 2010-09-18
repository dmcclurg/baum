<?php 
/**
Template Page for the jQuery Galleryview integration

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/

?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<div id="<?php echo $gallery->anchor ?>" class="galleryview">
	<!-- Thumbnails -->
	<?php foreach ($images as $image) : ?>		
	<div class="panel">
		<img src="<?php echo $image->imageURL ?>" />
		<div class="panel-overlay">
			<h2><?php echo html_entity_decode ($image->alttext); ?></h2>
			<p><?php echo html_entity_decode ($image->description); ?></p>
		</div>
	</div>
 	<?php endforeach; ?>
  	<ul class="filmstrip">
  	<?php foreach ($images as $image) : ?>	
	    <li><img src="<?php echo $image->thumbnailURL ?>" alt="<?php echo $image->alttext ?>" title="<?php echo $image->alttext ?>" /></li>
	<?php endforeach; ?>
  	</ul>

</div>

<script type="text/javascript" defer="defer">
	jQuery("document").ready(function(){
		jQuery('#<?php echo $gallery->anchor ?>').galleryView({
			panel_width: 920,
			panel_height: 606,
			frame_width: 120,
			frame_height: 80,
			transition_interval: 0,
			overlay_color: '#000',
			overlay_text_color: 'white',
			caption_text_color: '#222',
			background_color: 'black',
			border: 'none',
			nav_theme: 'light',
			easing: 'easeInOutQuad',
			transition_speed: 600,
			show_captions: false
		});
	});
	
</script>

<?php endif; ?>