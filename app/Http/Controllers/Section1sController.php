<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section1;

include('InitialValues.php');

class Section1sController extends Controller
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
        $section1 = section1::find($id);
        return view('admin.section1.edit', ['section1' => $section1]);
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
            'title1' => 'required',
            'title2' => 'required',
            'lb_btn_sctn2' => 'required'
        ]);

        $section1 = section1::find($id);

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
                $section1->image = $file_name;
            } else {
                return redirect()->route('section1.edit', ['section1' => 1])->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $section1->title1 = $request->title1;
        $section1->title2 = $request->title2;
        $section1->lb_btn_sctn2 = $request->lb_btn_sctn2;

        $section1->save();
        return redirect()->route('home')->with('success', 'Sección ' . config('app.nav_section1') . ' actualizada correctamente.');
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
