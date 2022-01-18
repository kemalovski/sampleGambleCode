<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AffiliateService;


class AffiliatesController extends Controller
{
    public function index(){
        $affiliates = (new AffiliateService())->getAffiliates();
        
    }
}
