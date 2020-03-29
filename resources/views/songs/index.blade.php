@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Songs Details</strong>
                </div>
                <div class="card-body">
                    <div id="table-container">
                        <table id="songs-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Song File</th>
                                <th>Remote File</th>
                                <th>Singers</th>
                                <th>Musicians</th>
                                <th>Writers</th>
                                <th>Released At</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Song File</th>
                                <th>Remote File</th>
                                <th>Singers</th>
                                <th>Musicians</th>
                                <th>Writers</th>
                                <th>Released At</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')

    <link href="{{ asset('css/songs/index.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    <script src="{{ asset('js/songs/index.js') }}"></script>

@endsection
