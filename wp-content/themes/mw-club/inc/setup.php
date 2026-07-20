<?php
/**
 * Theme Setup
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'club_theme_setup' );

function club_theme_setup() {

	/**
	 * Hier können später eigene Image Sizes,
	 * Übersetzungen oder Theme Supports ergänzt werden.
	 */
}


function club_include_dashicons_font(){
//Lade Dashicons font
    wp_enqueue_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'club_include_dashicons_font', 100 );

