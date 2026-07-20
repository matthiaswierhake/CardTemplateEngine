<?php
/**
 * Allgemeine Shortcodes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Aktuelles Jahr: [aktuelles_jahr]
 */
function club_current_year_shortcode() {

	return date_i18n( 'Y' );
}

add_shortcode( 'aktuelles_jahr', 'club_current_year_shortcode' );


require_once get_stylesheet_directory() . '/inc/editor/Editor.php';

function club_editor_shortcode() {

    return CLUB_Editor::render();

}

add_shortcode(
    'club_editor',
    'club_editor_shortcode'
);