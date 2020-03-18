@extends('layouts.admin')

@section('content')

    <div class="row" id="server-status">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Cloud Server Status</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                            Storage Disk Space
                            <span class="badge badge-secondary badge-pill">
                                {{ round(disk_free_space(storage_path())/(1024*1024*1024), 2) }} GB /  {{ round(disk_total_space(storage_path())/(1024*1024*1024), 2) }} GB
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')

    <link href="{{ asset('css/admin/home.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    <script src="{{ asset('js/admin/home.js') }}"></script>

@endsection
