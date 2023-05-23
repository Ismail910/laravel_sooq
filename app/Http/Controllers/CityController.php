<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(City::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', City::class);

        $cities =  City::where('country_id', $request->country_id)->where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('name', 'LIKE', '%'.$request->q.'%');
            }
        })->orderBy('id', 'DESC')->paginate();

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', City::class);

        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', City::class);

        $data = $request->all();
        $rules = [
            'country_id'=>"required",
            'status'=>"required|in:0,1",
        ];

        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
        }
        $request->validate($rules);

        $city = City::create([
            "name"=>$langAttr["name"],
            "status"=>$request->status,
            "country_id" => $request->country_id,
        ]);

        flash()->success('تم إضافة المدينة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.cities.index', ['country_id' => $request->country_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, City $city)
    {
        $this->authorize('view', $city);

        $cities =  City::where('country_id')->where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('name', 'LIKE', '%'.$request->q.'%');
            }
        })->orderBy('id', 'DESC')->paginate();

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $this->authorize('update', $city);

        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->authorize('update', $city);

        $data = $request->all();
        $rules = [
            'country_id'=>"required",
            'status'=>"required|in:0,1",
        ];

        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
        }
        $request->validate($rules);

        $city->update([
            "name"=>$langAttr["name"],
            "status"=>$request->status,
            "country_id"=>$request->country_id,
        ]);

        flash()->success('تم تحديث المدينة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.cities.index', ['country_id' => $request->country_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $this->authorize('delete', $city);

        try {
            $city->states()->delete();
            $city->delete();
            flash()->success('تم حذف المدينة بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.cities.index');
        } catch (\Exception $ex) {
            flash()->error($ex->getMessage(), 'عملية فاشلة');
            return redirect()->route('admin.cities.index');
        }
    }
}
