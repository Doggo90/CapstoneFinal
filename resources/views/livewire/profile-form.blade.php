@if (auth()->user()->id == $user->id)
    <div class="card">
        <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
            @csrf
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">Edit Profile</p>
                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                </div>
            </div>
            <div class="card-body">
                <p class="text-uppercase text-sm">User Information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Username</label>
                            <input class="form-control" type="text" name="username" value="{{ old('username', auth()->user()->username) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Email address</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">First name</label>
                            <input class="form-control" type="text" name="firstname"  value="{{ old('firstname', auth()->user()->firstname) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Last name</label>
                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}">
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Contact Information</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Address</label>
                            <input class="form-control" type="text" name="address"
                                value="{{ old('address', auth()->user()->address) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">City</label>
                            <input class="form-control" type="text" name="city" value="{{ old('city', auth()->user()->city) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Country</label>
                            <input class="form-control" type="text" name="country" value="{{ old('country', auth()->user()->country) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Postal code</label>
                            <input class="form-control" type="text" name="postal" value="{{ old('postal', auth()->user()->postal) }}">
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">About me</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">About me</label>
                            <input class="form-control" type="text" name="about"
                                value="{{ old('about', auth()->user()->about) }}">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endif
<div class="card">
        <div class="card-body">
            <p class="text-uppercase text-sm">User Information</p>
            <h4>{{$user->name}}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Email address</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">First name</label>
                        <input class="form-control" type="text" name="firstname"  value="{{ old('firstname', auth()->user()->firstname) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Last name</label>
                        <input class="form-control" type="text" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}">
                    </div>
                </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Contact Information</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Address</label>
                        <input class="form-control" type="text" name="address"
                            value="{{ old('address', auth()->user()->address) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">City</label>
                        <input class="form-control" type="text" name="city" value="{{ old('city', auth()->user()->city) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Country</label>
                        <input class="form-control" type="text" name="country" value="{{ old('country', auth()->user()->country) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Postal code</label>
                        <input class="form-control" type="text" name="postal" value="{{ old('postal', auth()->user()->postal) }}">
                    </div>
                </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">About me</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">About me</label>
                        <input class="form-control" type="text" name="about"
                            value="{{ old('about', auth()->user()->about) }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


