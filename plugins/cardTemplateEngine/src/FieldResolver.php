<?php

declare(strict_types=1);

namespace CTE;

use WP_Post;

final class FieldResolver
{
    public function resolve(WP_Post $post, array $definition): mixed
    {
        $source = (string) ($definition['source'] ?? 'acf');
        $field  = (string) ($definition['field'] ?? '');
        $value  = null;

        switch ($source) {
            case 'post_title':
                $value = get_the_title($post);
                break;

            case 'post_content':
                $value = $post->post_content;
                break;

            case 'post_excerpt':
                $value = $post->post_excerpt;
                break;

            case 'post_date':
                $value = get_the_date($definition['format'] ?? '', $post);
                break;

            case 'featured_image':
                $value = get_post_thumbnail_id($post);
                break;

            case 'permalink':
                $value = get_permalink($post);
                break;

            case 'edit_link':
                $value = get_edit_post_link($post->ID, 'raw');
                break;

            case 'meta':
                $value = $field !== '' ? get_post_meta($post->ID, $field, true) : null;
                break;

            case 'acf':
            default:
                if ($field !== '' && function_exists('get_field')) {
                    $value = get_field($field, $post->ID);
                } elseif ($field !== '') {
                    $value = get_post_meta($post->ID, $field, true);
                }
                break;
        }

        if (($value === null || $value === '' || $value === []) && array_key_exists('fallback', $definition)) {
            $fallback = $definition['fallback'];
            if (is_array($fallback)) {
                $value = $this->resolve($post, $fallback);
            } else {
                $value = $fallback;
            }
        }

        return apply_filters('cte_resolved_field', $value, $definition, $post);
    }
}
