<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card $card
 * @var \CTE\Includes\Tile $tile
 */

if (!$tile->hasCategories()) {
    return;
}
?>

<div class="mw-cte-tile__categories">

    <?= wp_kses_post($tile->categories()); ?>

</div>