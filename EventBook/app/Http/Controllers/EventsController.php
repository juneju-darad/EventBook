<?php

/**
* 
* Controller class for Event Model
* Handles requests, responses
* CRUD opetations
* 
*/

namespace App\Http\Controllers;

//using Models in this class
use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Organizer;
use App\Participant;
use DB;

class EventsController extends Controller
{
    /**
     * Display a listing of Events.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //$events =Event::all()
        $events = Event::orderBy('event_date','asc')->paginate(5);
        return view('events.index')->with('events',$events);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request,[
            'name' => 'required',
            'venue' => 'required',
            'event_date' => 'required',
            'reg_deadline' => 'required',
      //    'event_type' => 'required',
            'description' => 'required',
            ]);

            //Create Event
            $event = new event;
            $event->name = $request->input('name');
            $event->venue = $request->input('venue');
            $event->description = $request->input('description');
            $event->event_date = $request->input('event_date');
            $event->reg_deadline = $request->input('reg_deadline');
      //    $event->event_type = $request ->input('event_type');
            $event->description = $request ->input('description');
            $event->organizer_id = auth()->user()->id;
            $event->save();

        return redirect('/events')->with('success','Event Created!');
    }

    /**
     * Display the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('events.show')->with('event',$event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit')->with('event',$event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'venue' => 'required',
            'event_date' => 'required',
            'reg_deadline' => 'required',
        //    'event_type' => 'required',
            'description' => 'required',
            ]);

            //Create Event
            $event = Event::find($id);
            $event->name = $request->input('name');
            $event->venue = $request->input('venue');
            $event->description = $request->input('description');
            $event->event_date = $request->input('event_date');
            $event->reg_deadline = $request->input('reg_deadline');
        //    $event->event_type = $request ->input('event_type');
            $event->description = $request ->input('description');
            $event->save();

        return redirect('/events')->with('succes','Event Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return redirect('/events')->with('success', 'Event Removed!');
    }
}
