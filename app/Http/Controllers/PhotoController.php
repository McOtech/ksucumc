<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class PhotoController extends Controller
{
    public function index(){
        $photos = Photo::all();
        if (count($photos) > 0) {
            return json_encode($photos);
        }else {
            return json_encode([]);
        }

    }

    public function show(){
        return view('admin.my-photos');
    }

    public function create(){
        $photos = Photo::all();
        return view('admin.upload-photo', compact('photos'));
    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'path' => ['required', 'image']
        ]);

        if (request('path') != null) {
            $imagePath = request('path')->store('storage/videoCoverage/photos', 'public');

            if(Photo::create([
                'path' => $imagePath
            ])){
                $message['success'] = 'Image saved successfully.';
            }else {
                $message['error'] = 'Error saving image.';
            }
        }
        $messageBag = new MessageBag($message);
        return redirect()->route('photo.create')->withErrors($messageBag);
    }

    public function update(Photo $photo){
        $message = [];
        $data = request()->validate([
            'path' => ['required', 'image']
        ]);

        $previousPath = $photo->path;

        if (request('path') != null) {
            $imagePath = request('path')->store('storage/videoCoverage/photos', 'public');

            if($photo->update(['path' => $imagePath]) && $imagePath != 'storage/default/avatar.png'){
                Storage::disk('public')->delete($previousPath);
                $message['success'] = 'Image updated successfully.';
            }else {
                $message['error'] = 'Error updating image.';
            }
            // Storage::delete('storage/' . $previousPath);
        }
        $messageBag = new MessageBag($message);
        return redirect()->route('photo.create')->withErrors($messageBag);
    }

    public function delete(Photo $photo){
        $message = [];
        if($photo->delete() && $photo->path != 'storage/default/avatar.png'){
            Storage::disk('public')->delete($photo->path);
            $message['success'] = 'Image deleted suceesfully.';
        }else {
            $message['success'] = 'Error deleting Image.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->route('photo.create')->withErrors($messageBag);
    }
}
