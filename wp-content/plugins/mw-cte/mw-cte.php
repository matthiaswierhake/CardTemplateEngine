<?php

declare(strict_types=1);

/**
 * Plugin Name: MW - Card Template Engine
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CTE_VERSION', '0.4.0');
define('CTE_FILE', __FILE__);
define('CTE_DIR', plugin_dir_path(__FILE__));
define('CTE_URL', plugin_dir_url(__FILE__));

require_once CTE_DIR . 'src/Autoloader.php';

add_action(
    'plugins_loaded',
    static function (): void {

        CTE\Plugin::boot();

    }
);