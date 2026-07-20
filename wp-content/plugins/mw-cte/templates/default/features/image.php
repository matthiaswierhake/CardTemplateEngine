<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Tile $tile
 */

if (!$tile->hasThumbnail()) {
    return;
}

?>

<a
    class="mw-cte-tile__image"
    href="<?= esc_url($tile->permalink()); ?>">

    <img
        src="<?= esc_url($tile->thumbnail('medium_large')); ?>"
        alt="<?= esc_attr($tile->title()); ?>">

</a>

<figure class="mw-cte-tile__image--fallback">
    <img src="<?= esc_url($tile->thumbnail('medium_large')); ?>" alt="<?= esc_attr($tile->title()); ?>">
</figure>