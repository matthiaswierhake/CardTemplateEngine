<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class LSV_Editor {

    public static function render() {

        ob_start();
        ?>

        <div class="lsv-editor">

            <h2>LSV CMS</h2>

            <p>Editor erfolgreich geladen.</p>

            <p>Version 0.1</p>

        </div>

        <?php

        return ob_get_clean();

    }

}