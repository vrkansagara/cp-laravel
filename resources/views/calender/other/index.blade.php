@extends('layouts.app')

@section('header')
@endsection
@section('content')
    <div class="container">
        <div class="com-md-4">
            <a href="{{route('calender.create')}}">Create event</a>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <td scope="col">#</td>
                <td scope="col">Event</td>
                <td scope="col">Start time</td>
                <td scope="col">End time</td>
                <td scope="col">Creator</td>
                <td scope="col">Organizer</td>
                <td scope="col">Link</td>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{$event['title']}}</td>
                    <td>{{$event['start']}}</td>
                    <td>{{$event['end']}}</td>
                    <td>{{$event['creator_name']}}</td>
                    <td>{{$event['organizer_name']}}</td>
                    <td><a target="_blank" href="{{$event['link']}}">Go to event</a></td>
                </tr>
            @endforeach


            </tbody>
        </table>


    </div>
@endsection

@section('footer')


@endsection
