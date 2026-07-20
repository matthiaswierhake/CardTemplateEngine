<?php

declare(strict_types=1);

namespace CTE\Features;

final class FeatureRegistry
{
    /**
     * @var array<string, Feature>|null
     */
    private static ?array $features = null;

    /**
     * @return array<string, Feature>
     */
    public static function all(): array
    {
        if (self::$features !== null) {
            return self::$features;
        }

        $definitions = require __DIR__ . '/definitions.php';

        self::$features = [];

        foreach ($definitions as $key => $definition) {
            if (!is_string($key) || !is_array($definition)) {
                continue;
            }

            self::$features[$key] = new Feature(
                $key,
                $definition
            );
        }

        return self::$features;
    }

    public static function get(string $key): ?Feature
    {
        $features = self::all();

        return $features[$key] ?? null;
    }

    public static function has(string $key): bool
    {
        return self::get($key) !== null;
    }

    /**
     * @return array<string, Feature>
     */
    public static function defaults(): array
    {
        return array_filter(
            self::all(),
            static fn (Feature $feature): bool => $feature->isDefault()
        );
    }

    /**
     * @return array<string, array<string, Feature>>
     */
    public static function grouped(): array
    {
        $groups = [];

        foreach (self::all() as $key => $feature) {
            $category = $feature->category();

            if (!isset($groups[$category])) {
                $groups[$category] = [];
            }

            $groups[$category][$key] = $feature;
        }

        return $groups;
    }
}