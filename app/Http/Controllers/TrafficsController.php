<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RateLimit;
use App\Models\ReportError;
use App\Models\RateLimitDetail;

class TrafficsController extends Controller
{
  public function __construct()
  {
    // $this->authorizeResource(RateLimit::class);
  }

  public function index(Request $request)
  {
    $this->authorize('viewAny', RateLimit::class);

    $traffics = RateLimit::where(function ($q) use ($request) {
      if ($request->id != null)
        $q->where('id', $request->id);
      if ($request->ip != null)
        $q->where('ip', $request->ip);
      if ($request->user_id != null)
        $q->where('user_id', $request->user_id);
      else
        $q->whereNull('user_id');
      if ($request->domain != null)
        $q->where('domain', 'LIKE', '%' . $request->domain . '%');
      if ($request->country_code != null)
        $q->where('country_code', $request->country_code);
    })->withCount(['details' => function ($q) {
      $q->whereNull('user_id')->where('url', 'NOT LIKE', "%manifest.json");
    }])->orderBy('id', 'DESC')->paginate(40);

    return view('admin.traffics.index', compact('traffics'));
  }

  public function logs(Request $request, RateLimit $traffic)
  {
    $this->authorize('viewAny', RateLimit::class);

    $logs = RateLimitDetail::where('rate_limit_id', $traffic->id)->whereNull('user_id')->where('url', 'NOT LIKE', "%manifest.json")->orderBy('id', 'DESC')->simplePaginate(50);
    return view('admin.traffics.logs', compact('logs'));
  }
}
