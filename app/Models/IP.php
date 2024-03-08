<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    use HasFactory;

    protected $fillable = ['subnet_id', 'ip', 'status'];

    public function subnet()
    {
        return $this->belongsTo(Subnet::class);
    }
}
