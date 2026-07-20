<?php

declare(strict_types=1);

namespace CTE\Tests;

use CTE\Includes\Card;
use CTE\Includes\Query;

final class QueryTest
{
    public static function run(): void
    {
        $mode = isset($_GET['mode'])
            ? sanitize_key($_GET['mode'])
            : 'post';

        switch ($mode) {

            case 'category':

                $card = new Card(
                    title: 'Kategorie',
                    source: 'category',
                    value: 'news'
                );

                break;

            case 'tag':

                $card = new Card(
                    title: 'Tag',
                    source: 'tag',
                    value: 'featured'
                );

                break;

            case 'taxonomy':

                $card = new Card(
                    title: 'Taxonomie',
                    source: 'taxonomy',
                    value: 'verein',
                    taxonomy: 'news_category'
                );

                break;

            case 'post':
            default:

                $card = new Card(
                    title: 'Beiträge',
                    source: 'post_type',
                    value: 'post'
                );

        }

        $query = new Query($card);

        self::showArgs($query->getArgs());

        self::showPosts($query->get());
    }

    private static function showArgs(array $args): void
    {
        echo '<h2>WP_Query Argumente</h2>';

        echo '<pre>';
        print_r($args);
        echo '</pre>';
    }

    private static function showPosts(\WP_Query $query): void
    {
        echo '<h2>Ergebnis</h2>';

        echo '<p><strong>Gefundene Beiträge:</strong> '
            . esc_html((string) $query->found_posts)
            . '</p>';

        if (!$query->have_posts()) {
            echo '<div class="notice notice-warning"><p>Keine Beiträge gefunden.</p></div>';
            return;
        }

        echo '<table class="widefat striped">';

        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Titel</th>';
        echo '<th>Typ</th>';
        echo '<th>Status</th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';

        while ($query->have_posts()) {

            $query->the_post();

            echo '<tr>';

            echo '<td>' . get_the_ID() . '</td>';

            echo '<td>' . esc_html(get_the_title()) . '</td>';

            echo '<td>' . esc_html(get_post_type()) . '</td>';

            echo '<td>' . esc_html(get_post_status()) . '</td>';

            echo '</tr>';
        }

        echo '</tbody>';

        echo '</table>';

        wp_reset_postdata();
    }
}