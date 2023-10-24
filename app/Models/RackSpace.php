<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'rack_id',
        'unit_number',
        'name',
        'description',
        'client_email', // this is the email of the client who is renting the rack space
    ];
}
