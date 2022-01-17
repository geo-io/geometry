<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;

trait CommonMethods
{
    private Dimension $dimension;
    private ?int $srid;

    public function getDimension(): Dimension
    {
        return $this->dimension;
    }

    public function getSrid(): ?int
    {
        return $this->srid;
    }
}
