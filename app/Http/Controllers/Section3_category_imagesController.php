<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section3_category_images;
use App\Models\section3_categories;

include('InitialValues.php');

class Section3_category_imagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $section3_category_images = section3_category_images::where('section3_category_id', $request->section3_category_id)->get();
        $section3_category_name = section3_categories::where('id', $request->section3_category_id)->get();

        return view(
            'admin.section3_category_images.index',
            compact('section3_category_images', 'section3_category_name')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $section3_category = section3_categories::where('name', $request->section3_category_image)->get();
        $categories = section3_categories::all();

        return view(
            'admin.section3_category_images.create',
            compact('section3_category', 'categories')
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
            'category_id' => 'required',
            'image' => 'required'
        ]);

        $section3_category_images = new section3_category_images;

        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $file_name =  $file->getClientOriginalName();
            $ruta = public_path("images/" . $file_name);
            $ext = $file->guessExtension();

            if (($ext == "jpeg") or ($ext == "png") or ($ext == "jpg") or ($ext == "gif") or ($ext == "svg")) {
                if (file_exists($ruta)) {
                    !unlink($ruta);
                }
                copy($file, $ruta);
                $section3_category_images->image = $file_name;
            } else {
                return redirect()->route('section3_category_images.create')->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $section3_category_images->section3_category_id = $request->category_id;

        $section3_category_images->save();

        return redirect()->route('section3.edit', ['section3' => 1])->with('success', 'Sección ' . config('app.nav_section3') . ' actualizada correctamente.');
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
        $section3_category_images = section3_category_images::find($id);
        $section3_category_name = section3_categories::where('id', $section3_category_images->section3_category_id)->get();
        $categories = section3_categories::all();

        return view(
            'admin.section3_category_images.edit',
            compact('section3_category_images', 'categories', 'section3_category_name')
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
            'category_id' => 'required'
        ]);

        $section3_category_images = section3_category_images::find($id);

        if ($request->hasFile("url_img")) {
            $file = $request->file("url_img");
            $file_name =  $file->getClientOriginalName();
            $ruta = public_path("images/" . $file_name);
            $ext = $file->guessExtension();

            if (($ext == "jpeg") or ($ext == "png") or ($ext == "jpg") or ($ext == "gif") or ($ext == "svg")) {
                if (file_exists($ruta)) {
                    !unlink($ruta);
                }
                copy($file, $ruta);
                $section3_category_images->image = $file_name;
            } else {
                return redirect()->route('section3_category_images.edit', ['section3_category_images' => 1])->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $section3_category_images->section3_category_id = $request->category_id;

        $section3_category_images->save();
        return redirect()->route('section3.edit', ['section3' => 1])->with('success', 'Sección ' . config('app.nav_section3') . ' actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section3_category_images = section3_category_images::find($id);

        $section3_category_images->delete();
        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section3') . ' actualizada correctamente.');
        return redirect()->route('section3.edit', ['section3' => 1])->with('success', 'Sección ' . config('app.nav_section3') . ' actualizada correctamente.');
    }
}
