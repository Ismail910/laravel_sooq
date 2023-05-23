<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HelpCenter;

class FrontHelpCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = HelpCenter::where("hidden",1)->paginate(); // 
        return view("front.helpCenter.index",compact("videos"));
    }
}
