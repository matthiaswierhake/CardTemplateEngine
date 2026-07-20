<?php
/**
 * Redaktionsfunktionen
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode: [club_redaktion]
 */
function club_redaktion_shortcode() {

	if ( ! current_user_can( 'edit_posts' ) ) {
		return '';
	}

	ob_start();
	?>

	<div class="club-redaktion">

		<strong>🛠 Redaktion</strong>

		<div class="club-redaktion-buttons">

			<a class="club-admin-button" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
				<span class="dashicons dashicons-plus-alt2"></span>
				Neuer Beitrag
			</a>

			<a class="club-admin-button" href="<?php echo esc_url( admin_url( 'edit.php?post_type=tribe_events' ) ); ?>">
				<span class="dashicons dashicons-calendar-alt"></span>
				Termine
			</a>

		</div>

	</div>

	<?php
	return ob_get_clean();
}

add_shortcode( 'club_redaktion', 'club_redaktion_shortcode' );
