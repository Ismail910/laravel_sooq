<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
class FaqController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Faq::class); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Faq::class);

        $faqs = Faq::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('question','LIKE','%'.$request->q.'%')->orWhere('answer','LIKE','%'.$request->q.'%');
        })->orderBy('order','ASC')->orderBy('id','DESC')->paginate(100);
        return view('admin.faqs.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Faq::class);

        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Faq::class);

        Faq::create([
            'user_id'=>auth()->user()->id,
            'question'=>$request->question,
            'answer'=>$request->answer,
            'is_featured'=>$request->is_featured, 
        ]);
        flash()->success('تمت العملية بنجاح','عملية ناجحة');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        $this->authorize('view', $faq);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $this->authorize('update', $faq);

        return view('admin.faqs.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $this->authorize('update', $faq);

        $faq->update([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'is_featured'=>$request->is_featured, 
        ]);
        flash()->success('تمت العملية بنجاح','عملية ناجحة');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->authorize('delete', $faq);

        $faq->delete();
        flash()->success('تمت العملية بنجاح','عملية ناجحة');
        return redirect()->route('admin.faqs.index');
    }

    public function order(Request $request)
    {
        foreach($request->order as $key => $value){
            Faq::where('id',$value)->update(['order'=>$key]);
        }
    }

}
