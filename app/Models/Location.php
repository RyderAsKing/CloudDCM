<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description', 'for'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    public function vpss()
    {
        return $this->hasMany(Vps::class);
    }
}
