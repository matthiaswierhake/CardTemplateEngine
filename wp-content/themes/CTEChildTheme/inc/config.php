<?php
/**
 * Zentrale Konfiguration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LSV_LOGIN_SLUG', 'login' );
define( 'LSV_MEMBER_SLUG', 'mitgliederbereich' );
define( 'LSV_LOSTPASSWORD_SLUG', 'passwort-vergessen' );

define( 'LSV_LOGIN_URL', home_url( '/' . LSV_LOGIN_SLUG . '/' ) );
define( 'LSV_MEMBER_URL', home_url( '/' . LSV_MEMBER_SLUG . '/' ) );
define( 'LSV_LOSTPASSWORD_URL', home_url( '/' . LSV_LOSTPASSWORD_SLUG . '/' ) );
