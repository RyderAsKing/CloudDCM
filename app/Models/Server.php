<?php

namespace App\Models;

use App\Models\User;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Server extends Model
{
    protected $table = 'servers';

    use HasFactory;

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
