<?php

declare(strict_types=1);

namespace GeoIO\Geometry;

use GeoIO\Dimension;
use function count;

class Polygon implements Geometry
{
    use CommonMethods;

    /**
     * @var LinearRing[]
     */
    private array $linearRings;

    public function __construct(
        string $dimension,
        ?int $srid = null,
        LinearRing ...$lineStrings,
    ) {
        Dimension::assert($dimension);

        $this->dimension = $dimension;
        $this->srid = $srid;
        $this->linearRings = $lineStrings;

        Assert::geometry($this);
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->linearRings);
    }

    /**
     * @return LinearRing[]
     */
    public function getLinearRings(): array
    {
        return $this->linearRings;
    }
}
