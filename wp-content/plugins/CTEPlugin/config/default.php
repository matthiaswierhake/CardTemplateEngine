<?php

declare(strict_types=1);

return [
    'title' => ['source' => 'post_title'],
    'image' => ['source' => 'featured_image'],
    'teaser' => ['source' => 'post_excerpt'],
    'content' => ['source' => 'post_content', 'format' => 'wysiwyg'],
    'date' => ['source' => 'post_date', 'format' => 'd.m.Y'],
    'url' => ['source' => 'permalink'],
    'edit_url' => ['source' => 'edit_link'],
];
