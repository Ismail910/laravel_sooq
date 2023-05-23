<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['about_page', 'privacy_page'];
    protected $guarded = ['id','created_at','updated_at'];

    public function website_logo(){
        if($this->website_logo==null)
            return env('DEFAULT_IMAGE_LOGO');
        else
            return asset(env('STORAGE_URL')."/uploads/website/".$this->website_logo);
    }
    public function website_cover(){
        if($this->website_cover==null)
            return env('DEFAULT_IMAGE_COVER');
        else
            return env('STORAGE_URL').'/uploads/website/'.$this->website_cover;
    }
    public function website_watermark(){
        if($this->website_watermark==null)
            return env('DEFAULT_IMAGE_COVER');
        else
            return env('STORAGE_URL').'/uploads/website/'.$this->website_watermark;
    }
    public function website_wide_logo(){
        if($this->website_wide_logo==null)
            return env('DEFAULT_IMAGE_COVER');
        else
            return env('STORAGE_URL').'/uploads/website/'.$this->website_wide_logo;
    }
    public function website_icon(){
        if($this->website_icon==null)
            return env('DEFAULT_IMAGE_FAVICON');
        else
            return env('STORAGE_URL').'/uploads/website/'.$this->website_icon;
    }
    public function main_color(){
        if($this->main_color==null)
            return "#821b10";
        else
            return $this->main_color;
    }
    public function hover_color(){
        if($this->hover_color==null)
            return "#821b10";
        else
            return $this->hover_color;
    }
    public function phone(){
        if($this->phone==null)
            return "";
        else
            return $this->phone;
    }
}
