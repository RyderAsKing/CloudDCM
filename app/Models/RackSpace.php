<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'rack_id',
        'user_id',
        'unit_number',
        'name',
        'description',
        'client_email', // this is the email of the client who is renting the rack space
        'client_id', // this is the id of the client who is renting the rack space
        'hardware_type',
        'switch_port',
        'ipmi_port',
        'subnet',
    ];

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
