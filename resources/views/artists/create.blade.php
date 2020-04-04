@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form id="create-artists-form" action="{{ route('artists.store') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <strong>Add New Artist</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card border-primary">
                                    <div class="card-header text-center">
                                        <strong>Artist Data</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="membership_number">Membership Number</label>
                                            <div class="autocomplete">
                                                <input class="form-control" id="membership_number" name="membership_number" type="text"  placeholder="Membership Number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Artist Type*</label>
                                            <select id="type" name="type" class="form-control select2" required>
                                                <option></option>
                                                <option value="1">Singer</option>
                                                <option value="2">Music Director</option>
                                                <option value="3">Song Writer</option>
                                                <option value="4">Producer</option>
                                                <option value="5">Unknown</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Artist Status*</label>
                                            <select id="status" name="status" class="form-control select2" required>
                                                <option></option>
                                                <option value="1">Active Member</option>
                                                <option value="2">Consented Member</option>
                                                <option value="3">Non Member</option>
                                                <option value="4">Deceased now, but was Active</option>
                                                <option value="5">Deceased now, but Consent Given</option>
                                                <option value="6">Deceased now, and non member</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card border-primary">
                                    <div class="card-header text-center">
                                        <strong>Basic User Data</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="first_name">First Name*</label>
                                            <div class="autocomplete">
                                                <input class="form-control" id="first_name" name="first_name" type="text"  placeholder="Artist's First Name (Required)" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name*</label>
                                            <div class="autocomplete">
                                                <input class="form-control" id="last_name" name="last_name" type="text"  placeholder="Artist's Last Name (Required)" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" id="email" name="email" type="text"  placeholder="Artist's Email (Optional)">
                                        </div>
                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input class="form-control" id="dob" name="dob" type="text"  placeholder="Artist's Date of Birth (Optional)">
                                        </div>
                                        <div class="form-group">
                                            <label for="nic">NIC</label>
                                            <input class="form-control" id="nic" name="nic" type="text"  placeholder="NIC (Optional)">
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input class="form-control" id="mobile" name="mobile" type="text"  placeholder="Mobile Number (Optional)">
                                        </div>
                                        <div class="form-group">
                                            <label for="land">Land Phone</label>
                                            <input class="form-control" id="land" name="land" type="text"  placeholder="Land Line Number (Optional)">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address" placeholder="Address (Optional)" rows="3"></textarea>
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

    <link href="{{ asset('css/artists/create.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    <script src="{{ asset('js/artists/create.js') }}"></script>

@endsection
