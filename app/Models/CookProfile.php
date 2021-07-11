<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookProfile extends Model
{
    use HasFactory;
    const PROOFPATH = 'assets/upload/cook/proof';
    const PROOFDEACTIVATE = '2';
    const PROOFACTIVATE = '1';

    protected $table = 'cook_profile';
    protected $fillable = [
        'user_id', 'proof', 'proof_status'
    ];
    
    /**
     * Get the user associated with the CookProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'foreign_key', 'local_key');
    }
}
