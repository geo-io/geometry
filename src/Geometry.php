<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

interface Geometry
{
    public function getDimension(): string;

    public function getSrid(): ?int;

    public function isEmpty(): bool;
}
