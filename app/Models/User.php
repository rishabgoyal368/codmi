<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    const PENDINGSTATUS = 'pending';
    const ACTIVESTATUS = 'active';
    const USERTYPE = '1';
    const COOKTYPE = '2';

    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_pic',
        'mobile_number',
        'status',
        'type',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function addEdit($data)
    {
        return User::updateOrcreate(
            [
                'id' => @$data['id']
            ],
            [
                'name' => @$data['name'],
                'email' => @$data['email'],
                'password' => @$data['password'],
                'profile_pic' => @$data['profile_pic'],
                'mobile_number' => @$data['mobile_number'],
                'status' => @$data['status'],
                'type' => @$data['type'],
            ]
        );
    }
}
