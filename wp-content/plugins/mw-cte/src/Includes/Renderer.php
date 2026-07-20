<?php

declare(strict_types=1);

namespace CTE\Includes;

use WP_Query;

final class Renderer
{
    private Card $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Rendert eine komplette Card.
     */
    public function render(): void
    {
        $query = (new Query($this->card))->get();

        if (!$query->have_posts()) {

            echo '<p>Keine Beiträge gefunden.</p>';

            return;
        }

        $tiles = [];

        foreach ($query->posts as $post) {
            $tiles[] = new Tile($post);
        }

        $card = $this->card;

        include $this->locateCardTemplate();
    }

    /**
     * Liefert den Pfad zum Card-Template.
     */
    private function locateCardTemplate(): string
    {
        return \CTE_DIR
            . 'templates/'
            . $this->card->template()
            . '/card.php';
    }
}