<?php
/*
Template Name: Template-bikes
*/
?>
<?php
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] = get_option( $value['id'] ); }
    }
?>
<?php get_header(); ?>
		
	<div id="container" class="fullWidth">

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

<?php the_post() ?>
		
		<div class="post">
			<div class="entry-content">
				<?php the_content(); ?>

				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'basicmaths' ) . '&after=</div>') ?>
			</div>
			
				<div class="column">
					<?php include 'navigation-road.php'; ?>
				</div>
				<div class="column">
					<?php include 'navigation-mountain.php'; ?>
				</div>
				<div class="column last">
					<?php include 'navigation-touring.php'; ?>
				</div>
			
			<p class="bottom-nav">
				<a href ="fit-finish">→ Fitting and customisation</a><br />
				<a href ="f-a-q">→ Frequently asked questions</a>
			<p>


	
					
			<?php edit_post_link(__( 'Edit', 'basicmaths' ), '<div class="single-entry-meta"><span class="edit">', '</span></div><!-- .entry-meta -->'); ?> 

		</div><!-- .post -->
	
<?php if ( get_post_custom_values('comments') ) comments_template('', true); ?>

	</div><!-- #content -->

</div><!-- #container -->

<?php get_footer(); ?>