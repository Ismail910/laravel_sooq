<?php

namespace App\Http\Controllers;

use App\Models\HelpCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelpCenterController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(HelpCenter::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', HelpCenter::class);

        $videos = HelpCenter::paginate();
        return view("admin.helpCenter.index",compact("videos"));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', HelpCenter::class);

        $categories = HelpCenter::get('vid_category');
        return view('admin.helpCenter.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', HelpCenter::class);

        $data = $request->all();
        $rules = [
            "link" => 'required|regex:/youtu.be/i',
            "hidden" => "required|in:0,1"
        ];
        $messages = [
            "link.regex" => 'برجاء إدخال رابط يوتيوب صحيح'
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.title"] = "required|string|max:255";
            // Lang
            $langAttr["title"][$key] = $data[$key]['title'];
            $langAttr["subtitle"][$key] = $data[$key]['subtitle'];
        }
        Validator::validate($data,$rules,$messages);

        HelpCenter::create([
            "vid_category"=>$request->vid_category,
            'link'=>$request->link,
            "title"=>json_encode($langAttr["title"]),
            "subtitle"=>json_encode($langAttr["subtitle"]),
            "hidden"=>$request->hidden,
        ]);
        
        flash()->success('تم إضافة عنصر مركز المساعدة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.help-center.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function show(HelpCenter $helpCenter)
    {
        $this->authorize('view', $helpCenter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(HelpCenter $helpCenter)
    {
        $this->authorize('update', $helpCenter);

        $categories = $helpCenter->get('vid_category');
        return view('admin.helpCenter.edit',compact("helpCenter","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HelpCenter $helpCenter)
    {
        $this->authorize('update', $helpCenter);

        $data = $request->all();
        $rules = [
            "link" => 'required|regex:/youtu.be/i',
            "hidden" => "required|in:0,1"
        ];
        $messages = [
            "link.regex" => 'برجاء إدخال رابط يوتيوب صحيح'
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.title"] = "required|string|max:255";
            // Lang
            $langAttr["title"][$key] = $data[$key]['title'];
            $langAttr["subtitle"][$key] = $data[$key]['subtitle'];
        }
        Validator::validate($data,$rules,$messages);
        
        HelpCenter::where("id",$helpCenter->id)->update([
            "vid_category"=>$request->vid_category,
            "title"=>json_encode($langAttr["title"]),
            "link" => $request->link,
            "subtitle"=>json_encode($langAttr["subtitle"]),
            "hidden"=>$request->hidden,
        ]);
        
        flash()->success('تم تعديل عنصر مركز المساعدة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.help-center.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(HelpCenter $helpCenter)
    {
        $this->authorize('delete', $helpCenter);

        HelpCenter::where("id",$helpCenter->id)->delete();
        flash()->success('تم حذف عنصر مركز المساعدة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.help-center.index');
    }
}
