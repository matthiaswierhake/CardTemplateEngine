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
function club_dashboard_roles() {

    return array(
        'administrator',
        'editor',
    );
}

/**
 * Dashboard für nicht berechtigte Rollen sperren.
 */
add_action( 'admin_init', 'club_restrict_dashboard_access' );

function club_restrict_dashboard_access() {

    if ( wp_doing_ajax() ) {
        return;
    }

    foreach ( club_dashboard_roles() as $role ) {
        if ( current_user_can( $role ) ) {
            return;
        }
    }

    wp_safe_redirect( CLUB_MEMBER_URL );
    exit;
}