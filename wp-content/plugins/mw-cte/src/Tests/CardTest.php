<?php

declare(strict_types=1);

namespace CTE\Tests;

use CTE\Features\Feature;
use CTE\Includes\Card;

final class CardTest
{
    public static function run(): void
    {
        Assert::reset();

        $card = new Card(
            source: 'post_type',
            value: 'post'
        );

        /*
         |--------------------------------------------------------------------------
         | Datenquelle
         |--------------------------------------------------------------------------
         */

        Assert::equals(
            'post_type',
            $card->source(),
            'Source'
        );

        Assert::equals(
            'post',
            $card->value(),
            'Value'
        );

        Assert::null(
            $card->taxonomy(),
            'Taxonomy'
        );

        /*
         |--------------------------------------------------------------------------
         | Query
         |--------------------------------------------------------------------------
         */

        Assert::equals(
            5,
            $card->limit(),
            'Limit'
        );

        Assert::equals(
            'date',
            $card->orderby(),
            'Order By'
        );

        Assert::equals(
            'DESC',
            $card->order(),
            'Order'
        );

        /*
         |--------------------------------------------------------------------------
         | Darstellung
         |--------------------------------------------------------------------------
         */

        Assert::equals(
            '',
            $card->title(),
            'Title'
        );

        Assert::equals(
            'default',
            $card->template(),
            'Template'
        );

        Assert::equals(
            1,
            $card->columns(),
            'Columns'
        );

        /*
         |--------------------------------------------------------------------------
         | Default Features
         |--------------------------------------------------------------------------
         */

        Assert::equals(
            [
                'image',
                'date',
                'excerpt',
                'readmore',
            ],
            $card->features(),
            'Default features'
        );

        $featureObjects = $card->featureObjects();

        Assert::equals(
            4,
            count($featureObjects),
            'Feature object count'
        );

        Assert::instanceOf(
            Feature::class,
            $featureObjects[0],
            'First feature object'
        );

        Assert::equals(
            'image',
            $featureObjects[0]->key(),
            'Feature image'
        );

        Assert::equals(
            'date',
            $featureObjects[1]->key(),
            'Feature date'
        );

        Assert::equals(
            'excerpt',
            $featureObjects[2]->key(),
            'Feature excerpt'
        );

        Assert::equals(
            'readmore',
            $featureObjects[3]->key(),
            'Feature readmore'
        );

        /*
         |--------------------------------------------------------------------------
         | Feature API
         |--------------------------------------------------------------------------
         */

        Assert::true(
            $card->hasFeature('image'),
            'Has image'
        );

        Assert::false(
            $card->hasFeature('gallery'),
            'Has gallery'
        );

        $card->addFeature('gallery');

        Assert::true(
            $card->hasFeature('gallery'),
            'Add gallery'
        );
        $card->removeFeature('gallery');

        Assert::false(
            $card->hasFeature('gallery'),
            'Remove gallery'
        );

        /*
         |--------------------------------------------------------------------------
         | setFeatures()
         |--------------------------------------------------------------------------
         */

        $card->setFeatures([
            'title',
            'unknown-feature',
            'image',
            'image',
        ]);

        Assert::equals(
            [
                'title',
                'image',
            ],
            $card->features(),
            'setFeatures() filters invalid and duplicate features'
        );

        $featureObjects = $card->featureObjects();

        Assert::equals(
            2,
            count($featureObjects),
            'Feature object count after setFeatures'
        );

        Assert::equals(
            'title',
            $featureObjects[0]->key(),
            'First feature object after setFeatures'
        );

        Assert::equals(
            'image',
            $featureObjects[1]->key(),
            'Second feature object after setFeatures'
        );

        /*
         |--------------------------------------------------------------------------
         | Legacy API
         |--------------------------------------------------------------------------
         */

        Assert::true(
            $card->showImage(),
            'showImage()'
        );

        Assert::false(
            $card->showDate(),
            'showDate()'
        );

        Assert::false(
            $card->showExcerpt(),
            'showExcerpt()'
        );

        Assert::false(
            $card->showReadMore(),
            'showReadMore()'
        );

        /*
         |--------------------------------------------------------------------------
         | Sonstiges
         |--------------------------------------------------------------------------
         */

        Assert::equals(
            '',
            $card->cssClass(),
            'CSS class'
        );

        Assert::equals(
            '',
            $card->id(),
            'ID'
        );

        /*
         |--------------------------------------------------------------------------
         | Debug
         |--------------------------------------------------------------------------
         */

        $array = $card->toArray();

        Assert::true(
            isset($array['features']),
            'toArray() contains features'
        );

        Assert::true(
            isset($array['showImage']),
            'toArray() contains legacy values'
        );

        Assert::summary();
    }
}