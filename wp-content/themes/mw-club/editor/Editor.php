<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CLUB_Editor {

    public static function render() {

        ob_start();
        ?>

        <div class="club-editor">

            <h2>CLUB CMS</h2>

            <p>Editor erfolgreich geladen.</p>

            <p>Version 0.1</p>

        </div>

        <?php

        return ob_get_clean();

    }

}