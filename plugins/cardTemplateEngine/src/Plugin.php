<?php

declare(strict_types=1);

namespace CTE;

final class Plugin
{
    public static function boot(): void
    {
        add_action('wp_enqueue_scripts', [self::class, 'registerAssets']);
        Shortcode::register();
    }

    public static function registerAssets(): void
    {
        wp_register_style(
            'cte-cards',
            CTE_URL . 'assets/css/cards.css',
            [],
            CTE_VERSION
        );
    }
}
