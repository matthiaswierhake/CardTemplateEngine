<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CLUB_Field {

    public static function text( $name, $label, $value = '' ) {
        ob_start();
        ?>
        <div class="club-field">
            <label for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>

            <input
                    type="text"
                    id="<?php echo esc_attr( $name ); ?>"
                    name="<?php echo esc_attr( $name ); ?>"
                    value="<?php echo esc_attr( $value ); ?>"
                    class="club-input"
            >
        </div>
        <?php
        return ob_get_clean();
    }

    public static function textarea( $name, $label, $value = '' ) {
        ob_start();
        ?>
        <div class="club-field">
            <label for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>

            <textarea
                    id="<?php echo esc_attr( $name ); ?>"
                    name="<?php echo esc_attr( $name ); ?>"
                    class="club-textarea"
                    rows="5"><?php echo esc_textarea( $value ); ?></textarea>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function image( $name, $label, $value = 0 ) {

        $image_url = $value ? wp_get_attachment_image_url( $value, 'medium' ) : '';

        ob_start();
        ?>

        <div class="club-field club-image-field">

            <label><?php echo esc_html( $label ); ?></label>

            <div class="club-image-preview">
                <?php if ( $image_url ) : ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="">
                <?php else : ?>
                    <span>Kein Bild ausgewählt</span>
                <?php endif; ?>
            </div>

            <input
                    type="hidden"
                    name="<?php echo esc_attr( $name ); ?>"
                    value="<?php echo esc_attr( $value ); ?>"
                    class="club-image-id"
            >

            <button type="button" class="button club-image-select">
                Bild auswählen
            </button>

            <button type="button" class="button club-image-remove">
                Bild entfernen
            </button>

        </div>

        <?php
        return ob_get_clean();
    }
}