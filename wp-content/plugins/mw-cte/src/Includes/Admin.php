<?php

declare(strict_types=1);

namespace CTE\Includes;

final class Admin
{
    public function init(): void
    {
        add_action('admin_menu', [$this, 'registerMenu']);
    }

    public function registerMenu(): void
    {
        add_menu_page(
            'MW Card Template Engine',
            'MW CTE',
            'manage_options',
            'mw-cte',
            [$this, 'dashboardPage'],
            'dashicons-screenoptions',
            60
        );

        add_submenu_page(
            'mw-cte',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'mw-cte',
            [$this, 'dashboardPage']
        );

        add_submenu_page(
            'mw-cte',
            'Cards',
            'Cards',
            'manage_options',
            'mw-cte-cards',
            [$this, 'cardsPage']
        );

        add_submenu_page(
            'mw-cte',
            'Templates',
            'Templates',
            'manage_options',
            'mw-cte-templates',
            [$this, 'templatesPage']
        );

        add_submenu_page(
            'mw-cte',
            'Tests',
            'Tests',
            'manage_options',
            'mw-cte-tests',
            [$this, 'testsPage']
        );

        add_submenu_page(
            'mw-cte',
            'Einstellungen',
            'Einstellungen',
            'manage_options',
            'mw-cte-settings',
            [$this, 'settingsPage']
        );
    }

    public function dashboardPage(): void
    {
        echo '<div class="wrap">';
        echo '<h1>MW Card Template Engine</h1>';
        echo '<p>Dashboard</p>';
        echo '</div>';
    }

    public function cardsPage(): void
    {
        echo '<div class="wrap">';
        echo '<h1>Cards</h1>';
        echo '<p>Card-Verwaltung folgt.</p>';
        echo '</div>';
    }

    public function templatesPage(): void
    {
        echo '<div class="wrap">';
        echo '<h1>Templates</h1>';
        echo '<p>Template-Verwaltung folgt.</p>';
        echo '</div>';
    }

    public function testsPage(): void
    {
        ?>
        <div class="wrap">

            <h1>MW Card Template Engine – Testcenter</h1>

            <p>
                Hier können einzelne Komponenten der Card Template Engine getestet werden.
            </p>

            <table class="widefat striped">

                <thead>
                <tr>
                    <th style="width:220px">Test</th>
                    <th>Beschreibung</th>
                    <th style="width:180px">Aktion</th>
                </tr>
                </thead>

                <tbody>

                <tr>
                    <td><strong>Card</strong></td>
                    <td>Prüft die Card-Klasse.</td>
                    <td>
                        <a class="button button-primary"
                           href="<?php echo esc_url(
                               admin_url('admin.php?page=mw-cte-tests&test=card')
                           ); ?>">
                            Test starten
                        </a>
                    </td>
                </tr>

                <tr>

                    <td><strong>Query</strong></td>

                    <td>
                        Testet verschiedene Datenquellen.
                    </td>

                    <td>

                        <a class="button"
                           href="<?php echo esc_url(admin_url('admin.php?page=mw-cte-tests&test=query&mode=post')); ?>">
                            Post
                        </a>

                        <a class="button"
                           href="<?php echo esc_url(admin_url('admin.php?page=mw-cte-tests&test=query&mode=category')); ?>">
                            Kategorie
                        </a>

                        <a class="button"
                           href="<?php echo esc_url(admin_url('admin.php?page=mw-cte-tests&test=query&mode=tag')); ?>">
                            Tag
                        </a>

                        <a class="button"
                           href="<?php echo esc_url(admin_url('admin.php?page=mw-cte-tests&test=query&mode=taxonomy')); ?>">
                            Taxonomie
                        </a>

                    </td>

                </tr>

                <tr>
                    <td><strong>Tile</strong></td>
                    <td>Prüft die Tile-Klasse.</td>
                    <td>
                        <a class="button button-primary"
                           href="<?php echo esc_url(admin_url('admin.php?page=mw-cte-tests&test=tile')); ?>">
                            Test starten
                        </a>
                    </td>
                </tr>

                </tbody>

            </table>

            <hr>

            <?php

            if (isset($_GET['test'])) {

                switch (sanitize_key($_GET['test'])) {

                    case 'card':
                        \CTE\Tests\CardTest::run();
                        break;
                    case 'query':
                        \CTE\Tests\QueryTest::run();
                        break;
                    case 'tile':
                        \CTE\Tests\TileTest::run();
                        break;
                }

            }

            ?>

        </div>
        <?php
    }
    public function settingsPage(): void
    {
        echo '<div class="wrap">';
        echo '<h1>Einstellungen</h1>';
        echo '<p>Plugin-Einstellungen folgen.</p>';
        echo '</div>';
    }
}