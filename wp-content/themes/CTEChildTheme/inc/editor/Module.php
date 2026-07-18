<?php
/**
 * LSV CMS
 * Modulverwaltung
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LSV_Module {

    public static function all() {

        return array(

            'dashboard' => array(
                'title' => 'Dashboard',
                'icon'  => '🏠',
            ),

            'news' => array(
                'title' => 'Neuigkeiten',
                'icon'  => '📰',
            ),

            'events' => array(
                'title' => 'Termine',
                'icon'  => '📅',
            ),

            'images' => array(
                'title' => 'Bilder',
                'icon'  => '🖼️',
            ),

            'members' => array(
                'title' => 'Mitglieder',
                'icon'  => '👥',
            ),

            'settings' => array(
                'title' => 'Einstellungen',
                'icon'  => '⚙️',
            ),

        );

    }

}