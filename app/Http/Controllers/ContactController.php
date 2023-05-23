<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(Contact::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Contact::class);

        $filter = $request->filter;
        if ($filter) {
            $contacts =  Contact::where(function ($q) use ($filter) {
                if (User::where('name', 'LIKE', '%' . $filter . '%')->count()) {
                    $user_id = User::where('name', 'LIKE', '%' . $filter . '%')->first()->id;
                    $q->where('user_id', $user_id);
                } else if ($filter == 'استفسار') {
                    $q->where('type', 'inquiry');
                } else if ($filter == 'زيارة' || $filter == 'زيارة مندوب') {
                    $q->where('type', 'representative_visit');
                } else {
                    $q->where('id', $filter)
                        ->orWhere('name', 'LIKE', '%' . $filter . '%')
                        ->orWhere('phone', 'LIKE', '%' . $filter . '%')
                        ->orWhere('email', 'LIKE', '%' . $filter . '%')
                        ->orWhere('message', 'LIKE', '%' . $filter . '%');
                }
            });
        } else {
            $contacts = Contact::where('id', '>', 0);
        }

        $contacts = $contacts->orderBy('id', 'DESC')->paginate();

        return view('admin.contacts.index', compact('contacts', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Contact::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Contact::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return view('admin.contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();
        flash()->success('تم حذف طلب التواصل بنجاح','عملية ناجحة');
        return redirect()->route('admin.contacts.index');
    }

    public function resolve(Request $request)
    {
        $this->authorize('resolve', Contact::find($request->id));

        $contact = \App\Models\Contact::where('id',$request->id)->firstOrFail();
        $contact->update(['status'=>$contact->status=="PENDING"?"DONE":"PENDING"]);
        return ['status'=>$contact->status=="DONE"?"DONE":"PENDING" ];
    }
}
