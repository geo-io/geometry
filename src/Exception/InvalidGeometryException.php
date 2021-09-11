<?php

declare(strict_types=1);

namespace GeoIO\Geometry\Exception;

use InvalidArgumentException;

class InvalidGeometryException extends InvalidArgumentException implements Exception
{
    public static function create(mixed $value): self
    {
        return new self(sprintf(
            'Expected valid Geometry object, got %s.',
            get_debug_type($value),
        ));
    }

    public static function createForWrongType(string $expected, mixed $value): self
    {
        return new self(sprintf(
            'Expected Geometry object of type %s, got %s.',
            $expected,
            get_debug_type($value),
        ));
    }
}
