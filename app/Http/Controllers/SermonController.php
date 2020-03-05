<?php

namespace App\Http\Controllers;

use App\Event_Video;
use App\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class SermonController extends Controller
{
    public function index(){
        $sermons = Sermon::all();
        return view('ministries.sermons', compact('sermons'));
    }

    public function show(Sermon $sermon){
        $sermons = Sermon::all();
        $event_videos = Event_Video::all();
        return view('ministries.video', compact('sermon'))->with(['category' => 'sermon', 'sermons' => $sermons, 'event_videos' => $event_videos]);
    }

    public function create(){
        $sermons = Sermon::all();
        return view('admin.sermon', compact('sermons'));
    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'image' => ['required', 'image'],
            'title' => ['required', 'string'],
            'preacher' => ['required', 'string'],
            'date' => ['required'],
            'url' => ['required', 'url'],
            'content' => ['required']
        ]);
        // $imagePath = 'storage/default/avatar.png';
        // if (request('image') != null) {
            $imagePath = request('image')->store('storage/sermons', 'public');
        // }
        try {
            Sermon::create([
                'image' => $imagePath,
                'title' => $data['title'],
                'preacher' => $data['preacher'],
                'date' => $data['date'],
                'url' => $data['url'],
                'content' => $data['content']
            ]);
            $message['success'] = $data['title'] . ' saved successfully.';
        } catch (\Throwable $th) {
            $message['error'] = 'Error saving ' . $data['title'];
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function update(Sermon $sermon){
        $message = [];
        $data = request()->validate([
            'image' => ['image'],
            'title' => ['required', 'string'],
            'preacher' => ['required', 'string'],
            'date' => ['required'],
            'url' => ['required', 'url'],
            'content' => ['required']
        ]);
        $previousImagePath = $sermon->image;
        if (request('image') != null) {
            $imagePath = request('image')->store('storage/sermons', 'public');
            if ($sermon->update([
                'image' => $imagePath,
                'title' => $data['title'],
                'preacher' => $data['preacher'],
                'date' => $data['date'],
                'url' => $data['url'],
                'content' => $data['content']
            ]) && $previousImagePath != 'storage/default/avatar.png') {
                Storage::disk('public')->delete($previousImagePath);
                $message['success'] = $data['title'] . ' updated successfully.';
            }else {
                $message['error'] = 'Error updating ' . $data['title'];
            }
        }else{
            if($sermon->update([
                'image' => $previousImagePath,
                'title' => $data['title'],
                'preacher' => $data['preacher'],
                'date' => $data['date'],
                'url' => $data['url'],
                'content' => $data['content']
            ])){
                $message['success'] = $data['title'] . ' updated successfully.';
            }else {
                $message['error'] = 'Error updating ' . $data['title'];
            }
        }
        // $sermons = Sermon::all();
        // return redirect()->route('sermon.create', compact('sermons'));
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function delete(Sermon $sermon){
        $message = [];
        $imagePath = $sermon->image;
        $name = $sermon->title;
        if ($sermon->delete() && $imagePath != 'storage/default/avatar.png') {
            Storage::disk('public')->delete($imagePath);
            $message['success'] = $name . ' deleted successfully.';
        }else {
            $message['error'] = 'Error deleting ' . $name;
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }
}
