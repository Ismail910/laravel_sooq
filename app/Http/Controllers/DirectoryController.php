<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Directory;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class DirectoryController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Directory::class);
    }

    public function index()
    {
        $this->authorize('viewAny', Directory::class);

        $individuals = Directory::where("type","1")->get();
        $companies = Directory::where("type","2")->get();
        $cities = City::all();
        return view("admin.directory.index",compact("individuals","companies","cities"));
    }

    public function create()
    {
        $this->authorize('create', Directory::class);

        $users = User::where('id', '!=', auth()->id())->get();
        return view("admin.directory.create", compact('users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Directory::class);

        $data = $request->all();
        $rules = [
            "phone" => 'required|numeric',
            "type" => 'required',
            "img" => 'nullable|image',
            "category_id" => 'nullable',
            "address" => 'nullable',
        ];

        $validation_rule = 'required';
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            if ($data[$key]['name'] && $data[$key]['description']) {
                if ($request->type == 1 || ($request->type == 2 && $data[$key]['address'])) {
                    $validation_rule = 'nullable';
                }
            }
        }

        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "$validation_rule|string|max:255";
            $rules["$key.description"] = "$validation_rule|string|max:255";
            if ($request->type == 2) $rules["$key.address"] = "$validation_rule|string|max:255";

            // Lang
            $langAttr["name"][$key] = $data[$key]['name'] ?? "";
            $langAttr["description"][$key] = $data[$key]['description'] ?? "";
            if ($request->type == 2) $langAttr["address"][$key] = $data[$key]['address'] ?? "";
        }
        Validator::validate($data,$rules);
        $image = $request->img ? $request->img->hashName() : null;
        $image ? $request->img->storeAs('/public/uploads/directory',$image): "";

        $license = $request->license ? $request->license->hashName() : "";
        $license ? $request->license->storeAs('/public/uploads/directory',$license): "";

        $directory = Directory::create([
            "name" => $langAttr["name"],
            "description" => $langAttr["description"],
            'img' => $image,
            'license'=> $license,
            'phone'=>$request->phone,
            "city_id"=>$request->City,
            "category_id"=>$request->Category ?? null,
            "type"=>$request->type,
            "active"=>$request->active ?? 0,
            "user_id"=>$request->user_id,
            "lang"=>$request->lang
        ]);
        if ($request->type == 2) $directory->update(["address" => $langAttr["address"]]);

        flash()->success('تم إضافة عنصر الدليل المجاني بنجاح', 'عملية ناجحة');
        if ($request->type == 1) {
            return redirect()->route('front.directory.individuals');
        } else {
            return redirect()->route('front.directory.companies');
        }
    }

    public function edit(Directory $directory)
    {
        $this->authorize('update', $directory);

        $users = User::all();
        $parent_category = Category::where('id', $directory->category_id)->first()?->id;
        return view("admin.directory.edit",compact("directory", "users", "parent_category"));
    }

    public function update(Request $request, Directory $directory)
    {
        $this->authorize('update', $directory);

        $data = $request->all();
        $rules = [
            "phone" => 'required|numeric',
            "type" => 'required',
            "img" => 'nullable|image',
            "category_id" => 'nullable',
            "address" => 'nullable',
        ];

        $validation_rule = 'required';
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            if ($data[$key]['name'] && $data[$key]['description']) {
                if ($request->type == 1 || ($request->type == 2 && $data[$key]['address'])) {
                    $validation_rule = 'nullable';
                    break;
                }
            }
        }

        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "$validation_rule|string|max:255";
            $rules["$key.description"] = "$validation_rule|string|max:255";
            if ($request->type == 2) $rules["$key.address"] = "$validation_rule|string|max:255";

            // Lang
            $langAttr["name"][$key] = $data[$key]['name'] ?? "";
            $langAttr["description"][$key] = $data[$key]['description'] ?? "";
            if ($request->type == 2) $langAttr["address"][$key] = $data[$key]['address'] ?? "";
        }
        Validator::validate($data,$rules);

        $image = $request->img ? $request->img->hashName() : null;
        $image ? $request->img->storeAs('/public/uploads/directory',$image): "";
        
        $license = $request->license ? $request->license->hashName() : null;
        $license ? $request->license->storeAs('/public/uploads/directory',$license): "";

        $directory->update([
            "name" => $langAttr["name"],
            "description" => $langAttr["description"],
            'img'=> $image ? $image : $directory->img,
            'license' => $license ? $license : $directory->license,
            'phone'=>$request->phone,
            "city_id" => $request->City,
            "category_id" => $request->Category,
            "type"=>$request->type,
            "active"=> $request->active ?? 0,
            "user_id" => $request->user_id,
            "lang" => $request->lang,
        ]);
        if ($request->type == 2) $directory->update(["address" => $langAttr["address"]]);
        flash()->success('تم تعديل عنصر الدليل المجاني بنجاح', 'عملية ناجحة');

        if ($request->type == 1) {
            return redirect()->route('front.directory.individuals');
        } else {
            return redirect()->route('front.directory.companies');
        }
    }

    public function destroy(Directory $directory)
    {
        $this->authorize('delete', $directory);

        $directory->delete();
        return redirect()->back();
    }

}
