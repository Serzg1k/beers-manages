<?php

namespace App\Http\Controllers;

use App\Make;
use App\Type;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class MakeBeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makes = QueryBuilder::for(Make::query())
            ->allowedFilters([
                AllowedFilter::scope('type', 'hasTypes'),
            ])
            ->get();
        $types = Type::get();
        return view('makes.index',[
            'types' => $types,
            'makes' => $makes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('makes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
        ]);
        $make = new Make($validatedData);
        $make->save();
        return redirect()->route('makes.index')
            ->with('success','Product created successfully.');
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
    public function edit($id)
    {
        $make = Make::findOrFail($id);

        return view('makes.edit',
            [
                'make' => $make,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
        ]);
        $make = Make::findOrFail($id);
        $make->name = $validatedData['name'];
        $make->save();
        return redirect()->route('makes.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $make = Make::find($id);
        $make->delete();

        return redirect()->route('makes.index')
            ->with('success', 'Make deleted!');
    }
}
