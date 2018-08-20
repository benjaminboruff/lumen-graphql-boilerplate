<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];
    // public function getPhotoUrlAttribute($value)
    // {
    //     return empty($value)
    //         ? 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=mm'
    //         : url($value);
    // }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    // public function setPasswordAttribute($value)
    // {
    //     if ($value) {
    //         $this->attributes['password'] = app('hash')->make($value);
    //     }
    // }
}