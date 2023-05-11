<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section5_tabla;
use App\Models\section3_categories;

include('InitialValues.php');


class Section5_tablasController extends Controller
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
        $categories = section3_categories::all();

        return view(
            'admin.section5_tabla.create',
            compact('categories')
        );
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
            'elemento' => 'required',
            'u_m' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'importe' => 'required',
            'descripcion' => 'required'
        ]);

        $section5_tabla = new section5_tabla;

        $section5_tabla->elemento = $request->elemento;
        $section5_tabla->u_m = $request->u_m;
        $section5_tabla->cantidad = $request->cantidad;
        $section5_tabla->precio = $request->precio;
        $section5_tabla->importe = $request->importe;
        $section5_tabla->descripcion = $request->descripcion;
        $section5_tabla->section3_category_id = $request->section3_category_id;

        $section5_tabla->save();
        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section5') . ' actualizada correctamente.');
        return redirect()->route('section5.edit', ['section5' => 1])->with('success', 'Sección ' . config('app.nav_section5') . ' actualizada correctamente.');
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
        $section5_tabla = section5_tabla::find($id);
        $section5_category_name = section3_categories::where('id', $section5_tabla->section3_category_id)->get();
        $categories = section3_categories::all();

        return view(
            'admin.section5_tabla.edit',
            compact('section5_tabla', 'categories', 'section5_category_name')
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
            'elemento' => 'required',
            'u_m' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'importe' => 'required',
            'descripcion' => 'required'
        ]);

        $section5_tabla = section5_tabla::find($id);
        $section5_tabla->elemento = $request->elemento;
        $section5_tabla->u_m = $request->u_m;
        $section5_tabla->cantidad = $request->cantidad;
        $section5_tabla->precio = $request->precio;
        $section5_tabla->importe = $request->importe;
        $section5_tabla->descripcion = $request->descripcion;
        $section5_tabla->section3_category_id = $request->section3_category_id;

        $section5_tabla->save();
        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section5') . ' actualizada correctamente.');
        return redirect()->route('section5.edit', ['section5' => 1])->with('success', 'Sección ' . config('app.nav_section5') . ' actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section5_tabla = section5_tabla::find($id);

        $section5_tabla->delete();
        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section5') . ' actualizada correctamente.');
        return redirect()->route('section5.edit', ['section5' => 1])->with('success', 'Sección ' . config('app.nav_section5') . ' actualizada correctamente.');
    }
}
