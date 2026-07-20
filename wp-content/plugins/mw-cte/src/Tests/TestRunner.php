<?php

declare(strict_types=1);

namespace CTE\Tests;

final class TestRunner
{
    public static function run(): void
    {
        if (!isset($_GET['cte-test'])) {
            return;
        }

        if (!current_user_can('manage_options')) {
            wp_die('Keine Berechtigung.');
        }

        echo '<div class="wrap">';
        echo '<h1>MW Card Template Engine - Tests</h1>';

        switch (sanitize_key($_GET['cte-test'])) {

            case 'card':
                CardTest::run();
                break;

            case 'query':
                QueryTest::run();
                break;

            case 'tile':
                TileTest::run();
                break;

            default:
                echo '<p>Unbekannter Test.</p>';
        }

        echo '</div>';

        exit;
    }
}