<?php

namespace App\Http\Controllers;

use App\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class CohortController extends Controller
{
    private $template = ['ministry.create', 'committee.create', 'board.create'];

    public function index(){
        $cohorts = Cohort::all();
        return view('ministries.ministries', compact('cohorts'));
    }

    public function showMembers(Cohort $cohort){
        return view('ministries.members', compact('cohort'))->with(['category' => 'members']);
    }

    public function showAlumni(Cohort $cohort){
        return view('ministries.members', compact('cohort'))->with(['category' => 'alumni']);
    }

    public function showProfile(Cohort $cohort){
        return view('ministries.about-ministry', compact('cohort'));
    }

    public function show(Cohort $cohort){
        $this->authorize('update', $cohort);
        return view('admin.groupDashboard', compact('cohort'));
    }

    public function showInfo(Cohort $cohort){
        $this->authorize('update', $cohort);
        return view('admin.group-profile', compact('cohort'));
    }

    public function createMinistry(){
        $cohorts = Cohort::where('category', 'ministry')->get();
        foreach ($cohorts as $key => $cohort) {
            $this->authorize('view', $cohort);
        }
        return view('admin.ministries', compact('cohorts'));
    }

    public function createCommittee(){
        $cohorts = Cohort::where('category', 'committee')->get();
        foreach ($cohorts as $key => $cohort) {
            $this->authorize('view', $cohort);
        }
        return view('admin.committees', compact('cohorts'));
    }

    public function createBoard(){
        $cohorts = Cohort::where('category', 'board')->get();
        foreach ($cohorts as $key => $cohort) {
            $this->authorize('view', $cohort);
        }
        return view('admin.boards', compact('cohorts'));
    }

    public function activeMembers(Cohort $cohort){
        $this->authorize('update', $cohort);
        return view('admin.members.members', compact('cohort'));
    }

    public function requests(Cohort $cohort){
        $this->authorize('update', $cohort);
        return view('admin.members.requests', compact('cohort'));
    }

    public function alumni(Cohort $cohort){
        $this->authorize('update', $cohort);
        return view('admin.members.alumni', compact('cohort'));
    }

    public function membersDashboard(Cohort $cohort){
        $this->authorize('update', $cohort);
        return view('admin.members.member-dashboard', compact('cohort'));
    }

    public function store(){
        $cohorts = Cohort::all();
        foreach ($cohorts as $key => $cohort) {
            $this->authorize('update', $cohort);
        }
        // $this->authorize('create');
        $message = [];
        $data = request()->validate([
            'image' => ['image'],
            'name' => ['required', 'max:255'],
            'about' => ['required'],
            'category' => 'required',
            'img' => 'string'
        ]);
        if (request('image') != null) {
            $imagePath = request('image')->store('storage/cohort/coverImages', 'public');
        }else{
            $imagePath = "storage/default/avatar.png";
        }
        try {
            Cohort::create([
                'image' => $imagePath,
                'name' => $data['name'],
                'about' => $data['about'],
                'category' => $data['category']
            ]);
            $message['success'] = $data['name'] . ' created successfully.';
        } catch (\Throwable $th) {
            //throw $th;
            $message['error'] = $data['name'] . ' not created.';
        }
        $messageBag = new MessageBag($message);
        if ($data['category'] == 'ministry') {
            return redirect()->route($this->template[0])->withErrors($messageBag);
        }else if ($data['category'] == 'committee') {
            return redirect()->route($this->template[1])->withErrors($messageBag);
        }else{
            return redirect()->route($this->template[2])->withErrors($messageBag);
        }
    }

    public function update(Cohort $cohort){
        $this->authorize('update', $cohort);
        $message = [];
        if (request('name') != null) {
            $data = request()->validate([
                'image' => ['image'],
                'name' => ['required', 'max:255'],
                'about' => ['required'],
                'category' => 'required',
                'img' => 'string'
            ]);

            $previousImagePath = $cohort->image;

            if (request('image') != null) {
                $imagePath = request('image')->store('storage/cohort/coverImages', 'public');
            }else{
                $imagePath = $data['img'];
            }

            try {
                if($cohort->update([
                    'image' => $imagePath,
                    'name' => $data['name'],
                    'about' => $data['about'],
                    'category' => $data['category']
                ]) && $previousImagePath != $imagePath){
                    Storage::disk('public')->delete($previousImagePath);
                    $message['success'] = $data['name'] . ' Updated successfully.';
                }
            } catch (\Throwable $th) {
                //throw $th;
                    $message['error'] = $data['name'] . ' Update failed.';
            }
            $messageBag = new MessageBag($message);

            if ($cohort->category == 'ministry') {
                return redirect()->route($this->template[0])->withErrors($messageBag);
            }else if ($cohort->category == 'committee') {
                return redirect()->route($this->template[1])->withErrors($messageBag);
            }else{
                return redirect()->route($this->template[2])->withErrors($messageBag);
            }
        }else if(request('about') != null){
            $data = request()->validate([
                'about' => ['required'],
            ]);
            if($cohort->update(['about' => $data['about']])){
                $message['success'] = 'Content Updated successfully.';
            }else {
                $message['error'] = 'Content Updated failed.';
            }
            $messageBag = new MessageBag($message);
            return redirect()->route('cohort.edit', compact(('cohort')))->withErrors($messageBag);
        }else {
            $data = request()->validate([
                'policy' => ['required', 'file'],
            ]);
            $previousPolicyPath = $cohort->policy;
            $policyPath = request('policy')->store('storage/cohort/policies', 'public');
            if($cohort->update(['policy' => $policyPath]) && $previousPolicyPath != 'storage/default/avatar.png'){
                Storage::disk('public')->delete($previousPolicyPath);
                $message['success'] = 'Policy Updated successfully.';
            }else {
                $message['error'] = 'Policy Updated failed.';
            }
            $messageBag = new MessageBag($message);
            return redirect()->route('cohort.edit', compact(('cohort')))->withErrors($messageBag);
        }


    }

    public function delete(Cohort $cohort){
        $this->authorize('delete', $cohort);
        $message = [];
        $imagePath = $cohort->image;
        $name = $cohort->name;
        if($imagePath != 'storage/default/avatar.png'){
            if ($cohort->delete()) {
                Storage::disk('public')->delete($imagePath);
                $message['success'] = $name . ' deleted successfully.';
            }else {
                $message['error'] = $name . ' not deleted.';
            }

        }else {
            if ($cohort->delete()) {
                $message['success'] = $name . ' deleted successfully.';
            }else {
                $message['error'] = $name . ' not deleted.';
            }
            // $message['error'] = $name . ' not deleted.';
        }
        $messageBag = new MessageBag($message);

        if ($cohort->category == 'ministry') {
            return redirect()->route($this->template[0])->withErrors($messageBag);
        }else if ($cohort->category == 'committee') {
            return redirect()->route($this->template[1])->withErrors($messageBag);
        }else{
            return redirect()->route($this->template[2])->withErrors($messageBag);
        }
    }
}
