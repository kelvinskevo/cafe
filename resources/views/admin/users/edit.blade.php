@extends('admin/body/master')

@section('content')
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User credentials</h4>
                <p class="card-description"> </p>
                <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Email</label>
                        <input type="email" class="form-control" name="email" value='{{ $user->email }}'>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">usertyper</label>
                        <select class="form-control" name="usertype">
                            <option value="1" {{ old('usertype', $user->usertype) == 1 ? 'selected' : '' }}>Admin
                            </option>
                            <option value="2" {{ old('usertype', $user->usertype) == 2 ? 'selected' : '' }}>User
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
