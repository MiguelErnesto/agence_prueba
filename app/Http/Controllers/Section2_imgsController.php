<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section2_img;

include('InitialValues.php');

class Section2_imgsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section2_imgs =  section2_img::all();
        return view('admin.section2_img.index', ['section2_imgs' => $section2_imgs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.section2_img.create');
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $section2_img = new section2_img;

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
                $section2_img->image = $file_name;
            } else {
                return redirect()->route('section2_img.create')->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $section2_img->title = $request->title;
        $section2_img->description = $request->description;
        $section2_img->image = $request->image;

        $section2_img->save();

        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section2') . ' actualizada correctamente.');
        return redirect()->route('section2.edit', ['section2' => 1])->with('success', 'Sección ' . config('app.nav_section2') . ' actualizada correctamente.');
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
        $section2_img = section2_img::find($id);
        return view('admin.section2_img.edit', ['section2_img' => $section2_img]);
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
            'title' => 'required',
            'description' => 'required'
        ]);

        $section2_img = section2_img::find($id);

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
                $section2_img->image = $file_name;
            } else {
                return redirect()->route('section2_img.edit', ['section2_img' => 1])->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $section2_img->title = $request->title;
        $section2_img->description = $request->description;

        $section2_img->save();
        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section2') . ' actualizada correctamente.');
        return redirect()->route('section2.edit', ['section2' => 1])->with('success', 'Sección ' . config('app.nav_section2') . ' actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section2_img = section2_img::find($id);

        $section2_img->delete();
        //return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section2') . ' actualizada correctamente.');
        return redirect()->route('section2.edit', ['section2' => 1])->with('success', 'Sección ' . config('app.nav_section2') . ' actualizada correctamente.');
    }
}
