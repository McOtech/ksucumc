<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Event;
use App\Event_Video;
use App\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class EventVideoController extends Controller
{
    public function index(){
        $events = Event_Video::all();
        $sermons = Sermon::all();
        return view('ministries.videos', compact('events'))->with(['determiner' => 'all', 'sermons' => $sermons]);
    }

    public function show(Event $event){
        return view('ministries.videos', compact('event'))->with(['determiner' => 'event']);
    }

    public function view($event, Event_Video $event_video){
        $sermons = Sermon::all();
        $event_videos = Event_Video::all();
        return view('ministries.video', compact('event_video'))->with(['category' => 'event', 'sermons' => $sermons, 'event_videos' => $event_videos]);
    }

    public function create(Event $event){
        return view('admin.videos', compact('event'));
    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'image' => ['required', 'image'],
            'event_id' => ['required'],
            'title' => ['required', 'string'],
            'url' => ['required', 'url'],
            'description' => ['required']
        ]);
        if (request('image') != null) {
            $imagePath = request('image')->store('storage/videos/event/' . $data['event_id'], 'public');
        }else{
            $imagePath = 'storage/default/avatar.png';
        }
        try {
            Event_Video::create([
                'event_id' => $data['event_id'],
                'image' => $imagePath,
                'title' => $data['title'],
                'url' => $data['url'],
                'description' => $data['description']
            ]);
            $message['success'] = 'Video saved successfully.';
        } catch (\Throwable $th) {
            $message['error'] = 'Error saving video.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function update(Event_Video $event_video){
        $message = [];
        $data = request()->validate([
            'image' => ['image'],
            'title' => ['required', 'string'],
            'url' => ['required', 'url'],
            'description' => ['required']
        ]);
        if (request('image') != null) {
            $previousImagePath = $event_video->image;
            $imagePath = request('image')->store('storage/videos/event/' . $event_video->id, 'public');
            if ($event_video->update([
                'image' => $imagePath,
                'title' => $data['title'],
                'url' => $data['url'],
                'description' => $data['description']
            ]) && $previousImagePath != 'storage/default/avatar.png') {
                Storage::disk('public')->delete($previousImagePath);
                $message['success'] = 'Video updated successfully.';
            }else {
                $message['error'] = 'Error updating video.';
            }
        }else{
            $imagePath = $event_video->image;
            if($event_video->update([
                'image' => $imagePath,
                'title' => $data['title'],
                'url' => $data['url'],
                'description' => $data['description']
            ])){
                $message['success'] = 'Video updated successfully.';
            }else {
                $message['error'] = 'Error updating video.';
            }
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function delete(Event_Video $event_video){
        $message = [];
        $previousImagePath = $event_video->image;
        if ($event_video->delete() && $previousImagePath != 'storage/default/avatar.png') {
            Storage::disk('public')->delete($previousImagePath);
            $message['success'] = 'Video deleted successfully.';
        }else {
            $message['error'] = 'Error deleting video.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }
}
