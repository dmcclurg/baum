<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?> style="background:#000">
<head profile="http://gmpg.org/xfn/11">
    <title><?php
        if ( is_single() ) { bloginfo('name'); print ' | '; single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); }
        elseif ( is_page() ) { bloginfo('name'); print ' | '; single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); print ' Archive';}
    ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/img/favicon.ico" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory') ?>/print.css" media="print"  />

	<?php wp_head(); ?>

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'basicmaths' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'basicmaths' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

<!--[if lt IE 8]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->

<script type="text/javascript">

jQuery(document).ready(function() {
jQuery('#tabulartable tr').hover(
    function () {
     	jQuery(this).addClass("highlightRow");
		},
	function()
	   {
	    jQuery(this).removeClass("highlightRow");
    });
});

jQuery(document).ready(function() {
 jQuery("#tabulartable tr td:first-child").css({"font-style":"italic", "font-weight":"bold"});
});


</script>

</head>
 
<body id="darkTheme"<?php body_class(); ?>>

<div id="wrapper" class="<?php print $post_name; ?>">
	<div id="header">
		
		<img src="<?php echo bloginfo('stylesheet_directory') ?>/img/baum-logo.gif" width="299" height="49" alt="Baum Logo" class="printOnly">
		<h1><a href="<?php echo get_option('home'); ?>/"><span><?php bloginfo('name'); ?></span></a></h1>
					
	</div>
	
	<div id="skip">
		<a href="#content" title="<?php _e('Skip navigation to the content', 'basicmaths'); ?>"><span><?php _e('Skip to content', 'basicmaths'); ?></span></a>
	</div>

	<div id="access">
		<?php include("navigation.php"); ?>
	
		<!-- <ul id="nav">
		
			<?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>
			
			
		</ul> -->

	</div>
	
	<? if ( !(is_front_page())) {?>
	<!-- Only show intro if it isn't the home page -->
	<div id="intro"
	<? if ( is_page("Bikes")) {?>
	class="noBorder"	
	<? }?>
	
	>
		
		
		<? if ( !(is_page())) {?>
		<h2 class="description">Journal<em> &ndash; letters from Baumland</em></h2>
		
		<div id="nav-search">
			<label for="nav-s"><?php _e( 'Search', 'basicmaths' ) ?></label>
			<form id="nav-searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
				<div>
					<input id="nav-s" name="s" type="text" class="text" value="<?php the_search_query() ?>" size="30" tabindex="1" />
					<input type="submit" class="button" value="<?php _e( 'Go', 'basicmaths' ) ?>" tabindex="2" />
				</div>
			</form>
		</div>
		
		<? } else{ ?>
		<h2 class="description"><?php the_title(); ?></h2>
		<? } ?>
		
	</div>
	<? } ?>
