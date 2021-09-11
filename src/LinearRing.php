<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

class LinearRing extends LineString
{
    public function __construct(
        string $dimension,
        ?int $srid = null,
        Point ...$points,
    ) {
        parent::__construct($dimension, $srid, ...$points);

        Assert::linearRing($this);
    }
}
