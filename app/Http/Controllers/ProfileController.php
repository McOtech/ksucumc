<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Profile;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller
{
    public function edit(User $user){
        $this->authorize('update', $user->profile);
        $cohorts = Cohort::all();
        $profile = $user->profile;
        return view('admin.user-settings', compact('cohorts'))->with(['profile' => $profile]);
    }

    public function storeImage(){
        $message = [];
        $this->authorize('update', auth()->user()->profile);
        $data = request()->validate([
            'image' => ['required', 'image']
        ]);
        $imagePath = 'storage/default/avatar.png';
        if (request('image') != null) {
            $imagePath = request()->file('image')->store('storage/profilePictures/' . auth()->user()->username, 'public');
        }
        // $imagePath = Storage::putFile('profilePictures/' . auth()->user()->username, request()->file('image'), 'public');
        if(auth()->user()->profile()->create(['image' => $imagePath])){
            $message['success'] = 'Profile Image saved successfully.';
        }else {
            $message['error'] = 'Profile Image not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect('home')->withErrors($messageBag);
    }

    public function updateImage(){
        $this->authorize('update', auth()->user()->profile);
        $data = request()->validate([
            'image' => ['required', 'image']
        ]);
        $imagePath = 'storage/default/avatar.png';
        if (request('image') != null) {
            $imagePath = request()->file('image')->store('storage/profilePictures/' . auth()->user()->username, 'public');
        }
        // $imagePath = Storage::putFile('profilePictures/' . auth()->user()->username, request()->file('image'), 'public');
        if(auth()->user()->profile->update(['image' => $imagePath])){
            $message['success'] = 'Profile Image saved successfully.';
        }else {
            $message['error'] = 'Profile Image not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect('home')->withErrors($messageBag);
    }

    public function storeDetails(){
        $message = [];
        $this->authorize('update', auth()->user()->profile);
        if(auth()->user()->profile()->create(request()->all())){
            $message['success'] = 'Personal Details saved successfully';
        }else {
            $message['error'] = 'Personal Details not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect('home')->withErrors($messageBag);
    }

    public function updateDetails(){
        $message = [];
        $this->authorize('update', auth()->user()->profile);
        if(auth()->user()->profile->update(request()->all())){
            $message['success'] = 'Personal Details saved successfully';
        }else {
            $message['error'] = 'Personal Details not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect('home')->withErrors($messageBag);
    }

    public function storeContacts(){
        $message = [];
        $this->authorize('update', auth()->user()->profile);
        if(auth()->user()->profile()->create(request()->all())){
            $message['success'] = 'Contacts saved successfully';
        }else {
            $message['error'] = 'Contacts not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect('home')->withErrors($messageBag);
    }

    public function updateContacts(){
        $message = [];
        $this->authorize('update', auth()->user()->profile);
        if(auth()->user()->profile->update(request()->all())){
            $message['success'] = 'Contacts saved successfully';
        }else {
            $message['error'] = 'Contacts not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect('home')->withErrors($messageBag);
    }
}
