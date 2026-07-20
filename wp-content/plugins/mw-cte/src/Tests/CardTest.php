<?php

declare(strict_types=1);

namespace CTE\Tests;

use CTE\Includes\Card;

final class CardTest
{
    public static function run(): void
    {
        $card = new Card(
            title: 'News',
            source: 'category',
            value: 'news',
            limit: 5,
            template: 'news'
        );

        ?>

        <h2>Ergebnis</h2>

        <table class="widefat striped">

            <tbody>

            <?php self::row('Titel', $card->title()); ?>

            <?php self::row('Quelle', $card->source()); ?>

            <?php self::row('Wert', $card->value()); ?>

            <?php self::row('Limit', (string)$card->limit()); ?>

            <?php self::row('Template', $card->template()); ?>

            <?php self::row('OrderBy', $card->orderby()); ?>

            <?php self::row('Order', $card->order()); ?>

            </tbody>

        </table>

        <?php
    }

    private static function row(
        string $label,
        string $value
    ): void {

        echo '<tr>';
        echo '<th style="width:220px">'.$label.'</th>';
        echo '<td>'.$value.'</td>';
        echo '</tr>';

    }
}