<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Geometry\Exception\MixedDimensionalityException;
use GeoIO\Geometry\Exception\MixedSridsException;

abstract class BaseGeometry implements Geometry
{
    protected string $dimension;
    protected ?int $srid;

    public function getDimension(): string
    {
        return $this->dimension;
    }

    public function getSrid(): ?int
    {
        return $this->srid;
    }

    protected function assertGeometry(Geometry $geometry): void
    {
        if ($geometry->getDimension() !== $this->getDimension()) {
            throw MixedDimensionalityException::create($this, $geometry);
        }

        if (null !== ($srid = $geometry->getSrid()) && $srid !== $this->getSrid()) {
            throw MixedSridsException::create($this, $geometry);
        }
    }
}
