<?php

declare(strict_types=1);

namespace GeoIO\Geometry\Exception;

use GeoIO\Geometry\Geometry;
use InvalidArgumentException;
use function get_class;

class MixedDimensionalityException extends InvalidArgumentException implements Exception
{
    public static function create(Geometry $geometry, Geometry $subGeometry): self
    {
        return new self(sprintf(
            'Can not mix dimensionality in a geometry: %s(%s) vs. %s(%s).',
            get_class($geometry),
            $geometry->getDimension(),
            get_class($subGeometry),
            $subGeometry->getDimension(),
        ));
    }
}
