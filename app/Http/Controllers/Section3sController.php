<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section3;
use App\Models\section3_categories;
use App\Models\section3_category_images;

include('InitialValues.php');

class Section3sController extends Controller
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
        $section3 = section3::find($id);
        $section3_categories = section3_categories::all();
        //$section3_category_images = section3_category_images::all();
        return view('admin.section3.edit', ['section3' => $section3], ['section3_categories' => $section3_categories]);
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
            'description' => 'required'
        ]);

        $section3 = section3::find($id);
        $section3->description = $request->description;
        $section3->save();
        return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section3') . ' actualizada correctamente.');
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
