<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Coordinates;
use GeoIO\Dimension;

class Point implements Geometry
{
    use CommonMethods;

    private ?Coordinates $coordinates;

    public function __construct(
        Dimension $dimension,
        ?int $srid = null,
        ?Coordinates $coordinates = null,
    ) {
        $this->dimension = $dimension;
        $this->srid = $srid;
        $this->coordinates = $coordinates;

        Assert::geometry($this);
    }

    public function isEmpty(): bool
    {
        return null === $this->coordinates;
    }

    public function getX(): ?float
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->x;
    }

    public function getY(): ?float
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->y;
    }

    public function getZ(): ?float
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->z;
    }

    public function getM(): ?float
    {
        if (null === $this->coordinates) {
            return null;
        }

        return $this->coordinates->m;
    }
}
