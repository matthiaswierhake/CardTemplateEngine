<?php

declare(strict_types=1);

namespace CTE;

final class TemplateLoader
{
    public function locate(string $type, string $template): string
    {
        $type = sanitize_key($type);
        $template = sanitize_file_name($template ?: 'default');

        $relativeCandidates = [
            "card-template-engine/{$type}/{$template}.php",
            "card-template-engine/default/{$template}.php",
        ];

        foreach ($relativeCandidates as $relative) {
            $themePath = locate_template($relative, false, false);
            if (is_string($themePath) && $themePath !== '') {
                return $themePath;
            }
        }

        $pluginCandidates = [
            CTE_DIR . "templates/{$type}/{$template}.php",
            CTE_DIR . "templates/default/{$template}.php",
            CTE_DIR . 'templates/default/default.php',
        ];

        foreach ($pluginCandidates as $path) {
            if (is_readable($path)) {
                return $path;
            }
        }

        return '';
    }
}
