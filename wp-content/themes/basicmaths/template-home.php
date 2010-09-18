<?php
/*
Template Name: Template-home
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
		
	<div id="container" class="homePage">
	<div id="content">

<?php the_post() ?>
		
		<div class="post">
			<?php if(function_exists('displayDDSlider')) { echo displayDDSlider(array(name=>"homepage")); } ?>
			
			<div class="entry-content">
				<?php the_content(); ?>
				
				<div id="recentPostsHomePage"
				<h2>Recent Journal Entries</h2>
				<ul>
				
				<?php $lastposts = get_posts('numberposts=3'); 
					foreach($lastposts as $post) :setup_postdata($post); ?>
					<li>
						<div class="headBlock">
				 			<span><?php the_date(); ?></span>
							<em class="nextprev-arrow">›</em>
				 			<h3><a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></h3>
							
						</div>
				 		<?php the_excerpt(); ?>
					</li>
					<?php endforeach; ?>

				</div>

<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'basicmaths' ) . '&after=</div>') ?>
				
			</div>

			
			<?php edit_post_link(__( 'Edit', 'basicmaths' ), '<div class="single-entry-meta"><span class="edit">', '</span></div><!-- .entry-meta -->'); ?> 

		</div><!-- .post -->
	
<?php if ( get_post_custom_values('comments') ) comments_template('', true); ?>

	</div><!-- #content -->

</div><!-- #container -->

<?php get_footer(); ?>