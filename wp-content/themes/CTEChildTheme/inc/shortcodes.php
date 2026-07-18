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
function lsv_current_year_shortcode() {

	return date_i18n( 'Y' );
}

add_shortcode( 'aktuelles_jahr', 'lsv_current_year_shortcode' );


require_once get_stylesheet_directory() . '/inc/editor/Editor.php';

function lsv_editor_shortcode() {

    return LSV_Editor::render();

}

add_shortcode(
    'lsv_editor',
    'lsv_editor_shortcode'
);