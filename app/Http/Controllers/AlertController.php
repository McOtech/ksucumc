<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class AlertController extends Controller
{
    public function index(){
        $alerts = Alert::all();
        return view('admin.my-alerts', compact('alerts'));
    }

    public function create(){
        $alerts = Alert::all();
        return view('admin.alerts', compact('alerts'));
    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'title' => ['required', 'string'],
            'date' => ['required'],
            'content' => ['required']
        ]);
        if(Alert::create([
            'title' => $data['title'],
            'date' => $data['date'],
            'content' => $data['content']
        ])){
            $message['success'] = 'Notification saved successfully.';
        }else {
            $message['error'] = 'Notification not saved.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function update(Alert $alert){
        $message = [];
        $data = request()->validate([
            'title' => ['required', 'string'],
            'date' => ['required'],
            'content' => ['required']
        ]);
        if($alert->update([
            'title' => $data['title'],
            'date' => $data['date'],
            'content' => $data['content']
        ])){
            $message['success'] = 'Notification updated successfully.';
        }else {
            $message['error'] = 'Notification not updated.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function delete(Alert $alert){
        $message = [];
        if($alert->delete()){
            $message['success'] = 'Notification updated successfully.';
        }else {
            $message['error'] = 'Notification not updated.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }
}
