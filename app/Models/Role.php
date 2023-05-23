<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['name'];

    public function hasPermission($permission_id)
    {
        return PermissionRole::where([
            ['role_id', '=', $this->id],
            ['permission_id', '=', $permission_id],
        ])->count();
    }
}
