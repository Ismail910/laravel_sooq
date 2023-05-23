<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Representative;
use Illuminate\Http\Request;

class FrontRepresentativeController extends Controller
{
    public function index(Request $request)
    {
        $representatives =  Representative::where(function ($query) use ($request) {
            if ($request->country_filter) $query->where('country_id', $request->country_filter);
        })->orderBy('id', 'DESC')->paginate(1);

        $country_filter = $request->country_filter;
        $num_of_representatives = Representative::count();
        $countries = Country::all();
        return view('front.representatives.index', compact('representatives', 'countries', 'country_filter', 'num_of_representatives'));
    }


    /**
     * Get more representatives from database
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMoreRepresentatives(Request $request)
    {
        $representatives = Representative::where(function ($query) use ($request) {
            if ($request->country_filter) $query->where('country_id', $request->country_filter);
        })->where('id', '<', $request->last_id)->orderBy('created_at', 'desc')->take(10)->get();

        foreach ($representatives as &$representative) {
            $representative->country_name = $representative->country?->name;
            $representative->country_phone_code = $representative->country?->phone_code;
            $representative->photoUrl = $representative->photoUrl();
        }

        return response()->json([
            'representatives' => $representatives
        ]);
    }
}
