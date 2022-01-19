<?php

namespace App\Services;

use \File;
use App\Services\GreatCircleService;
use App\Constant\Constant;

class AffiliateService
{

    public string $affiliate_file_path;
    public array $within100KmAffiliates;

    public function __construct($filePath = ''){
        $this->affiliate_file_path = $filePath;
    }

    /**
     * get array from affiliate.txt file
     * 
     * @return self
     */
    public function getAffiliates() : self
    {
        $affilates_file_content = file_get_contents($this->affiliate_file_path);

        $affilates_file_content = explode("\n", $affilates_file_content);

        foreach ($affilates_file_content as $key => $value) {

            $within100KmAffiliates = $this->getwithin100KmAffiliates(
                json_decode($value, true), 
                Constant::DISTANCE_FROM_DUBLIN_OFFICE
            );

            if ($within100KmAffiliates) {
                $this->within100KmAffiliates[] = $within100KmAffiliates;
            }
                
        }

        return $this;
    }

    /**
     * It sends back the affiliates within 100 km as an array.
     * @return mixed (array || null)
     */
    public function getwithin100KmAffiliates($affiliate, $km){
        
        $distanceFromDublinOffice = (new GreatCircleService())->distance(
            Constant::GAMBLING_DUBLINOFFICE_LAT,
            Constant::GAMBLING_DUBLINOFFICE_LONG,
            $affiliate["latitude"],
            $affiliate["longitude"]
        );

        if ($distanceFromDublinOffice < $km) {
            $affiliate["distanceFromDublinOffice"] = $distanceFromDublinOffice;
            $within100KmAffiliates = $affiliate;
            return $within100KmAffiliates;
        }

        return;
    }

    /**
     * sorted by affiliate_id
     * @return self
     */
    public function sort_ascending_affiliates_by_id(){
        
        usort($this->within100KmAffiliates, function($a, $b) {
            return $a['affiliate_id'] <=> $b['affiliate_id'];
        });

        return $this;
    }
        
}
