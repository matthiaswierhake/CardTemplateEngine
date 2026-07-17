<?php

declare(strict_types=1);

return [
    'title' => ['source' => 'post_title'],
    'image' => [
        'source' => 'acf',
        'field' => 'titelbild',
        'fallback' => ['source' => 'featured_image'],
    ],
    'teaser' => [
        'source' => 'acf',
        'field' => 'teaser',
        'fallback' => ['source' => 'post_excerpt'],
    ],
    'content' => [
        'source' => 'acf',
        'field' => 'langtext',
        'format' => 'wysiwyg',
        'fallback' => ['source' => 'post_content'],
    ],
    'date' => [
        'source' => 'acf',
        'field' => 'datum',
        'fallback' => ['source' => 'post_date', 'format' => 'd.m.Y'],
    ],
    'author' => ['source' => 'acf', 'field' => 'autor'],
    'url' => ['source' => 'permalink'],
    'edit_url' => ['source' => 'edit_link'],
];
