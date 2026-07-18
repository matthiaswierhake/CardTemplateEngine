<?php
/**
 * Redaktionsfunktionen
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode: [lsv_redaktion]
 */
function lsv_redaktion_shortcode() {

	if ( ! current_user_can( 'edit_posts' ) ) {
		return '';
	}

	ob_start();
	?>

	<div class="lsv-redaktion">

		<strong>🛠 Redaktion</strong>

		<div class="lsv-redaktion-buttons">

			<a class="lsv-admin-button" href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>">
				<span class="dashicons dashicons-plus-alt2"></span>
				Neuer Beitrag
			</a>

			<a class="lsv-admin-button" href="<?php echo esc_url( admin_url( 'edit.php?post_type=tribe_events' ) ); ?>">
				<span class="dashicons dashicons-calendar-alt"></span>
				Termine
			</a>

		</div>

	</div>

	<?php
	return ob_get_clean();
}

add_shortcode( 'lsv_redaktion', 'lsv_redaktion_shortcode' );
