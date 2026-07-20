<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card $card
 * @var \CTE\Includes\Tile $tile
 */
?>

<h3 class="mw-cte-tile__title">

    <a href="<?= esc_url($tile->permalink()); ?>">

        <?= esc_html($tile->title()); ?>

    </a>

</h3>