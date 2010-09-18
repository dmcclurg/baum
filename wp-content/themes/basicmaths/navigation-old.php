 
<ul id="topnav">
    <li><a href="#" class="home">Home</a></li>
    <li>
    	<a href="#" class="products">Products</a>
            <?php print_subnav(7);?>
    </li>
    <li><a href="#" class="sale">Sale</a></li>
    <li><a href="#" class="community">Community</a></li>
    <li><a href="#" class="store">Store Locator</a></li>
</ul>

<?php
function print_subnav($parent_id) {
    $pages = get_pages('child_of=' . $parent_id);

    if(!empty($pages)) {
    	echo '<div class="sub" style="display:block!important">';

	foreach($pages as $page) {
	    if($page->post_parent==$parent_id) {

		echo '<ul>';
		$before = '<h2>';
		$after = '</h2>';
		echo '<li class="gc">' . $before . $page->post_title . '</a>' . $after .'</li>';

		$grandchildren = get_pages('child_of=' . $page->ID);
		foreach($grandchildren as $grandchild) {
		    echo '<li><a href="' . get_page_link($page->ID) . '/' . $grandchild->post_name . '">' . $grandchild->post_title . '</a></h2></li>';
		}
	    }
	}
	echo '</div>';
    }
}

?>