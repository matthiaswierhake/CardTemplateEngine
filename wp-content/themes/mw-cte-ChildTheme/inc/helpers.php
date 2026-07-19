<?php
/**
 * Allgemeine Hilfsfunktionen
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prüft, ob der aktuelle Benutzer eine der genannten Rollen hat.
 */
function lsv_user_has_role( array $roles ) {

	$user = wp_get_current_user();

	if ( ! $user || empty( $user->roles ) ) {
		return false;
	}

	return (bool) array_intersect( $roles, (array) $user->roles );
}

/**
 * Gibt den Anzeigenamen des aktuellen Benutzers zurück.
 */
function lsv_current_user_display_name() {

	$user = wp_get_current_user();

	if ( ! $user || ! $user->exists() ) {
		return '';
	}

	return $user->display_name;
}
