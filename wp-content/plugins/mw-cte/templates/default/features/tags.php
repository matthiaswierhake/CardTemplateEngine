<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card $card
 * @var \CTE\Includes\Tile $tile
 */

if (!$tile->hasTags()) {
    return;
}
?>

<div class="mw-cte-tile__tags">

    <?= wp_kses_post($tile->tags()); ?>

</div>