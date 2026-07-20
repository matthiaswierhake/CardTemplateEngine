<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card $card
 * @var \CTE\Includes\Tile $tile
 */

if (!$tile->hasAuthor()) {
    return;
}
?>

<p class="mw-cte-tile__author">

    <?= esc_html($tile->author()); ?>

</p>