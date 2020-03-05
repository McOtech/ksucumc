<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\CohortImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class CohortImageController extends Controller
{
    public function show(Cohort $cohort){
        return view('ministries.gallery', compact('cohort'))->with(['category' => 'cohort']);
    }

    public function create(Cohort $cohort){
        return view('admin.cohort-gallery', compact('cohort'));
    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'image' => ['required', 'image'],
            'cohort_id' => ['required', 'string'],
            'title' => ['required', 'string']
        ]);

        $imagePath = request('image')->store('storage/images/cohort/' . $data['cohort_id'], 'public');
        try{
            CohortImage::create([
                'image' => $imagePath,
                'cohort_id' => $data['cohort_id'],
                'title' => $data['title']
            ]);
            $message['success'] = 'Image saved successfully.';
        }catch(Exception $e){
            $message['error'] = 'Image not saved';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function update(CohortImage $cohortImage){
        $message = [];
        $data = request()->validate([
            'image' => ['image'],
            'title' => ['required', 'string']
        ]);
        $previousImagePath = $cohortImage->image;
        if (request('image') != null) {
            $imagePath = request('image')->store('storage/images/cohort/' . $cohortImage->cohort_id, 'public');
            if ($cohortImage->update([
                'image' => $imagePath,
                'title' => $data['title']
            ]) && $previousImagePath != 'storage/default/avatar.png') {
                Storage::disk('public')->delete($previousImagePath);
                $message['success'] = 'Image updated successfully';
            }else {
                $message['error'] = 'Image update failed';
            }
        }else {
            if($cohortImage->update([
                'image' => $previousImagePath,
                'title' => $data['title']
            ])){
                $message['success'] = 'Image updated successfully';
            }else {
                $message['error'] = 'Image update failed.';
            }
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function delete(CohortImage $cohortImage){
        $previousImagePath = $cohortImage->image;
        if ($cohortImage->delete() && $previousImagePath != 'storage/default/avatar.png') { //if ($cohortImage->delete())
            Storage::disk('public')->delete($previousImagePath);
            $message['success'] = 'Image deleted successfully';
        }else {
            $message['error'] = 'Image delete failed.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }
}
