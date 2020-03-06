<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Membership;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class MembershipController extends Controller
{
    public function create(){
        $cohorts = Cohort::all();
        // $leaders = DB::table('memberships')->where('post', '<>', 'member')->get();
        $leaders = Membership::where('post', '<>', 'member')->get();
        // dd($leaders);
        return view('admin.leaders', compact('cohorts'))->with(compact('leaders'));
    }

    public function show(User $user){
        $profile = $user->profile;
        return view('admin.user-profile', compact('profile'));
    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'username' => ['required', 'string:255'],
            'cohort_id' => ['required', 'integer'],
            'post' => ['required', 'string']
        ]);
        $right = 'request';
        if (request('right') != null) {
            $right = request('right');
        }
        $user = User::where('username', $data['username'])->first();
        try {
            if($user->profile->phone != null){
                if ($data['post'] == 'admin') {
                    $cohorts = Cohort::all();
                    foreach ($cohorts as $key => $cohort) {
                        Membership::create([
                            'user_id' => $user->id,
                            'cohort_id' => $cohort->id,
                            'post' => $data['post'],
                            'right' => $right
                        ]);
                    }
                }else {
                    Membership::create([
                        'user_id' => $user->id,
                        'cohort_id' => $data['cohort_id'],
                        'post' => $data['post'],
                        'right' => $right
                    ]);
                }

                $message['success'] = 'Request sent successfully';
            }else {
                $message['error'] = 'Request sent failed. Fill the information required in profile then try again.';
            }
        } catch (\Throwable $th) {
            $message['error'] = 'Request sent failed ' . $th->getMessage();
        }
        $messageBag = new MessageBag($message);


        if (request('control') != null) {
            return redirect()->route('profile.edit', ['user' => auth()->user()->id])->withErrors($messageBag);
        }else {
            // dd($user->profile->phone);
            return redirect()->route('leader.create')->withErrors($messageBag);
        }
    }

    public function update(Membership $leader){
        $message = [];
        if (request('post') != null) {
            $data = request()->validate([
                'right' => ['required', 'string'],
                'post' => ['required', 'string']
            ]);
            if ($data['post'] == 'admin') {
                try {
                    Membership::where('user_id', $leader->user_id)->update([
                        'right' => $data['right'],
                        'post' => $data['post']
                    ]);
                    $message['success'] = 'Leadership Update Successful.';
                } catch (\Throwable $th) {
                    $message['error'] = 'Leadership Update Failed.';
                }

            }else {
                if($leader->update([
                    'right' => $data['right'],
                    'post' => $data['post']
                ])){
                    $message['success'] = 'Leadership Update Successful.';
                }else {
                    $message['error'] = 'Leadership Update Failed.';
                }
            }

            $messageBag = new MessageBag($message);
            return redirect()->route('profile.edit', ['user' => auth()->user()->id])->withErrors($messageBag);
        }else {
            $data = request()->validate([
                'right' => ['required', 'string']
            ]);
            if($leader->update([
                'right' => $data['right']
            ])){
                $message['success'] = 'Leadership Update Successful.';
            }else {
                $message['error'] = 'Leadership Update Failed.';
            }
            $messageBag = new MessageBag($message);
            return redirect()->route('leader.create')->withErrors($messageBag);
        }

    }

    public function updateMember($cohort, $member){
        $message = [];
        $data = request()->validate([
            'right' => ['required', 'string'],
            'post' => ['string']
        ]);
        if (request('post') != null) {
            if(Membership::where(['cohort_id' => $cohort, 'id' => $member])->update([
                'right' => $data['right'],
                'post' => $data['post']
            ])){
                $message['success'] = 'Membership Update Successful.';
            }else {
                $message['error'] = 'Membership Update Failed.';
            }
            $messageBag = new MessageBag($message);
            return redirect()->back()->withErrors($messageBag);
        }else{
            if(Membership::where(['cohort_id' => $cohort, 'id' => $member])->update([
                'right' => $data['right']
            ])){
                $message['success'] = 'Membership Update Successful.';
            }else {
                $message['error'] = 'Membership Update Failed.';
            }
        }
        $messageBag = new MessageBag($message);

        $cohort = Cohort::findOrFail($cohort);
        return redirect()->route('requests.show', compact('cohort'))->withErrors($messageBag);
    }

    public function delete(Membership $leader){
        $message = [];
        if ($leader->post == 'admin') {
            $user_id = $leader->user_id;

            try {
                Membership::where('user_id', $user_id)->delete();
                $message['success'] = 'Leadership Terminated.';
            } catch (\Throwable $th) {
                $message['error'] = 'Leadership Terminate Failed.';
            }
        }else {
            if($leader->delete()){
                $message['success'] = 'Leadership Terminated.';
            }else {
                $message['error'] = 'Leadership Terminate Failed.';
            }
        }

        $messageBag = new MessageBag($message);
        return redirect()->route('leader.create')->withErrors($messageBag);
    }

    public function deleteMember($cohort, $member){
        $message = [];
        if(Membership::where(['id' => $member, 'cohort_id' => $cohort])->delete()){
            $message['success'] = 'Membership Terminated.';
        }else {
            $message['error'] = 'Membership Terminated Failed.';
        }
        $messageBag = new MessageBag($message);
        $cohort = Cohort::findOrFail($cohort);
        if (request('control') == null) {
            return redirect()->back()->withErrors($messageBag);
        }
        return redirect()->route('requests.show', compact('cohort'))->withErrors($messageBag);
    }
}
