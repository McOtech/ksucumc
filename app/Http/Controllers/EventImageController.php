<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class EventImageController extends Controller
{
    public function show(Event $event){
        // $eventImages = EventImage::where('event_id', $event)->get();
        return view('ministries.gallery', compact('event'))->with(['category' => 'event']);
    }

    public function create(Event $event){
        return view('admin.gallery', compact('event'));
    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'image' => ['required', 'image'],
            'event_id' => ['required', 'string'],
            'title' => ['required', 'string']
        ]);

        $imagePath = request('image')->store('storage/images/event/' . $data['event_id'], 'public');
        try {
            EventImage::create([
                'image' => $imagePath,
                'event_id' => $data['event_id'],
                'title' => $data['title']
            ]);
            $message['success'] = 'Image saved successfully.';
        } catch (\Throwable $th) {
            $message['error'] = 'Error! Image not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function update(EventImage $eventImage){
        $message = [];
        $data = request()->validate([
            'image' => ['image'],
            'title' => ['required', 'string']
        ]);
        $previousImagePath = $eventImage->image;
        if (request('image') != null) {
            $imagePath = request('image')->store('storage/images/event/' . $eventImage->event_id, 'public');
            if ($eventImage->update([
                'image' => $imagePath,
                'title' => $data['title']
            ]) && $previousImagePath != 'storage/default/avatar.png') {
                Storage::disk('public')->delete($previousImagePath);
                $message['success'] = 'Image updated successfully.';
            }else {
                $message['error'] = 'Error! Image not saved.';
            }
        }else {
            if($eventImage->update([
                'image' => $previousImagePath,
                'title' => $data['title']
            ])){
                $message['success'] = 'Image updated successfully.';
            }else {
                $message['error'] = 'Error! Image not saved';
            }
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function delete(EventImage $eventImage){
        $message = [];
        $previousImagePath = $eventImage->image;
        if ($eventImage->delete() && $previousImagePath != 'storage/default/avatar.png') {
            Storage::disk('public')->delete($previousImagePath);
            $message['success'] = 'Image deleted successfully.';
        }else {
            $message['error'] = 'Error! Image not deleted.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }
}
