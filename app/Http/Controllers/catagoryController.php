<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Catagory;
use App\Http\Requests\Catagories\CreateRequestCatagory;

class catagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('catagory.index')->with('catagories',Catagory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catagory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequestCatagory $request)
    {

        Catagory::create([
          'name' => $request->name,
        ]);

        session()->flash('success','Catagory Created Successfully.');

        return redirect(route('catagory.index'));
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
    public function edit(Catagory $catagory)
    {
        return view('catagory.create')->with('catagory',$catagory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRequestCatagory $request, Catagory $catagory)
    {

        $catagory->update([
          'name' => $request->name,
        ]);

        session()->flash('success','Catagory Updated Successfully');

        return redirect(route('catagory.index',$catagory));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catagory $catagory)
    {
        $catagory->delete();

        session()->flash('success','Catagory deleted successfully.');

        return redirect(route('catagory.index'));
    }
}
