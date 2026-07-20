<?php

declare(strict_types=1);

namespace CTE\Includes;

use CTE\Features\Feature;
use CTE\Features\FeatureRegistry;

final class Card
{
    /*
     |--------------------------------------------------------------------------
     | Datenquelle
     |--------------------------------------------------------------------------
     */

    private string $source;
    private string $value;
    private ?string $taxonomy;

    /*
     |--------------------------------------------------------------------------
     | Abfrage
     |--------------------------------------------------------------------------
     */

    private int $limit;
    private string $orderby;
    private string $order;

    /*
     |--------------------------------------------------------------------------
     | Darstellung
     |--------------------------------------------------------------------------
     */

    private string $title;
    private string $template;
    private int $columns;

    /**
     * Aktivierte Features.
     *
     * @var string[]
     */
    private array $features = [];

    private string $cssClass;
    private string $id;

    public function __construct(
        string $source,
        string $value,

        ?string $taxonomy = null,

        int $limit = 5,
        string $orderby = 'date',
        string $order = 'DESC',

        string $title = '',
        string $template = 'default',
        int $columns = 1,

        bool $showImage = true,
        bool $showDate = true,
        bool $showExcerpt = true,
        bool $showReadMore = true,

        string $cssClass = '',
        string $id = ''
    ) {

        /*
         |--------------------------------------------------------------------------
         | Datenquelle
         |--------------------------------------------------------------------------
         */

        $this->source = $source;
        $this->value = $value;
        $this->taxonomy = $taxonomy;

        /*
         |--------------------------------------------------------------------------
         | Query
         |--------------------------------------------------------------------------
         */

        $this->limit = $limit;
        $this->orderby = $orderby;
        $this->order = strtoupper($order);

        /*
         |--------------------------------------------------------------------------
         | Darstellung
         |--------------------------------------------------------------------------
         */

        $this->title = $title;
        $this->template = $template;
        $this->columns = max(1, $columns);

        /*
         |--------------------------------------------------------------------------
         | Feature-Liste erzeugen
         |--------------------------------------------------------------------------
         */

        if ($showImage) {
            $this->addFeature('image');
        }

        if ($showDate) {
            $this->addFeature('date');
        }

        if ($showExcerpt) {
            $this->addFeature('excerpt');
        }

        if ($showReadMore) {
            $this->addFeature('readmore');
        }

        /*
         |--------------------------------------------------------------------------
         | Sonstiges
         |--------------------------------------------------------------------------
         */

        $this->cssClass = $cssClass;
        $this->id = $id;
    }

    /*
     |--------------------------------------------------------------------------
     | Datenquelle
     |--------------------------------------------------------------------------
     */

    public function source(): string
    {
        return $this->source;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function taxonomy(): ?string
    {
        return $this->taxonomy;
    }

    /*
     |--------------------------------------------------------------------------
     | Query
     |--------------------------------------------------------------------------
     */

    public function limit(): int
    {
        return $this->limit;
    }

    public function orderby(): string
    {
        return $this->orderby;
    }

    public function order(): string
    {
        return $this->order;
    }

    /*
     |--------------------------------------------------------------------------
     | Darstellung
     |--------------------------------------------------------------------------
     */

    public function title(): string
    {
        return $this->title;
    }

    public function template(): string
    {
        return $this->template;
    }

    public function columns(): int
    {
        return $this->columns;
    }

    /**
     * Aktivierte Features.
     *
     * @return string[]
     */
    public function features(): array
    {
        return $this->features;
    }

    /**
     * Aktivierte Features als Feature-Objekte.
     *
     * @return Feature[]
     */
    public function featureObjects(): array
    {
        $features = [];

        foreach ($this->features as $key) {

            $feature = FeatureRegistry::get($key);

            if ($feature !== null) {
                $features[] = $feature;
            }
        }

        return $features;
    }

    public function hasFeature(string $feature): bool
    {
        return in_array($feature, $this->features, true);
    }

    public function addFeature(string $feature): self
    {
        if (
            FeatureRegistry::has($feature)
            && !$this->hasFeature($feature)
        ) {
            $this->features[] = $feature;
        }

        return $this;
    }

    public function removeFeature(string $feature): self
    {
        $this->features = array_values(
            array_filter(
                $this->features,
                static fn(string $item): bool => $item !== $feature
            )
        );

        return $this;
    }

    /**
     * @param string[] $features
     */
    public function setFeatures(array $features): self
    {
        $this->features = [];

        foreach (array_unique($features) as $feature) {

            if (FeatureRegistry::has($feature)) {
                $this->features[] = $feature;
            }
        }

        return $this;
    }

    public function showImage(): bool
    {
        return $this->hasFeature('image');
    }

    public function showDate(): bool
    {
        return $this->hasFeature('date');
    }

    public function showExcerpt(): bool
    {
        return $this->hasFeature('excerpt');
    }

    public function showReadMore(): bool
    {
        return $this->hasFeature('readmore');
    }

    public function cssClass(): string
    {
        return $this->cssClass;
    }

    public function id(): string
    {
        return $this->id;
    }

    /*
     |--------------------------------------------------------------------------
     | Debug
     |--------------------------------------------------------------------------
     */

    public function toArray(): array
    {
        return [

            /*
             |--------------------------------------------------------------
             | Datenquelle
             |--------------------------------------------------------------
             */

            'source'   => $this->source,
            'value'    => $this->value,
            'taxonomy' => $this->taxonomy,

            /*
             |--------------------------------------------------------------
             | Query
             |--------------------------------------------------------------
             */

            'limit'    => $this->limit,
            'orderby'  => $this->orderby,
            'order'    => $this->order,

            /*
             |--------------------------------------------------------------
             | Darstellung
             |--------------------------------------------------------------
             */

            'title'    => $this->title,
            'template' => $this->template,
            'columns'  => $this->columns,

            /*
             |--------------------------------------------------------------
             | Features
             |--------------------------------------------------------------
             */

            'features' => $this->features,

            /*
             |--------------------------------------------------------------
             | Legacy-Kompatibilität
             |--------------------------------------------------------------
             */

            'showImage'    => $this->showImage(),
            'showDate'     => $this->showDate(),
            'showExcerpt'  => $this->showExcerpt(),
            'showReadMore' => $this->showReadMore(),

            /*
             |--------------------------------------------------------------
             | Sonstiges
             |--------------------------------------------------------------
             */

            'cssClass' => $this->cssClass,
            'id'       => $this->id,
        ];
    }

    /*
     |--------------------------------------------------------------------------
     | Aktionen
     |--------------------------------------------------------------------------
     */

    /**
     * Darf der aktuelle Benutzer Beiträge dieses Card-Typs erstellen?
     */
    public function canCreate(): bool
    {
        return current_user_can('edit_posts');
    }

    /**
     * URL zum Anlegen eines neuen Beitrags.
     */
    public function newPostUrl(): string
    {
        $postType = 'post';

        switch ($this->source()) {

            case 'post_type':
                $postType = $this->value();
                break;

            case 'category':
            case 'tag':
            case 'taxonomy':
                $postType = 'post';
                break;
        }

        return admin_url(
            'post-new.php?post_type=' . $postType
        );
    }
}
