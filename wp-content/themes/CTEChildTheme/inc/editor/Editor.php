<?php

require_once __DIR__ . '/Dashboard.php';
require_once __DIR__ . '/Module.php';
require_once __DIR__ . '/News.php';


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LSV_Editor {




    public static function render() {

        $user = wp_get_current_user();

        ob_start();
        ?>

        <div class="lsv-cms">

            <header class="lsv-cms-header">

                <div class="lsv-cms-title">
                    LSV CMS
                </div>

                <div class="lsv-cms-user">
                    <?php echo esc_html( $user->display_name ); ?>
                </div>

            </header>

            <div class="lsv-cms-main">

                <aside class="lsv-cms-sidebar">

                    <ul>

                        <?php

                        $current = $_GET['module'] ?? 'dashboard';

                        foreach ( LSV_Module::all() as $id => $module ) :

                            ?>

                            <li class="<?php echo $current === $id ? 'active' : ''; ?>">

                                <a href="?module=<?php echo esc_attr( $id ); ?>">

                                    <?php echo $module['icon']; ?>
                                    <?php echo esc_html( $module['title'] ); ?>

                                </a>

                            </li>

                        <?php endforeach; ?>

                    </ul>


                </aside>

                <section class="lsv-cms-content">

                    <?php

                    $current = $_GET['module'] ?? 'dashboard';

                    switch ( $current ) {

                        case 'news':

                            echo LSV_News::render();

                            break;


                        case 'events':

                            echo '<h2>Termine</h2>';
                            echo '<p>Hier entsteht das Termin-Modul.</p>';

                            break;

                        case 'images':

                            echo '<h2>Bilder</h2>';
                            echo '<p>Hier entsteht die Bildverwaltung.</p>';

                            break;

                        case 'members':

                            echo '<h2>Mitglieder</h2>';
                            echo '<p>Hier entsteht die Mitgliederverwaltung.</p>';

                            break;

                        case 'settings':

                            echo '<h2>Einstellungen</h2>';
                            echo '<p>Hier entstehen die CMS-Einstellungen.</p>';

                            break;

                        default:

                            echo LSV_Dashboard::render();

                            break;
                    }
                    ?>
                </section>

            </div>

            <footer class="lsv-cms-footer">

                Version 0.1

            </footer>

        </div>

        <?php

        return ob_get_clean();

    }

}