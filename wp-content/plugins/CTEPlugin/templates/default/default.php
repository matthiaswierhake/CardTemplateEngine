<?php
/** @var \CTE\Card $card */
/** @var array $atts */
if (! defined('ABSPATH')) {
    exit;
}

$image = $card->image('image', 'large');
$url = $card->url('url');
$title = $card->text('title');
?>
<article class="cte-card">
    <?php if ($image !== '') : ?>
        <a class="cte-card__media" href="<?php echo esc_url($url); ?>" tabindex="-1" aria-hidden="true">
            <?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </a>
    <?php endif; ?>

    <div class="cte-card__body">
        <?php if ($card->has('date')) : ?>
            <div class="cte-card__meta"><?php echo esc_html($card->text('date')); ?></div>
        <?php endif; ?>

        <?php if ($title !== '') : ?>
            <h3 class="cte-card__title"><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a></h3>
        <?php endif; ?>

        <?php if ($card->has('teaser') || $card->has('content')) : ?>
            <p class="cte-card__teaser"><?php echo $card->excerpt('teaser', 'content', 28); ?></p>
        <?php endif; ?>

        <div class="cte-card__actions">
            <?php if ($url !== '') : ?>
                <a class="cte-card__button" href="<?php echo esc_url($url); ?>"><?php esc_html_e('Weiterlesen', 'card-template-engine'); ?></a>
            <?php endif; ?>

            <?php if (current_user_can('edit_post', $card->id()) && $card->url('edit_url') !== '') : ?>
                <a class="cte-card__edit" href="<?php echo esc_url($card->url('edit_url')); ?>"><?php esc_html_e('Bearbeiten', 'card-template-engine'); ?></a>
            <?php endif; ?>
        </div>
    </div>
</article>
