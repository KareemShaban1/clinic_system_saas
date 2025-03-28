<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;


class Calendar extends Component
{
    public $events = '';
 
    public function getevent()
    {       
        $events = Event::select('id','title','date')->get();
 
        return  json_encode($events);
    }
 
    /**
    * Write code on Method
    *
    * @return response()
    */
    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['date'] = $event['date'];
        $input['clinic_id'] = auth()->user()->clinic_id;
        Event::create($input);
    }
 
    /**
    * Write code on Method
    *
    * @return response()
    */
    public function eventDrop($event, $oldEvent)
    {
      $eventdata = Event::find($event['id']);
      $eventdata->date = $event['start'];
      $eventdata->save();
    }
 
    /**
    * Write code on Method
    *
    * @return response()
    */
    public function render()
    {       
        $events = Event::select('id','title','date')->get();
 
        $this->events = json_encode($events);
 
        return view('backend.dashboards.clinic.livewire.calendar');
    }
}
