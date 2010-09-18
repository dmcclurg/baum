<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] = get_settings( $value['id'] ); }
    }
?>
		<div id="footer">
				<p>&copy; Baum Cycles, Australia 2010<br />Ph +61 3 5277 1933  &bull; <a href="mailto:handcrafted@baumcycles.com?subject=Contact">handcrafted@baumcycles.com</a></p>
		</div>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>