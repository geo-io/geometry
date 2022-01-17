<?php

declare(strict_types=1);

namespace GeoIO\Geometry\Exception;

use GeoIO\Dimension;
use InvalidArgumentException;

class MissingCoordinateException extends InvalidArgumentException implements Exception
{
    public static function create(string $coordinate, Dimension $dimension): self
    {
        return new self(sprintf(
            '%s-coordinate must not be null for dimension %s.',
            strtoupper($coordinate),
            $dimension->value,
        ));
    }
}
