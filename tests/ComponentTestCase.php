<?php

namespace Tests;

use Illuminate\Support\Facades\Blade;

abstract class ComponentTestCase extends TestCase
{
    /**
 * Render a Blade component and return the HTML.
 */
protected function renderComponent(string $component, array $data = []): string
{
    // Separate scalar and array data
    $scalarData = [];
    $arrayData = [];
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $arrayData[$key] = $value;
        } else {
            $scalarData[$key] = $value;
        }
    }

    // Build attribute string for scalars, dynamic bindings for arrays
    $attrs = $this->attributesToString($scalarData);
    foreach ($arrayData as $key => $value) {
        $attrs .= sprintf(' :%s="$%s"', $key, $key);
    }

    $html = Blade::render(
        sprintf('<x-%s %s />', $component, $attrs),
        $arrayData
    );

    return trim($html);
}

/**
 * Render a slot-based Blade component.
 */
protected function renderSlotComponent(string $component, string $slot = '', array $data = []): string
{
    $scalarData = [];
    $arrayData = [];
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $arrayData[$key] = $value;
        } else {
            $scalarData[$key] = $value;
        }
    }

    $attrs = $this->attributesToString($scalarData);
    foreach ($arrayData as $key => $value) {
        $attrs .= sprintf(' :%s="$%s"', $key, $key);
    }

    $html = Blade::render(
        sprintf('<x-%s %s>%s</x-%s>', $component, $attrs, $slot, $component),
        $arrayData
    );

    return trim($html);
}

/**
 * Convert an array of scalar attributes to a Blade attribute string.
 */
protected function attributesToString(array $data): string
{
    $parts = [];
    foreach ($data as $key => $value) {
        if (is_bool($value)) {
            if ($value) $parts[] = $key;
        } elseif (is_string($value)) {
            $parts[] = sprintf('%s="%s"', $key, $value);
        } elseif (is_int($value) || is_float($value)) {
            $parts[] = sprintf('%s="%d"', $key, $value);
        }
    }
    return implode(' ', $parts);
}

    /**
     * Assert that HTML contains all given strings.
     */
    protected function assertSeeAll(string $html, array $strings): void
    {
        foreach ($strings as $string) {
            $this->assertStringContainsString($string, $html);
        }
    }

    /**
     * Assert that HTML contains dark mode classes.
     */
    protected function assertHasDarkClasses(string $html): void
    {
        $this->assertStringContainsString('dark:', $html, 'Component should have dark mode classes');
    }
}