<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable implements JWTSubject
    {
    use HasFactory, Notifiable, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'profile_pic',
        'isk_number',
        'vrb_number',
        'email',
        'password',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
        {
        return $this->getKey();
        }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
        {
        return [];
        }

 
    public function UploaderOrganization(){
      return $this->belongsToMany(Organization::class,"organization_users","user_id","organization_id")->withPivot("status");
    }
    public function AccessorOrganization(){
        return $this->belongsToMany(ReportConsumer::class,"report_consumer_users","user_id","report_consumer_id")->withPivot("status");
    }

    }