<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'phone',
        'email',
        'contact_name',
        'address',
        'city',
        'sales_person',
        'num_desktops',
        'num_notebooks',
        'num_printers',
        'num_servers',
        'num_firewalls',
        'num_wifi_access_points',
        'num_switches',
        'quote_provided',
    ];
}
