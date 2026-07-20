<?php
/** @var \CTE\Includes\Card $card */
if (! defined('ABSPATH')) {
    exit;
}
$image = $card->image('image', 'large');
?>
<article class="cte-card cte-card--full">
    <?php if ($image !== '') : ?>
        <div class="cte-card__media"><?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
    <?php endif; ?>
    <div class="cte-card__body">
        <h3 class="cte-card__title"><?php echo esc_html($card->text('title')); ?></h3>
        <?php if ($card->has('date')) : ?><div class="cte-card__meta"><?php echo esc_html($card->text('date')); ?></div><?php endif; ?>
        <?php if ($card->has('content')) : ?><div class="cte-card__content"><?php echo $card->html('content'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div><?php endif; ?>
        <div class="cte-card__actions">
            <?php if ($card->url('url') !== '') : ?><a class="cte-card__button" href="<?php echo esc_url($card->url('url')); ?>"><?php esc_html_e('Weiterlesen', 'card-template-engine'); ?></a><?php endif; ?>
            <?php if (current_user_can('edit_post', $card->id()) && $card->url('edit_url') !== '') : ?><a class="cte-card__edit" href="<?php echo esc_url($card->url('edit_url')); ?>"><?php esc_html_e('Bearbeiten', 'card-template-engine'); ?></a><?php endif; ?>
        </div>
    </div>
</article>
