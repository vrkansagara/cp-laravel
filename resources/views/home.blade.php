@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                        <ul>
                            <li>Conference Room CRUD using resource controller</li>
                            <li>Install this package https://github.com/spatie/laravel-permission</li>
                            <li>Install this package https://github.com/spatie/laravel-medialibrary</li>
                            <li></li>
                            <li></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
