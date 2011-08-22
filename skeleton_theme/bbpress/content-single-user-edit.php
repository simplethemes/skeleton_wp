<?php

/**
 * Single User Edit Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_notices' );

	// Profile details
	bbp_get_template_part( 'bbpress/user', 'details' );

	// User edit form
	bbp_get_template_part( 'bbpress/form', 'user-edit' );

?>