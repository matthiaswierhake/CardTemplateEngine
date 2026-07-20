<?php

declare(strict_types=1);

namespace _old;

use WP_Query;
use function CTE\apply_filters;
use function CTE\sanitize_key;
use function CTE\sanitize_title;

final class QueryBuilder
{
    public function build(array $attributes): WP_Query
    {
        $args = [
            'post_type' => sanitize_key((string) $attributes['type']),
            'post_status' => 'publish',
            'posts_per_page' => max(-1, (int) $attributes['limit']),
            'orderby' => sanitize_key((string) $attributes['orderby']),
            'order' => strtoupper((string) $attributes['order']) === 'ASC' ? 'ASC' : 'DESC',
            'no_found_rows' => true,
            'ignore_sticky_posts' => true,
        ];

        $taxonomy = sanitize_key((string) $attributes['taxonomy']);
        $category = sanitize_title((string) $attributes['category']);
        if ($taxonomy !== '' && $category !== '') {
            $args['tax_query'] = [[
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $category,
            ]];
        }

        return new WP_Query(apply_filters('cte_query_args', $args, $attributes));
    }
}
