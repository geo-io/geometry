<?php

declare(strict_types=1);

namespace GeoIO\Geometry\Exception;

use InvalidArgumentException;

class LinearRingNotClosedException extends InvalidArgumentException implements Exception
{
    public static function create(): self
    {
        return new self('LinearRing requires the first and last positions to be equivalent.');
    }
}
