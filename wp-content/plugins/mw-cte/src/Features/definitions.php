<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */

    'title' => [

        'label'       => 'Titel',
        'description' => 'Beitragstitel',
        'category'    => 'Content',

        'template'    => 'title',
        'method'      => 'title',

        'position'    => 'content',

        'default'     => true,
        'sortable'    => true,

    ],

    'excerpt' => [

        'label'       => 'Kurztext',
        'description' => 'Beitragsauszug',

        'category'    => 'Content',

        'template'    => 'excerpt',
        'method'      => 'excerpt',

        'position'    => 'content',

        'default'     => true,
        'sortable'    => true,

    ],

    'content' => [

        'label'       => 'Langtext',
        'description' => 'Vollständiger Beitrag',

        'category'    => 'Content',

        'template'    => 'content',
        'method'      => 'content',

        'position'    => 'content',

        'default'     => false,
        'sortable'    => true,

    ],



    /*
    |--------------------------------------------------------------------------
    | Media
    |--------------------------------------------------------------------------
    */

    'image' => [

        'label'       => 'Beitragsbild',
        'description' => 'Featured Image',

        'category'    => 'Media',

        'template'    => 'image',
        'method'      => 'thumbnail',

        'position'    => 'before_content',

        'default'     => true,
        'sortable'    => true,

    ],

    'gallery' => [

        'label'       => 'Galerie',
        'description' => 'Mehrere Bilder',

        'category'    => 'Media',

        'template'    => 'gallery',
        'method'      => 'gallery',

        'position'    => 'content',

        'default'     => false,
        'sortable'    => true,

    ],



    /*
    |--------------------------------------------------------------------------
    | Meta
    |--------------------------------------------------------------------------
    */

    'date' => [

        'label'       => 'Datum',
        'description' => 'Veröffentlichungsdatum',

        'category'    => 'Meta',

        'template'    => 'date',
        'method'      => 'date',

        'position'    => 'content',

        'default'     => true,
        'sortable'    => true,

    ],

    'author' => [

        'label'       => 'Autor',
        'description' => 'Beitragsautor',

        'category'    => 'Meta',

        'template'    => 'author',
        'method'      => 'author',

        'position'    => 'content',

        'default'     => false,
        'sortable'    => true,

    ],

    'categories' => [

        'label'       => 'Kategorien',
        'description' => 'Beitragskategorien',

        'category'    => 'Meta',

        'template'    => 'categories',
        'method'      => 'categories',

        'position'    => 'content',

        'default'     => false,
        'sortable'    => true,

    ],

    'tags' => [

        'label'       => 'Schlagwörter',
        'description' => 'Tags',

        'category'    => 'Meta',

        'template'    => 'tags',
        'method'      => 'tags',

        'position'    => 'content',

        'default'     => false,
        'sortable'    => true,

    ],



    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    'actions' => [

        'label'       => 'Aktionen',
        'description' => 'Bearbeiten, Löschen usw.',

        'category'    => 'Actions',

        'template'    => 'actions',
        'method'      => 'actions',

        'position'    => 'before_content',

        'default'     => false,
        'sortable'    => false,

    ],

    'readmore' => [

        'label'       => 'Weiterlesen',
        'description' => 'Link zum Beitrag',

        'category'    => 'Actions',

        'template'    => 'readmore',
        'method'      => 'permalink',

        'position'    => 'content',

        'default'     => true,
        'sortable'    => true,

    ],

];