<?php

namespace App\Events;

use App\Song;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SongUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $song;
    public $filename;

    /**
     * Create a new event instance.
     *
     * @param Song $song
     * @param $filename
     */
    public function __construct(Song $song, $filename)
    {
        $this->song = $song;
        $this->filename = $filename;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
