<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * @ref:- https://developers.google.com/calendar/v3/reference
 * Class CalenderController
 * @package App\Http\Controllers
 */
class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexx()
    {
        $client = new \Google_Client();
        $client->setAccessToken(session()->get('google_token_social'));

        $service = new \Google_Service_Calendar($client);
//        $availableCalenders = $service->calendarList->listCalendarList()->getItems();
//        $availableCalenders = $service->calendars->get(session()->get('google_token_email'));
        $availableEvents = $service->events->listEvents(session()->get('google_token_email'));

        $fileName = storage_path(sprintf("events/%s-events-%s.json", Auth::user()->id, time()));

        $events = [];
        foreach ($availableEvents->getItems() as $index => $item) {
            $events[$index]['link'] = $item->getHtmlLink();
            $events[$index]['id'] = $item->getId();
            $events[$index]['title'] = $item->getSummary();
            $events[$index]['start'] = $item->getStart()->getDateTime();
            $events[$index]['end'] = $item->getEnd()->getDateTime();
            $events[$index]['creator_name'] = $item->getCreator()->getDisplayName();
            $events[$index]['creator_email'] = $item->getCreator()->getEmail();
            $events[$index]['organizer_name'] = $item->getOrganizer()->getDisplayName();
            $events[$index]['organizer_email'] = $item->getOrganizer()->getEmail();
            if ($index == 20) {
                break;
            }
        }
        file_put_contents($fileName, json_encode($events));


        return view('calender.index', compact('events'));
    }

    public function index()
    {
        return view('calender.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $client = new \Google_Client();
            $client->setAccessToken(session()->get('google_token_social'));

            $service = new \Google_Service_Calendar($client);
            $payLoad = $request->all();
            $emails = [];
            foreach (explode(',', $payLoad['emails']) as $k => $v) {
                $emails [] = ['email' => $v];
            }
            $eventData = array(
                'summary' => $payLoad['summary'],
                'location' => $payLoad['location'],
                'description' => $payLoad['description'],
                'start' => array(
                    'dateTime' => '2019-09-25T09:12:00-17:00',
                    'timeZone' => 'Asia/Kolkata',
                ),
                'end' => array(
                    'dateTime' => '2019-09-28T17:12:00-17:00',
                    'timeZone' => 'Asia/Kolkata',
                ),
                'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=2'
                ),
                'attendees' => $emails,
                'reminders' => array(
                    'useDefault' => FALSE,
                    'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 10),
                    ),
                ),
            );
            $fileName = storage_path(sprintf("events/%s-%s.json", Auth::user()->id, time()));
            file_put_contents($fileName, json_encode($eventData));
            $event = new \Google_Service_Calendar_Event($eventData);

            $calendarId = 'primary';
            // https://developers.google.com/calendar/v3/reference/events/insert
            $event = $service->events->insert($calendarId, $event);
            return redirect()->to(route('calender.index'));
        } catch (\Google_Service_Exception $exception) {
            dd($exception->getMessage(), $payLoad, $eventData);

            return redirect()->to(route('calender.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
