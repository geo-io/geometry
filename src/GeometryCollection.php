<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use function count;

class GeometryCollection extends BaseGeometry
{
    /**
     * @var Geometry[]
     */
    private array $geometries;

    public function __construct(
        string $dimension,
        ?int $srid = null,
        Geometry ...$geometries,
    ) {
        Dimension::assert($dimension);

        $this->dimension = $dimension;
        $this->srid = $srid;
        $this->geometries = $geometries;

        $this->assertGeometries();
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

    private function assertGeometries(): void
    {
        foreach ($this->getGeometries() as $geometry) {
            $this->assertGeometry($geometry);
        }
    }
}
