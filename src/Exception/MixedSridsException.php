<?php

declare(strict_types=1);

namespace GeoIO\Geometry\Exception;

use GeoIO\Geometry\Geometry;
use InvalidArgumentException;
use function get_class;

class MixedSridsException extends InvalidArgumentException implements Exception
{
    public static function create(Geometry $geometry, Geometry $subGeometry): self
    {
        return new self(sprintf(
            'Cannot mix SRID\'s in a geometry: %s(%d) vs. %s(%d).',
            get_class($geometry),
            $geometry->getSrid() ?? 0,
            get_class($subGeometry),
            $subGeometry->getSrid() ?? 0,
        ));
    }
}
