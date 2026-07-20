<?php

declare(strict_types=1);

namespace CTE\Tests;

use CTE\Includes\Tile;
use WP_Query;

final class TileTest
{
    public static function run(): void
    {
        $query = new WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
        ]);

        if (!$query->have_posts()) {

            echo '<div class="notice notice-warning"><p>Keine Beiträge gefunden.</p></div>';

            return;
        }

        $post = $query->posts[0];

        $tile = new Tile($post);

        ?>

        <h2>Tile-Test</h2>

        <table class="widefat striped">

            <tbody>

            <?php self::row('ID', (string) $tile->id()); ?>

            <?php self::row('Titel', $tile->title()); ?>

            <?php self::row('Post Type', $tile->postType()); ?>

            <?php self::row('Permalink', $tile->permalink()); ?>

            <?php self::row('Datum', $tile->date()); ?>

            <?php self::row('Hat Auszug', $tile->hasExcerpt() ? 'Ja' : 'Nein'); ?>

            <?php self::row('Hat Beitragsbild', $tile->hasThumbnail() ? 'Ja' : 'Nein'); ?>

            <?php self::row('ACF-Felder', (string) count($tile->fields())); ?>

            </tbody>

        </table>

        <?php

        if ($tile->hasThumbnail()) {

            echo '<h3>Beitragsbild</h3>';

            echo '<img src="' .
                esc_url($tile->thumbnail('medium')) .
                '" style="max-width:300px;height:auto;">';

        }

        $fields = $tile->fields();

        if (!empty($fields)) {

            echo '<h3>ACF-Felder</h3>';

            echo '<table class="widefat striped">';

            foreach ($fields as $key => $value) {

                if (is_array($value)) {
                    $value = wp_json_encode($value);
                }

                self::row($key, (string) $value);
            }

            echo '</table>';
        }

        wp_reset_postdata();
    }

    private static function row(string $label, string $value): void
    {
        echo '<tr>';
        echo '<th style="width:220px">' . esc_html($label) . '</th>';
        echo '<td>' . esc_html($value) . '</td>';
        echo '</tr>';
    }
}