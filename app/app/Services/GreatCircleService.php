<?php

namespace App\Services;

Class GreatCircleService {

    const M = 6371009;
    const KM = 6371.009;
    const MI = 3958.761;
    const NM = 3440.070;
    const YD = 6967420;
    const FT = 20902260;
    
    private function validateRadius($unit) {
        if ( defined('self::'.$unit) ) { return constant('self::'.$unit); }
        else if ( is_numeric($unit) ) { return $unit; }
        else { throw new Exception('Invalid unit or radius: '.$unit); }
    }

    // Takes two sets of geographic coordinates in decimal degrees and produces distance along the great circle line.
    // Optionally takes a fifth argument with one of the predefined units of measurements, or planet radius in custom units.
    public static function distance($lat1, $lon1, $lat2, $lon2, $unit = self::KM) {
        $r = self::validateRadius($unit);
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
        $lonDelta = $lon2 - $lon1;
        $a = pow(cos($lat2) * sin($lonDelta) , 2) + pow(cos($lat1) * sin($lat2) - sin($lat1) * cos($lat2) * cos($lonDelta) , 2);
        $b = sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lonDelta);
        $angle = atan2(sqrt($a) , $b);

        return $angle * $r;
    }

}
?>
