<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Directory;

class FrontDirectoryController extends Controller
{
    public function companiesIndex(){
        $companies = Directory::where("type",2)->orderBy('created_at', 'DESC')->get();
        return view("front.directory.Companiesindex",compact("companies"));
    }
    
    public function individualsIndex(){
        $individuals = Directory::where("type",1)->orderBy('created_at', 'DESC')->get();
        return view("front.directory.Individualsindex",compact("individuals"));
    }

    public function companiesCreate(){
        return view("front.directory.CompaniesCreate");
    }
    
    public function individualsCreate(){
        return view("front.directory.IndividualsCreate");
    }

    public function show($id){
        $provider = Directory::findOrFail($id);
        $type = $provider->type == 1 ? "individual" : "company";
        return view("front.directory.show",compact("provider","type"));
    }

    public function edit($id){
        $directory = Directory::findOrFail($id);

        if($directory->type == 1){
            return view("front.directory.IndividualsEdit",compact("directory"));
        }else{
            return view("front.directory.CompaniesEdit",compact("directory"));
        }
    }
}
