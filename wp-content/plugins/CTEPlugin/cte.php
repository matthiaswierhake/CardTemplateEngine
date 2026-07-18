<?php
/**
 * Plugin Name: Card Template Engine
 * Description: Rendert beliebige WordPress-Inhaltstypen und ACF-Felder als konfigurierbare Karten per Shortcode.
 * Version: 0.3.0
 * Author: Matthias W. / OpenAI
 * Requires at least: 6.4
 * Requires PHP: 8.0
 * Text Domain: card-template-engine
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

define('CTE_VERSION', '0.3.0');
define('CTE_FILE', __FILE__);
define('CTE_DIR', plugin_dir_path(__FILE__));
define('CTE_URL', plugin_dir_url(__FILE__));

require_once CTE_DIR . 'src/Plugin.php';
require_once CTE_DIR . 'src/FieldResolver.php';
require_once CTE_DIR . 'src/Card.php';
require_once CTE_DIR . 'src/ConfigLoader.php';
require_once CTE_DIR . 'src/TemplateLoader.php';
require_once CTE_DIR . 'src/QueryBuilder.php';
require_once CTE_DIR . 'src/Renderer.php';
require_once CTE_DIR . 'src/Shortcode.php';

add_action('plugins_loaded', static function (): void {
    CTE\Plugin::boot();
});
