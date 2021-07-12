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
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getCookStatus()
    {
        if ($this->proof_status == CookProfile::PROOFACTIVATE) {
            return '<label class="badge badge-success">Activate</label>';
        } else if ($this->proof_status == CookProfile::PROOFDEACTIVATE) {
            return '<label class="badge badge-danger">Deactivate</label>';
        }
    }

    public function getProofAttribute($value)
    {
        return env('APP_URL').CookProfile::PROOFPATH.'/'.$value;
    }
}
