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
        $section1 = section1::all();

        $section2 = section2::all();
        $section2_imgs = section2_img::all();

        if ($section2_imgs->isEmpty()) {
            config(['app.nav_section2_no_empty' => 0]);
        } else {
            config(['app.nav_section2_no_empty' => 1]);
        }

        $section3 = section3::all();
        $section3_categories = section3_categories::all();
        $section3_category_images = section3_category_images::all();

        $array_categories[0] = '';
        foreach ($section3_categories as $section3_ctg) {
            $array_categories[$section3_ctg->id] = $section3_ctg->name;
        }

        $section4 = section4::all();
        $section4_images = section4_images::all();

        if ($section4_images->isEmpty()) {
            config(['app.nav_section4_no_empty' => 0]);
        } else {
            config(['app.nav_section4_no_empty' => 1]);
        }

        $section5 = section5::all();
        $section5_tabla = section5_tabla::all();

        $section6 = section6::all()[0];

        $footer = footer::all()[0];

        $social_network = social_network::all();

        return view(
            'welcome',
            compact(
                'section1',
                'section2',
                'section2_imgs',
                'section3',
                'section3_categories',
                'section3_category_images',
                'section4',
                'section4_images',
                'section5',
                'section5_tabla',
                'array_categories',
                'section6',
                'footer',
                'social_network'
            )
        );
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
