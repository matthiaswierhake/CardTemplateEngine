<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card $card
 * @var \CTE\Includes\Tile $tile
 */

if (!$tile->hasContent()) {
    return;
}
?>

<div class="mw-cte-tile__content-text">

    <?= wp_kses_post($tile->content()); ?>

</div>