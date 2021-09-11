<?php

declare(strict_types=1);

namespace GeoIO\Geometry\Exception;

use InvalidArgumentException;

class InsufficientNumberOfGeometriesException extends InvalidArgumentException implements Exception
{
    public static function create(int $expected, int $given, string $type): self
    {
        return new self(sprintf(
            'Expected at least %d geometries of type %s, got %d.',
            $expected,
            $type,
            $given,
        ));
    }
}
