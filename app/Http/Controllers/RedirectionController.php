<?php

namespace App\Http\Controllers;

use App\Models\Redirection;
use Illuminate\Http\Request;

class RedirectionController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Redirection::class); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Redirection::class);

        $redirections =  Redirection::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('url','LIKE','%'.$request->q.'%')->orWhere('new_url','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();
        return view('admin.redirections.index',compact('redirections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Redirection::class);

        return view('admin.redirections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Redirection::class);

        $request->validate([
            'url'=>"required|url",
            'new_url'=>"required|url",
            'code'=>"required|numeric|in:301,302",
        ]);
        Redirection::create([
            'user_id'=>auth()->user()->id,
            'url'=>$request->url,
            'new_url'=>$request->new_url,
            'code'=>$request->code,
        ]);
        flash()->success('تم إضافة التحويل بنجاح','عملية ناجحة');
        return redirect()->route('admin.redirections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function show(Redirection $redirection)
    {
        $this->authorize('view', $redirection);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function edit(Redirection $redirection)
    {
        $this->authorize('update', $redirection);

        return view('admin.redirections.edit',compact('redirection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redirection $redirection)
    {
        $this->authorize('update', $redirection);

        $request->validate([
            'url'=>"required|url",
            'new_url'=>"required|url",
            'code'=>"required|numeric|in:301,302",
        ]);
        $redirection->update([
            'url'=>$request->url,
            'new_url'=>$request->new_url,
            'code'=>$request->code,
        ]);
        flash()->success('تم تحديث التحويل بنجاح','عملية ناجحة');
        return redirect()->route('admin.redirections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redirection  $redirection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redirection $redirection)
    {
        $this->authorize('delete', $redirection);

        $redirection->delete();
        flash()->success('تم حذف التحويل بنجاح','عملية ناجحة');
        return redirect()->route('admin.redirections.index');
    }
}
