<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use function count;

class MultiPoint extends BaseGeometry
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

        Assert::geometry($this);
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
}
