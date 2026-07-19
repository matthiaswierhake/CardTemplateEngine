<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LSV_Card {

    public static function begin( $title ) {

        ob_start();
        ?>

        <div class="lsv-card">

        <h3><?php echo esc_html( $title ); ?></h3>

        <?php

        return ob_get_clean();
    }

    public static function end() {

        return '</div>';

    }

}