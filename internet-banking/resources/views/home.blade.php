@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <!-- Profile Update Form -->
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                    
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <select name="profile_image" class="form-control" required>
                                <option value="profile1.jpg" {{ auth()->user()->profile_image == 'profile1.jpg' ? 'selected' : '' }}>Profile 1</option>
                                <option value="profile2.jpg" {{ auth()->user()->profile_image == 'profile2.jpg' ? 'selected' : '' }}>Profile 2</option>
                                <option value="profile3.jpg" {{ auth()->user()->profile_image == 'profile3.jpg' ? 'selected' : '' }}>Profile 3</option>
                                <option value="profile4.jpg" {{ auth()->user()->profile_image == 'profile4.jpg' ? 'selected' : '' }}>Profile 4</option>
                                <option value="profile5.jpg" {{ auth()->user()->profile_image == 'profile5.jpg' ? 'selected' : '' }}>Profile 5</option>
                                <option value="profile6.jpg" {{ auth()->user()->profile_image == 'profile6.jpg' ? 'selected' : '' }}>Profile 6</option>

                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    
                    <!-- Menampilkan gambar profil yang dipilih -->
                    <div class="mt-4">
                        <img src="{{ asset('images/profile_images/' . auth()->user()->profile_image) }}" alt="Profile Image" class="profile-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
