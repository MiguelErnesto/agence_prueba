<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section4_images;

include('InitialValues.php');

class Section4_imagesController extends Controller
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
        return view('admin.section4_images.create');
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
            'image' => 'required',
            'name' => 'required',
            'role' => 'required',
        ]);

        $section4_images = new section4_images;

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
                $section4_images->image = $file_name;
            } else {
                return redirect()->route('section4_images.create')->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $section4_images->name = $request->name;
        $section4_images->role = $request->role;

        $section4_images->save();

        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section4') . ' actualizada correctamente.');
        return redirect()->route('section4.edit', ['section4' => 1])->with('success', 'Sección ' . config('app.nav_section4') . ' actualizada correctamente.');
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
        $section4_images = section4_images::find($id);
        return view('admin.section4_images.edit', ['section4_images' => $section4_images]);
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
            'name' => 'required',
            'role' => 'required',
        ]);

        $section4_images = section4_images::find($id);

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
                $section4_images->image = $file_name;
            } else {
                return redirect()->route('section4_images.edit', ['section4_images' => 1])->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $section4_images->name = $request->name;
        $section4_images->role = $request->role;

        $section4_images->save();
        //return redirect()->route('home')->with('success', 'Sección  ' . config('app.nav_section4') . '  actualizada correctamente.');
        return redirect()->route('section4.edit', ['section4' => 1])->with('success', 'Sección  ' . config('app.nav_section4') . '  actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section4_images = section4_images::find($id);

        $section4_images->delete();
        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section4') . ' actualizada correctamente.');
        return redirect()->route('section4.edit', ['section4' => 1])->with('success', 'Sección ' . config('app.nav_section4') . ' actualizada correctamente.');
    }
}
