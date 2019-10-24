<?php

namespace App\Http\Controllers;

use App\Beer;
use App\Make;
use App\Type;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beers = QueryBuilder::for(Beer::query())
//            ->with([
//                'make',
//                'type',
//            ])
            ->allowedFilters(['name', 'make_id', 'type_id'])
            ->get();
        $makes = Make::get();
        $types = Type::get();
        return view('beers.index',[
            'beers' => $beers,
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
        $makes = Make::get();
        $types = Type::get();

        return view('beers.create',
            [
                'types' => $types,
                'makes' => $makes
            ]);
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
            'description' => ['required', 'string'],
            'make_id' => ['required', 'integer'],
            'type_id' => ['required', 'integer'],
        ]);
        $beer = new Beer();
        $beer->fill($validatedData);
        $beer->make()->associate($validatedData['make_id']);
        $beer->type()->associate($validatedData['type_id']);
        $beer->save();
        return redirect()->route('beers.index')
            ->with('success','Beer created successfully.');
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
        $beer = Beer::findOrFail($id);
        $makes = Make::get();
        $types = Type::get();
        $beerMake = $beer->make ? $beer->make->id : 0;
        $beerType = $beer->type ? $beer->type->id : 0;

        return view('beers.edit',
            [
                'beer' => $beer,
                'beerMake' => $beerMake,
                'beerType' => $beerType,
                'types' => $types,
                'makes' => $makes
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
            'description' => ['required', 'string'],
            'make_id' => ['required', 'integer'],
            'type_id' => ['required', 'integer'],
        ]);
        $beer = Beer::findOrFail($id);
        $beer->fill($validatedData);
        $beer->make()->associate($validatedData['make_id']);
        $beer->type()->associate($validatedData['type_id']);
        $beer->save();
        return redirect()->route('beers.index')
            ->with('success','Beer created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beer = Beer::find($id);
        $beer->delete();

        return redirect()->route('beers.index')
            ->with('success', 'Beer deleted!');
    }
}
