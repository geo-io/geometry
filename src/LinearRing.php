<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;

class LinearRing extends LineString
{
    public function __construct(
        Dimension $dimension,
        ?int $srid = null,
        Point ...$points,
    ) {
        parent::__construct($dimension, $srid, ...$points);

        Assert::linearRing($this);
    }
}
