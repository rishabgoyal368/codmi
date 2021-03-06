<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    const PROFILEPATH = 'assets/upload/users/';

    protected $fillable = [
        'name', 'email', 'password', 'profile_pic', 'role'
    ];

    public function getProfileImage()
    {
        $image = $this->profile_pic;
        if ($image) {
            return env('APP_URL') . Admin::PROFILEPATH . $image;
        } else {
            return env('APP_URL') . 'assets/images/faces/face1.jpg';
        }
    }

    public function getRole()
    {
        if ($this->role == '1') {
            return 'User';
        } else if ($this->role == '2') {
            return 'Retail';
        }
    }
}
