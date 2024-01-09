<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subnet extends Model
{
    use HasFactory;

    protected $table = 'subnets';

    protected $fillable = ['name', 'subnet', 'vlan', 'leased_company'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
