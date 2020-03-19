<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the artists associated with the user.
     */
    public function artists(){
        return $this->hasMany('App\Models\Artist');
    }

    /**
     * Get the channels of which the user is the contact person.
     */
    public function channelContacts(){
        return $this->hasMany('App\Models\Channel', 'contact_user');
    }

    /**
     * Get the channels added by the user.
     */
    public function channelAdds(){
        return $this->hasMany('App\Models\Channel', 'added_by');
    }

    /**
     * Get the user who added the user.
     */
    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function isArtist()
    {
        return count($this->artists) > 0;
    }

    public function isAdmin()
    {
        return $this->role < 3;
    }

    public function isTechnicalAdmin()
    {
        return $this->role < 2;
    }

    public function getRole()
    {
        // 1 - technical_admin 2 - admin, 3 - artist, 4 - client
        $roles = [
            1 => "Technical Admin",
            2 => "Admin",
            3 => "Artist",
            4 => "Client",
            5 => "Other"
        ];
        return $roles[$this->role];
    }
}
