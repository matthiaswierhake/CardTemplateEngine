<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Tile $tile
 */

if (!$tile->hasExcerpt()) {
    return;
}

?>

<div class="mw-cte-tile__excerpt">

    <?= wp_kses_post($tile->excerpt()); ?>

</div>
