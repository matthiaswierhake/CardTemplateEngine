<?php

declare(strict_types=1);

namespace CTE;

final class ConfigLoader
{
    public function load(string $type): array
    {
        $type = sanitize_key($type);
        $paths = [
            trailingslashit(get_stylesheet_directory()) . 'card-template-engine/config/' . $type . '.php',
            trailingslashit(get_template_directory()) . 'card-template-engine/config/' . $type . '.php',
            CTE_DIR . 'config/' . $type . '.php',
            CTE_DIR . 'config/default.php',
        ];

        foreach ($paths as $path) {
            if (! is_readable($path)) {
                continue;
            }
            $config = include $path;
            if (is_array($config)) {
                return apply_filters('cte_card_config', $config, $type, $path);
            }
        }

        return [];
    }
}
