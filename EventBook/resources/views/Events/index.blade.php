@extends('layouts.app')

@section('content')

    <h1>Events</h1>

    @if(count($events)>0)
    @foreach($events as $event)
        <div class= 'well' >
            <div class="row">
                <div class="col-md-4 col-sm-4">

                </div>
                <div class="col-md-8 col-sm-8">

                </div>
            </div>
            <h3><a href ="/events/{{$event->id}}">{{$event->name}}</a></h3>
            <small>Event Date: {{$event->event_date}}</small>
            <hr>
        </div>
    @endforeach
    {{$events->links()}}
    @else 
        <p>No Events Found</p>
    @endif

@endsection

