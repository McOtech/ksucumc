<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class EventsController extends Controller
{
    public function index(Event $event){
        return view('ministries.event-details', compact('event'));
    }

    public function show(Cohort $cohort){
        $events = Event::where('cohort_id', $cohort->id)->where('status', 'past')->get();
        return view('admin.past-events', compact('cohort'))->with(['category' => 'past', 'events' => $events]);
    }

    public function create(Cohort $cohort){
        $events = Event::where('cohort_id', $cohort->id)->where('status', 'present')->get();
        // $events = $events->where('date', '<', 'NOW()');
        return view('admin.past-events', compact('cohort'))->with(['category' => 'scheduled', 'events' => $events]);
    }

    public function store(Cohort $cohort){
        $message = [];
        $data = request()->validate([
            'image' => ['image'],
            'status' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'venue' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cohort_id' => ['required']
        ]);
            $imagePath = "";
        if (request('image') != null) {
            $imagePath = request('image')->store('storage/events/' . $data['cohort_id'], 'public');
        }else{
            $imagePath = "storage/default/avatar.png";
        }
        try {
            Event::create([
                'cohort_id' => $data['cohort_id'],
                'status' => $data['status'],
                'name' => $data['name'],
                'date' => $data['date'],
                'venue' => $data['venue'],
                'description' => $data['description'],
                'image' => $imagePath

            ]);
            $message['success'] = $data['name'] . ' created successfully.';
        } catch (\Throwable $th) {
            $message['error'] = 'Error creating ' . $data['name'] . ' event';
        }
        $messageBag = new MessageBag($message);

        return redirect()->route('event.create', compact('cohort'))->with(['category' => 'scheduled'])->withErrors($messageBag);
    }

    public function update(Cohort $cohort, Event $event){
        $message = [];
        $data = request()->validate([
            'image' => ['image'],
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'venue' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            // 'cohort_id' => ['required'],
            'location' => ['string', 'required']
        ]);
            $imagePath = "";
            $previousImagePath = $event->image;
        if (request('image') != null) {
            $imagePath = request('image')->store('storage/events/' . $cohort->id, 'public');
            if($event->update([
                // 'cohort_id' => $data['cohort_id'],
                'name' => $data['name'],
                'date' => $data['date'],
                'venue' => $data['venue'],
                'description' => $data['description'],
                'image' => $imagePath,
                'location' => $data['location']
            ]) && $previousImagePath != 'storage/default/avatar.png'){
                Storage::disk('public')->delete($previousImagePath);
                $message['success'] = $data['name'] . ' updated successfully.';
            }else {
                $message['error'] = 'Error updating ' . $data['name'] . ' event';
            }
        }else{
            $imagePath = $event->image;
            if($event->update([
                // 'cohort_id' => $data['cohort_id'],
                'name' => $data['name'],
                'date' => $data['date'],
                'venue' => $data['venue'],
                'description' => $data['description'],
                'image' => $imagePath,
                'location' => $data['location']
            ])){
                $message['success'] = $data['name'] . ' updated successfully.';
            }else {
                $message['error'] = 'Error updating ' . $data['name'] . ' event';
            }
        }
        $messageBag = new MessageBag($message);
        return redirect()->route('event.create', compact('cohort'))->with(['category' => 'scheduled'])->withErrors($messageBag);
    }

    public function updateStatus(Cohort $cohort, Event $event){
        $message = [];
        $data = request()->validate([
            'status' => ['required', 'string']
        ]);
        if($event->update([
            'status' => $data['status']
        ])){
            $message['success'] = 'Status updated successfully.';
        }else {
            $message['error'] = 'Status update failed.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->route('event.create', compact('cohort'))->with(['category' => 'scheduled'])->withErrors($messageBag);
    }

    public function delete(Cohort $cohort, Event $event){
        // dd(getdate(), date()->createFromFormat("Y-F-j|", $event->date) );
        $message = [];
        $imagePath = $event->image;
        $name = $event->name;
        if ($event->delete() && $imagePath != 'storage/default/avatar.png') {
            Storage::disk('public')->delete($imagePath);
            $message['success'] = $name . ' event deleted successfully.';
        }else {
            $message['error'] = 'Error deleting ' . $name . ' event';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }
}
