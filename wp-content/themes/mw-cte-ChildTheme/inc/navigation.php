<?php
/**
 * Navigation und Logout
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Logout immer auf Startseite umleiten.
 */
add_filter( 'logout_redirect', 'lsv_logout_redirect', 10, 3 );

function lsv_logout_redirect( $redirect_to, $requested_redirect_to, $user ) {

	return home_url( '/' );
}

/**
 * Dynamisches Hauptmenü.
 *
 * Erwartete CSS-Klassen im WordPress-Menü:
 * - menu-login
 * - menu-member
 * - menu-logout
 */
add_filter( 'wp_nav_menu_objects', 'lsv_dynamic_menu_items', 20 );

function lsv_dynamic_menu_items( $items ) {

	$logged_in = is_user_logged_in();
	$user      = wp_get_current_user();

	foreach ( $items as $key => &$item ) {

		$classes = (array) $item->classes;

		if ( in_array( 'menu-login', $classes, true ) ) {

			if ( $logged_in ) {
				$item->title = '👤 ' . esc_html( $user->display_name );
				$item->url   = '#';
			} else {
				$item->title = '👤';
				$item->url   = LSV_LOGIN_URL;
			}
		}

		if ( in_array( 'menu-member', $classes, true ) ) {

			if ( ! $logged_in ) {
				unset( $items[ $key ] );
			} else {
				$item->url = LSV_MEMBER_URL;
			}
		}

		if ( in_array( 'menu-logout', $classes, true ) ) {

			if ( ! $logged_in ) {
				unset( $items[ $key ] );
			} else {
				$item->url = wp_logout_url( home_url( '/' ) );
			}
		}
	}

	return array_values( $items );
}
