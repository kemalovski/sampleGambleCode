<?php

namespace App\Services;

use File;

class AffiliateService
{

    private string $affiliate_file_path;

    public function __construct(){
        $this->affiliate_file_path = storage_path() . "/json/affiliates.txt";
    }

    public function getAffiliates(): array
    {
        $affiliates = File::get($this->affiliate_file_path);

        return explode("\n", $affiliates);
    }
        
}
