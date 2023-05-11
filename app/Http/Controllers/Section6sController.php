<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section6;

include('InitialValues.php');


class Section6sController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
        $section6 = section6::find($id);
        return view(
            'admin.section6.edit',
            compact('section6')
        );
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
        $request->validate([
            'description' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'location' => 'required'
        ]);

        $section6 = section6::find($id);
        $section6->description = $request->description;
        $section6->phone = $request->phone;
        $section6->email = $request->email;
        $section6->location = $request->location;

        $section6->save();
        return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section6') . ' actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
