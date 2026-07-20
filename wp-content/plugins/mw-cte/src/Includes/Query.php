<?php

declare(strict_types=1);

namespace CTE\Includes;

use WP_Query;

final class Query
{
    private Card $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function get(): WP_Query
    {
        $args = [
            'post_status'         => 'publish',
            'posts_per_page'      => $this->card->limit(),
            'orderby'             => $this->card->orderby(),
            'order'               => $this->card->order(),
            'ignore_sticky_posts' => true,
        ];

        switch ($this->card->source()) {

            case 'post_type':
                $args['post_type'] = $this->card->value();
                break;

            case 'category':
                $args['post_type'] = 'post';
                $args['category_name'] = $this->card->value();
                break;

            case 'tag':
                $args['post_type'] = 'post';
                $args['tag'] = $this->card->value();
                break;

            case 'taxonomy':

                $args['tax_query'] = [
                    [
                        'taxonomy' => $this->card->taxonomy(),
                        'field'    => 'slug',
                        'terms'    => $this->card->value(),
                    ]
                ];

                break;

            default:

                // Fallback auf normale Beiträge
                $args['post_type'] = 'post';

        }

        return new WP_Query($args);
    }

    /**
     * Query-Argumente zum Testen zurückgeben.
     */
    public function getArgs(): array
    {
        $args = [
            'post_status'         => 'publish',
            'posts_per_page'      => $this->card->limit(),
            'orderby'             => $this->card->orderby(),
            'order'               => $this->card->order(),
            'ignore_sticky_posts' => true,
        ];

        switch ($this->card->source()) {

            case 'post_type':
                $args['post_type'] = $this->card->value();
                break;

            case 'category':
                $args['post_type'] = 'post';
                $args['category_name'] = $this->card->value();
                break;

            case 'tag':
                $args['post_type'] = 'post';
                $args['tag'] = $this->card->value();
                break;

            case 'taxonomy':
                $args['tax_query'] = [
                    [
                        'taxonomy' => $this->card->taxonomy(),
                        'field'    => 'slug',
                        'terms'    => $this->card->value(),
                    ]
                ];
                break;

            default:
                $args['post_type'] = 'post';
        }

        return $args;
    }
}