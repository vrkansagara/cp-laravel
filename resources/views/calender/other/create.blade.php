@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{route('calender.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Summary</label>
                <textarea class="form-control" name="summary"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Location</label>
                <input type="text" class="form-control" name="location"
                       placeholder="800 Howard St., San Francisco, CA 94103">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Emails (multiple email with , saperated)</label>
                <input class="form-control" name="emails" placeholder="name@example.com">
            </div>
            <input type="submit" class="btn-primary btn-sm" value="Create event">
            <input type="reset" class="btn-default btn-sm" value="Clear">
        </form>
    </div>
@endsection
