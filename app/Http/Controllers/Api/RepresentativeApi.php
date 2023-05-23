<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\{Country, Representative};

class RepresentativeApi extends Controller
{
    use GeneralTrait;

    public function get_all_representatives()
    {
        $representatives = Representative::all();
        return $this->returnData("representatives", $representatives, "All representatives");
    }

    public function get_country_representatives($country_id = 0)
    {
        if (!$country_id || !(Country::where('id', $country_id)->count())) {
            return $this->returnError('404', 'Country not found');
        }

        $representatives = Representative::where('country_id', $country_id)->get();
        return $this->returnData("representatives", $representatives, "All country representatives");
    }
}
