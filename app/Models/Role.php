<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Notifiable;

    const SUPER_ADMIN = "0";
    const USER = "5de1ff22b38edb02784e0092";
    const RELATILOR = "5de1ff22b38edb02784e0092";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role_id', 'permissions', 'status'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function admin()
    {
        return $this->hasMany('App\Admin', 'role', '_id');
    }

}
