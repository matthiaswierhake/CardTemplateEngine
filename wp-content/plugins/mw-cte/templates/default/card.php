<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card   $card
 * @var \CTE\Includes\Tile[] $tiles
 */

?>

<section
    class="mw-cte-card <?= esc_attr($card->cssClass()); ?>"
    <?= $card->id() !== '' ? 'id="' . esc_attr($card->id()) . '"' : ''; ?>
>

    <?php if ($card->title() !== '') : ?>

        <header class="mw-cte-card__header">

            <h2 class="mw-cte-card__title">
                <?= esc_html($card->title()); ?>
            </h2>

        </header>

    <?php endif; ?>


    <div class="mw-cte-card__grid columns-<?= (int) $card->columns(); ?>">

        <?php foreach ($tiles as $tile) : ?>

            <?php include __DIR__ . '/tile.php'; ?>

        <?php endforeach; ?>

    </div>

</section>