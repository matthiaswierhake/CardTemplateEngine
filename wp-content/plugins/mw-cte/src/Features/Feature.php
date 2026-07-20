<?php

declare(strict_types=1);

namespace CTE\Features;

use CTE\Includes\Tile;

final class Feature
{
    private string $key;
    private string $label;
    private string $description;
    private string $category;

    private string $template;
    private string $method;
    private string $position;

    private bool $default;
    private bool $sortable;

    /**
     * @param array<string,mixed> $definition
     */
    public function __construct(string $key, array $definition)
    {
        $this->key = $key;

        $this->label = (string) ($definition['label'] ?? '');
        $this->description = (string) ($definition['description'] ?? '');
        $this->category = (string) ($definition['category'] ?? '');

        $this->template = (string) ($definition['template'] ?? '');
        $this->method = (string) ($definition['method'] ?? '');
        $this->position = (string) ($definition['position'] ?? 'content');

        $this->default = (bool) ($definition['default'] ?? false);
        $this->sortable = (bool) ($definition['sortable'] ?? false);
    }

    public function key(): string
    {
        return $this->key;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function category(): string
    {
        return $this->category;
    }

    public function template(): string
    {
        return $this->template;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function position(): string
    {
        return $this->position;
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * Liefert den Wert des Features für ein Tile.
     */
    public function value(Tile $tile): mixed
    {
        $method = $this->method;

        return $tile->$method();
    }
}