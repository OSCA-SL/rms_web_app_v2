<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the channel associated with the match.
     */
    public function channel()
    {
        return $this->belongsTo('App\Models\Channel', 'channel_id');
    }

    /**
     * Get the song associated with the match.
     */
    public function song()
    {
        return $this->belongsTo('App\Models\Song', 'song_id');
    }
}
