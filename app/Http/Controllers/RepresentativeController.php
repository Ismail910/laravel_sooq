<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RepresentativeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->authorizeResource(Representative::class);
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Representative::class);

        $representatives =  Representative::where(function ($query) use ($request) {
            if ($request->country_filter) $query->where('country_id', $request->country_filter);
            if ($request->filter) $query->where('name', 'LIKE', '%' . $request->filter . '%')->orWhere('phone', 'LIKE', '%' . $request->filter . '%')->orWhere('description', 'LIKE', '%' . $request->filter . '%');
        })->orderBy('id', 'DESC')->paginate(30);

        $country_filter = $request->country_filter;
        $filter = $request->filter;
        $countries = Country::all();
        return view('admin.representatives.index', compact('representatives', 'countries', 'country_filter', 'filter'));
    }

    public function show(Representative $representative)
    {
        $this->authorize('view', $representative);
        return view('admin.representatives.show', compact('representative'));
    }

    public function create()
    {
        $this->authorize('create', Representative::class);

        $countries = Country::all();
        return view('admin.representatives.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Representative::class);

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|max:30',
                'country_id' => 'required|exists:countries,id',
                'description' => 'required|string',
                'photo' => 'required|image|max:5120',
            ]);

            DB::beginTransaction();

            $representative = Representative::create([
                'name' => $request->name,
                'phone' => ltrim($request->phone, "+ 0"),
                'country_id' => $request->country_id,
                'description' => $request->description,
            ]);

            if ($request->hasFile('photo')) {
                $fileName = $this->store_file([
                    'source' => $request->photo,
                    'validation' => "image",
                    'path_to_save' => '/uploads/representatives/',
                    'type' => 'AVATAR',
                    'user_id' => Auth::id(),
                    'resize' => [500, 3000],
                    'small_path' => 'small/',
                    'visibility' => 'PUBLIC',
                    'file_system_type' => env('FILESYSTEM_DRIVER'),
                    'watermark' => true,
                    'compress' => 'auto',
                ])['filename'];
                $this->use_hub_file($fileName, 10, $representative->id);
                $representative->update([
                    'photo' => $fileName
                ]);
            }
            DB::commit();

            flash()->success('تم إنشاء المندوب بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.representatives.show', $representative->id);
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return redirect()->back();
        }
    }

    public function edit(Representative $representative)
    {
        $this->authorize('update', $representative);

        try {
            $countries = Country::all();

            return view('admin.representatives.edit', compact('representative', 'countries'));
        } catch (\Exception $e) {
            flash($e->getMessage(), 'عملية فاشلة');
            return redirect()->back();
        }
    }

    public function update(Request $request, Representative $representative)
    {
        $this->authorize('update', $representative);

        try {
            DB::beginTransaction();

            $request->validate([
                'id' => 'required',
                'name' => 'required|string|max:255',
                'phone' => 'required|max:30',
                'country_id' => 'required|exists:countries,id',
                'description' => 'required|string',
                'photo' => 'nullable|image|max:5120',
            ]);

            if ($request->hasFile('photo')) {
                $fileName = $this->store_file([
                    'source' => $request->photo,
                    'validation' => "image",
                    'path_to_save' => '/uploads/representatives/',
                    'type' => 'AVATAR',
                    'user_id' => Auth::id(),
                    'resize' => [500, 3000],
                    'small_path' => 'small/',
                    'visibility' => 'PUBLIC',
                    'file_system_type' => env('FILESYSTEM_DRIVER'),
                    'watermark' => true,
                    'compress' => 'auto',
                ])['filename'];
                $this->use_hub_file($fileName, 10, $representative->id);
                $representative->update([
                    'photo' => $fileName
                ]);
            }

            $representative->update([
                'name' => $request->name,
                'phone' => ltrim($request->phone, "+ 0"),
                'country_id' => $request->country_id,
                'description' => $request->description,
            ]);

            DB::commit();

            flash()->success('تم تعديل المندوب بنجاح', 'عملية ناجحة');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return redirect()->back();
        }
    }

    public function destroy(Representative $representative)
    {
        $this->authorize('delete', $representative);

        try {
            $representative->delete();

            flash()->success('تم حذف المندوب بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.representatives.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return redirect()->back();
        }
    }
}
