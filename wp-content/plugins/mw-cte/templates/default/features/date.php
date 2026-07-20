<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Tile $tile
 */

?>

<div class="mw-cte-tile__date">

    <?= esc_html($tile->date()); ?>

</div>

<figure class="mw-cte-tile__image--fallback">
    <img src="<?= esc_url($tile->thumbnail('medium_large')); ?>" alt="<?= esc_attr($tile->title()); ?>">
</figure>