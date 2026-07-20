<?php

declare(strict_types=1);

namespace CTE\Includes;

use WP_Post;

final class Tile
{
    private WP_Post $post;

    public function __construct(WP_Post $post)
    {
        $this->post = $post;
    }

    /**
     * Den kompletten WP_Post zurückgeben.
     */
    public function post(): WP_Post
    {
        return $this->post;
    }

    /**
     * Beitrags-ID.
     */
    public function id(): int
    {
        return (int) $this->post->ID;
    }

    /**
     * Beitragstitel.
     */
    public function title(): string
    {
        return get_the_title($this->post);
    }

    /**
     * Permalink.
     */
    public function permalink(): string
    {
        return get_permalink($this->post);
    }

    /**
     * Beitragstyp.
     */
    public function postType(): string
    {
        return get_post_type($this->post);
    }

    /**
     * Veröffentlichungsdatum.
     */
    public function date(string $format = ''): string
    {
        if ($format === '') {
            $format = get_option('date_format');
        }

        return get_the_date($format, $this->post);
    }

    /**
     * Auszug.
     */
    public function excerpt(): string
    {
        return get_the_excerpt($this->post);
    }

    /**
     * Vollständiger Inhalt.
     */
    public function content(): string
    {
        return apply_filters('the_content', $this->post->post_content);
    }

    /**
     * Hat der Beitrag einen Auszug?
     */
    public function hasExcerpt(): bool
    {
        return has_excerpt($this->post);
    }

    /**
     * Hat der Beitrag ein Beitragsbild?
     */
    public function hasThumbnail(): bool
    {
        return has_post_thumbnail($this->post);
    }

    /**
     * URL des Beitragsbildes.
     */
    public function thumbnail(string $size = 'large'): string
    {
        return (string) get_the_post_thumbnail_url($this->post, $size);
    }

    /**
     * Beitragsbild-ID.
     */
    public function thumbnailId(): int
    {
        return (int) get_post_thumbnail_id($this->post);
    }

    /**
     * ACF-Feld lesen.
     */
    public function field(string $name): mixed
    {
        if (!function_exists('get_field')) {
            return null;
        }

        return get_field($name, $this->post->ID);
    }

    /**
     * Existiert ein ACF-Feld?
     */
    public function hasField(string $name): bool
    {
        return $this->field($name) !== null;
    }

    /**
     * Kategorien.
     */
    public function categories(): array
    {
        return get_the_category($this->post->ID);
    }

    /**
     * Begriffe einer beliebigen Taxonomie.
     */
    public function terms(string $taxonomy): array
    {
        $terms = get_the_terms($this->post->ID, $taxonomy);

        return is_array($terms) ? $terms : [];
    }

    /**
     * Benutzerdefinierte Taxonomie als Text.
     */
    public function termList(
        string $taxonomy,
        string $separator = ', '
    ): string {

        $terms = $this->terms($taxonomy);

        if (empty($terms)) {
            return '';
        }

        return implode(
            $separator,
            wp_list_pluck($terms, 'name')
        );
    }

    /**
     * Alle ACF-Felder.
     */
    public function fields(): array
    {
        if (!function_exists('get_fields')) {
            return [];
        }

        return get_fields($this->post->ID) ?: [];
    }
}