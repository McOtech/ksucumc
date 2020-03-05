<?php

namespace App\Http\Controllers;
use App\Http\Requests\Year\CreateYearRequest;
use App\Http\Requests\Year\UpdateYearRequest;
use App\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('year.index');
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


    public function list()
    {
        return view('year.list')->with('year', year::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateYearRequest $request)
    {
        year::create([
            'year' => $request->year
          ]);

          session()->flash('success', 'year created successfully.');

          return redirect(route('year.list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        return view('year.index')->with('year', $year);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateYearRequest $request, Year $year)
    {
        $year->update([
            'year' => $request->year
          ]);

          session()->flash('success', 'year updated successfully.');

          return redirect(route('year.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        if ($year->leaders->count() > 0) {
            session()->flash('error', 'Year cannot be deleted, because it is associated to some leaders.');

            return redirect()->back();
          }

        $year->delete();

        session()->flash('success', 'year deleted successfully.');

        return redirect(route('year.list'));
    }
}
