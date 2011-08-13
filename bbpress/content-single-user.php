<?php

/**
 * Single User Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_notices' );

	// Profile details
	bbp_get_template_part( 'bbpress/user', 'details'        );

	// Subscriptions
	bbp_get_template_part( 'bbpress/user', 'subscriptions'  );

	// Favorite topics
	bbp_get_template_part( 'bbpress/user', 'favorites'      );

	// Topics created
	bbp_get_template_part( 'bbpress/user', 'topics-created' );

?>
