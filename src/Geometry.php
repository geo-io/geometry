<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;

interface Geometry
{
    public function getDimension(): Dimension;

    public function getSrid(): ?int;

    public function isEmpty(): bool;
}
