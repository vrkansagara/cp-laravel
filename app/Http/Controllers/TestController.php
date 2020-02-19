<?php

namespace App\Http\Controllers;

use Google\Auth\Credentials\ServiceAccountCredentials;

class TestController extends Controller
{
    public function index()
    {
        $serviceAccountCredentials = base_path('data/google/calender/CPInternal-a872658570dc.json');
        $scopes = [
            \Google_Service_Calendar::CALENDAR,
            \Google_Service_Calendar::CALENDAR_READONLY,
            \Google_Service_Calendar::CALENDAR_EVENTS,
            \Google_Service_Calendar::CALENDAR_EVENTS_READONLY,
            \Google_Service_Calendar::CALENDAR_SETTINGS_READONLY,
        ];
        $client = new ServiceAccountCredentials($scopes, $serviceAccountCredentials);
        $token = $client->fetchAuthToken();
        session()->put('google_toke', $token);
        return redirect()->to('home');
    }

    public function create()
    {

        $client = new \Google_Client();
        $client->setAccessToken(session()->get('google_token_social'));

        $service = new \Google_Service_Calendar($client);

        $event = new \Google_Service_Calendar_Event(array(
            'summary' => 'Google I/O 2015',
            'location' => '800 Howard St., San Francisco, CA 94103',
            'description' => 'A chance to hear more about Google\'s developer products.',
            'start' => array(
                'dateTime' => '2019-09-23T09:05:00-07:00',
                'timeZone' => 'Asia/Kolkata',
            ),
            'end' => array(
                'dateTime' => '2019-09-23T17:05:00-07:00',
                'timeZone' => 'Asia/Kolkata',
            ),
            'recurrence' => array(
                'RRULE:FREQ=DAILY;COUNT=2'
            ),
            'attendees' => array(
//                array('email' => 'sujit@commercepundit.com'),
//                array('email' => 'bansari@commercepundit.com'),
                array('email' => 'vrkansagara@yopmail.com'),
            ),
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
            ),
        ));

        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);
        dd($event);

    }
}
