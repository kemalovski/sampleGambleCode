<?php

namespace App\Services;

use File;

class AffiliateService
{

    private string $affiliate_file_path;
    public array $affiliates;

    public function __construct(){
        $this->affiliate_file_path = storage_path() . "/json/affiliates.txt";
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

    public function sort_ascending_affiliates_by_id(){
        
        usort($this->affiliates, function($a, $b) {
            return $a['affiliate_id'] <=> $b['affiliate_id'];
        });

        foreach ($this->affiliates as $key => $value) {
            echo json_encode($value)."<br>";
        }
        return $this;
    }
        
}
