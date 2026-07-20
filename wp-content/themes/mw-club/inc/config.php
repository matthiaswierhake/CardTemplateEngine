<?php
/**
 * Zentrale Konfiguration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CLUB_LOGIN_SLUG', 'login' );
define( 'CLUB_MEMBER_SLUG', 'mitgliederbereich' );
define( 'CLUB_LOSTPASSWORD_SLUG', 'passwort-vergessen' );

define( 'CLUB_LOGIN_URL', home_url( '/' . CLUB_LOGIN_SLUG . '/' ) );
define( 'CLUB_MEMBER_URL', home_url( '/' . CLUB_MEMBER_SLUG . '/' ) );
define( 'CLU    B_LOSTPASSWORD_URL', home_url( '/' . CLUB_LOSTPASSWORD_SLUG . '/' ) );