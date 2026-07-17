<?php

declare(strict_types=1);

namespace CTE;

use WP_Post;

final class Card
{
    private WP_Post $post;
    private array $mapping;
    private FieldResolver $resolver;
    private array $cache = [];

    public function __construct(WP_Post $post, array $mapping, ?FieldResolver $resolver = null)
    {
        $this->post = $post;
        $this->mapping = $mapping;
        $this->resolver = $resolver ?? new FieldResolver();
    }

    public function post(): WP_Post
    {
        return $this->post;
    }

    public function id(): int
    {
        return (int) $this->post->ID;
    }

    public function has(string $slot): bool
    {
        $value = $this->raw($slot);
        return ! ($value === null || $value === '' || $value === []);
    }

    public function raw(string $slot, mixed $default = null): mixed
    {
        if (array_key_exists($slot, $this->cache)) {
            return $this->cache[$slot];
        }

        if (! isset($this->mapping[$slot]) || ! is_array($this->mapping[$slot])) {
            return $default;
        }

        $value = $this->resolver->resolve($this->post, $this->mapping[$slot]);
        $this->cache[$slot] = $value;

        return ($value === null || $value === '') ? $default : $value;
    }

    public function text(string $slot, string $default = ''): string
    {
        $value = $this->raw($slot, $default);
        if (is_scalar($value)) {
            return (string) $value;
        }
        return $default;
    }

    public function html(string $slot): string
    {
        $value = $this->text($slot);
        if ($value === '') {
            return '';
        }

        $definition = $this->mapping[$slot] ?? [];
        $format = (string) ($definition['format'] ?? 'wysiwyg');

        if ($format === 'plain') {
            return esc_html($value);
        }

        if ($format === 'paragraph') {
            return wpautop(wp_kses_post($value));
        }

        return (string) apply_filters('the_content', $value);
    }

    public function url(string $slot = 'url'): string
    {
        return esc_url((string) $this->raw($slot, ''));
    }

    public function image(string $slot = 'image', string $size = 'large', array $attributes = []): string
    {
        $value = $this->raw($slot);
        if (empty($value)) {
            return '';
        }

        $attachmentId = 0;
        $url = '';
        $alt = $this->text('title');

        if (is_numeric($value)) {
            $attachmentId = (int) $value;
        } elseif (is_array($value)) {
            $attachmentId = (int) ($value['ID'] ?? $value['id'] ?? 0);
            $url = (string) ($value['url'] ?? '');
            $alt = (string) ($value['alt'] ?? $alt);
        } elseif (is_string($value)) {
            $url = $value;
        }

        $attributes = array_merge([
            'class' => 'cte-card__image',
            'loading' => 'lazy',
            'alt' => $alt,
        ], $attributes);

        if ($attachmentId > 0) {
            return (string) wp_get_attachment_image($attachmentId, $size, false, $attributes);
        }

        if ($url !== '') {
            $parts = [];
            foreach ($attributes as $key => $attributeValue) {
                $parts[] = sprintf('%s="%s"', esc_attr((string) $key), esc_attr((string) $attributeValue));
            }
            return sprintf('<img src="%s" %s>', esc_url($url), implode(' ', $parts));
        }

        return '';
    }

    public function excerpt(string $primary = 'teaser', string $fallback = 'content', int $words = 28): string
    {
        $value = $this->text($primary);
        if ($value === '') {
            $value = $this->text($fallback);
        }
        if ($value === '') {
            $value = get_the_excerpt($this->post);
        }

        return esc_html(wp_trim_words(wp_strip_all_tags($value), $words));
    }
}
