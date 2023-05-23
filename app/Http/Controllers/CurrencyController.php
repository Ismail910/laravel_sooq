<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Currency::class);
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Currency::class);

        $currencies= Currency::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);

            $q->where('name','LIKE','%'.$request->key.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.currencies.index',compact('currencies'));
    }

    public function create()
    {
        $this->authorize('create', Currency::class);

        return view('admin.currencies.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Currency::class);

        $request->validate([
            'name'=>"required|string|unique:currencies,name",
        ]);

        try {
            DB::beginTransaction();
            $currency = Currency::create([
                "name" => $request->name,
            ]);

            DB::commit();
            flash()->success('تم الاضـافة بنجاح','عملية ناجحة');
            return redirect()->route('admin.currencies.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->success($e->getMessage(),'عملية فاشلة');
            return back();
        }
    }


    public function show(Currency $currency)
    {
        $this->authorize('view', $currency);
    }

    public function edit(Currency $currency)
    {
        $this->authorize('update', $currency);

        return view('admin.currencies.edit',compact('currency'));
    }


    public function update(Request $request, Currency $currency)
    {
        $this->authorize('update', $currency);

        $request->validate([
            'name'=>"required|string|unique:currencies,name," .$currency->id,
        ]);

        try {
            DB::beginTransaction();
            $currency->update([
                "name"=>$request->name,
            ]);

            DB::commit();
            flash()->success('تم التعديل بنجاح','عملية ناجحة');
            return redirect()->route('admin.currencies.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->success($e->getMessage(),'عملية فاشلة');
            return back();
        }
    }

    public function destroy(Currency $currency)
    {
        $this->authorize('delete', $currency);

        $currency->delete();
        flash()->success('تم الحذف بنجاح');
        return redirect()->route('admin.currencies.index');
    }
}
