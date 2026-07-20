<?php

declare(strict_types=1);

namespace CTE\Tests;

use CTE\Features\Feature;
use CTE\Features\FeatureRegistry;

final class FeatureRegistryTest
{
    public static function run(): void
    {
        echo '<h2>Feature Registry Test</h2>';

        Assert::reset();

        /*
         * Registry laden
         */

        $features = FeatureRegistry::all();

        Assert::true(
            is_array($features),
            'Registry returns array'
        );

        Assert::true(
            count($features) > 0,
            'Registry is not empty'
        );

        /*
         * Titel vorhanden
         */

        Assert::true(
            FeatureRegistry::has('title'),
            'Has title'
        );

        Assert::instanceOf(
            Feature::class,
            FeatureRegistry::get('title'),
            'Title is Feature'
        );

        Assert::equals(
            'content',
            FeatureRegistry::get('title')->position(),
            'Title position'
        );

        /*
         * Bild vorhanden
         */

        Assert::true(
            FeatureRegistry::has('image'),
            'Has image'
        );

        Assert::instanceOf(
            Feature::class,
            FeatureRegistry::get('image'),
            'Image is Feature'
        );

        Assert::equals(
            'before_content',
            FeatureRegistry::get('image')->position(),
            'Image position'
        );

        /*
         * Weitere Positionen
         */

        Assert::equals(
            'content',
            FeatureRegistry::get('excerpt')->position(),
            'Excerpt position'
        );

        Assert::equals(
            'content',
            FeatureRegistry::get('readmore')->position(),
            'Readmore position'
        );

        /*
         * Unbekanntes Feature
         */

        Assert::false(
            FeatureRegistry::has('foobar'),
            'Unknown feature'
        );

        Assert::null(
            FeatureRegistry::get('foobar'),
            'Unknown returns null'
        );

        /*
         * Default Features
         */

        $defaults = FeatureRegistry::defaults();

        Assert::true(
            count($defaults) > 0,
            'Default features exist'
        );

        foreach ($defaults as $feature) {

            Assert::true(
                $feature->isDefault(),
                sprintf(
                    '%s is default',
                    $feature->key()
                )
            );

        }

        /*
         * Gruppierung
         */

        $groups = FeatureRegistry::grouped();

        Assert::true(
            isset($groups['Content']),
            'Group Content'
        );

        Assert::true(
            isset($groups['Media']),
            'Group Media'
        );

        Assert::true(
            isset($groups['Meta']),
            'Group Meta'
        );

        Assert::true(
            isset($groups['Actions']),
            'Group Actions'
        );

        Assert::summary();
    }
}