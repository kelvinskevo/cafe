<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Auth\Events\Validated;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $events = Event::orderBy('created_at', 'desc')->get();
        return view('admin.events.index')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/event_images'), $imagename);
            $validated['image'] = $imagename;
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('message', 'New Event Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('dashboard', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit')->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {

            if ($event->image) {
                $oldimagepath = public_path('admin/event_images/' . $event->image);
                if (file_exists($oldimagepath)) {
                    unlink($oldimagepath);
                }
            }
            $imagename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin/event_images'), $imagename);
            $validated['image'] = $imagename;
        } else {
            $validated['image'] = $event->image;
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('message', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if (file_exists(public_path('admin/event_iamges/' . $event->image))) {
            unlink(public_path('admin/event_images/' . $event->image));
        }

        $event->delete();

        return redirect()->route('events.index')->with('message', 'Event Deleted Successfully');
    }
}
