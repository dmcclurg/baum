<?php
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] = get_option( $value['id'] ); }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
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

	<?php wp_head(); ?>

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'basicmaths' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'basicmaths' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

<!--[if lt IE 8]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->

</head>
 
<body <?php body_class(); ?>>

<div id="wrapper">

	<div id="header">
	
		<h1><a href="<?php echo get_option('home'); ?>/"><span><?php bloginfo('name'); ?></span></a></h1>
					
	</div>
	
	<div id="skip">
		<a href="#content" title="<?php _e('Skip navigation to the content', 'basicmaths'); ?>"><span><?php _e('Skip to content', 'basicmaths'); ?></span></a>
	</div>

	<div id="access">	
		<?php include("navigation.php"); ?>
	</div>
	
	<? if ( !(is_front_page())) {?>
	<!-- Only show intro if it isn't the home page -->
	<div id="intro"
	<? if ( is_page("Bikes")) {?>
	class="noBorder"	
	<? }?>
	
	>
		
		
		<? if ( !(is_page())) {?>
		<h2 class="description">The requested page was not found.</em></h2>
		
		<? } else{ ?>
		<h2 class="description"><?php the_title(); ?></h2>
		<? } ?>
		
	</div>
	<? } ?>

		
	<div id="container">

<?php if($bm_cats_or_tags == 'true') { ?>
		<div id="toptags">
			<h3><?php _e( 'Categories', 'basicmaths' ) ?></h3>
			<ul>
				<?php basic_categories(); ?>
			</ul>
		</div>
<?php } else { ?>
		<div id="toptags">
			<h3><?php _e( 'Top Tags', 'basicmaths' ) ?></h3>
			<ul>
				<?php basic_tags(); ?>
			</ul>
		</div>
<?php } ?>

		<div id="content">

			<div class="post">
				<h2 class="archive-title"><?php _e( 'Error', 'basicmaths' ) ?> <span class="error"><?php _e( '404', 'basicmaths' ) ?></span></h2>
				<div class="single-entry-meta">
					<span class="meta-item meta-description"><span class="label"><?php _e( 'Description', 'basicmaths' ) ?></span> <span class="meta-content error"><?php _e( 'Page not found', 'basicmaths' ) ?></span></span>
					<span class="meta-item meta-message"><span class="label"><?php _e( 'Message', 'basicmaths' ) ?></span> <span class="meta-content"><?php _e( 'Sorry, the page that you were looking for could not be found. If you want to find something else, you can search for it here:', 'basicmaths' ) ?></span></span>
					<span class="meta-item meta-search"><label class="label" for="s"><?php _e( 'Search', 'basicmaths' ) ?></label>
						<span class="meta-content">
							<form id="searchform" class="blog-search" method="get" action="<?php bloginfo('home') ?>">
								<div>
									<input id="s" name="s" type="text" class="text" value="<?php the_search_query() ?>" size="30" tabindex="1" />
									<input type="submit" class="button" value="<?php _e( 'Go', 'basicmaths' ) ?>" tabindex="2" />
								</div>
							</form>
						</span>
					</span>
				</div>
				
				<div class="entry-content">
<?php basic_404_link(); ?>

				</div>

			</div><!-- .post -->
				
		</div><!-- #content -->
	
<?php get_sidebar(); ?>

	</div><!-- #container -->

<?php get_footer(); ?>