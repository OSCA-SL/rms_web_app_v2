@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form id="create-song-form" action="{{ route('songs.store') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <strong>Add New Song</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card border-primary">
                                    <div class="card-header text-center">
                                        <strong>Song Data</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Song Title</label>
                                            <div class="autocomplete">
                                                <input class="form-control" id="title" name="title" type="text"  placeholder="Enter Song Title" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="released_at">Release Date</label>
                                            <input class="form-control" id="released_at" name="released_at" type="text"  placeholder="Song Release Date">
                                        </div>
                                        <div class="form-group">
                                            <label for="details">Song Details</label>
                                            <textarea class="form-control" id="details" name="details" placeholder="Special Details About The Song (Optional)" rows="2"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="song">Upload Song</label>
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="song" name="song" required>
                                                <label class="custom-file-label" for="song">
                                                    <span class="d-inline-block text-truncate w-75">Choose file</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card border-primary">
                                    <div class="card-header text-center">
                                        <strong>Song Artists Data</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="singers">Singer(s)</label>
                                            <select name="singers[]" id="singers" multiple="multiple" class="select2 form-control">
                                                @foreach($artists as $artist)
                                                    <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="music_directors">Music Director(s)</label>
                                            <select name="musicians[]" id="musicians" multiple="multiple" class="select2 form-control">
                                                @foreach($artists as $artist)
                                                    <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="song_writers">Song Writers(s)</label>
                                            <select name="writers[]" id="writers" multiple="multiple" class="select2 form-control">
                                                @foreach($artists as $artist)
                                                    <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="producers">Producers(s)</label>
                                            <select name="producers[]" id="producers" multiple="multiple" class="select2 form-control">
                                                @foreach($artists as $artist)
                                                    <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="reset" class="btn btn-danger btn-lg btn-block">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('styles')

    <link href="{{ asset('css/songs/create.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    <script src="{{ asset('js/songs/create.js') }}"></script>

@endsection

