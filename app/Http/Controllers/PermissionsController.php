<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class PermissionsController extends Controller
{
    public function show(Permission $permission){

    }

    public function store(){
        $message = [];
        $data = request()->validate([
            'cohort_id' => ['required', 'string'],
            'right' => ['required', 'string']
        ]);
        try {
            Permission::create([
                'cohort_id' => $data['cohort_id'],
                'right' => $data['right']
            ]);
            $message['success'] = 'Permission granted';
        } catch (\Throwable $th) {
            $message['error'] = 'Error granting permission.';
        }

        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }

    public function delete(Permission $permission){
        $message = [];
        if($permission->delete()){
            $message['success'] = 'Permission denied';
        }else {
            $message['error'] = 'Error denying permission.';
        }
        $messageBag = new MessageBag($message);
        return redirect()->back()->withErrors($messageBag);
    }
}
