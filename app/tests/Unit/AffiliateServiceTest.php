<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\AffiliateService;

class AffiliateServiceTest extends TestCase
{

	private AffiliateService $affiliateService;

	protected function setUp(): void
    {

        parent::setUp();

        $this->affiliateService = new AffiliateService(
        	'/var/www/storage/txt/affiliates.txt'
        );

    }
    
    /**
     * Getting File
     *
     * @return void
     */
    public function test_txtFileExist()
    {
    	// File exist
		$this->assertTrue(file_exists($this->affiliateService->affiliate_file_path));

    }

	/**
     * GetContents as a array from the txt file
     * The elements of the array as expected
     *
     * @return void
     */
    public function test_getAffiliates()
    {

    	$this->affiliateService = $this->affiliateService->getAffiliates();
    	
    	// GetContents as a array from the txt file
    	$this->assertTrue(is_array($this->affiliateService->within100KmAffiliates));
    	
    	// The elements of the array as expected
    	$this->assertSame(
    		"latitude affiliate_id name longitude distanceFromDublinOffice", 
    		implode(" ", array_keys($this->affiliateService->within100KmAffiliates[0]) )
    	);
    	
    }

	/**
     * Affiliates within 100km
     * Affiliates within 10km
     *
     * @return void
     */
    public function test_getwithin100KmAffiliates()
    {
  		$affiliate = ["latitude"=>"52.986375","affiliate_id"=>12,"name"=>"Yosef Giles","longitude"=>"-6.043701"];

        // we know  $affiliates within 100km from dublin office
        $this->assertTrue(
           is_array(
           	(new AffiliateService())
				->getwithin100KmAffiliates($affiliate, 100)
			)
        );

    	// we know  $affiliates is not within 10km from dublin office so this will not turn back us as an array
    	$this->assertTrue(
           !is_array(
           		(new AffiliateService())
					->getwithin100KmAffiliates($affiliate, 10)
			)
        );
    }

	/**
     * we know  $affiliates is not within 10km from dublin office so this assert will not turn back us as an array
     * @return void
     */
    public function test_sort_ascending_affiliates_by_id(){

		$within100KmAffiliates = $this->affiliateService
        	->getAffiliates()
        	->sort_ascending_affiliates_by_id()
        	->within100KmAffiliates;
		
        $ascendingSortByaffiliate_id = true;
        $previous_affiliate = reset($within100KmAffiliates);
		
        foreach ($within100KmAffiliates as $key => $affiliate) {
        	
        	if (
        		$affiliate != $previous_affiliate &&
        		$previous_affiliate["affiliate_id"] > $affiliate["affiliate_id"]
        	) {
        		$ascendingSortByaffiliate_id = false;
        	}
        	$previous_affiliate = $affiliate;
        }

        $this->assertTrue($ascendingSortByaffiliate_id);

    }

}