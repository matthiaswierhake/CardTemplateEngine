<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LSV_Toolbar {

    public static function render( $title, $new_link ) {

        ob_start();
        ?>

        <div class="lsv-toolbar">

            <h2><?php echo esc_html( $title ); ?></h2>

            <a class="button button-primary"
               href="<?php echo esc_url( $new_link ); ?>">

                ➕ Neu

            </a>

        </div>

        <?php

        return ob_get_clean();

    }

}