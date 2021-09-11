<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

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
}
