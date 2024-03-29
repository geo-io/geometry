Geo I/O Geometry
==

[![Build Status](https://github.com/geo-io/geometry/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/geo-io/geometry/actions/workflows/ci.yml)
[![Coverage Status](https://coveralls.io/repos/github/geo-io/geometry/badge.svg?branch=main)](https://coveralls.io/github/geo-io/geometry?branch=main)

Basic implementation of geometric objects which roughly follows the
[Simple Feature Access for SQL](https://www.ogc.org/standards/sfs)
specification, although without any kind of advanced functionalities such as
geometric operations.

It can be used as a default input/output for the Geo I/O geometric data
representation parsers and generators.

Supported types are Point, LineString, Polygon, MultiPoint, MultiLineString,
MultiPolygon and GeometryCollection.

Installation
--

Install [through composer](https://getcomposer.org). Check the
[packagist page](https://packagist.org/packages/geo-io/geometry) for all
available versions.

```bash
composer require geo-io/geometry
```

License
--

Copyright (c) 2014-2022 Jan Sorgalla. Released under the [MIT License](LICENSE).
