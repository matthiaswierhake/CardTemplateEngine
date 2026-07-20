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
add_action( 'template_redirect', 'club_protect_members_area' );

function club_protect_members_area() {

    if ( is_page( CLUB_MEMBER_SLUG ) && ! is_user_logged_in() ) {
        wp_safe_redirect( CLUB_LOGIN_URL );
        exit;
    }
}

/**
 * Admin-Bar nur für Administratoren.
 */
add_filter( 'show_admin_bar', 'club_show_admin_bar' );

function club_show_admin_bar( $show ) {

    return current_user_can( 'administrator' );
}