<?php
/**
 * Rollenverwaltung
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rollen mit Dashboard-Zugriff.
 */
function lsv_dashboard_roles() {

	return array(
		'administrator',
		'editor',
	);
}

/**
 * Rollen mit sichtbarer Admin-Bar.
 */
function lsv_adminbar_roles() {

	return array(
		'administrator',
		'editor',
	);
}

/**
 * Dashboard für nicht berechtigte Rollen sperren.
 */
add_action( 'admin_init', 'lsv_restrict_dashboard_access' );

function lsv_restrict_dashboard_access() {

	if ( wp_doing_ajax() ) {
		return;
	}

	foreach ( lsv_dashboard_roles() as $role ) {
		if ( current_user_can( $role ) ) {
			return;
		}
	}

	wp_safe_redirect( LSV_MEMBER_URL );
	exit;
}

/**
 * Admin-Bar rollenabhängig anzeigen.
 */
add_filter( 'show_admin_bar', 'lsv_show_admin_bar' );

function lsv_show_admin_bar( $show ) {

	foreach ( lsv_adminbar_roles() as $role ) {
		if ( current_user_can( $role ) ) {
			return true;
		}
	}

	return false;
}
