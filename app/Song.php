<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Song extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['song_status'];

    /**
     * Get the artists associated with the song.
     */
    public function artists(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')->withPivot('type');
    }

    /**
     * Get the matches associated with the song.
     */
    public function matches()
    {
        return $this->hasMany('App\Models\Match', 'song_id');
    }

    /**
     * Get the singers associated with the song.
     */
    public function singers(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')
            ->withPivot('type')
            ->wherePivot('type', '=', '1');
    }

    /**
     * Get the musicians associated with the song.
     */
    public function musicians(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')
            ->withPivot('type')
            ->wherePivot('type', '=', '2');
    }

    /**
     * Get the writers associated with the song.
     */
    public function writers(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')
            ->withPivot('type')
            ->wherePivot('type', '=', '3');
    }

    /**
     * Get the producers associated with the song.
     */
    public function producers(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')
            ->withPivot('type')
            ->wherePivot('type', '=', '4');
    }

    /**
     * Get the user who added the song.
     */
    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    /**
     * Get the user who approved the song.
     */
    public function approvedUser(){
        return $this->belongsTo('App\Models\User', 'approved_by');
    }

    /**
     * Get the song's hash status.
     *
     * @return string
     */
    public function getSongStatusAttribute()
    {
        if ($this->hash_status == 0){
            return "Uploading to Main server failed!";
        }
        elseif ($this->hash_status == 1){
            return "Uploaded to Main server";
        }
        elseif ($this->hash_status == 2){
            return "Uploaded, but hashing failed!";
        }
        elseif ($this->hash_status == 3){
            return "Uploaded & Hashed!";
        }
        else{
            return "Unknown state!";
        }
    }

    public function fileName()
    {
        return pathinfo(public_path($this->file_path))['basename'];
    }

    public function fileSize()
    {
        return Storage::disk('public')->size("songs/{$this->fileName()}");
    }

    public function isSinger($artist_id)
    {
        return $this->singers->contains($artist_id);
    }

    public function isMusician($artist_id)
    {
        return $this->musicians->contains($artist_id);
    }

    public function isWriter($artist_id)
    {
        return $this->writers->contains($artist_id);
    }

    public function isProducer($artist_id)
    {
        return $this->producers->contains($artist_id);
    }

    public function isArtist($artist_id)
    {
        return $this->artists->contains($artist_id);
    }
}
