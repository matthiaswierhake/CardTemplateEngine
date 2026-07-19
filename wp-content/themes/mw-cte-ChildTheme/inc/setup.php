<?php
/**
 * Theme Setup
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'lsv_theme_setup' );

function lsv_theme_setup() {

	/**
	 * Hier können später eigene Image Sizes,
	 * Übersetzungen oder Theme Supports ergänzt werden.
	 */
}


function lsv_include_dashicons_font(){
//Lade Dashicons font
    wp_enqueue_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'lsv_include_dashicons_font', 100 );

