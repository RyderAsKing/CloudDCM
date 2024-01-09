<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VPS extends Model
{
    use HasFactory;
    protected $table = 'vps';

    protected $fillable = [
        'hostname',
        'ip_address',
        'username',
        'password',
        'cpu',
        'memory',
        'storage',
        'os',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
