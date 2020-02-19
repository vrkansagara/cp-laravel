@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/other/core/main.css')}}">

@endsection
@section('content')

    <div id="calender"></div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid'],
                timeZone: 'UTC',
                defaultView: 'dayGridMonth',
                events:
                    '[{"title":"All Day Event","start":"2020-01-01"},{"title":"Long Event","start":"2020-01-07","end":"2020-01-10"},{"groupId":"999","title":"Repeating Event","start":"2020-01-09T16:00:00+00:00"},{"groupId":"999","title":"Repeating Event","start":"2020-01-16T16:00:00+00:00"},{"title":"Conference","start":"2020-01-06","end":"2020-01-08"},{"title":"Meeting","start":"2020-01-07T10:30:00+00:00","end":"2020-01-07T12:30:00+00:00"},{"title":"Lunch","start":"2020-01-07T12:00:00+00:00"},{"title":"Birthday Party","start":"2020-01-08T07:00:00+00:00"},{"url":"http:\\/\\/google.com\\/","title":"Click for Google","start":"2020-01-28"}]'
            });

            calendar.render();
        })
    </script>
    <script type="text/javascript" src="{{asset('assets/other/core/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/other/daygrid/main.js')}}"></script>

@endsection
