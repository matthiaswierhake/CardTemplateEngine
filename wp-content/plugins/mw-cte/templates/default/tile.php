<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card $card
 * @var \CTE\Includes\Tile $tile
 */

?>

<article class="mw-cte-tile">

    <?php if ($card->showImage() && $tile->hasThumbnail()) : ?>

        <a
            class="mw-cte-tile__image"
            href="<?= esc_url($tile->permalink()); ?>"
        >

            <img
                src="<?= esc_url($tile->thumbnail('medium_large')); ?>"
                alt="<?= esc_attr($tile->title()); ?>">

        </a>

    <?php endif; ?>


    <div class="mw-cte-tile__content">

        <h3 class="mw-cte-tile__title">

            <a href="<?= esc_url($tile->permalink()); ?>">

                <?= esc_html($tile->title()); ?>

            </a>

        </h3>


        <?php if ($card->showDate()) : ?>

            <div class="mw-cte-tile__date">

                <?= esc_html($tile->date()); ?>

            </div>

        <?php endif; ?>


        <?php if ($card->showExcerpt() && $tile->hasExcerpt()) : ?>

            <div class="mw-cte-tile__excerpt">

                <?= wp_kses_post($tile->excerpt()); ?>

            </div>

        <?php endif; ?>


        <?php if ($card->showReadMore()) : ?>

            <p class="mw-cte-tile__more">

                <a href="<?= esc_url($tile->permalink()); ?>">

                    Weiterlesen →

                </a>

            </p>

        <?php endif; ?>

    </div>

</article>