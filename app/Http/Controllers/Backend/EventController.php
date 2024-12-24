<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    //
    public function index()
    {

        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        // get all events
        $events = Event::all();

        return view('backend.dashboards.user.pages.events.index', compact('events'));

    }

    public function show()
    {
        return view('backend.dashboards.user.pages.events.show');
    }


    public function destroy(Event $event)
    {


        // delete selected event
        $event->delete();

        return redirect()->route('backend.events.index');
    }


    public function trash()
    {

        // get deleted events
        $events = Event::onlyTrashed()->get();
        return view('backend.dashboards.user.pages.events.trash', compact('events'));
    }



    public function restore($id)
    {
        // get deleted events
        $events = Event::onlyTrashed()->findOrFail($id);
        // restore deleted events
        $events->restore();
        return redirect()->route('backend.events.index');

    }


    public function forceDelete($id)
    {
        // get deleted events
        $events = Event::onlyTrashed()->findOrFail($id);
        // delete deleted events forever
        $events->forceDelete();

        return redirect()->route('backend.events.index');

    }


}
