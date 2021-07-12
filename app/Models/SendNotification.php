<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendNotification extends Model
{
    use HasFactory;
    protected $table = 'device_token';
    protected $fillable = [
        'user_id', 'is_seen', 'body', 'title', 'notification_type',
    ];
}
