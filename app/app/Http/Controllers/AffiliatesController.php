<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AffiliateService;


class AffiliatesController extends Controller
{
    public function index(){
        $affiliateService = new AffiliateService();
        $affiliates = $affiliateService->getAffiliates()->sort_ascending_affiliates_by_id();

        return json_encode($affiliates);

    }
}
