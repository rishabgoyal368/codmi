<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'profile_pic'
    ];

    public function getProfileImage()
    {
        $image = $this->profile_pic;
        if ($image) {
            return env('APP_URL') . 'assets/images/faces/face1.jpg';
        } else {
            return env('APP_URL') . 'assets/images/faces/face1.jpg';
        }
    }
}
