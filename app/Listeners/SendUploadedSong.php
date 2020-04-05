<?php

namespace App\Listeners;

use App\Events\SongUploaded;
use App\Fingerprint;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class SendUploadedSong implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SongUploaded $event
     * @return void
     */
    public function handle(SongUploaded $event)
    {
        $song = $event->song;
        $filename = $event->filename;

        try{
            $local_file  = Storage::disk('public')->get("/songs/{$filename}");

            Storage::disk('ftp')->put($filename, $local_file);
            $remote_file_exists = Storage::disk('ftp')->exists($filename);

            if ($remote_file_exists === true){
                $song->remote_file_path = "http://song-hash.osca.lk/storage/songs/".$filename;
                $song->hash_status = 1;
                $song->save();

                $system_url = config('app.radio_server');
                $client = new Client();
                $response = $client->request('POST', $system_url, [
                    'multipart' => [
                        [
                            'name' => 'username',
                            'contents' => config('app.radio_username'),
                        ],
                        [
                            'name' => 'password',
                            'contents' => config('app.radio_password'),
                        ],
                        [
                            'name' => 'id',
                            'contents' => $song->id,
                        ],
                        [
                            'name' => 'file_name',
                            'contents' => $filename,
                        ],
                        [
                            'name' => 'ftp',
                            'contents' => true,
                        ],
                    ]
                ]);

                $response_status = $response->getStatusCode();
                $song->refresh();
                $fp_count = Fingerprint::where('song_id', $song->id)->count();
                if ($response_status >=200 && $response_status <300){
                    if($fp_count > 0 ){
                        $song->hash_status = 3;
                        Log::channel('song_uploads')
                            ->info('song ID:'.$song->id.' - successfully hashed.');
                    }
                    else{
                        $song->hash_status = 2;
                        Log::channel('song_uploads')
                            ->error('song ID:'.$song->id.' - request successful but not hashed.');
                    }
                }
                else{
                    $song->hash_status = 2;
                    Log::channel('song_uploads')
                        ->error('song ID:'.$song->id.' - request not successful. Response : '.$response->getBody()->getContents());
                }
                $song->save();
            }
            else{
                $song->hash_status = 0;
                $song->save();
                Log::channel('song_uploads')
                    ->error('song ID:'.$song->id.' - file not found in the remote server.');
            }
            $song->save();
        }
        catch (FileNotFoundException $e){
            Log::channel('song_uploads')
                ->error('song ID:'.$song->id.' - file not found in the cloud server.');
        }
        catch (RequestException $e){
            $song->refresh();
            if ($song->hash_status > 2){
                $song->hash_status = 2;
                $song->save();
            }
            Log::channel('song_uploads')
                ->error('song ID:'.$song->id.' - request error: '.$e->getResponse());
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\SongUploaded  $event
     * @param  \Exception  $exception
     * @return void
     */

    public function failed(SongUploaded $event, $exception)
    {
        $song = $event->song;
        Log::channel('song_uploads')
            ->error('song ID:'.$song->id.' - SendUploadedSong Event exception : '.$exception->getMessage());
    }
}
