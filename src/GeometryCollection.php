<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use function count;

class GeometryCollection implements Geometry
{
    use CommonMethods;

    /**
     * @var Geometry[]
     */
    private array $geometries;

    public function __construct(
        Dimension $dimension,
        ?int $srid = null,
        Geometry ...$geometries,
    ) {
        $this->dimension = $dimension;
        $this->srid = $srid;
        $this->geometries = $geometries;

        Assert::geometry($this);
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->geometries);
    }

    /**
     * @return Geometry[]
     */
    public function getGeometries(): array
    {
        return $this->geometries;
    }
}
