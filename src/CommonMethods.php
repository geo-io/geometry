<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

trait CommonMethods
{
    private string $dimension;
    private ?int $srid;

    public function getDimension(): string
    {
        return $this->dimension;
    }

    public function getSrid(): ?int
    {
        return $this->srid;
    }
}
