<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use function count;

class MultiPolygon extends BaseGeometry
{
    /**
     * @var Polygon[]
     */
    private array $polygons;

    public function __construct(
        string $dimension,
        ?int $srid = null,
        Polygon ...$polygons,
    ) {
        Dimension::assert($dimension);

        $this->dimension = $dimension;
        $this->srid = $srid;
        $this->polygons = $polygons;

        Assert::geometry($this);
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->polygons);
    }

    /**
     * @return Polygon[]
     */
    public function getPolygons(): array
    {
        return $this->polygons;
    }
}
