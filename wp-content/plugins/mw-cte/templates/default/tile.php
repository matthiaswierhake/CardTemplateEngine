<?php

declare(strict_types=1);

/**
 * @var \CTE\Includes\Card $card
 * @var \CTE\Includes\Tile $tile
 */

$featurePath = CTE_DIR
        . 'templates/'
        . $card->template()
        . '/features/';

?>

<article class="mw-cte-tile">

    <?php if ($tile->hasActions()) : ?>

        <div class="mw-cte-tile__actions">

            <?php if ($tile->canEdit()) : ?>

                <a
                        class="mw-cte-tile__action mw-cte-tile__action--edit"
                        href="<?= esc_url($tile->editUrl()); ?>"
                        title="Bearbeiten"
                        aria-label="Beitrag bearbeiten"
                >

                    <span class="dashicons dashicons-edit"></span>

                </a>

            <?php endif; ?>

            <?php if ($tile->canDelete()) : ?>

                <a
                        class="mw-cte-tile__action mw-cte-tile__action--delete"
                        href="<?= esc_url($tile->deleteUrl()); ?>"
                        onclick="return confirm('Beitrag wirklich löschen?');"
                        title="Löschen"
                        aria-label="Beitrag löschen"
                >

                    <span class="dashicons dashicons-trash"></span>

                </a>

            <?php endif; ?>

        </div>

    <?php endif; ?>

    <?php foreach ($card->featureObjects() as $feature) : ?>

        <?php
        if ($feature->position() !== 'before_content') {
            continue;
        }

        $template = $featurePath
                . $feature->template()
                . '.php';

        if (file_exists($template)) {
            include $template;
        }
        ?>

    <?php endforeach; ?>

    <div class="mw-cte-tile__content">

        <?php foreach ($card->featureObjects() as $feature) : ?>

            <?php
            if ($feature->position() !== 'content') {
                continue;
            }

            $template = $featurePath
                    . $feature->template()
                    . '.php';

            if (file_exists($template)) {
                include $template;
            }
            ?>

        <?php endforeach; ?>

    </div>

</article>