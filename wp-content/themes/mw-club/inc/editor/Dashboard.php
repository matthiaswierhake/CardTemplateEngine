<?php
/**
 * Dashboard-Modul
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CLUB_Dashboard {

    public static function render() {

        ob_start();
        ?>

        <h2>Dashboard</h2>

        <p>Willkommen im CLUB CMS.</p>

        <div class="club-card">

            <h3>Projektstatus</h3>

            <ul>
                <li>✅ Editor läuft</li>
                <li>✅ Navigation läuft</li>
                <li>✅ Router läuft</li>
                <li>🚧 News-Modul folgt</li>
            </ul>

        </div>

        <?php

        return ob_get_clean();

    }

}