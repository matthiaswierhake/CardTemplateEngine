<?php

declare(strict_types=1);

namespace CTE\Shortcodes;

use CTE\Includes\Card;
use CTE\Includes\Renderer;

final class Shortcode
{
    /**
     * Shortcodes registrieren.
     */
    public function init(): void
    {
        add_shortcode('mw_cte', [$this, 'render']);
    }

    /**
     * Ausgabe des Shortcodes.
     */
    public function render(array $atts = []): string
    {
        ob_start();

        $card = new Card(
            title: 'Beiträge',
            source: 'post_type',
            value: 'post',
            taxonomy: null,
            limit: 5,
            template: 'default'
        );

        (new Renderer($card))->render();

        return ob_get_clean();
    }
}