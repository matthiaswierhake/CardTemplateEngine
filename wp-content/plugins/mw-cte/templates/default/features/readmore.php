<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Tile $tile
 */

?>

<p class="mw-cte-tile__more">

    <a href="<?= esc_url($tile->permalink()); ?>">

        Weiterlesen →

    </a>

</p>

<figure class="mw-cte-tile__image--fallback">
    <img src="<?= esc_url($tile->thumbnail('medium_large')); ?>" alt="<?= esc_attr($tile->title()); ?>">
</figure>