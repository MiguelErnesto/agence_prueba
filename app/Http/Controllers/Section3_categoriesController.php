<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section3_categories;
use App\Models\section3_category_images;

include('InitialValues.php');

class Section3_categoriesController extends Controller
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
        return view('admin.section3_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $section3_categories = new section3_categories;
        $section3_categories->name = $request->name;
        $section3_categories->save();

        //return redirect()->route('home')->with('success', 'Categoría ' . $section3_categories->name . ' creada satisfactoriamente.');
        return redirect()->route('section3.edit', ['section3' => 1])->with('success', 'Categoría ' . $section3_categories->name . ' creada satisfactoriamente.');
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
        $section3_categories = section3_categories::find($id);
        return view('admin.section3_categories.edit', ['section3_categories' => $section3_categories]);
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
            'name' => 'required'
        ]);

        $section3_categories = section3_categories::find($id);
        $section3_categories->name = $request->name;
        $section3_categories->save();
        //return redirect()->route('home')->with('success', 'Categoría "' . $section3_categories->name  . '" actualizada correctamente.');
        return redirect()->route('section3.edit', ['section3' => 1])->with('success', 'Categoría "' . $section3_categories->name  . '" actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section3_categories = section3_categories::find($id);

        $section3_categories->delete();

        //return redirect()->route('home')->with('success', 'Categoría ' . $section3_categories->name . ' eliminada correctamente.');
        return redirect()->route('section3.edit', ['section3' => 1])->with('success', 'Categoría ' . $section3_categories->name . ' eliminada correctamente.');
    }
}
