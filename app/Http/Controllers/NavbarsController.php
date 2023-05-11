<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\navbar;

include('InitialValues.php');

class NavbarsController extends Controller
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
        $navbar = navbar::find($id);
        return view('admin.navbar.edit', ['navbar' => $navbar]);
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
            'item1' => 'required',
            'item2' => 'required',
            'item3' => 'required',
            'item4' => 'required',
            'item5' => 'required',
            'item6' => 'required'
        ]);

        $navbar = navbar::find($id);
        $navbar->item1 = $request->item1;
        $navbar->item2 = $request->item2;
        $navbar->item3 = $request->item3;
        $navbar->item4 = $request->item4;
        $navbar->item5 = $request->item5;
        $navbar->item6 = $request->item6;

        // (isset($_POST['nav_chk1'])) $navbar->chk1 = 1;
        if ($request->nav_chk1 != null) $navbar->chk1 = 1;
        else $navbar->chk1 = 0;
        if ($request->nav_chk2 != null) $navbar->chk2 = 1;
        else $navbar->chk2 = 0;
        if ($request->nav_chk3 != null) $navbar->chk3 = 1;
        else $navbar->chk3 = 0;
        if ($request->nav_chk4 != null) $navbar->chk4 = 1;
        else $navbar->chk4 = 0;
        if ($request->nav_chk5 != null) $navbar->chk5 = 1;
        else $navbar->chk5 = 0;
        if ($request->nav_chk6 != null) $navbar->chk6 = 1;
        else $navbar->chk6 = 0;

        $navbar->save();
        return redirect()->route('home')->with('success', 'Menu Superior actualizado correctamente.');
        //return redirect()->route('navbar.edit', ['navbar' => $navbar])->with('success', 'Menu Superior actualizado correctamente.');
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
