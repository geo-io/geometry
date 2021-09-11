<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException;
use GeoIO\Geometry\Exception\LinearRingNotClosedException;
use function count;

class LinearRing extends LineString
{
    public function __construct(
        string $dimension,
        ?int $srid = null,
        Point ...$points,
    ) {
        parent::__construct($dimension, $srid, ...$points);

        $this->assertPoints();
    }

    private function assertPoints(): void
    {
        $points = $this->getPoints();

        $count = count($points);

        if ($count > 0 && $count < 4) {
            throw InsufficientNumberOfGeometriesException::create(
                4,
                $count,
                'Point'
            );
        }

        $lastPoint = end($points);
        $firstPoint = reset($points);

        if ($lastPoint &&
            $firstPoint &&
            (
                $lastPoint->getX() !== $firstPoint->getX() ||
                 $lastPoint->getY() !== $firstPoint->getY() ||
                 $lastPoint->getZ() !== $firstPoint->getZ() ||
                 $lastPoint->getM() !== $firstPoint->getM()
            )
        ) {
            throw LinearRingNotClosedException::create();
        }
    }
}
