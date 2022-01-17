<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use function count;

class MultiLineString implements Geometry
{
    use CommonMethods;

    /**
     * @var LineString[]
     */
    private array $lineStrings;

    public function __construct(
        Dimension $dimension,
        ?int $srid = null,
        LineString ...$lineStrings,
    ) {
        $this->dimension = $dimension;
        $this->srid = $srid;
        $this->lineStrings = $lineStrings;

        Assert::geometry($this);
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->lineStrings);
    }

    /**
     * @return LineString[]
     */
    public function getLineStrings(): array
    {
        return $this->lineStrings;
    }
}
