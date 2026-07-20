<?php

declare(strict_types=1);

namespace CTE\Tests;

use CTE\Features\Feature;

final class FeatureTest
{
    public static function run(): void
    {
        echo '<h2>Feature Test</h2>';

        Assert::reset();

        $feature = new Feature(
            'title',
            [
                'label'       => 'Titel',
                'description' => 'Beitragstitel',
                'category'    => 'Content',

                'template'    => 'title',
                'method'      => 'title',
                'position'    => 'content',

                'default'     => true,
                'sortable'    => true,
            ]
        );

        /*
         |--------------------------------------------------------------------------
         | Stammdaten
         |--------------------------------------------------------------------------
         */

        Assert::equals(
            'title',
            $feature->key(),
            'Feature Key'
        );

        Assert::equals(
            'Titel',
            $feature->label(),
            'Feature Label'
        );

        Assert::equals(
            'Beitragstitel',
            $feature->description(),
            'Feature Description'
        );

        Assert::equals(
            'Content',
            $feature->category(),
            'Feature Category'
        );

        /*
         |--------------------------------------------------------------------------
         | Rendering
         |--------------------------------------------------------------------------
         */

        Assert::equals(
            'title',
            $feature->template(),
            'Feature Template'
        );

        Assert::equals(
            'title',
            $feature->method(),
            'Feature Method'
        );

        Assert::equals(
            'content',
            $feature->position(),
            'Feature Position'
        );

        /*
         |--------------------------------------------------------------------------
         | Optionen
         |--------------------------------------------------------------------------
         */

        Assert::true(
            $feature->isDefault(),
            'Default Feature'
        );

        Assert::true(
            $feature->isSortable(),
            'Sortable Feature'
        );

        Assert::summary();
    }
}