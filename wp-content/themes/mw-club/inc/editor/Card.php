<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CLUB_Card {

    public static function begin( $title ) {

        ob_start();
        ?>

        <div class="club-card">

        <h3><?php echo esc_html( $title ); ?></h3>

        <?php

        return ob_get_clean();
    }

    public static function end() {

        return '</div>';

    }

}