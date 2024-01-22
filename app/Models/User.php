<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\VPS;
use App\Models\Customer;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'owner_id',
        'company_name',
        'company_logo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // methods

    public function canImpersonate()
    {
        return $this->hasRole('admin');
    }

    public function canBeImpersonated(): bool
    {
        return !$this->hasRole('admin');
    }

    public function isUser()
    {
        return $this->hasRole('user');
    }

    public function isSubUser()
    {
        return $this->owner_id !== null;
    }

    // relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    public function rackSpaces()
    {
        return $this->hasMany(RackSpace::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function vpss()
    {
        return $this->hasMany(VPS::class);
    }

    public function subnets()
    {
        return $this->hasMany(Subnet::class);
    }

    public function servers()
    {
        return $this->hasMany(Server::class);
    }
}
