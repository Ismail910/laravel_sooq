<?php

namespace App\Http\Controllers;

use App\Models\ContactReply;
use Illuminate\Http\Request;

class ContactReplyController extends Controller
{
    protected function resourceAbilityMap()
    {
        return [
            'index'=>'viewAny',
            'create'=>'store',
            'store'=>'store',
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
            'resolve'=>'resolve',
        ];
    }
    protected function resourceMethodsWithoutModels()
    {
        return ['index', 'create', 'store' , 'resolve'];
    }

    public function __construct()
    {
        // $this->authorizeResource(ContactReply::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', ContactReply::class);

        $request->validate(['contact_id'=>"required|exists:contacts,id"]);
        $contact= \App\Models\Contact::where('id',$request->id)->with(['replies'])->firstOrFail();
        return view('admin.contacts.replies.index',compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', ContactReply::class);

        $request->validate(['contact_id'=>"required|exists:contacts,id"]);
        $contact= \App\Models\Contact::where('id',$request->id)->with(['replies'])->firstOrFail();
        return view('admin.contacts.replies.create',compact('contact'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', ContactReply::class);

        $contact= \App\Models\Contact::where('id',$request->contact_id)->firstOrFail();
        $contact->update(['has_support_reply'=>1]);

        ContactReply::create(['user_id'=>auth()->user()->id,'contact_id'=>$request->contact_id,'content'=>$request->content,'is_support_reply'=>1]);
        flash()->success('تمت العملية بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactReply  $contactReply
     * @return \Illuminate\Http\Response
     */
    public function show(ContactReply $contactReply)
    {
        $this->authorize('view', $contactReply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactReply  $contactReply
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactReply $contactReply)
    {
        $this->authorize('update', $contactReply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactReply  $contactReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactReply $contactReply)
    {
        $this->authorize('update', $contactReply);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactReply  $contactReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactReply $contactReply)
    {
        $this->authorize('delete', $contactReply);
    }

    public function resolve(Request $request)
    {
        $this->authorize('resolve', ContactReply::find($request->id));

        $contact = \App\Models\Contact::where('contact_id',$request->contact_id)->firstOrFail();
        $contact->update(['status'=>$contact->status=="PENDING"?"DONE":"PENDING"]);
        return 1;
    }
}
