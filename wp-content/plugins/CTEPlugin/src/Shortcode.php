<?php

declare(strict_types=1);

namespace CTE;

final class Shortcode
{
    public static function register(): void
    {
        add_shortcode('cte_cards', [self::class, 'handle']);
        add_shortcode('card', [self::class, 'handle']);
    }

    public static function handle(array|string $attributes = []): string
    {
        $attributes = shortcode_atts([
            'type' => 'news',
            'template' => 'default',
            'taxonomy' => '',
            'category' => '',
            'limit' => 6,
            'orderby' => 'date',
            'order' => 'DESC',
            'columns' => 'auto',
            'min_width' => 280,
        ], is_array($attributes) ? $attributes : [], 'cte_cards');

        if (! post_type_exists((string) $attributes['type'])) {
            return '<p class="cte-message">' . esc_html__('Der angegebene Inhaltstyp existiert nicht.', 'card-template-engine') . '</p>';
        }

        $query = (new QueryBuilder())->build($attributes);
        return (new Renderer())->render($query, $attributes);
    }
}
