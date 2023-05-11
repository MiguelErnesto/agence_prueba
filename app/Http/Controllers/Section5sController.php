<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section5;
use App\Models\section5_tabla;
use App\Models\section3_categories;

include 'InitialValues.php';

class Section5sController extends Controller
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
        $section5 = section5::find($id);
        $section5_tabla = section5_tabla::all();
        $section3_categories = section3_categories::all();

        $contador = 0;
        $nombres_categ[$contador] = '';

        foreach ($section5_tabla as $section5_tab) {
            $categ = section3_categories::find(
                $section5_tab->section3_category_id
            );
            $nombres_categ[$contador] = $categ->name;
            $contador++;
        }

        return view(
            'admin.section5.edit',
            compact('section5', 'nombres_categ', 'section5_tabla')
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
        ]);

        $section5 = section5::find($id);
        $section5->description = $request->description;
        $section5->save();
        return redirect()
            ->route('home')
            ->with(
                'success',
                'Sección ' .
                    config('app.nav_section5') .
                    ' actualizada correctamente.'
            );
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
