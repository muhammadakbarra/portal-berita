@extends('master')
@section('content')
    <div class="container padding">
        <div class="text-primary my-2">Update Profile</div>
        <form action="/profile/{{ $profile->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ $profile->age }}">
            </div>
            @error('age')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="bio">Biodata</label>
                <textarea name="bio" id="bio" cols="30" rows="10" class="form-control">{{ $profile->bio }}</textarea>
            </div>
            @error('bio')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="address">Adress</label>
                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ $profile->address }}</textarea>
            </div>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="photo_profile">Photo Profile</label>
                <input type="file" name="photo_profile" id="photo_profile" class="form-control">
            </div>
            @error('photo_profile')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection