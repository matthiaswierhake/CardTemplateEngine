<?php
/**
 * MW Club Child Theme
 * Version 0.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Basis-Konfiguration
 */
require_once get_stylesheet_directory() . '/inc/config.php';

/**
 * Hilfsfunktionen
 */
require_once get_stylesheet_directory() . '/inc/helpers.php';

/**
 * Theme Setup
 */
require_once get_stylesheet_directory() . '/inc/setup.php';

/**
 * Sicherheit
 */
require_once get_stylesheet_directory() . '/inc/security.php';

/**
 * Rollen
 */
require_once get_stylesheet_directory() . '/inc/roles.php';

/**
 * Navigation
 */
require_once get_stylesheet_directory() . '/inc/navigation.php';

/**
 * Login
 */
require_once get_stylesheet_directory() . '/inc/login.php';

/**
 * Redaktion
 */
require_once get_stylesheet_directory() . '/inc/redaktion.php';

/**
 * Mitgliederbereich
 */
require_once get_stylesheet_directory() . '/inc/members.php';

/**
 * Shortcodes
 */
require_once get_stylesheet_directory() . '/inc/shortcodes.php';

/**
 * News
 */
require_once get_stylesheet_directory() . '/inc/news.php';

/**
 * Styles laden
 */
add_action( 'wp_enqueue_scripts', 'club_enqueue_styles', 20 );

function club_enqueue_styles() {

    wp_enqueue_style(
        'kadence-parent',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( get_template() )->get( 'Version' )
    );

    $css_files = array(
        'variables',
        'layout',
        'header',
        'navigation',
        'login',
        'redaktion',
        'startseite',
        'mitglieder',
        'footer',
        'responsive',
    );

    foreach ( $css_files as $file ) {

        $path = get_stylesheet_directory() . '/css/' . $file . '.css';

        if ( file_exists( $path ) ) {

            wp_enqueue_style(
                'club-' . $file,
                get_stylesheet_directory_uri() . '/css/' . $file . '.css',
                array( 'kadence-parent' ),
                filemtime( $path )
            );

        }
    }

    $editor_css = get_stylesheet_directory() . '/css/editor/editor.css';

    if ( file_exists( $editor_css ) ) {

        wp_enqueue_style(
            'club-editor',
            get_stylesheet_directory_uri() . '/css/editor/editor.css',
            array( 'kadence-parent' ),
            filemtime( $editor_css )
        );
    }
}

/**
 * JavaScript laden
 */
add_action( 'wp_enqueue_scripts', 'club_enqueue_scripts', 20 );

function club_enqueue_scripts() {

    $js_files = array(
        'global',
        'login',
        'navigation',
        'members',
    );

    foreach ( $js_files as $file ) {

        $path = get_stylesheet_directory() . '/js/' . $file . '.js';

        if ( file_exists( $path ) ) {

            wp_enqueue_script(
                'club-' . $file,
                get_stylesheet_directory_uri() . '/js/' . $file . '.js',
                array(),
                filemtime( $path ),
                true
            );

        }
    }

    $editor_js = get_stylesheet_directory() . '/js/editor/editor.js';

    if ( file_exists( $editor_js ) ) {

        wp_enqueue_media();

        wp_enqueue_script(
            'club-editor',
            get_stylesheet_directory_uri() . '/js/editor/editor.js',
            array(),
            filemtime( $editor_js ),
            true
        );
    }
}