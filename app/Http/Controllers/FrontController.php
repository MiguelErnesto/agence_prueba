<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\main;
use App\Models\front_preview;
use App\Models\navbar;
use App\Models\section1;
use App\Models\section2;
use App\Models\section2_img;
use App\Models\section3;
use App\Models\section3_categories;
use App\Models\section3_category_images;
use App\Models\section4;
use App\Models\section4_images;
use App\Models\section5;
use App\Models\section5_tabla;
use App\Models\section6;
use App\Models\social_network;
use App\Models\footer;
use App\Models\caoAcompanhamentoSistema;

include 'InitialValues.php';

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = caoAcompanhamentoSistema::all();
        return view('agence.con_desempenho', compact('query'));
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
        //
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
        //
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
