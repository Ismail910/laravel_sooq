<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Category;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Table::class);
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Table::class);

        $tables =  Table::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%')->orWhere('description','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.tables.index',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Table::class);

        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Table::class);

        $request->validate([
            'name'=>"required|max:190",
        ]);

        $lastTable = Table::latest()->get();
        // dd($lastTable);
        for ($table_number=1; $table_number <= $request->table_number ; $table_number++) {
            $table = Table::create([
                "name"=> $request->name . ' ' . ($lastTable->count() ? $lastTable->count() + $table_number : $table_number),
                "status"=>$request->status ?? 0,
            ]);
        }

        flash()->success('تم إضافة الاماكن بنجاح','عملية ناجحة');
        return redirect()->route('admin.tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        $this->authorize('view', $table);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        $this->authorize('update', $table);

        $categories= Category::orderBy('id','DESC')->get();
        return view('admin.tables.edit',compact('table','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, table $table)
    {
        $this->authorize('update', $table);

        $request->validate([
            'name'=>"required|max:190|unique:tables,name,".$table->id,
        ]);
        $table->update([
            "name" =>$request->name,
            "status" =>$request->status,
        ]);

        flash()->success('تم تحديث الاماكن بنجاح','عملية ناجحة');
        return redirect()->route('admin.tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $this->authorize('delete', $table);

        $table->delete();
        flash()->success('تم حذف الاماكن بنجاح','عملية ناجحة');
        return redirect()->route('admin.tables.index');
    }
}
