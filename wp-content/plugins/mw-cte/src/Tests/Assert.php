<?php

declare(strict_types=1);

namespace CTE\Tests;

final class Assert
{
    private static int $passed = 0;
    private static int $failed = 0;

    public static function reset(): void
    {
        self::$passed = 0;
        self::$failed = 0;
    }

    public static function equals(mixed $expected, mixed $actual, string $message = ''): void
    {
        if ($expected === $actual) {
            self::pass($message ?: 'equals');
            return;
        }

        self::fail(
            $message ?: 'equals',
            sprintf(
                'Expected %s, got %s',
                var_export($expected, true),
                var_export($actual, true)
            )
        );
    }

    public static function true(bool $value, string $message = ''): void
    {
        self::equals(true, $value, $message ?: 'true');
    }

    public static function false(bool $value, string $message = ''): void
    {
        self::equals(false, $value, $message ?: 'false');
    }

    public static function null(mixed $value, string $message = ''): void
    {
        self::equals(null, $value, $message ?: 'null');
    }

    public static function notNull(mixed $value, string $message = ''): void
    {
        if ($value !== null) {
            self::pass($message ?: 'notNull');
            return;
        }

        self::fail($message ?: 'notNull', 'Value is null');
    }

    public static function instanceOf(string $class, mixed $object, string $message = ''): void
    {
        if ($object instanceof $class) {
            self::pass($message ?: 'instanceOf');
            return;
        }

        self::fail(
            $message ?: 'instanceOf',
            sprintf('Object is not instance of %s', $class)
        );
    }

    public static function summary(): void
    {
        echo '<hr>';

        printf(
            '<p><strong>Tests:</strong> %d &nbsp; <span style="color:green;">✔ %d</span> &nbsp; <span style="color:red;">✘ %d</span></p>',
            self::$passed + self::$failed,
            self::$passed,
            self::$failed
        );
    }

    private static function pass(string $message): void
    {
        self::$passed++;

        printf(
            '<div style="color:green;">✔ %s</div>',
            esc_html($message)
        );
    }

    private static function fail(string $message, string $details): void
    {
        self::$failed++;

        printf(
            '<div style="color:red;">✘ %s<br><small>%s</small></div>',
            esc_html($message),
            esc_html($details)
        );
    }
}