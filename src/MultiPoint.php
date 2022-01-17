<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use function count;

class MultiPoint implements Geometry
{
    use CommonMethods;

    /**
     * @var Point[]
     */
    private array $points;

    public function __construct(
        Dimension $dimension,
        ?int $srid = null,
        Point ...$points,
    ) {
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
