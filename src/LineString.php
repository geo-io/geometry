<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use GeoIO\Geometry\Exception\InsufficientNumberOfGeometriesException;
use function count;

class LineString extends BaseGeometry
{
    /**
     * @var Point[]
     */
    private array $points;

    public function __construct(
        string $dimension,
        ?int $srid = null,
        Point ...$points,
    ) {
        Dimension::assert($dimension);

        $this->dimension = $dimension;
        $this->srid = $srid;
        $this->points = $points;

        $this->assertPoints();
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->points);
    }

    /**
     * @return Point[]
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    private function assertPoints(): void
    {
        $points = $this->getPoints();

        $count = count($points);

        if (1 === $count) {
            throw InsufficientNumberOfGeometriesException::create(
                2,
                $count,
                'Point'
            );
        }

        foreach ($points as $point) {
            $this->assertGeometry($point);
        }
    }
}
