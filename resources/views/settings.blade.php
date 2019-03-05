@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="card" method="POST" action="{{ action('HomeController@updateSettings') }}">
                <div class="card-header">Settings</div>

                <div class="card-body">

                    @csrf

                    <div class="form-group">
                        <label for="name">Change username</label>
                        <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
                    </div>

                    <div class="form-group">
                        <label for="username">Change email</label>
                        <input class="form-control" name="email" type="email" value="{{ Auth::user()->email }}">
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
