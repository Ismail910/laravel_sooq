<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Voucher::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Voucher::class);

        $vouchers = Voucher::all();
        return view("admin.voucher.index",compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Voucher::class);

        $users = User::all();
        return view("admin.voucher.create",compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Voucher::class);

        $data = $request->all();
        $rules = [
            "code" => 'required',
            "amount" => 'required|numeric|between:1,100',
            "special_user" => 'required',
            "include_shipping" => 'required|boolean',
            "starts_from" => 'required|date',
            "ends_at" => 'required|date',
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
        }
        Validator::validate($data,$rules);
        Voucher::create([
            "code"=>$request->code,
            "name" => json_encode($langAttr["name"]),
            'amount'=>$request->amount,
            "special_user" => $request->special_user == 0 ? 0 : implode(",",$request->users),
            "include_shipping"=>$request->include_shipping,
            "starts_from"=>$request->starts_from,
            "ends_at"=>$request->ends_at,
        ]);
        
        flash()->success('تم إضافة قسيمة الشراء بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.voucher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        $this->authorize('view', $voucher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        $this->authorize('update', $voucher);

        $users = User::all();
        return view("admin.voucher.edit",compact('voucher',"users"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        $this->authorize('update', $voucher);

        $data = $request->all();
        $rules = [
            "code" => 'required',
            "amount" => 'required|numeric|between:1,100',
            "special_user" => 'required',
            "include_shipping" => 'required|boolean',
            "starts_from" => 'required|date',
            "ends_at" => 'required|date',
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
        }
        Validator::validate($data,$rules);
        $voucher->update([
            "code"=>$request->code,
            "name" => json_encode($langAttr["name"]),
            'amount'=>$request->amount,
            "special_user" => $request->special_user == 0 ? 0 : ($request->users ? implode(",",$request->users) : 0),
            "include_shipping"=>$request->include_shipping,
            "starts_from"=>$request->starts_from,
            "ends_at"=>$request->ends_at,
        ]);
        
        flash()->success('تم تعديل قسيمة الشراء بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {     
        $this->authorize('delete', $voucher);

        $voucher->delete();
        flash()->success('تم حذف قسيمة الشراء', 'عملية ناجحة');
        return redirect(route('admin.voucher.index'));
    }
}
