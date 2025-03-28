<?php

namespace App\Http\Controllers\Backend\Clinic;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    //
    public function index()
    {

        // get current date on egypt
        $current_date = Carbon::now('Egypt')->format('Y-m-d');
        // get all events
        $events = Event::all();

        return view('backend.dashboards.clinic.pages.events.index', compact('events'));

    }

    public function data()
    {
        $events = Event::all();

        return DataTables::of($events)
            ->addColumn('action', function ($event) {
                // $editUrl = route('backend.events.edit', $event->id);
                $deleteUrl = route('backend.events.destroy', $event->id);

                return '
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action']) // Ensure the HTML in the action column is not escaped
            ->make(true);
    }

    public function show()
    {
        return view('backend.dashboards.clinic.pages.events.show');
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
        return view('backend.dashboards.clinic.pages.events.trash', compact('events'));
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
