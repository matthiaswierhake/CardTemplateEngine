<?php

declare(strict_types=1);

namespace CTE;

use CTE\Includes\Admin;
use CTE\Shortcodes\Shortcode;

final class Plugin
{
    /**
     * Plugin starten
     */
    public static function boot(): void
    {
        self::registerAdmin();
        self::registerShortcodes();
        // Weitere Initialisierungen
        // self::registerShortcodes();
        // self::registerAssets();
        // self::registerAjax();
        // self::registerRestApi();
    }

    /**
     * Admin-Menü registrieren
     */
    private static function registerAdmin(): void
    {
        (new Admin())->init();
    }
    private static function registerShortcodes(): void
    {
        (new Shortcode())->init();
    }
}