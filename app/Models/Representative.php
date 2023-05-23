<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;
    protected $table = 'representatives';

    protected $guarded = ['id','created_at','updated_at'];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function photoUrl()
    {
        if ($this->photo==null) {
            return env('DEFAULT_IMAGE');
        } else {
            return env("STORAGE_URL")."/uploads/representatives/".$this->photo;
        }
    }
}
