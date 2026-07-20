<?php

require_once __DIR__ . '/Field.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CLUB_Form {

    public static function begin( $title ) {
        ob_start();
        ?>

        <form class="club-form" method="post">

        <?php wp_nonce_field( 'club_cms_save', 'club_cms_nonce' ); ?>

        <h3><?php echo esc_html( $title ); ?></h3>

        <?php
        return ob_get_clean();
    }

    public static function text( $name, $label, $value = '' ) {
        echo CLUB_Field::text( $name, $label, $value );
    }

    public static function textarea( $name, $label, $value = '' ) {
        echo CLUB_Field::textarea( $name, $label, $value );
    }

    public static function image( $name, $label, $value = 0 ) {
        echo CLUB_Field::image( $name, $label, $value );
    }

    public static function end( $button_text = 'Speichern' ) {
        ob_start();
        ?>

        <p class="club-form-actions">
            <button type="submit" class="button button-primary">
                <?php echo esc_html( $button_text ); ?>
            </button>
        </p>

        </form>

        <?php
        return ob_get_clean();
    }
}