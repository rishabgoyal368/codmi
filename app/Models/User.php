<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements JWTSubject
{
    const PENDINGSTATUS = '2';
    const ACTIVESTATUS = '1';
    const USERTYPE = '1';
    const COOKTYPE = '2';
    const PROFILE_PIC = 'assets/upload/users/';

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
        'login_type',
        // 'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'email_verified_at', 'deleted_at', 'created_at', 'updated_at'
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
                'login_type' => $data['login_type']
            ]
        );
    }

    public function getProfileImage()
    {
        $image = $this->profile_pic;
        if ($image) {
            return env('APP_URL') . User::PROFILE_PIC . $image;
        } else {
            return env('APP_URL') . 'assets/images/faces-clipart/pic-1.png';
        }
    }

    public function getUserType()
    {
        $user_type = $this->type;
        switch ($user_type) {
            case User::COOKTYPE:
                return array('badge badge-info', 'Cook');
                break;

            case User::USERTYPE:
                return array('badge badge-warning', 'User');
                break;

            default:
                return array('badge badge-default', '--');
                break;
        }
    }

    public function getStatus()
    {
        $status = $this->status;
        switch ($status) {
            case User::ACTIVESTATUS:
                return array('badge badge-success', 'Active');
                break;

            case User::PENDINGSTATUS:
                return array('badge badge-danger', 'pending');
                break;

            default:
                return array('badge badge-default', '--');
                break;
        }
    }

    public function getLoginType()
    {
        $login_type = $this->login_type;
        switch ($login_type) {
            case 'email':
                return array('badge badge-success', 'Email');
                break;

            case 'facebook':
                return array('badge badge-info', 'Facebook');
                break;

            case 'google':
                return array('badge badge-danger', 'Google');
                break;

            default:
                return array('badge badge-default', '--');
                break;
        }
    }
}
