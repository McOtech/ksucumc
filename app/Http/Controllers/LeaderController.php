<?php

namespace App\Http\Controllers;
use App\Leader;

use Illuminate\Http\Request;
use App\Http\Requests\Leders\CreateLederRequest;
use App\Http\Requests\Leders\UpdateLederRequest;
use App\Position;
use App\Year;

class LeaderController extends Controller
{
    public function __construct()
    {
      $this->middleware('VerifyPositionCount')->only(['index', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leaders.index')->with('position', Position::all())->with('years', Year::all());
    }


    public function list()
    {
        return view('leaders.list')->with('leader', Leader::all())->with('years', Year::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLederRequest $request)
    {
        // dd($request);

        // upload the image to storage
        $image = $request->image->store('leaders');
        // create the post
        $leader = Leader::create([
          'name' => $request->name,
          'course' => $request->course,
          'description' => $request->description,
          'image' => $image,
          'position_id' => $request->position,
          'message' => $request->message,
        ]);

        if ($request->years) {
            $leader->years()->attach($request->years);
          }

        session()->flash('success', 'Leader Added successfully.');
        return redirect(route('list'));
    }


    public function show($id)
    {
        //
    }


    public function edit(Leader $leader)
    {
        return view('leaders.index')->with('leader', $leader)->with('position', Position::all())->with('years', Year::all());
    }


    public function update(UpdateLederRequest $request, Leader $leader)
    {
        $data = $request->only(['name', 'description', 'message', 'course']);
        // check if new image
        if ($request->hasFile('image')) {
          // uplload it
          $image = $request->image->store('leaders');
          // delete old one
          $leader->deleteImage();

          $data['image'] = $image;
        }

        if ($request->years) {
          $leader->years()->sync($request->years);
        }

        // update attributes
        $leader->update($data);

        // flash message
        session()->flash('success', 'Leader updated successfully.');

        // redirect user
        return redirect(route('list'));
    }


    public function trashed()
    {
      $trashed = Leader::onlyTrashed()->get();
      return view('leaders.list')->with('leader', $trashed);
    }


    public function destroy($id)
    {
        // $leader->delete();
        // return redirect(route('list'));

        $leader = Leader::withTrashed()->where('id', $id)->firstOrFail();

        if ($leader->trashed()) {
            $leader->deleteImage();
            $leader->forceDelete();
        } else {
            $leader->delete();
        }
        session()->flash('success', 'Leader deleted successfully.');

        return redirect()->back();

    }

      public function restore($id)
    {
      $leader = Leader::withTrashed()->where('id', $id)->firstOrFail();

      $leader->restore();

      session()->flash('success', 'Leader restored successfully.');

      return redirect()->back();
    }


}
