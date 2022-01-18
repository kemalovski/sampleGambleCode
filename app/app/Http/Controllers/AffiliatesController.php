<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AffiliateService;
use App\Constant\Constant;


class AffiliatesController extends Controller
{
    public function index(){
        
        $affiliateService = new AffiliateService();
        $affiliates = $affiliateService
            ->getAffiliates()
            ->getwithin100KmAffiliates(Constant::DISTANCE_FROM_DUBLIN_OFFICE)
            ->sort_ascending_affiliates_by_id();

        return view('affiliates', [ 'affiliates' => $affiliates->within100KmAffiliates ]);

    }
}
