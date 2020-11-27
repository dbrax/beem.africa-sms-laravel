<?php

namespace Epmnzava\BongolivesmsLaravel\Tests;

use Orchestra\Testbench\TestCase;
use Epmnzava\BongolivesmsLaravel\BongolivesmsLaravelServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BongolivesmsLaravelServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
