<?php
/**
 * Sicherheit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Mitgliederbereich schützen.
 */
add_action( 'template_redirect', 'lsv_protect_members_area' );

function lsv_protect_members_area() {

	if ( is_page( LSV_MEMBER_SLUG ) && ! is_user_logged_in() ) {
		wp_safe_redirect( LSV_LOGIN_URL );
		exit;
	}
}
