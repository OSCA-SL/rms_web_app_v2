@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Artists Details</strong>
                </div>
                <div class="card-body">
                    <div id="table-container">
                        <table id="artists-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Membership No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($artists as $artist)
                                <tr>
                                    <td>{{ $artist->id }}</td>
                                    <td>{{ $artist->membership_number }}</td>
                                    <td>{{ $artist->user->first_name }}</td>
                                    <td>{{ $artist->user->last_name }}</td>
                                    <td>{{ $artist->getType() }}</td>
                                    <td>{{ $artist->getStatus() }}</td>
                                    <td>
                                        <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                                        <button class="btn btn-success"><i class="fas fa-check-square"></i></button>
                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Membership No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Type</th>
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

    <link href="{{ asset('css/artists/index.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    <script src="{{ asset('js/artists/index.js') }}"></script>

@endsection
