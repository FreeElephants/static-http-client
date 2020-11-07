<?php

namespace FreeElephants\StaticHttpClient;

use Helmich\Psr7Assert\Psr7Assertions;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{

    use Psr7Assertions;

    protected const FIXTURE_PATH = __DIR__ . '/../../_fixtures';
}
