<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\GreatCircleService;

class GreatCircleServiceTest extends TestCase
{

	private GreatCircleService $greatCircleService;

	protected function setUp(): void
    {

        parent::setUp();

        $this->greatCircleService = new GreatCircleService();

    }

    /**
     * Calculate distance
     *
     * @return void
     */
    public function test_distance()
    {
      // https://www.meridianoutpost.com/resources/etools/calculators/calculator-latitude-longitude-distance.php?
      // assumed aboved link is correct
      $this->assertSame(
         round($this->greatCircleService->distance(53.2451022, -6.238335, 53.3340285, -6.2535495), 2), 
         9.94
      );
      

    }
}