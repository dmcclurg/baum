
<ul id="topnav" class="<?php wp_title('',true,''); ?>">
    <li class="bikeItem">
    	<a href="bikes" class="bikes">Bikes</a>
			<div class="sub">
				<ul class="firstChild" id="road">
					<li><h2>Road</h2>
					<?php include 'navigation-road.php'; ?>
					</li>
				</ul>
				<ul class="firstChild" id="mountain">
					
					<li><h2>Mountain</h2>
					<?php include 'navigation-mountain.php'; ?>
					</li>
				</ul>
				<ul class="firstChild" id="touring">
					<li><h2>Touring</h2>
						<?php include 'navigation-touring.php'; ?>
					</li>
					
				</ul>
			</div>
    </li>
    <li><a href="fit-finish" class="fitFinish">Fit &amp Finish</a></li>
    <li><a href="blog" class="blog">Blog</a></li>
    <li><a href="about" class="about">About</a></li>
	<li><a href="contact" class="contact">Contact</a></li>
	<li><a href="f-a-q" class="faq">F.A.Q</a></li>
</ul>

<script>
jQuery(function(){
   var path = location.pathname.substring(1);
   if ( path )
     jQuery('ul.firstChild li a[href$="' + path + '"]').attr('class', 'current');
 });

</script>

<?php
function print_subnav($parent_id) {
    $pages = get_pages('child_of=' . $parent_id);

    if(!empty($pages)) {
    	echo '<div class="sub">';

	foreach($pages as $page) {
	    if($page->post_parent==$parent_id) {

		echo '<ul>';
		$before = '<h2>';
		$after = '</h2>';
		echo '<li>' . $before . $page->post_title . '</a>' . $after .'</li>';

		$grandchildren = get_pages('child_of=' . $page->ID);
		foreach($grandchildren as $grandchild) {
		    echo '<li class="here"><a href="' . get_page_link($page->ID) . '/' . $grandchild->post_name . '">' . $grandchild->post_title . '</a></h2></li>';
		}
	    }
	}
	echo '</div>';
    }
}

?>