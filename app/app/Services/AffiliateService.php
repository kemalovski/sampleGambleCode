<?php

namespace App\Services;

use File;
use App\Services\GreatCircleService;
use App\Constant\Constant;

class AffiliateService
{

    private string $affiliate_file_path;
    public array $affiliates;
    public array $within100KmAffiliates;

    public function __construct(){
        $this->affiliate_file_path = storage_path() . '/json/affiliates.txt';
    }

    public function getAffiliates(): self
    {
        $affilates_file_content = File::get($this->affiliate_file_path);

        $affilates_file_content = explode("\n", $affilates_file_content);

        foreach ($affilates_file_content as $key => $value) {
                $this->affiliates[] = json_decode($value, true);
        }

        return $this;

    }

    public function getwithin100KmAffiliates($km){
        
        foreach ($this->affiliates as $key => $value) {

            $distanceFromDublinOffice = GreatCircleService::distance(
                Constant::GAMBLING_DUBLINOFFICE_LAT,
                Constant::GAMBLING_DUBLINOFFICE_LONG,
                $value["latitude"],
                $value["longitude"]
            );

            if ($distanceFromDublinOffice < $km) {
                $value["distanceFromDublinOffice"] = $distanceFromDublinOffice;
                $this->within100KmAffiliates[$key] = $value;
            }

        }

        return $this;
    }

    public function sort_ascending_affiliates_by_id(){
        
        usort($this->affiliates, function($a, $b) {
            return $a['affiliate_id'] <=> $b['affiliate_id'];
        });

        return $this;
    }
        
}
