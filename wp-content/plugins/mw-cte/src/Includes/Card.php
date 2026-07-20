<?php

declare(strict_types=1);

namespace CTE\Includes;

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

    private bool $showImage;
    private bool $showDate;
    private bool $showExcerpt;
    private bool $showReadMore;

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

        $this->source = $source;
        $this->value = $value;
        $this->taxonomy = $taxonomy;

        $this->limit = $limit;
        $this->orderby = $orderby;
        $this->order = strtoupper($order);

        $this->title = $title;
        $this->template = $template;
        $this->columns = max(1, $columns);

        $this->showImage = $showImage;
        $this->showDate = $showDate;
        $this->showExcerpt = $showExcerpt;
        $this->showReadMore = $showReadMore;

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

    public function showImage(): bool
    {
        return $this->showImage;
    }

    public function showDate(): bool
    {
        return $this->showDate;
    }

    public function showExcerpt(): bool
    {
        return $this->showExcerpt;
    }

    public function showReadMore(): bool
    {
        return $this->showReadMore;
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
            'source'         => $this->source,
            'value'          => $this->value,
            'taxonomy'       => $this->taxonomy,

            'limit'          => $this->limit,
            'orderby'        => $this->orderby,
            'order'          => $this->order,

            'title'          => $this->title,
            'template'       => $this->template,
            'columns'        => $this->columns,

            'showImage'      => $this->showImage,
            'showDate'       => $this->showDate,
            'showExcerpt'    => $this->showExcerpt,
            'showReadMore'   => $this->showReadMore,

            'cssClass'       => $this->cssClass,
            'id'             => $this->id,
        ];
    }
}